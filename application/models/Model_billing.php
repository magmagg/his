<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Model_billing extends CI_Model{


  function get_billing_details($id){
    $this->db->select('*');
    $this->db->from('billing');
    $this->db->where("bill_status = 0 AND patient_id='".$id."'");
    $query = $this->db->get()->row();
    return $query;
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
    $this->db->where('rad_bill_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function get_laboratory_bill($id){
    $this->db->select('*');
    $this->db->from('lab_billing');
    $this->db->where('lab_bill_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function get_room_billing($id){
    $this->db->select('*');
    $this->db->from('bed_billing');
    $this->db->where('bed_bill_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function get_csr_billing($id){
    $this->db->select('*');
    $this->db->from('csr_billing');
    $this->db->where('csr_bill_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  function submit_to_cashier($data, $transaction_id){
    $this->db->where('transaction_id', $transaction_id);
    $this->db->update('billing', $data);
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

      $this->db->select('*');
      $this->db->from('bed_billing');
      $this->db->where('bed_bill_id', $id);
      $query = $this->db->get();

      return $query->row()->admission_id;
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

  function discharge_patient($id, $admission_id){
      $data_remove_in_bed = array("bed_patient"=>NULL, "bed_maintenance"=>1);
      $data_remove_in_admission = array("status"=>1);
      $data_discharge_status = array("patient_status"=>0);
      $this->db->where("bed_patient", $id);
      $this->db->update("beds", $data_remove_in_bed);

      $this->db->where("admission_id", $admission_id);
      $this->db->update("admission_schedule", $data_remove_in_admission);

      $this->db->where("patient_id", $id);
      $this->db->update("patient", $data_discharge_status);

      $data_discharge = array("admission_id"=>$admission_id, "patient_id"=>$id);
      $this->db->insert('discharge_schedule', $data_discharge);
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
