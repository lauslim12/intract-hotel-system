<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model {

  public function getAllReviews($hotel_id)
  {
    $this->db->select('*');
    $this->db->from('reviews');
    $this->db->where('hotel_to', $hotel_id);
    $this->db->order_by('date_added DESC');
    return $this->db->get()->result_array();
  }

  public function getNumberOfPostsByUser($user_id)
  {
    $this->db->select('*');
    $this->db->from('reviews');
    $this->db->where('added_by', $user_id);
    return $this->db->count_all_results();
  }
  
  public function post($data)
  {
    $this->db->trans_begin();
    $this->db->insert('reviews', $data);
    $this->db->trans_complete();
    
    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

}