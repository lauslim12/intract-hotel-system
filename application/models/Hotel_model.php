<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_model extends CI_Model {
  
  public function getHotels() 
  {
    $query = $this->db->get('hotels');
    return $query->result_array();
  }

  public function getRooms() 
  {
    $query = $this->db->get('rooms');
    return $query->result_array();
  }

  public function getHotel($id) 
  {
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

  public function getHotelRooms($id) 
  {
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

  public function getHotelHeadlines($id) 
  {
    $this->db->select('*');
    $this->db->from('hotel_headlines');
    $this->db->where('hotel_id', $id);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getHotelPrice($id, $room_name) 
  {
    $this->db->select('*');
    $this->db->from('rooms');
    $this->db->where('hotel_id', $id);
    $this->db->where('room_name', $room_name);
    $query = $this->db->get();
    $row = $query->row();

    return $row;
  }

  public function purchaseRoom($purchaseData) 
  {
    $roomId = $purchaseData['room_id'];
    $roomPurchased = $purchaseData['num_rooms'];
    $status = $this->reduceAvailableRoom($roomPurchased, $roomId);

    if($status === 0) {
      $back = $this->session->userdata('if_transaction_fail');
      $this->session->unset_userdata('if_transaction_fail');
      $this->session->set_flashdata('message', 'It looks like that we do not have that amount of rooms available. Please try again!');
      redirect($back);
    }
    else {
      $this->db->insert('orders', $purchaseData);
      redirect('dashboard');
    }
  }

  public function reduceAvailableRoom($roomPurchased, $roomId) 
  {
    $sql = "UPDATE rooms SET room_count = IF(room_count - ? >= 0, room_count - ?, room_count) WHERE id = ?";
    $this->db->query($sql, [$roomPurchased, $roomPurchased, $roomId]);
    $status = $this->db->affected_rows();
    return $status;
  }

  public function payHotel($orderedRoom, $roomId, $orderId) 
  {
    $restore_room_query = "UPDATE rooms SET room_count = room_count + ? WHERE id = ?";
    $this->db->query($restore_room_query, [$orderedRoom, $roomId]);
    
    $finish_order_query = "UPDATE orders SET finished = 1 WHERE id = ?";
    $this->db->query($finish_order_query, [$orderId]);
  }

  public function searchHotel($keyword) 
  {
    $this->db->select('*');
    $this->db->from('hotels');
    $this->db->like('name', $keyword);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getRoomByOrder($order_id) 
  {
    $this->db->select('*');
    $this->db->from('orders');
    $this->db->where('id', $order_id);
    $query = $this->db->get();

    return $query->row_array();
  }

  public function sortHotel($choice) 
  {
    $this->db->select('*');
    $this->db->from('hotels');

    if($choice === 1) {
      $this->db->order_by('rating DESC');
    }
    else {
      $this->db->order_by('rating ASC');
    }

    $query = $this->db->get();

    return $query->result_array();
  }

  public function filterHotel() 
  {
    $this->db->select('*');
    $this->db->from('hotels');
    $this->db->where('star', 5);
    $query = $this->db->get();

    return $query->result_array();
  }


}