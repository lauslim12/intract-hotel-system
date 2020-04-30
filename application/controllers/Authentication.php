<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
  }
  
  public function login() {
    if($this->User_model->isLoggedIn()) {
      redirect('dashboard');
    }
    else {
      $username = $this->input->post("username", TRUE);
      $password = $this->input->post("password", TRUE);
      $flag = $this->User_model->checkUser($username, $password);
      
      if($flag != FALSE) {
        foreach($flag as $i) {
          $session_data = [
            'user_id' => $i->id,
            'username' => $i->username,
            'privilege_level' => $i->privilege_level
          ];

          $this->session->set_userdata($session_data);

          if($this->session->userdata('privilege_level') == 1) {
            redirect('admin');
          }
          else {
            redirect('dashboard');
          }
        }
      }
      else {
        $this->load->view('welcome_message');
      }
    }
  }

  public function register() {
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $username = $this->input->post('username');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $birthday = $this->input->post('birthday');
    $gender = $this->input->post('gender');
    $this->User_model->register($first_name, $last_name, $username, $email, $password, $birthday, $gender);
  }

}
