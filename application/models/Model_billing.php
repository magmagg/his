<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Model_billing extends CI_Model{

  function get_admitted_patients(){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->Where('patient_status !=', 0);
      $query = $this->db->get();
      return $query->result_array();
  }

  function get_patient_with_billing(){
    $this->db->select('*');
    $this->db->from('billing b');
    $this->db->join('patient p', 'p.patient_id = b.patient_id', 'left');
    $this->db->where('b.bill_status', 0);
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_patient_detail($id){
    $this->db->select('*');
    $this->db->from('patient');
    $this->db->where('patient_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function get_radiology_bill($id){
    $this->db->select('*');
    $this->db->from('rad_billing');
    $this->db->where(array('patient_id'=>$id, 'rad_bill_status'=>0));
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_laboratory_bill($id){
    $this->db->select('*');
    $this->db->from('lab_billing');
    $this->db->where(array('patient_id'=>$id, 'lab_bill_status'=>0));
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_directroom_billing($id){
    $this->db->select('*');
    $this->db->from('bed_billing');
    $this->db->where('patient_id ="'.$id.'" AND bed_bill_status != 2 AND bill_name != "Emergency Room Bill" AND bill_name != "Operating Room Bill" AND bill_name != "ICU Bill"');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_emergencyroom_billing($id){
    $this->db->select('*');
    $this->db->from('bed_billing');
    $this->db->where('patient_id ="'.$id.'" AND bed_bill_status != 2 AND bill_name = "Emergency Room Bill"');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_icu_billing($id){
    $this->db->select('*');
    $this->db->from('bed_billing');
    $this->db->where('patient_id ="'.$id.'" AND bed_bill_status != 2 AND bill_name = "ICU Bill"');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_or_billing($id){
    $this->db->select('*');
    $this->db->from('bed_billing');
    $this->db->where('patient_id ="'.$id.'" AND bed_bill_status != 2 AND bill_name = "Operating Room Bill"');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_csr_billing($id){
    $this->db->select('*');
    $this->db->from('csr_billing');
    $this->db->where(array('patient_id'=>$id, 'csr_bill_status'=>0));
    $query = $this->db->get();
    return $query->result_array();
  }

  function submit_to_cashier($data){
    $this->db->insert('billing', $data);
    $this->db->select('transaction_id');
    $this->db->from('billing');
    $this->db->order_by('date_submitted', 'desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row('transaction_id');
  }

  function get_transaction_details($id){
    $this->db->select('*');
    $this->db->from('billing b');
    $this->db->join('patient p', 'b.patient_id = p.patient_id', 'left');
    $this->db->where('b.transaction_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function mark_as_paid($id){
    $data = array("bill_status"=>1, "date_paid"=>date('Y-m-d H:i:s'));
    $this->db->where('transaction_id', $id);
    $this->db->update('billing', $data);
  }

  function mark_room_bill_as_paid($id){
      $data = array("bed_bill_status"=>2);
      $this->db->where("bed_bill_id", $id);
      $this->db->update("bed_billing", $data);
  }

  function mark_pharm_bill_as_paid($id){

  }

  function mark_lab_bill_as_paid($id){
      $data = array("lab_bill_status"=>1);
      $this->db->where("lab_bill_id", $id);
      $this->db->update("lab_billing", $data);
  }


  function mark_rad_bill_as_paid($id){
      $data = array("rad_bill_status"=>1);
      $this->db->where("rad_bill_id", $id);
      $this->db->update("rad_billing", $data);
  }


  function mark_csr_bill_as_paid($id){
      $data = array("csr_bill_status"=>1);
      $this->db->where("csr_bill_id", $id);
      $this->db->update("csr_billing", $data);
  }

  function discharge_patient($id, $status){
      $data_remove_in_bed = array("bed_patient"=>NULL);
      $data_remove_in_admission = array("status"=>1);
      $data_discharge_status = array("patient_status"=>0);
      if($status == 1){
        $this->db->where("bed_patient", $id);
        $this->db->update("beds", $data_remove_in_bed);

        $this->db->where("patient_id", $id);
        $this->db->update("admission_schedule", $data_remove_in_admission);

        $this->db->where("patient_id", $id);
        $this->db->update("patient", $data_discharge_status);
      }else if($status == 2){
          $this->db->where("bed_patient", $id);
          $this->db->update("beds", $data_remove_in_bed);

          $this->db->where("patient_id", $id);
          $this->db->update("admission_schedule", $data_remove_in_admission);

          $this->db->where("patient_id", $id);
          $this->db->update("patient", $data_discharge_status);
      }else if($status == 3){
        $this->db->where("bed_patient", $id);
        $this->db->update("beds", $data_remove_in_bed);

        $this->db->where("patient_id", $id);
        $this->db->update("admission_schedule", $data_remove_in_admission);

        $this->db->where("patient_id", $id);
        $this->db->update("patient", $data_discharge_status);
      }else if($status == 4){
        $this->db->where("bed_patient", $id);
        $this->db->update("beds", $data_remove_in_bed);

        $this->db->where("patient_id", $id);
        $this->db->update("admission_schedule", $data_remove_in_admission);

        $this->db->where("patient_id", $id);
        $this->db->update("patient", $data_discharge_status);
      }
  }

  function get_billing_detail($id){
    $this->db->select('*');
    $this->db->from('billing b');
    $this->db->join('patient p', 'p.patient_id = b.patient_id', 'left');
    $this->db->where('b.transaction_id', $id);
    $query = $this->db->get();
    return $query->row();
  }
}
?>