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
    $this->db->where(array('patient_id'=>$id, 'bed_bill_status'=>0));
    $query = $this->db->get();
    return $query->row();
  }
    
  function get_emergencyroom_billing($id){
    $this->db->select('*');
    $this->db->from('bill_er');
    $this->db->where(array('patient_id'=>$id, 'bill_status'=>0));
    $query = $this->db->get();
    return $query->row();
  }
    
  function get_icu_billing($id){
    $this->db->select('*');
    $this->db->from('bill_icu');
    $this->db->where(array('patient_id'=>$id, 'bill_status'=>0));
    $query = $this->db->get();
    return $query->row();
  }
    
  function get_or_billing($id){
    $this->db->select('*');
    $this->db->from('bill_or');
    $this->db->where(array('patient_id'=>$id, 'bill_status'=>0));
    $query = $this->db->get();
    return $query->row();
  }
    
  function get_csr_billing($id){
    $this->db->select('*');
    $this->db->from('csr_billing');
    $this->db->where(array('patient_id'=>$id, 'csr_bill_status'=>0));
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>
