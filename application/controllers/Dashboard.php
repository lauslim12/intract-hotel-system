<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Hotel_model');
  }

  public function index() {
    if($this->User_model->isLoggedIn()) {
      $data['hotels'] = $this->Hotel_model->getHotels();
      $this->load->view("dashboard", $data);
    }
    else {
      redirect(site_url());
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect(site_url());
  }
  


}
