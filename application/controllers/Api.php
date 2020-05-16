<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('User_model');
  }

  public function logged_user_get() 
  {
    $user = $this->User_model->getUserData($this->session->userdata('username'));

    if(!empty($user)) {
      $this->response($user, 200);
    }
    else {
      $this->response([
        'status' => false,
        'message' => 'No data!'
      ], 404);
    }
  }

}


