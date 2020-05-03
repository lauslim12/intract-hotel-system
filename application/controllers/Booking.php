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
    $data['rooms'] = $this->Hotel_model->getHotelRooms($data['id']);
    $data['headlines'] = $this->Hotel_model->getHotelHeadlines($data['id']);

    $this->load->view('pages/bookingSection', $data);
  }

  public function confirmBooking() {
    $id = $this->input->post('hotel_id');
    $data = call_frontend($this);

    $data['user_orders'] = [
      'id' => $this->input->post('hotel_id'),
      'hotel_name' => $this->input->post('hotel_name'),
      'num_rooms' => $this->input->post('num_rooms'),
      'duration' => $this->input->post('duration'),
      'room' => $this->input->post('room')
    ];

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
    $this->session->set_userdata('room_name', $data['user_orders']['room']);
    $this->session->set_userdata('payment_price', $data['payment_price']);
    $this->session->set_userdata('room_id', $data['room_id']);
  }

  public function clearBookingData() {
    $unset = ['hotel_id', 'hotel_name', 'num_rooms', 'duration', 'payment_price', 'room_name', 'room_id'];
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
      'price' => $this->session->userdata('payment_price'),
      'finished' => FALSE
    ];

    $this->clearBookingData();
    $this->Hotel_model->purchaseRoom($purchaseData);
  }

}
