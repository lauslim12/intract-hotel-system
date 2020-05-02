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
    $this->load->view('booking', $data);
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

    $this->load->view('pages/bookingConfirm', $data); 
  }

  public function orderHotel() {
    $purchaseData = [
      'id' => '',
      'user_id' => $this->session->userdata('user_id'),
      'hotel_id' => $this->input->post('hotel_id'),
      'room_id' => $this->input->post('room_id'),
      'num_rooms' => $this->input->post('num_rooms'),
      'duration' => $this->input->post('duration'),
      'price' => $this->input->post('price'),
      'finished' => FALSE
    ];

    $this->Hotel_model->purchaseRoom($purchaseData);
  }

}
