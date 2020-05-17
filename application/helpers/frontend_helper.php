<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  function call_frontend($object) {
		$data['navigation'] = $object->load->view('templates/navigation.php', NULL, TRUE);
    $data['footer'] = $object->load->view('templates/footer.php', NULL, TRUE);
    $data['sidebar'] = $object->load->view('templates/sidebar.php', NULL, TRUE);
    $data['css'] = $object->load->view('includes/css.php', NULL, TRUE);
    return $data;
  }

  function call_frontend_admin($object) {
    $data['header'] = $object->load->view('templates/admin/header.php', NULL, TRUE);
    $data['sidebar'] = $object->load->view('templates/admin/sidebar.php',  NULL, TRUE);
    $data['footer'] = $object->load->view('templates/admin/footer.php',  NULL, TRUE);
    $data['css'] = $object->load->view('includes/admin/css.php', NULL, TRUE);
    $data['js'] = $object->load->view('includes/admin/js.php', NULL, TRUE);
    return $data;
  }
?>