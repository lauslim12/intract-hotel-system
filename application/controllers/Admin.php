<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Hotel_model');
    $this->load->model('Order_model');
    $this->load->model('Room_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  public function guard($data)
  {
    if(empty($data)) {
      redirect('admin');
    }
  }

  public function index() 
  {
    if($this->User_model->isAdmin() == 1) {
      $data = call_frontend_admin($this);
      $this->load->view('admin', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showData() 
  {
    if($this->User_model->isAdmin() == 1) {
      $data = call_frontend_admin($this);
      $data['user'] = $this->User_model->getUserData($this->session->userdata('username'));
      $data['hotels'] = $this->Hotel_model->getHotels();
      $this->load->view('pages/admin/showData', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showUsers()
  {
    if($this->User_model->isAdmin() == 1) {
      $data = call_frontend_admin($this);
      $data['users'] = $this->User_model->getUsers();
      $this->load->view('pages/admin/showUsers', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showOrders()
  {
    if($this->User_model->isAdmin() == 1) {
      $data = call_frontend_admin($this);
      $data['orders'] = $this->Order_model->getOrders();
      $this->load->view('pages/admin/showOrders', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showDetailHotel()
  {
    if($this->User_model->isAdmin() == 1) {
      $id = $this->uri->segment(3);
      $data = call_frontend_admin($this);
      $data['hotel'] = $this->Hotel_model->getHotelEssentialData($id);
      $data['headlines'] = $this->Hotel_model->getHotelHeadlines($id);
      $data['features'] = $this->Hotel_model->getHotelFeatures($id);
      $this->guard($data['hotel']);
      $this->load->view('pages/admin/showDetailHotel', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showNewHotel($errorArray = null)
  {
    if($this->User_model->isAdmin() == 1) {
      $data = call_frontend_admin($this);
      $data['error_image'] = $errorArray;
      $this->load->view('pages/admin/showNewHotel', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showEditHotel($id = NULL)
  {
    if($this->User_model->isAdmin() == 1) {
      if($id === NULL) {
        $id = $this->uri->segment(3);
      }

      $data = call_frontend_admin($this);
      $data['hotel'] = $this->Hotel_model->getHotelEssentialData($id);
      $data['headlines'] = $this->Hotel_model->getHotelHeadlines($id);
      $data['features'] = $this->Hotel_model->getHotelFeatures($id);
      $this->guard($data['hotel']);
      $this->load->view('pages/admin/showEditHotel', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showEditRoom()
  {
    if($this->User_model->isAdmin() == 1) {
      $id = $this->uri->segment(3);
      $data = call_frontend_admin($this);
      $data['rooms'] = $this->Room_model->getRoom($id);
      $data['hotel_id'] = $id;
      $this->guard($data['rooms']);
      $this->load->view('pages/admin/showEditRoom', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function validateHotel($marker)
  {
    $this->form_validation->set_rules('name', 'Hotel Name', 'required|min_length[5]', array(
      'required' => "You must provide a clear hotel name!",
      'min_length' => "Minimum characters are five!"
    ));
    
    $this->form_validation->set_rules('location', 'Location', 'required', array(
      'required' => "You must provide a location!"
    ));

    $this->form_validation->set_rules('star', 'Star', 'trim|required|numeric', array(
      'required' => "Please fill the star of the hotel!",
      'numeric' => "Star must be a numeric value!"
    ));

    $this->form_validation->set_rules('headline', 'Headline', 'required|min_length[10]|max_length[60]', array(
      'required' => "You must fill the headline of the hotel!",
      'min_length' => "Minimum 10 characters are needed!",
      'max_length' => "Maximum is 60 characters!"
    ));

    $this->form_validation->set_rules('description', 'Description', 'required|min_length[40]', array(
      'required' => "You must fill the description!",
      'min_length' => "Minimum 40 characters for the description!"
    ));

    if($marker === 1) {
      $this->form_validation->set_rules('room_name', 'Room Name', 'required', array(
        'required' => "You must fill the room name!"
      ));
  
      $this->form_validation->set_rules('room_count', 'Room Count', 'required|numeric', array(
        'required' => "You have to fill the number of available rooms!",
        'numeric' => "The number of available rooms has to be numeric in value!"
      ));
  
      $this->form_validation->set_rules('price', 'Price', 'required|numeric', array(
        'required' => "You have to fill the number of the room price!",
        'numeric' => "The price has to be numeric in value!"
      ));
  
      $this->form_validation->set_rules('feature', 'Hotel Feature', 'required|min_length[5]|max_length[40]', array(
        'required' => "You have to fill the number of available rooms!",
        'min_length' => "Minimum length is five characters!",
        'max_length' => "Maximum length of a feature is 40 characters!"
      ));
    }
  }

  public function uploadImage($file, $path_img) 
  {
    if($path_img === 1) {
      $config['upload_path'] = './assets/images/hotel_pics/';
    }
    else if($path_img === 2) {
      $config['upload_path'] = './assets/images/hotel_headlines/';
    }
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 0;
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if(!$this->upload->do_upload($file)) {
      $data = ['error' => $this->upload->display_errors()];
      $this->showNewHotel($data);
      return;
    }
    else {
      $data = ['upload_data' => $this->upload->data()];
      $image_name = $data['upload_data']['file_name'];
      if($path_img === 1) {
        $path_to_img = "/assets/images/hotel_pics/" . $image_name;
      }
      else if($path_img === 2) {
        $path_to_img = "/assets/images/hotel_headlines/" . $image_name;
      }
      $this->upload = NULL;
      return $path_to_img;
    }
  }

  public function newHotel()
  {
    $this->validateHotel(0);
    if(!$this->form_validation->run()) {
      $this->showNewHotel();
      return;
    }

    $image = $this->uploadImage('picture', 1);
    $dataHotel = [
      'id' => '',
      'name' => $this->input->post('name', TRUE),
      'location' => $this->input->post('location', TRUE),
      'headline' => $this->input->post('headline', TRUE),
      'description' => $this->input->post('description', TRUE),
      'picture' => $image,
      'rating' => 0,
      'star' => $this->input->post('star', TRUE)
    ];

    $id = $this->Hotel_model->insertHotel($dataHotel);

    if($id != NULL) {
      $headline1 = $this->uploadImage('headline_picture_1', 2);
      $headline2 = $this->uploadImage('headline_picture_2', 2);
      $headline3 = $this->uploadImage('headline_picture_3', 2);

      $dataRooms = [
        'id' => '',
        'hotel_id' => $id,
        'room_name' => $this->input->post('room_name', TRUE),
        'room_count' => $this->input->post('room_count', TRUE),
        'price' => $this->input->post('price', TRUE)
      ];

      $dataFeature = [
        'hotel_id' => $id,
        'feature' => $this->input->post('feature')
      ];

      $dataHeadline = [
        [
          'hotel_id' => $id,
          'headline_picture' => $headline1
        ],
        [
          'hotel_id' => $id,
          'headline_picture' => $headline2
        ],
        [
          'hotel_id' => $id,
          'headline_picture' => $headline3
        ]
      ];

      $this->Hotel_model->insertHotelDetails($dataRooms, $dataFeature, $dataHeadline);
      redirect('admin');
    }
    else {
      redirect('admin');
    }
  }

  public function editHotel()
  {
    $id = $this->input->post('hotel_id', TRUE);

    if($_FILES['picture']['size'] === 0) {
      $image = $this->input->post('thumbnail_previous', TRUE);
    }
    else {
      $image = $this->uploadImage('picture', 1);
    }

    $this->validateHotel(1);
    if(!$this->form_validation->run()) {
      $this->showEditHotel($id);
      return;
    }

    $dataHotel = [
      'name' => $this->input->post('name', TRUE),
      'location' => $this->input->post('location', TRUE),
      'headline' => $this->input->post('headline', TRUE),
      'description' => $this->input->post('description', TRUE),
      'picture' => $image,
      'star' => $this->input->post('star', TRUE)
    ];

    $this->Hotel_model->editHotel($dataHotel, $id);
    redirect('admin/showData');
  }

  public function editHotelHeadlines()
  {
    $id = $this->input->post('hotel_id', TRUE);

    if($_FILES['headline_picture_1']['size'] === 0) {
      $headline1 = $this->input->post('prev_headline_pic_1', TRUE);
    }
    else {
      $headline1 = $this->uploadImage('headline_picture_1', 2);
    }

    if($_FILES['headline_picture_2']['size'] === 0) {
      $headline2 = $this->input->post('prev_headline_pic_2', TRUE);
    }
    else {
      $headline2 = $this->uploadImage('headline_picture_2', 2);
    }

    if($_FILES['headline_picture_3']['size'] === 0) {
      $headline3 = $this->input->post('prev_headline_pic_3', TRUE);
    }
    else {
      $headline3 = $this->uploadImage('headline_picture_3', 2);
    }

    $data = [
      [
        'hotel_id' => $id,
        'headline_picture' => $headline1
      ],
      [
        'hotel_id' => $id,
        'headline_picture' => $headline2
      ],
      [
        'hotel_id' => $id,
        'headline_picture' => $headline3
      ]
    ];

    $this->Hotel_model->editHotelHeadlines($data, $id);
    redirect('admin/showData');
  }

  public function editHotelFeatures()
  {
    $id = $this->input->post('hotel_id', TRUE);
    $maxLoop = $this->Hotel_model->getTotalHotelFeatures($id);
    $data = [];

    for($i = 0; $i < $maxLoop; $i++) {
      $className = "feature" . $i;
      $array = [
        'hotel_id' => $id,
        'feature' => $this->input->post($className, TRUE)
      ];
      array_push($data, $array);
    }

    $status = $this->Hotel_model->editHotelFeatures($data, $id);
    redirect('admin/showData');
  }

  public function deleteHotel()
  {
    $id = $this->input->post('hotel_id', TRUE);
    $status = $this->Hotel_model->deleteHotel($id);
    redirect('admin/showData');
  }

  public function newRoom()
  {
    $hotel_id = $this->input->post('hotel_id', TRUE);
    $data = [
      'id' => '',
      'hotel_id' => $hotel_id,
      'room_name' => $this->input->post('room_name', TRUE),
      'room_count' => $this->input->post('room_count', TRUE),
      'price' => $this->input->post('room_price', TRUE)
    ];

    $this->Room_model->newRoom($data);
    $path_to_redirect = 'admin/showEditRoom/' . $hotel_id;
    redirect($path_to_redirect);
  }

  public function editRoom()
  {
    $id = $this->input->post('room_id', TRUE);
    $hotel_id = $this->input->post('hotel_id', TRUE);

    $data = [
      'room_name' => $this->input->post('room_name', TRUE),
      'room_count' => $this->input->post('room_count', TRUE),
      'price' => $this->input->post('room_price', TRUE)
    ];

    $this->Room_model->editRoom($data, $id);
    $redirect_path = 'admin/showEditRoom/' . $hotel_id;
    redirect($redirect_path);
  }

  public function newFeature()
  {
    $hotel_id = $this->input->post('hotel_id', TRUE);
    $data = [
      'hotel_id' => $hotel_id,
      'feature' => $this->input->post('hotel_feature', TRUE)
    ];

    $this->Hotel_model->newFeature($data);
    redirect('admin');
  }

  public function deleteFeature()
  {
    $hotel_id = $this->input->post('hotel_id', TRUE);
    $feature = $this->input->post('feature', TRUE);
    
    $this->Hotel_model->deleteFeature($hotel_id, $feature);
    redirect('admin');
  }

  public function deleteRoom()
  {
    $id = $this->input->post('room_id', TRUE);
    $this->Room_model->deleteRoom($id);
    redirect('admin');
  }

  public function deleteUser()
  {
    $id = $this->input->post('user_id', TRUE);
    $this->User_model->deleteUser($id);
    redirect('admin/showUsers');
  }
}
