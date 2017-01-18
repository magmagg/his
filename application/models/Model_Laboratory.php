<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_Laboratory extends CI_Model{


    function get_patient_list(){
      $this->db->select('*');
      $this->db->from('patient');
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

    /* Laboratory Request*/
    function get_laboratoryrequest_list()
    {
      $this->db->select('*');
      $this->db->from('laboratory_request');
      $this->db->join('patient','laboratory_request.lab_patient=patient.patient_id','left');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_laboratoryrequest_of_nurse($id){
      $this->db->select('*');
      $this->db->from('laboratory_request lr');
      $this->db->join('patient p', 'lr.lab_patient=p.patient_id', 'left');
      $this->db->where('user_id_fk', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_laboratorytopatient_data($id)
    {
      $this->db->select('*');
      $this->db->from('laboratory_request');
      $this->db->join('patient','laboratory_request.lab_patient=patient.patient_id','left');
      $query = $this->db->get();
      return $query->row();
    }

    function get_laboratorytouser_data($id)
    {
      $this->db->select('*');
      $this->db->from('laboratory_request');
      $this->db->join('users', 'laboratory_request.user_id_fk=users.user_id', 'left');
      $query = $this->db->get();
      return $query->row();
    }

    function get_laboratorytorequest_data($id)
    {
      $this->db->select('*');
      $this->db->from('laboratory_request a');
      $this->db->join('urgency_cat u', 'a.urgency_cat_fk=u.urg_id','left');
      $this->db->join('fasting_cat f', 'a.fasting_cat_fk=f.fast_id', 'left');
      $this->db->join('laboratory_examination_type l', 'a.exam_type_fk=l.lab_exam_type_id', 'left');
      $this->db->join('examination_category e', 'l.lab_exam_type_category_id=e.exam_cat_id', 'left');
      $query = $this->db->get();
      return $query->row();
    }

    function get_laboratorytospecimen_data($id)
    {
      $this->db->select('*');
      $this->db->from('lab_specimen_request a');
      $this->db->join('laboratory_specimens l', 'a.specimen_id=l.specimen_id', 'left');
      $this->db->where('lab_req_id',$id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_laboratorytoremarks_data($id)
    {
      $this->db->select('*');
      $this->db->from('lab_request_remarks');
      $this->db->where('lab_id_fk',$id);
      $query = $this->db->get();
      return $query->row();
    }

    function approvelabreq($id,$data)
    {
        $this->db->where('lab_id',$id);
        $this->db->update('laboratory_request',$data);

        $this->db->select('*');
        $this->db->from('laboratory_request lr');
        $this->db->join('laboratory_examination_type let', 'let.lab_exam_type_id = lr.exam_type_fk', 'left');
        $this->db->where('lr.lab_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function insert_bill($data, $existing_bill, $patient){
        $this->db->insert('lab_billing', $data);
        $this->db->select('*');
        $this->db->from('lab_billing');
        $this->db->where('patient_id', $patient);
        $this->db->order_by('lab_bill_id', 'desc');
        $this->db->limit(1);
        $query_lab_bill = $this->db->get()->row();

        if(empty($existing_bill)){
            $data_insert_bill = array("patient_id"=>$patient, "lab_billing_ids"=>$query_lab_bill->lab_bill_id);
            $this->db->insert('billing', $data_insert_bill);
        }else{
            if($existing_bill->lab_billing_ids == ""){
             $data_update_lab_bill = array("lab_billing_ids"=>$query_lab_bill->lab_bill_id);
            }else{
             $data_update_lab_bill = array("lab_billing_ids"=>$existing_bill->lab_billing_ids.",".$query_lab_bill->lab_bill_id);
            }
            $this->db->where('transaction_id', $existing_bill->transaction_id);
            $this->db->update('billing', $data_update_lab_bill);
        }
    }

    function get_accepted_labreq()
    {
      $this->db->select('*');
      $this->db->from('laboratory_request a');
      $this->db->join('patient b', 'a.lab_patient=b.patient_id','left');
      $this->db->where('lab_status',2);
      $query = $this->db->get();
      return $query->result_array();
    }

    function cancellabreq($id,$data)
    {
      $this->db->where('lab_id',$id);
      $this->db->update('laboratory_request',$data);
    }

    function get_rejected_labreq()
    {
      $this->db->select('*');
      $this->db->from('laboratory_request a');
      $this->db->join('patient b', 'a.lab_patient=b.patient_id','left');
      $this->db->where('lab_status',3);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_all_examcateg()
    {
      $this->db->select('*');
      $this->db->from('examination_category');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_examcateg($id)
    {
        $this->db->select('*');
        $this->db->from('examination_category');
        $this->db->where('exam_cat_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function insertcategory($data)
    {
      $this->db->insert('examination_category',$data);
    }

    function updatecategory($id,$data)
    {
      $this->db->where('exam_cat_id',$id);
      $this->db->update('examination_category',$data);
    }

    function get_all_examtype(){
      $this->db->select('*');
      $this->db->from('laboratory_examination_type');
      $this->db->join('examination_category','laboratory_examination_type.lab_exam_type_category_id=examination_category.exam_cat_id','left');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_specific_examtype($id){
      $this->db->select('*');
      $this->db->from('laboratory_examination_type');
      $this->db->where('lab_exam_type_id',$id);
      $query = $this->db->get();
      return $query->row();
    }

    function insertexamtype($data)
    {
      $this->db->insert('laboratory_examination_type',$data);
    }

    function updateexamtype($id,$data)
    {
      $this->db->where('lab_exam_type_id',$id);
      $this->db->update('laboratory_examination_type',$data);
    }

    function get_all_labspec()
    {
      $this->db->select('*');
      $this->db->from('laboratory_specimens');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_specific_specimen($id)
    {
      $this->db->select('*');
      $this->db->from('laboratory_specimens');
      $this->db->where('specimen_id',$id);
      $query = $this->db->get();
      return $query->row();
    }

    function insertspecimen($data)
    {
      $this->db->insert('laboratory_specimens',$data);
    }

    function updatespecimen($id,$data)
    {
      $this->db->where('specimen_id',$id);
      $this->db->update('laboratory_specimens',$data);
    }

    function get_all_urgencycategory()
    {
      $this->db->select('*');
      $this->db->from('urgency_cat');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_all_fastingcategory()
    {
      $this->db->select('*');
      $this->db->from('fasting_cat');
      $query = $this->db->get();
      return $query->result_array();
    }

    function insertlaboratoryrequest($data1){
      $this->db->insert('laboratory_request',$data1);
      $labid = $this->db->insert_id();
      return $labid;
    }

    function insertrequestspecimen($data2){
      $this->db->insert('lab_specimen_request',$data2);
    }

    function insertrequestremark($data3){
      $this->db->insert('lab_request_remarks',$data3);
    }

    function get_existing_lab_bill($patient){
        $this->db->select('*');
        $this->db->from('billing');
        $this->db->where("bill_status = 0 AND patient_id ='".$patient."'");
        $query = $this->db->get()->row();
        return $query;
    }

}
?>
