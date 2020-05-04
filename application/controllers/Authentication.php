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
      $username = strtolower($this->input->post("login_username", TRUE));
      $password = $this->input->post("login_password", TRUE);
      $flag = $this->User_model->checkUser($username, $password);
      
      if($flag != FALSE) {
        foreach($flag as $i) {
          $session_data = [
            'user_id' => $i->id,
            'username' => $i->username,
            'profile_pic' => $i->profile_pic,
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
        $this->session->set_flashdata('message', 'Your email or password is incorrect!');
        $this->load->view('landing');
      }
    }
  }

  public function register() {
    $registerData = [
      'id' => '',
      'first_name' => $this->input->post('first_name', TRUE),
      'last_name' => $this->input->post('last_name', TRUE),
      'username' => $this->input->post('username', TRUE),
      'email' => $this->input->post('email', TRUE),
      'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
      'birthdate' => $this->input->post('birthdate', TRUE),
      'gender' => $this->input->post('gender', TRUE),
      'signup_date' => date('Y-m-d'),
      'profile_pic' => '/assets/images/profile_pics/defaults/head_belize_hole.png',
      'privilege_level' => 0
    ];

    $this->User_model->register($registerData);
  }

}
