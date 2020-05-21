<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
  
  public function getNumberOfRatings($hotel_id) 
  {
    $notNull = "rating IS NOT NULL";
    $this->db->select('rating');
    $this->db->from('orders');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where($notNull);
    return $this->db->count_all_results();
  }
}