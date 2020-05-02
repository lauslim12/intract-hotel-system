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

  public function showBooking() {
    $data = call_frontend($this);
    $data['id'] = $this->uri->segment(3);
    $data['hotel'] = $this->Hotel_model->getHotel($data['id']);
    $this->load->view('booking', $data);
  }

  public function orderHotel() {
    $id = $this->uri->segment(3);
    $rooms = $this->input->post('room_count');
    $user_id = $this->session->userdata('user_id');
    $price = $this->input->post('price');

    $price = $price * $rooms;
    $room_after_sell = $this->input->post('rooms') - $rooms;

    $this->Hotel_model->purchaseRoom($id, $rooms, $user_id, $price, $room_after_sell);
  }

}
