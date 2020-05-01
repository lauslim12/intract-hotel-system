<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  function call_frontend($object) {
		$data['navigation'] = $object->load->view('templates/navigation.php', NULL, TRUE);
    $data['footer'] = $object->load->view('templates/footer.php', NULL, TRUE);
    $data['sidebar'] = $object->load->view('templates/sidebar.php', NULL, TRUE);
    return $data;
  }
?>