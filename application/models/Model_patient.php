<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_patient extends CI_Model{

    function get_total_patient_count(){
      $this->db->select('*');
      $this->db->from('patient');
      $query = $this->db->get();
      return $query->num_rows();
    }

    function get_count_admitted_patient(){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_status !=', 0);
      $query = $this->db->get();
      return $query->num_rows();
    }

    function get_count_patient_admitted_in_er(){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_status ', 1);
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function fetch_all_patient(){
      $this ->db->select('*');
      $this ->db->from('patient');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_single_patient($id){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_id', $id);
      $query = $this->db->get();
      return $query->row();
    }

    public function get_vital_sign($id){
      $this->db->select('*');
      $this->db->from('vitals v');
      $this->db->join('users u', 'v.user_id = u.user_id', 'left');
      $this->db->where('v.patient_id', $id);
      $this->db->order_by('date_recorded', 'desc');
      $query = $this->db->get();
      return $query->result_array();
    }

    public function recordvitalsign($data){
      $sql = $this->db->insert('vitals', $data);
      if($sql){
        return true;
      }else{
        return false;
      }
    }

    public  function get_admitting_data($id){
      $this->db->select('*');
      $this->db->from('admission_schedule as');
      $this->db->join('discharge_schedule ds','as.admission_id=ds.admission_id','left');
      $this->db->join('patient p', 'as.patient_id = p.patient_id', 'left');
      $this->db->where('as.patient_id', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    public  function get_laboratory_data($id){
      $this->db->select('*');
      $this->db->from('laboratory_request lr');
      $this->db->join('laboratory_examination_type let','lr.exam_type_fk = let.lab_exam_type_id','left');
      $this->db->where('lr.lab_patient', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_radiology_data($id){
      $this->db->select('*');
      $this->db->from('radiology_request rr');
      $this->db->join('radiology_exam re', 'rr.exam_id = re.exam_id', 'left');
      $this->db->join('radiology_pat rp', 'rr.request_id = rp.rad_reqid', 'left');
      $this->db->where('rr.patient_id', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_patient_billing($id){
      $this->db->select('*');
      $this->db->from('billing');
      $this->db->where('patient_id', $id);
      $query = $this->db->get();
      return $query->result_array();
    }
    
    function get_billing_data($id){
        $this->db->select('*');
        $this->db->from('billing');
        $this->db->where('transaction_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_pharmacy_data($id){
      $this->db->select('*');
      $this->db->from('pharmacy_request pr');
      $this->db->join('pharmacy_inventory pi', 'pr.phar_item_id = pi.item_id', 'left');
      $this->db->where('pr.phar_patient', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function push_for_billing($id, $data){
      $this->db->where('billing_breakdown_id', $id);
      $this->db->update('billing_rad_breakdown', $data);
    }
  }
?>
