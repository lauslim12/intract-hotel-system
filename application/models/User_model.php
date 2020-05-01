<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  
  public function isLoggedIn() {
    return $this->session->userdata('user_id');
  }
  
  public function checkUser($username, $password) {
    $this->db->select("*");
    $this->db->from("users");
    $this->db->where("username", $username);
    $this->db->where("password", $password);
    $this->db->limit(1);
    $query = $this->db->get();

    if($query->num_rows() == 0) {
      return FALSE;
    }
    else {
      return $query->result();
    }
  }

  public function register($registerData) {
    $this->db->insert('users', $registerData);

    if($this->db->affected_rows() != 1) {
      $this->session->set_flashdata('message', 'You failed to register!');
    }
    else {
      $this->session->set_flashdata('message', 'Successfully registered!');
    }

    redirect('welcome');
  }

  public function getHistory($user_id) {
    $query = $this->db->query("SELECT o.*, h.name FROM orders AS o JOIN hotels AS h ON (h.id = o.hotel_id) WHERE user_id = '$user_id'");
    return $query->result_array();
  }

}

?>