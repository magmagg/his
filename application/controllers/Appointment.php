<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Appointment extends CI_Controller{

  function __construct(){
    parent::__construct();
      $this->load->model('Model_user');
      $this->load->model('Model_appointment');
  }



public function viewschedule(){
  $header['title'] = "HIS: View schedules";
  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
  $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
  $this->load->view('users/includes/header', $header);

}


public function myschedule(){
  $header['title'] = "HIS: My schedule";
  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
  $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
  $this->load->view('users/includes/header', $header);
  $this->load->view('appointment/mysched');
}



}
