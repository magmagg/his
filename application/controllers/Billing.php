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
        $data['emergencyroom_bill'] = $this->Model_billing->get_emergencyroom_billing($id);
        $data['icu_bill'] = $this->Model_billing->get_icu_billing($id);
        $data['operatingroom_bill'] = $this->Model_billing->get_or_billing($id);
        $data['radiology_bill'] = $this->Model_billing->get_radiology_bill($id);
        $data['laboratory_bill'] = $this->Model_billing->get_laboratory_bill($id);
        $data['csr_bill'] = $this->Model_billing->get_csr_billing($id);
        $this->load->view('billing/input_pf_modal.php');
        $this->load->view('billing/patientbilling.php', $data);
      }
    }

    function submit_to_cashier(){
      $data = array(
        "patient_id"=>$this->input->post('patient_id'),
        "room_billing_ids"=>$this->input->post('room_data'),
        "lab_billing_ids"=>$this->input->post('lab_data'),
        "er_billing_ids"=>$this->input->post('er_data'),
        "rad_billing_ids"=>$this->input->post('rad_data'),
        "or_billing_ids"=>$this->input->post('or_data'),
        "csr_billing_ids"=>$this->input->post('csr_data'),
        "icu_billing_ids"=>$this->input->post('icu_data'),
        "professional_fee"=>$this->input->post('prof_fee'),
        "total_bill"=>$this->input->post('overall_amount')
      );
      $transaction_id = $this->Model_billing->submit_to_cashier($data);
      echo $transaction_id;
    }
  }
?>
