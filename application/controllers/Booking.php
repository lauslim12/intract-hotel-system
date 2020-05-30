<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('Hotel_model');
    $this->load->model('Room_model');
    $this->load->model('Order_model');
    $this->load->model('Review_model');
    $this->load->model('User_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');
  }

  public function index() 
  {
    redirect('dashboard');
  }

  public function guard($array) 
  {
    if(empty($array)) {
      redirect('dashboard');
    }
  }

  public function setChosenHotel($hotel_id)
  {
    $this->session->set_userdata('chosen_hotel_id', $hotel_id);
  }

  public function unsetChosenHotel()
  {
    $this->session->unset_userdata('chosen_hotel_id');
  }

  public function isToday($str)
  {
    $now = new DateTime();
    $checkIn = new DateTime($str);
    $now->setTime(0, 0, 0);
    $checkIn->setTime(0, 0, 0);

    if($now > $checkIn) {
      $this->form_validation->set_message('isToday', 'The start date cannot be less than today!');
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function compareDate($string)
  {
    $startDate = strtotime($this->input->post('date_check_in', TRUE));
    $endDate = strtotime($this->input->post('date_check_out', TRUE));

    if($endDate > $startDate) {
      return TRUE;
    }
    else {
      $this->form_validation->set_message('compareDate', 'The end date cannot be lesser than the start date!');
      return FALSE;
    }
  }

  public function compareRooms($number)
  {
    $roomWanted = $this->input->post('room', TRUE);
    $hotel_id = $this->session->userdata('chosen_hotel_id');
    $roomAvailable = $this->Room_model->getRoomAvailableByRoomName($hotel_id, $roomWanted);

    if($number > $roomAvailable) {
      $this->form_validation->set_message('compareRooms', 'We do not have that many rooms!');
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function validateBooking()
  {
    $this->form_validation->set_rules('num_rooms', 'Number of Rooms', 'trim|required|numeric|callback_compareRooms', array(
      'required' => "Please fill out the number of rooms!",
      'numeric' => "The data you entered is not a numerical value!"
    ));

    $this->form_validation->set_rules('date_check_in', 'Check In Date', 'required|callback_isToday|callback_compareDate', array(
      'required' => "You have to fill the check in date!"
    ));

    $this->form_validation->set_rules('date_check_out', 'Check Out Date', 'required', array(
      'required' => "You have to fill the check out date!"
    ));
  }

  public function showDetail() 
  {
    $userReviewData = [];

    $data = call_frontend($this);
    $data['id'] = $this->uri->segment(3);
    $data['hotel'] = $this->Hotel_model->getHotel($data['id']);
    $data['headlines'] = $this->Hotel_model->getHotelHeadlines($data['id']);
    $data['rooms'] = $this->Room_model->getHotelRooms($data['id']);
    $data['votes'] = $this->Order_model->getNumberOfRatings($data['id']);
    $data['reviews'] = $this->Review_model->getAllReviews($data['id']);
    
    foreach($data['reviews'] as $review) {
      $singleUserData = $this->User_model->getUserDataById($review['added_by']);
      array_push($userReviewData, $singleUserData);
    }
    
    $data['user_reviews'] = $userReviewData;
    $this->guard($data['hotel']);
    $this->load->view('booking', $data);
  }

  public function showBooking($id = NULL) 
  {
    $data = call_frontend($this);

    if($id === NULL) {
      $data['id'] = $this->uri->segment(3);
    }
    else {
      $data['id'] = $id;
    }

    $this->setChosenHotel($data['id']);
    $data['hotel'] = $this->Hotel_model->getHotel($data['id']);
    $data['headlines'] = $this->Hotel_model->getHotelHeadlines($data['id']);
    $data['rooms'] = $this->Room_model->getHotelRooms($data['id']);
    $data['votes'] = $this->Order_model->getNumberOfRatings($data['id']);
    $this->guard($data['hotel']);
    $this->session->set_userdata('if_transaction_fail', current_url());
    $this->load->view('pages/bookingSection', $data);
  }

  public function confirmBooking() 
  {
    $id = $this->session->userdata('chosen_hotel_id');
    $this->validateBooking();
    if($this->form_validation->run() === FALSE) {
      $this->showBooking($id);
      return;
    }

    $data = call_frontend($this);

    $data['user_orders'] = [
      'id' => $id,
      'hotel_name' => $this->input->post('hotel_name', TRUE),
      'num_rooms' => $this->input->post('num_rooms', TRUE),
      'date_check_in' => $this->input->post('date_check_in', TRUE),
      'date_check_out' => $this->input->post('date_check_out', TRUE),
      'room' => $this->input->post('room', TRUE)
    ];

    $data['user_orders']['duration'] = strtotime($data['user_orders']['date_check_out']) - strtotime($data['user_orders']['date_check_in']);
    // Count the number of difference in days.
    $data['user_orders']['duration'] = $data['user_orders']['duration'] / (60 * 60 * 24);

    $row = $this->Hotel_model->getHotelPrice($id, $data['user_orders']['room']);
    $data['payment_price'] = $row->price * $data['user_orders']['duration'] * $data['user_orders']['num_rooms'];
    $data['room_id'] = $row->id;

    $this->setBookingData($data);
    $this->unsetChosenHotel();
    $this->load->view('pages/bookingConfirm', $data); 
  }

  // Session for userdata (security measures against parameter tampering)
  public function setBookingData($data) 
  {
    $session_data = [
      'hotel_id' => $data['user_orders']['id'],
      'hotel_name' => $data['user_orders']['hotel_name'],
      'num_rooms' => $data['user_orders']['num_rooms'],
      'duration' => $data['user_orders']['duration'],
      'date_check_in' => $data['user_orders']['date_check_in'],
      'date_check_out' => $data['user_orders']['date_check_out'],
      'room_name' => $data['user_orders']['room'],
      'payment_price' => $data['payment_price'],
      'room_id' => $data['room_id']
    ];
    
    $this->session->set_userdata($session_data);
  }

  public function clearBookingData() 
  {
    $unset = ['hotel_id', 'hotel_name', 'num_rooms', 'date_check_in', 'date_check_out', 'duration', 'payment_price', 'room_name', 'room_id'];
    $this->session->unset_userdata($unset);
  }

  public function orderHotel() 
  {
    $purchaseData = [
      'id' => '',
      'user_id' => $this->session->userdata('user_id'),
      'hotel_id' => $this->session->userdata('hotel_id'),
      'room_id' => $this->session->userdata('room_id'),
      'num_rooms' => $this->session->userdata('num_rooms'),
      'duration' => $this->session->userdata('duration'),
      'date_check_in' => $this->session->userdata('date_check_in'),
      'date_check_out' => $this->session->userdata('date_check_out'),
      'price' => $this->session->userdata('payment_price'),
      'rating' => NULL,
      'finished' => FALSE
    ];

    $this->clearBookingData();
    $this->Order_model->purchaseRoom($purchaseData);
  }

  public function finishBooking() 
  {
    $data = call_frontend($this);
    $data['id'] = $this->uri->segment(3);
    $data['rooms'] = $this->Hotel_model->getRoomByOrder($data['id']);
    $this->guard($data['rooms']);
    if($data['rooms']['user_id'] != $this->session->userdata('user_id') || $data['rooms']['finished'] == 1) {
      redirect('dashboard');
    }
    $this->load->view('pages/bookingFinish', $data);
  }

  public function confirmFinishBooking() 
  {
    $bookingFinishedData = [
      'id' => $this->input->post('order_id', TRUE),
      'room_id' => $this->input->post('room_id', TRUE),
      'num_rooms' => $this->input->post('ordered_rooms', TRUE),
      'payment' => $this->input->post('payment', TRUE),
      'rating' => $this->input->post('rating', TRUE)
    ];

    $result = $this->Hotel_model->getRoomByOrder($bookingFinishedData['id']);

    if($result['price'] != $bookingFinishedData['payment']) {
      $this->session->set_flashdata('error_message', 'Please pay the exact amount!');
      redirect('booking/finishBooking');
    }
    else {
      $this->Order_model->payHotel($bookingFinishedData['num_rooms'], $bookingFinishedData['room_id'], $bookingFinishedData['id'], $bookingFinishedData['rating'], $result['hotel_id']);
      $redirect_path = 'profile/view/' . $this->session->userdata('username');
      redirect($redirect_path);
    }

  }

}
