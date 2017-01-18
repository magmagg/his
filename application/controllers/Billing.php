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
        $data['patients'] = $this->Model_billing->get_patient_with_billing();
        $this->load->view('billing/choose_patient_to_view_billing.php', $data);
      }else{
        $transaction_id = $this->uri->segment(3);
        $data_billing = $this->Model_billing->get_billing_details($transaction_id);
        $data['patient_detail'] = $this->Model_billing->get_patient_detail($data_billing->patient_id);
        $data['room_price'] = 0;
        $data['er_price'] = 0;
        $data['or_price'] = 0;
        $data['icu_price'] = 0;
        $data['pharm_price'] = 0;
        $data['lab_price'] = 0;
        $data['rad_price'] = 0;
        $data['csr_price'] = 0;
        $data['professional_fee'] = $data_billing->professional_fee;
        $data['bill_status'] = $data_billing->bill_status;
        $data['transaction_id'] = $data_billing->transaction_id;
        $room_bill_ids = explode(",", $data_billing->room_billing_ids);
        foreach($room_bill_ids as $room_bill){
            $room_bill_data = $this->Model_billing->get_room_billing($room_bill);
            if($room_bill_data->bill_name == "Operating Room Bill"){
                $data['or_price'] += $room_bill_data->price;
            }else if($room_bill_data->bill_name == "Emergency room Bill"){
                $data['er_price'] += $room_bill_data->price;
            }else if($room_bill_data->bill_name == "Intensive Care Unit Bill"){
                $data['icu_price'] += $room_bill_data->price;
            }else{
                $data['room_price'] += $room_bill_data->price;
            }
        }

        $rad_bill_ids = explode(",", $data_billing->rad_billing_ids);
        foreach($rad_bill_ids as $rad_bill){
            $rad_bill_data = $this->Model_billing->get_radiology_bill($rad_bill);
            if(!empty($rad_bill_data)){
                $data['rad_price'] += $rad_bill_data->price;
            }
        }

        $lab_bill_ids = explode(",", $data_billing->lab_billing_ids);
        foreach($lab_bill_ids as $lab_bill){
            $lab_bill_data = $this->Model_billing->get_laboratory_bill($lab_bill);
            if(!empty($lab_bill_data)){
                $data['lab_price'] += $lab_bill_data->price;
            }
        }

        $csr_bill_ids = explode(",", $data_billing->csr_billing_ids);
        foreach($csr_bill_ids as $csr_bill){
            $csr_bill_data = $this->Model_billing->get_csr_billing($csr_bill);
            if(!empty($csr_bill_data)){
                $data['csr_price'] += $csr_bill_data->price;
            }
        }

        $this->load->view('billing/input_pf_modal.php');
        $this->load->view('billing/patientbilling.php', $data);
      }
    }
      
    function TransactionHistory(){
      $header['title'] = "HIS: Patient Billing";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $this->load->view('users/includes/header', $header);
      if(!$this->uri->segment(3)){
        $data['billings_data'] = $this->Model_billing->get_all_billings();
        $this->load->view('billing/billings.php', $data);
      }else{
        $transaction_id = $this->uri->segment(3);
        $data_billing = $this->Model_billing->get_billing_details($transaction_id);
        $data['patient_detail'] = $this->Model_billing->get_patient_detail($data_billing->patient_id);
        $data['room_price'] = 0;
        $data['er_price'] = 0;
        $data['or_price'] = 0;
        $data['icu_price'] = 0;
        $data['pharm_price'] = 0;
        $data['lab_price'] = 0;
        $data['rad_price'] = 0;
        $data['csr_price'] = 0;
        $data['professional_fee'] = $data_billing->professional_fee;
        $data['bill_status'] = $data_billing->bill_status;
        $data['transaction_id'] = $data_billing->transaction_id;
        $room_bill_ids = explode(",", $data_billing->room_billing_ids);
        foreach($room_bill_ids as $room_bill){
            $room_bill_data = $this->Model_billing->get_room_billing($room_bill);
            if($room_bill_data->bill_name == "Operating Room Bill"){
                $data['or_price'] += $room_bill_data->price;
            }else if($room_bill_data->bill_name == "Emergency room Bill"){
                $data['er_price'] += $room_bill_data->price;
            }else if($room_bill_data->bill_name == "Intensive Care Unit Bill"){
                $data['icu_price'] += $room_bill_data->price;
            }else{
                $data['room_price'] += $room_bill_data->price;
            }
        }

        $rad_bill_ids = explode(",", $data_billing->rad_billing_ids);
        foreach($rad_bill_ids as $rad_bill){
            $rad_bill_data = $this->Model_billing->get_radiology_bill($rad_bill);
            if(!empty($rad_bill_data)){
                $data['rad_price'] += $rad_bill_data->price;
            }
        }

        $lab_bill_ids = explode(",", $data_billing->lab_billing_ids);
        foreach($lab_bill_ids as $lab_bill){
            $lab_bill_data = $this->Model_billing->get_laboratory_bill($lab_bill);
            if(!empty($lab_bill_data)){
                $data['lab_price'] += $lab_bill_data->price;
            }
        }

        $csr_bill_ids = explode(",", $data_billing->csr_billing_ids);
        foreach($csr_bill_ids as $csr_bill){
            $csr_bill_data = $this->Model_billing->get_csr_billing($csr_bill);
            if(!empty($csr_bill_data)){
                $data['csr_price'] += $csr_bill_data->price;
            }
        }

        $this->load->view('billing/billing_info.php', $data);
      }
    }
    /*==============================================================================================================================*/
    function Payment(){
      $header['title'] = "HIS: Patient Billing";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $this->load->view('users/includes/header', $header);
      if(!$this->uri->segment(3)){
        $data['patients'] = $this->Model_billing->get_patient_for_payment();
        $this->load->view('billing/choose_patient_for_payment.php', $data);
      }else{
        $data['billing_detail'] = $this->Model_billing->get_billing_detail($this->uri->segment(3));
        $this->load->view('billing/payment_details', $data);
      }
    }
    /*==============================================================================================================================*/
    function submit_to_cashier(){
      $data = array(
        "professional_fee"=>$this->input->post('prof_fee'),
        "total_bill"=>$this->input->post('overall_amount'),
        "bill_status"=>1
      );
      $this->Model_billing->submit_to_cashier($data, $this->input->post('transaction_id'));
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="'.$this->input->post('transaction_id').' has been passed to Cashier.">
                                <input type="hidden" id="type" value="success">' );
      redirect(base_url().'Dashboard', 'refresh');
    }

    function mark_as_paid(){
        $transaction_id = $this->uri->segment(3);
        $transaction_data = $this->Model_billing->get_transaction_details($transaction_id);

        $room_bill_ids = explode(",", $transaction_data->room_billing_ids);
        foreach($room_bill_ids as $room_bill){
            $admission_id = $this->Model_billing->mark_room_bill_as_paid($room_bill);
            $this->Model_billing->discharge_patient($transaction_data->patient_id, $admission_id);
        }

        $pharm_bill_ids = explode(",", $transaction_data->pharm_billing_ids);
        foreach($pharm_bill_ids as $pharm_bill){

        }

        $lab_bill_ids = explode(",", $transaction_data->lab_billing_ids);
        foreach($lab_bill_ids as $lab_bill){
            $this->Model_billing->mark_lab_bill_as_paid($lab_bill);
        }

        $rad_bill_ids = explode(",", $transaction_data->rad_billing_ids);
        foreach($rad_bill_ids as $rad_bill){
            $this->Model_billing->mark_rad_bill_as_paid($rad_bill);
        }

        $csr_bill_ids = explode(",", $transaction_data->csr_billing_ids);
        foreach($csr_bill_ids as $csr_bill){
            $this->Model_billing->mark_csr_bill_as_paid($csr_bill);
        }


        $this->Model_billing->mark_as_paid($transaction_id);
        $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                  <input type="hidden" id="msg" value=" Bill '.$transaction_id.' has been mark as paid.">
                                  <input type="hidden" id="type" value="success">' );
        redirect(base_url().'Dashboard', 'refresh');
    }
  }
?>
