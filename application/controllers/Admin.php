<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Hotel_model');
  }

  public function index() {
    if($this->User_model->isAdmin() == 1) {
      $this->load->view('admin');
    }
    else {
      redirect('dashboard');
    }
  }

  public function showData() {
    if($this->User_model->isAdmin() == 1) {
      $data['user'] = $this->User_model->getUserData($this->session->userdata('username'));
      $data['hotels'] = $this->Hotel_model->getHotels();
      $data['header'] = $this->load->view('templates/admin/header.php', NULL, TRUE);
      $data['sidebar'] = $this->load->view('templates/admin/sidebar.php',  NULL, TRUE);
      $data['footer'] = $this->load->view('templates/admin/footer.php',  NULL, TRUE);
      $this->load->view('pages/admin/showData', $data);
    }
    else {
      redirect('dashboard');
    }
  }

}
