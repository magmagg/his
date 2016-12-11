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

  function get_patient_admitting_info($id){
    $this->db->select('*');
    $this->db->from('admission_schedule');
    $this->db->where(array('patient_id'=>$id, 'status'=>1));
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
    return $query->row();
  }
}
?>
