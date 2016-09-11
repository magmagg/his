<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Billing extends CI_Controller{

    function (){
      $header['title'] = "HIS: Patient Billing";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));


    }

  }
?>
