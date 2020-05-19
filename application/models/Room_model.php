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

}