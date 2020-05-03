<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Hotel_model');
  }

  public function index() {
    redirect('dashboard');
  }

  public function view() {
    $username = $this->uri->segment(3);
    $data = call_frontend($this);
    $data['user_data'] = $this->User_model->getUserData($username);
    $data['user_hotel'] = $this->User_model->getUserTransactionsHotel($data['user_data']['id']);
    $data['user_rooms'] = $this->User_model->getUserTransactionsRooms($data['user_data']['id']);
    $data['transaction_data'] = $this->User_model->getUserTransactionData($data['user_data']['id']);

    if($data['user_data'] === FALSE) {
      redirect('welcome');
    }
    else {
      $this->load->view('profile', $data);
    }
  }

}
