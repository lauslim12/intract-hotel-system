<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_model extends CI_Model {
  
  public function getHotels() 
  {
    $query = $this->db->get('hotels');
    return $query->result_array();
  }

  public function getNumberOfHotels()
  {
    $this->db->select('id');
    $this->db->from('hotels');
    return json_encode($this->db->count_all_results(), JSON_NUMERIC_CHECK);
  }

  public function getHotelEssentialData($id)
  {
    $this->db->select('*');
    $this->db->from('hotels');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row_array();
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

  public function getHotelHeadlines($id) 
  {
    $this->db->select('*');
    $this->db->from('hotel_headlines');
    $this->db->where('hotel_id', $id);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getHotelFeatures($id)
  {
    $this->db->select('*');
    $this->db->from('hotel_features');
    $this->db->where('hotel_id', $id);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getTotalHotelFeatures($id)
  {
    $this->db->select('*');
    $this->db->from('hotel_features');
    $this->db->where('hotel_id', $id);
    return $this->db->count_all_results();
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

  public function filterHotel($star) 
  {
    $this->db->select('*');
    $this->db->from('hotels');
    $this->db->where('star', $star);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function insertHotel($dataHotel)
  {    
    $this->db->trans_begin();
    $this->db->insert('hotels', $dataHotel);
    $insert_id = $this->db->insert_id();
    $this->db->trans_complete();

    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return $insert_id;
    }
  }

  public function insertHotelDetails($dataRoom, $dataFeature, $dataHeadline)
  {
    $this->db->trans_begin();
    $this->db->insert('rooms', $dataRoom);
    $this->db->insert('hotel_features', $dataFeature);
    $this->db->insert_batch('hotel_headlines', $dataHeadline);

    if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
    }
    else {
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function newFeature($dataFeature)
  {
    $this->db->trans_begin();
    $this->db->insert('hotel_features', $dataFeature);
    $this->db->trans_complete();

    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function deleteFeature($hotel_id, $feature)
  {
    $this->db->trans_begin();
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('feature', $feature);
    $this->db->delete('hotel_features');
    $this->db->trans_complete();

    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function editHotel($data, $id)
  {
    $this->db->trans_begin();
    $this->db->where('id', $id);
    $this->db->update('hotels', $data);
    $this->db->trans_complete();
    
    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function editHotelHeadlines($data, $id)
  {
    $this->db->trans_begin();
    $this->db->where('hotel_id', $id);
    $this->db->delete('hotel_headlines');
    $this->db->insert_batch('hotel_headlines', $data);
    $this->db->trans_complete();
    
    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function editHotelFeatures($data, $id)
  {
    $this->db->trans_begin();
    $this->db->where('hotel_id', $id);
    $this->db->delete('hotel_features');
    $this->db->insert_batch('hotel_features', $data);
    $this->db->trans_complete();
    
    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function deleteHotel($id)
  {
    $this->db->trans_begin();
    $this->db->where('id', $id);
    $this->db->delete('hotels');
    $this->db->trans_complete();
    
    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

}