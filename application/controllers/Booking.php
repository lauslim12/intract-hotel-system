<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Hotel_model');
  }

  public function index() {
    redirect('dashboard');
  }

  public function showDetail() {
    $data = call_frontend($this);
    $data['id'] = $this->uri->segment(3);
    $data['hotel'] = $this->Hotel_model->getHotel($data['id']);
    $data['headlines'] = $this->Hotel_model->getHotelHeadlines($data['id']);
    $data['rooms'] = $this->Hotel_model->getHotelRooms($data['id']);

    // Guard to prevent parameter tampering.
    if($data['hotel'] === FALSE) {
      redirect('dashboard');
    }
    else {
      $this->load->view('booking', $data);
    }
  }

  public function showBooking() {
    $data = call_frontend($this);
    $data['id'] = $this->uri->segment(3);
    $data['hotel'] = $this->Hotel_model->getHotel($data['id']);
    $data['headlines'] = $this->Hotel_model->getHotelHeadlines($data['id']);
    $data['rooms'] = $this->Hotel_model->getHotelRooms($data['id']);

    $this->session->set_userdata('if_transaction_fail', current_url());

    $this->load->view('pages/bookingSection', $data);
  }

  public function confirmBooking() {
    $id = $this->input->post('hotel_id');
    $data = call_frontend($this);

    $data['user_orders'] = [
      'id' => $this->input->post('hotel_id'),
      'hotel_name' => $this->input->post('hotel_name'),
      'num_rooms' => $this->input->post('num_rooms'),
      'date_check_in' => $this->input->post('date_check_in'),
      'date_check_out' => $this->input->post('date_check_out'),
      'room' => $this->input->post('room')
    ];

    $data['user_orders']['duration'] = strtotime($data['user_orders']['date_check_out']) - strtotime($data['user_orders']['date_check_in']);
    // Count the number of difference in days.
    $data['user_orders']['duration'] = $data['user_orders']['duration'] / (60 * 60 * 24);

    $row = $this->Hotel_model->getHotelPrice($id, $data['user_orders']['room']);
    $data['payment_price'] = $row->price * $data['user_orders']['duration'] * $data['user_orders']['num_rooms'];
    $data['room_id'] = $row->id;

    $this->setBookingData($data);
    $this->load->view('pages/bookingConfirm', $data); 
  }

  // Session for userdata (security measures against parameter tampering)
  public function setBookingData($data) {
    $this->session->set_userdata('hotel_id', $data['user_orders']['id']);
    $this->session->set_userdata('hotel_name', $data['user_orders']['hotel_name']);
    $this->session->set_userdata('num_rooms', $data['user_orders']['num_rooms']);
    $this->session->set_userdata('duration', $data['user_orders']['duration']);
    $this->session->set_userdata('date_check_in', $data['user_orders']['date_check_in']);
    $this->session->set_userdata('date_check_out', $data['user_orders']['date_check_out']);
    $this->session->set_userdata('room_name', $data['user_orders']['room']);
    $this->session->set_userdata('payment_price', $data['payment_price']);
    $this->session->set_userdata('room_id', $data['room_id']);
  }

  public function clearBookingData() {
    $unset = ['hotel_id', 'hotel_name', 'num_rooms', 'date_check_in', 'date_check_out', 'duration', 'payment_price', 'room_name', 'room_id'];
    $this->session->unset_userdata($unset);
  }

  public function orderHotel() {
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
      'finished' => FALSE
    ];

    $this->clearBookingData();
    $this->Hotel_model->purchaseRoom($purchaseData);
  }

  public function finishBooking() {
    $data = call_frontend($this);
    $data['id'] = $this->uri->segment(3);
    $data['rooms'] = $this->Hotel_model->getRoomByOrder($data['id']);
    $this->load->view('pages/bookingFinish', $data);
  }

  public function confirmFinishBooking() {
    $bookingFinishedData = [
      'id' => $this->input->post('order_id'),
      'room_id' => $this->input->post('room_id'),
      'num_rooms' => $this->input->post('ordered_rooms'),
      'payment' => $this->input->post('payment'),
      'rating' => $this->input->post('rating')
    ];

    $result = $this->Hotel_model->getRoomByOrder($bookingFinishedData['id']);

    if($result['price'] != $bookingFinishedData['payment']) {
      $this->session->set_flashdata('error_message', 'Please pay the exact amount!');
      redirect('booking/finishBooking');
    }
    else {
      $this->Hotel_model->payHotel($bookingFinishedData['num_rooms'], $bookingFinishedData['room_id'], $bookingFinishedData['id']);
      redirect('profile');
    }

  }

}
