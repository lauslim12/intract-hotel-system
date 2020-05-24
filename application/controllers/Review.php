<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Review_model');
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    redirect('dashboard');
  }

  public function uploadPicture($file) 
  {
    $config['upload_path'] = './assets/images/reviewers/reviewer_photos';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 0;
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if(!$this->upload->do_upload($file)) {
      $error = ['error' => $this->upload->display_errors()];
      var_dump($error);
      //redirect('profile');
    }
    else {
      $data = ['upload_data' => $this->upload->data()];
      $image_name = $data['upload_data']['file_name'];
      $path_to_img = "/assets/images/reviewers/reviewer_photos/" . $image_name;
      return $path_to_img;
    }
  }

  public function submitPost()
  {
    $post = $this->input->post('post_text', TRUE);
    $added_by = $this->session->userdata('user_id');
    $hotel_to = $this->input->post('hotel_id', TRUE);
    $date_added = date("Y-m-d H:i:s");

    if($_FILES['fileToUpload']['size'] == 0) {
      $image = NULL;
    }
    else {
      $image = $this->uploadPicture('fileToUpload');
    }

    $data = [
      'id' => '',
      'body' => $post,
      'added_by' => $added_by,
      'hotel_to' => $hotel_to,
      'date_added' => $date_added,
      'image' => $image
    ];

    $this->Review_model->post($data);
    $redirect_path = "booking/showDetail/" . $hotel_to;
    redirect($redirect_path);
  }

}
