<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_model extends CI_Model {
  public function getHotels() {
    $query = $this->db->query("SELECT * FROM hotels");
    return $query->result_array();
  }

}

?>