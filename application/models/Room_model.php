<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_model extends CI_Model {
  
  // Impossible to fail, because of the primary key constraint.
  public function getRoomAvailableByRoomName($hotel_id, $room_name)
  {
    $this->db->select('room_count');
    $this->db->from('rooms');
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('room_name', $room_name);
    return $this->db->get()->row()->room_count;
  }

  public function getAllRoomsPriceRange()
  {
    $this->db->select("MIN(price) AS min, MAX(price) AS max");
    $this->db->from('rooms');
    $this->db->group_by('hotel_id');
    return $this->db->get()->result_array();
  }

  public function getRoomBudget($budget)
  {
    $this->db->select("hotels.*, MIN(price) AS min, MAX(price) AS max");
    $this->db->from('rooms');
    $this->db->join('hotels', 'rooms.hotel_id = hotels.id');
    $this->db->group_by('hotel_id');
    $this->db->having('MIN(price) <=', $budget);
    return $this->db->get()->result_array();
  }
}