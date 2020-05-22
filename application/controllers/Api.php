<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Order_model');
    $this->load->model('Hotel_model');
  }

  public function respondJSON($data)
  {
    if(!empty($data)) {
      $this->response($data, 200);
    }
    else {
      $this->response([
        'status' => false,
        'message' => 'No data!'
      ], 404);
    } 
  }

  public function logged_user_get() 
  {
    $user = $this->User_model->getUserData($this->session->userdata('username'));
    $this->respondJSON($user);
  }

  public function fetch_earnings_get()
  {
    $sales = $this->Order_model->getEarnings();
    $this->respondJSON($sales);
  }

  public function fetch_sales_get()
  {
    $sales = $this->Order_model->getSales();
    $this->respondJSON($sales);
  }

  public function fetch_users_get()
  {
    $users = $this->User_model->getNumberOfUsers();
    $this->respondJSON($users);
  }

  public function fetch_hotels_get()
  {
    $hotels = $this->Hotel_model->getNumberOfHotels();
    $this->respondJSON($hotels);
  }
}


