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
    $sql = "SELECT u.username, AVG(orders.rating) AS average FROM users AS u JOIN orders ON u.id = orders.user_id WHERE rating IS NOT NULL GROUP BY 1";
    $query = $this->db->query($sql);
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