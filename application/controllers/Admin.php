<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Hotel_model');
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

  public function showOrders()
  {
    if($this->User_model->isAdmin() == 1) {
      $data = call_frontend_admin($this);
      $data['orders'] = $this->Hotel_model->getOrders();
      $this->load->view('pages/admin/showOrders', $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function showNewHotel()
  {
    if($this->User_model->isAdmin() == 1) {
      $data = call_frontend_admin($this);
      $this->load->view('pages/admin/showNewHotel', $data);
    }
    else {
      redirect('dashboard');
    }
  }

}
