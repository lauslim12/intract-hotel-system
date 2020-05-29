<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

  public function getOrders()
  {
    $query = $this->db->get('orders');
    return $query->result_array();
  }

  public function getOrder($id)
  {
    $this->db->select('*');
    $this->db->from('orders');
    $this->db->where('id', $id);
    return $this->db->get()->row_array();
  }
  
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

  /* Under Revamping */
  public function reduceAvailableRoom($roomPurchased, $roomId) 
  {
    $sql = "UPDATE rooms SET room_count = IF(room_count - ? >= 0, room_count - ?, room_count) WHERE id = ?";
    $this->db->query($sql, [$roomPurchased, $roomPurchased, $roomId]);
    $status = $this->db->affected_rows();
    return $status;
  }

  public function payHotel($orderedRoom, $roomId, $orderId, $rating, $hotel_id) 
  {
    $this->db->trans_begin();
    $restore_room_query = "UPDATE rooms SET room_count = room_count + ? WHERE id = ?";
    $this->db->query($restore_room_query, [$orderedRoom, $roomId]);
    
    $finish_order_query = "UPDATE orders SET finished = 1, rating = ? WHERE id = ?";
    $this->db->query($finish_order_query, [$rating, $orderId]);

    $this->updateRating($hotel_id);
    $this->db->trans_complete();
  }

  public function updateRating($hotel_id)
  {
    $this->db->select_avg('rating');
    $this->db->from('orders');
    $this->db->where('hotel_id', $hotel_id);
    $average = $this->db->get()->row()->rating;
    
    $this->db->trans_begin();
    $this->db->set('rating', $average);
    $this->db->where('id', $hotel_id);
    $this->db->update('hotels');
    $this->db->trans_complete();

    if($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function forceFinishOrder($id, $orders)
  {
    $this->payHotel($orders['room_count'], $orders['room_id'], $id, 10, $orders['hotel_id']);
    return TRUE;
  }
  /* End of Revamping */
}