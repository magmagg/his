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

    function mark_as_paid(){
        $transaction_id = $this->uri->segment(3);
        $transaction_data = $this->Model_billing->get_transaction_details($transaction_id);

        $room_bill_ids = explode(",", $transaction_data->room_billing_ids);
        foreach($room_bill_ids as $room_bill){
            $this->Model_billing->mark_room_bill_as_paid($room_bill);
        }

        $pharm_bill_ids = explode(",", $transaction_data->pharm_billing_ids);
        foreach($pharm_bill_ids as $pharm_bill){
            //$this->Model_billing->mark_pharm_bill_as_paid($pharm_bill);
        }

        $lab_bill_ids = explode(",", $transaction_data->lab_billing_ids);
        foreach($lab_bill_ids as $lab_bill){
            $this->Model_billing->mark_lab_bill_as_paid($lab_bill);
        }

        $er_bill_ids = explode(",", $transaction_data->er_billing_ids);
        foreach($er_bill_ids as $er_bill){
            $this->Model_billing->mark_er_bill_as_paid($er_bill);
        }

        $rad_bill_ids = explode(",", $transaction_data->rad_billing_ids);
        foreach($rad_bill_ids as $rad_bill){
            $this->Model_billing->mark_rad_bill_as_paid($rad_bill);
        }

        $or_bill_ids = explode(",", $transaction_data->or_billing_ids);
        foreach($or_bill_ids as $or_bill){
            $this->Model_billing->mark_or_bill_as_paid($or_bill);
        }

        $csr_bill_ids = explode(",", $transaction_data->csr_billing_ids);
        foreach($csr_bill_ids as $csr_bill){
            $this->Model_billing->mark_csr_bill_as_paid($csr_bill);
        }

        $icu_bill_ids = explode(",", $transaction_data->icu_billing_ids);
        foreach($icu_bill_ids as $icu_bill){
            $this->Model_billing->mark_icu_bill_as_paid($icu_bill);
        }

        $this->Model_billing->mark_as_paid($transaction_id);
        $this->Model_billing->discharge_patient($transaction_data->patient_id, $transaction_data->patient_status);
    }

    function testing(){
        if($patient_detail->patient_status == 1){
          $this->Model_admitting->remove_patient_from_er($patient, $room, $bed);
      }else if($patient_detail->patient_status == 2){
          $this->Model_admitting->remove_patient_from_dr($patient);
      }else if($patient_detail->patient_status == 3){
          $this->Model_admitting->remove_patient_from_or($patient);
      }else if($patient_detail->patient_status == 4){
          $this->Model_admitting->remove_patient_from_icu($patient);
      }
    }

  }
?>
