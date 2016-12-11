<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Billing extends CI_Controller{

    function __construct(){
      parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('Model_billing');
    }

    function PatientBilling (){
      $header['title'] = "HIS: Patient Billing";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $this->load->view('users/includes/header', $header);
      if($this->uri->segment(3) == FALSE){
        $data['patients'] = $this->Model_billing->get_admitted_patients();
        $this->load->view('billing/choose_patient_to_view_billing.php', $data);
      }else{
        $id = $this->uri->segment(3);
        $data['patient_detail'] = $this->Model_billing->get_patient_detail($id);
        $data['directroom_bill'] = $this->Model_billing->get_directroom_billing($id);
        $data['radiology_bill'] = $this->Model_billing->get_radiology_bill($id);
        $data['laboratory_bill'] = $this->Model_billing->get_laboratory_bill($id);
        $this->load->view('billing/patientbilling.php', $data);
      }
    }
  }
?>
