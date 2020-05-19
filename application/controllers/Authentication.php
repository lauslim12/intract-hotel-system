<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }
  
  public function login() 
  {
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

  public function registerValidations()
  {
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required', array(
      'required' => "You must provide a first name!"
    ));

    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required', array(
      'required' => "You must provide a last name!"
    ));

    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]', array(
      'required' => "You must provide a username!",
      'is_unique' => "Your username must be unique!"
    ));

    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
      'required' => "You must provide an email!",
      'valid_email' => "Your email is not a valid email!"
    ));

    $this->form_validation->set_rules('password', 'Password', 'trim|required', array(
      'required' => "You must provide a password!"
    ));

    $this->form_validation->set_rules('passwordconf', 'Password Confirm', 'trim|required|matches[password]', array(
      'required' => "You must fill this column!",
      'matches' => "Your passwords do not match!"
    ));

    $this->form_validation->set_rules('birthdate', 'Birthdate', 'trim|required', array(
      'required' => "You must provide a birthdate!"
    ));

    $this->form_validation->set_rules('gender', 'Gender', 'trim|required', array(
      'required' => "You must provide a gender!"
    ));
  }

  public function register() 
  {
    $this->registerValidations();

    if($this->form_validation->run() == FALSE) {
      $this->load->view('landing');
      return;
    }

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
