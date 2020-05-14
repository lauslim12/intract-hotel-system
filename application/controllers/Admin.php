<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
  }

  public function index() {
    if($this->User_model->isAdmin() == 1) {
      $this->load->view('admin');
    }
    else {
      redirect('dashboard');
    }
  }

}
