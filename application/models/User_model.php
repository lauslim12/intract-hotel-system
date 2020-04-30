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

  public function register($first_name, $last_name, $username, $email, $password, $birthday, $gender) {
    $this->db->query("INSERT INTO users VALUES('', '$first_name', '$last_name', '$username', '$email', '$password', '$birthday', '$gender', date('Y-m-d'), NULL, 1)");
    
    if($this->db->affected_rows() != 1) {
      echo "fail register";
    }
    else {
      echo "sukses register";
    }

  }

}

?>