<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Hotel_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  public function profileValidations()
  {
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required', array(
      'required' => "You must provide a first name!"
    ));

    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required', array(
      'required' => "You must provide a last name!"
    ));

    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array(
      'required' => "You must provide an email!",
      'valid_email' => "Your email is not a valid email!",
      'is_unique' => "Your email must be unique!"
    ));
  }

  public function index() 
  {
    redirect('dashboard');
  }

  public function view() 
  {
    $username = $this->uri->segment(3);
    $data = call_frontend($this);
    $data['user_data'] = $this->User_model->getUserData($username);
    $data['user_hotel'] = $this->User_model->getUserTransactionsHotel($data['user_data']['id']);
    $data['user_rooms'] = $this->User_model->getUserTransactionsRooms($data['user_data']['id']);
    $data['transaction_data'] = $this->User_model->getUserTransactionData($data['user_data']['id']);
    $data['user_posts'] = $this->User_model->getNumberOfPosts($data['user_data']['id']);
    $data['user_likes'] = $this->User_model->getNumberOfLikes($data['user_data']['id']);

    if($data['user_data'] === FALSE) {
      redirect('welcome');
    }
    else {
      $this->load->view('profile', $data);
    }
  }

  public function uploadDisplayPicture() 
  {
    $config['upload_path'] = './assets/images/profile_pics/profile_users';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 5120;
    $config['max_width'] = 1920;
    $config['max_height'] = 1080;

    $this->load->library('upload', $config);

    if(!$this->upload->do_upload('fileToUpload')) {
      $error = ['error' => $this->upload->display_errors()];
      var_dump($error);
      //redirect('profile');
    }
    else {
      $data = ['upload_data' => $this->upload->data()];
      $image_name = $data['upload_data']['orig_name'];
      $path_to_img = "/assets/images/profile_pics/profile_users/" . $image_name;
      $this->changeDisplayPicture($path_to_img);
    }
  }

  public function changeDisplayPicture($path_to_img) 
  {
    $user_id = $this->session->userdata('user_id');
    $update_status = $this->User_model->setDisplayPicture($user_id, $path_to_img);

    if($update_status === TRUE) {
      $this->session->set_userdata('profile_pic', $path_to_img);
      redirect('profile/view');
    }
    else {
      redirect('profile/view');
    }
  }

  public function changeUserData()
  {
    $this->profileValidations();
    $user_id = $this->session->userdata('user_id');

    if($this->input->post('password') == '') {
      $password = $this->input->post('password_prev');
    }
    else {
      $password = $this->input->post('password', TRUE);
    }

    $data = [
      'first_name' => $this->input->post('first_name', TRUE),
      'last_name' => $this->input->post('last_name', TRUE),
      'email' => $this->input->post('email', TRUE),
      'password' => $password
    ];

    $update_status = $this->User_model->changeUserData($data, $user_id);
    $redirect_url = 'profile/view/' . $this->session->userdata('username');
    if($update_status === TRUE) {
      $this->session->set_userdata('first_name', $data['first_name']);
      $this->session->set_userdata('last_name', $data['last_name']);
      redirect($redirect_url);
    }
    else {
      redirect($redirect_url);
    }
  }

}
