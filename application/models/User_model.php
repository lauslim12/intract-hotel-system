<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  
  public function isLoggedIn() 
  {
    return $this->session->userdata('user_id');
  }

  public function isAdmin() 
  {
    return $this->session->userdata('privilege_level');
  }

  public function getUsers()
  {
    $query = $this->db->get('users');
    return $query->result_array();
  }

  public function getNumberOfOrders($user_id)
  {
    $this->db->select('*');
    $this->db->from('orders');
    $this->db->where('user_id', $user_id);
    return $this->db->count_all_results();
  }

  public function getNumberOfUsers()
  {
    $this->db->select('id');
    $this->db->from('users');
    return json_encode($this->db->count_all_results(), JSON_NUMERIC_CHECK);
  }

  public function getNumberOfPosts($user_id)
  {
    $this->db->select('id');
    $this->db->from('reviews');
    $this->db->where('added_by', $user_id);
    return $this->db->count_all_results();
  }

  public function getNumberOfLikes($user_id)
  {
    $this->db->select('*');
    $this->db->from('likes');
    $this->db->where('user_id', $user_id);
    return $this->db->count_all_results();
  }
  
  public function checkUser($username, $password) 
  {
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

  public function register($registerData) 
  {
    $this->db->insert('users', $registerData);

    if($this->db->affected_rows() != 1) {
      $this->session->set_flashdata('message', 'You failed to register!');
    }
    else {
      $this->session->set_flashdata('message', 'Successfully registered!');
    }

    redirect('welcome');
  }

  public function getUserTransactionsHotel($user_id) 
  {
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

  public function getUserTransactionsRooms($user_id) 
  {
    $this->db->select('*');
    $this->db->from('orders');
    $this->db->join('rooms', 'rooms.id = orders.room_id');
    $this->db->where('user_id', $user_id);
    $this->db->order_by('orders.id ASC');
    $query = $this->db->get();
    
    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      return $query->result_array();
    }
  }

  public function getUserTransactionData($user_id) 
  {
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

  public function getUserData($username) 
  {
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

  public function getUserDataById($user_id)
  {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('id', $user_id);
    $this->db->limit(1);
    $query = $this->db->get();

    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      return $query->row_array();
    }
  }

  public function setDisplayPicture($user_id, $path_to_image) 
  {
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

  public function deleteUser($user_id)
  {
    $this->db->trans_begin();
    $this->db->where('id', $user_id);
    $this->db->delete('users');
    $this->db->trans_complete();
    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function changeUserData($data, $user_id)
  {
    $this->db->trans_begin();
    $this->db->where('id', $user_id);
    $this->db->update('users', $data);
    $this->db->trans_complete();
    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

}