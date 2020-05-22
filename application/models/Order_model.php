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

  public function getStatisticsForUserRating()
  {
    $query = $this->db->query("SELECT AVG(orders.rating) AS average, 
                    u.username AS user FROM orders
                    JOIN users as u on u.id = orders.user_id 
                    WHERE rating IS NOT NULL;");
    return $query->result_array();
  }

  public function getUserRating()
  {
    $notNull = "rating IS NOT NULL";
    $this->db->select_avg('rating');
    $this->db->from('orders');
    $this->db->where($notNull);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getHotelName()
  {
    $this->db->select('name');
    $this->db->from('hotels');
    $query = $this->db->get();
    
    return $query->result_array();
  }

  public function getEarnings()
  {
    $this->db->select_sum('price');
    $this->db->from('orders');
    $this->db->where('finished', 1);
    $earnings = $this->db->get()->row()->price;
    $earnings = str_replace('""', '', $earnings);
    return json_encode($earnings, JSON_NUMERIC_CHECK);
  }

  public function getSales()
  {
    $notNull = "finished != 0";
    $this->db->select('id');
    $this->db->from('orders');
    $this->db->where($notNull);
    return json_encode($this->db->count_all_results(), JSON_NUMERIC_CHECK);
  }

}