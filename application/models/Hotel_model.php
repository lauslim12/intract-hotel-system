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
    $this->db->join('hotel_features', 'hotels.id = hotel_features.hotel_id');
    $this->db->where('hotels.id', $id);
    $query = $this->db->get();
    
    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      $query = $query->result_array();
    }

    $this->db->from('hotel_features');
    $this->db->where('hotel_id', $id);
    $query['count_feature'] = $this->db->count_all_results();

    return $query;
  }

  public function getHotelRooms($id) {
    $this->db->select('*');
    $this->db->from('rooms');
    $this->db->where('hotel_id', $id);
    $this->db->where('room_count > 0');
    $query = $this->db->get();

    if($query->num_rows() === 0) {
      return FALSE;
    }
    else {
      $query = $query->result_array();
      return $query;
    }
  }

  public function getHotelHeadlines($id) {
    $this->db->select('*');
    $this->db->from('hotel_headlines');
    $this->db->where('hotel_id', $id);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getHotelPrice($id, $room_name) {
    $this->db->select('*');
    $this->db->from('rooms');
    $this->db->where('hotel_id', $id);
    $this->db->where('room_name', $room_name);
    $query = $this->db->get();
    $row = $query->row();

    return $row;
  }

  public function purchaseRoom($purchaseData) {
    $this->db->insert('orders', $purchaseData);
    $roomId = $purchaseData['room_id'];
    $roomPurchased = $purchaseData['num_rooms'];
    $this->reduceAvailableRoom($roomPurchased, $roomId);
    redirect('dashboard');
  }

  public function reduceAvailableRoom($roomPurchased, $roomId) {
    $this->db->query("UPDATE rooms SET room_count = room_count - '$roomPurchased' WHERE id = '$roomId'");
  }

  public function searchHotel($keyword) {
    $query = $this->db->query("SELECT * FROM hotels WHERE name LIKE '%$keyword%'");
    return $query->result_array();
  }

}

?>