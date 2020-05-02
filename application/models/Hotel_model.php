<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_model extends CI_Model {
  public function getHotels() {
    $query = $this->db->get('hotels');
    return $query->result_array();
  }

  public function getRooms() {
    $query = $this->db->get('rooms');
    return $query->result_array();
  }

  public function getHotel($id) {
    $this->db->select('*');
    $this->db->from('hotels');
    $this->db->join('rooms', 'hotels.id = rooms.hotel_id');
    $this->db->join('hotel_features', 'hotels.id = hotel_features.hotel_id');
    $this->db->where('hotels.id', $id);
    $query = $this->db->get()->result_array();

    $this->db->from('hotel_features');
    $this->db->where('hotel_id', $id);
    $query['count_feature'] = $this->db->count_all_results();

    return $query;
  }

  public function purchaseRoom($id, $rooms, $user_id, $price, $rooms_after_sale) {
    $this->db->query("INSERT INTO orders VALUES ('', '$user_id', '$id', '$rooms', '$price')");
    $this->db->query("UPDATE hotels SET rooms = '$rooms_after_sale' WHERE id = '$id'");
    redirect('dashboard');
  }

  public function searchHotel($keyword) {
    $query = $this->db->query("SELECT * FROM hotels WHERE name LIKE '%$keyword%'");
    return $query->result_array();
  }

}

?>