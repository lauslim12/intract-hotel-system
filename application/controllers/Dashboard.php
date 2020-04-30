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
      $user_id = $this->session->userdata('user_id');
      $data['hotels'] = $this->Hotel_model->getHotels();
      $data['histories'] = $this->User_model->getHistory($user_id);
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

  public function search() {
    $keyword = $this->input->post('search');
    $data['search'] = $this->Hotel_model->searchHotel($keyword);
    $this->load->view('search', $data);
  }
  


}
