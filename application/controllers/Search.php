<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('Hotel_model');
    $this->load->model('Room_model');
  }

  public function index() 
  {
    redirect('dashboard');
  }

  public function searchHotel() 
  {
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
    $data['prices'] = $this->Room_model->getAllRoomsPriceRange();
    $this->session->set_flashdata('filterMessage', "Your Results");
    $this->load->view("dashboard", $data);
  }

  public function sortByRating() 
  {
    $param = $this->uri->segment(3);
    $this->session->set_flashdata('filterMessage', "Your Sorted Results");

    if($param === 'ascending') {
      $sorted_hotels = $this->Hotel_model->sortHotel(2);
      $data = call_frontend($this);
      $data['hotels'] = $sorted_hotels;
      $data['prices'] = $this->Room_model->getAllRoomsPriceRange();
      $this->load->view("dashboard", $data);
    }
    else if($param === 'descending') {
      $sorted_hotels = $this->Hotel_model->sortHotel(1);
      $data = call_frontend($this);
      $data['hotels'] = $sorted_hotels;
      $data['prices'] = $this->Room_model->getAllRoomsPriceRange();
      $this->load->view("dashboard", $data);
    }
    else {
      redirect('dashboard');
    }
  }

  public function filterPrice()
  {
    $budget = $this->input->get('q');
    $filtered_hotels = $this->Room_model->getRoomBudget($budget);
    $data = call_frontend($this);
    $data['hotels'] = $filtered_hotels;
    if(empty($data['hotels'])) {
      redirect('dashboard');
    }
    $message = "Your Budget";
    $this->session->set_flashdata('filterMessage', $message);
    $this->load->view('dashboard', $data);
  }

  public function filterByStar() 
  {
    $star = $this->uri->segment(3);
    $filtered_hotels = $this->Hotel_model->filterHotel($star);
    $data = call_frontend($this);
    $data['hotels'] = $filtered_hotels;
    $data['prices'] = $this->Room_model->getAllRoomsPriceRange();
    if(empty($data['hotels'])) {
      redirect('dashboard');
    }
    $this->session->set_flashdata('filterMessage', "Filter By Star");
    $this->load->view("dashboard", $data);
  }

}
