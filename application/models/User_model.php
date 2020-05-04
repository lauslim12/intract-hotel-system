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
    $this->db->limit(1);
    $query = $this->db->get();
    $result = $query->row_array();

    if($query->num_rows() === 0 || !password_verify($password, $result['password'])) {
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

  public function getUserTransactionsHotel($user_id) {
    $this->db->select('*');
    $this->db->from('orders');
    $this->db->join('hotels', 'hotels.id = orders.hotel_id');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get();
    
    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      return $query->result_array();
    }
  }


  public function getUserTransactionsRooms($user_id) {
    $this->db->select('*');
    $this->db->from('orders');
    $this->db->join('rooms', 'rooms.id = orders.room_id');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get();
    
    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      return $query->result_array();
    }
  }

  public function getUserTransactionData($user_id) {
    $this->db->select('*');
    $this->db->from('orders');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get();

    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      return $query->result_array();
    }
  }

  public function getUserData($username) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username', $username);
    $this->db->limit(1);
    $query = $this->db->get();

    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      return $query->row_array();
    }
  }

  public function setDisplayPicture($user_id, $path_to_image) {
    $this->db->trans_begin();
    $this->db->set('profile_pic', $path_to_image);
    $this->db->where('id', $user_id);
    $this->db->update('users');
    $this->db->trans_complete();

    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }

  }

}

?>