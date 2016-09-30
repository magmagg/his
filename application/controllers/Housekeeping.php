<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Housekeeping extends CI_Controller{

    function __construct(){
      parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('Model_housekeeping');
    }

    function ReportedBeds(){
      $header['title'] = "HIS: Emergency Room Admission";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $this->load->view('users/includes/header.php',$header);
      $data['roomlist']=$this->Model_housekeeping->get_room_with_bed_reported();
      $this->load->view('housekeeping/view_roomlist.php', $data);
      $this->load->view('includes/toastr.php');
    }

    function UpdateBed(){
      $bed_id = $this->uri->segment(3);
      $data = array("bed_maintenance"=>0);
      $this->Model_housekeeping->update_bed($bed_id, $data);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Successfully updated bed status">
                                <input type="hidden" id="type" value="success">');
      redirect(base_url()."Housekeeping/ReportedBeds");
    }
  }
?>
