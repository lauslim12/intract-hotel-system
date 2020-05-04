<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Hotel_model');
  }

  public function index() {
    redirect('dashboard');
  }

  public function searchHotel() {
    $keyword = $this->input->get('q');

    if($keyword === '') {
      redirect('dashboard');
    }

    $found_hotels = $this->Hotel_model->searchHotel($keyword);

    if(empty($found_hotels)) {
      redirect('dashboard');
    }

    $data = call_frontend($this);
    $data['hotels'] = $found_hotels;
    $this->load->view("dashboard", $data);
  }

  public function sortByRating() {
    $param = $this->uri->segment(3);

    if($param === 'ascending') {
      $sorted_hotels = $this->Hotel_model->sortHotel(2);
      $data = call_frontend($this);
      $data['hotels'] = $sorted_hotels;
      $this->load->view("dashboard", $data);
    }
    else if($param === 'descending') {
      $sorted_hotels = $this->Hotel_model->sortHotel(1);
      $data = call_frontend($this);
      $data['hotels'] = $sorted_hotels;
      $this->load->view("dashboard", $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function filterByStar() {
    $filtered_hotels = $this->Hotel_model->filterHotel();
    $data = call_frontend($this);
    $data['hotels'] = $filtered_hotels;
    $this->load->view("dashboard", $data);
  }

}
