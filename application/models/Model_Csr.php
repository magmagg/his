<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_Csr extends CI_Model{

    function get_csr_inventory()
    {
      $this->db->select('*');
      $this->db->from('csr_inventory');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_stockname($id)
    {
      $this->db->select('*');
      $this->db->from('csr_inventory');
      $this->db->where('csr_id',$id);
      $query = $this->db->get();
      return $query->row('item_name');
    }

    function reqtypenewproduct()
    {
    $this->db->select('*');
    $this->db->from('purchase_req_type');
    $this->db->where('pur_name','New Product');
    $query = $this->db->get();
    return $query->row('pur_req_id');
    }

    function reqtyperestock()
    {
    $this->db->select('*');
    $this->db->from('purchase_req_type');
    $this->db->where('pur_name','Restock');
    $query = $this->db->get();
    return $query->row('pur_req_id');
    }

    function requestproduct($data)
    {
      $this->db->insert('purchasing_csr',$data);
    }

    function restockproduct($data)
    {
      $this->db->insert('purchasing_csr',$data);
    }

    function restockdata($id)
    {
      $this->db->select('*');
      $this->db->from('csr_inventory');
      $this->db->where('csr_id',$id);
      $query = $this->db->get();
      return $query->row();
    }
    // NURSE REQUESTS
    function get_nurse_requests()
    {
      $this->db->select('*');
      $this->db->from('csr_request a');
      $this->db->join('users b', 'a.nurse_id=b.user_id','left');
      $this->db->join('csr_inventory c', 'a.csr_item_id=c.csr_id', 'left');
      $this->db->where('a.csr_status', 0);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_nurse_acceptedrequests()
    {
      $this->db->select('*');
      $this->db->from('csr_request a');
      $this->db->join('users b', 'a.nurse_id=b.user_id','left');
      $this->db->join('csr_inventory c', 'a.csr_item_id=c.csr_id', 'left');
      $this->db->where('csr_status',1);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_nurse_rejectedrequests()
    {
      $this->db->select('*');
      $this->db->from('csr_request a');
      $this->db->join('users b', 'a.nurse_id=b.user_id','left');
      $this->db->join('csr_inventory c', 'a.csr_item_id=c.csr_id', 'left');
      $this->db->where('csr_status',2);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_nurse_releasedrequests()
    {
      $this->db->select('*');
      $this->db->from('csr_request a');
      $this->db->join('users b', 'a.nurse_id=b.user_id','left');
      $this->db->join('csr_inventory c', 'a.csr_item_id=c.csr_id', 'left');
      $this->db->where('csr_status',3);
      $query = $this->db->get();
      return $query->result_array();
    }

    //PRODUCTS REQUESTS
    function get_product_request(){
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $query = $this->db->get();
      return $query->result_array(); 
    }
      
    function get_accepted_request()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->where('pur_stat',1);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_rejected_request()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->where('pur_stat',2);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_hold_request()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->where('pur_stat',3);
      $query = $this->db->get();
      return $query->result_array();
    }

    //NURSE REQ

    function get_request_quant($id)
    {
      $this->db->select('*');
      $this->db->from('csr_request');
      $this->db->where('csr_req_id',$id);
      $query = $this->db->get();
      return $query->row('item_quant');
    }

    function get_csrid($id)
    {
      $this->db->select('*');
      $this->db->from('csr_request');
      $this->db->where('csr_req_id',$id);
      $query = $this->db->get();
      return $query->row('csr_item_id');
    }

    function get_stock_quant($csrid)
    {
      $this->db->select('*');
      $this->db->from('csr_inventory');
      $this->db->where('csr_id',$csrid);
      $query = $this->db->get();
      return $query->row('item_stock');
    }

    //Accept
    function accept_request($id,$datareq)
    {
      $this->db->where('csr_req_id',$id);
      $this->db->update('csr_request',$datareq);

      $this->db->select('*');
      $this->db->from('csr_request cr');
      $this->db->join('csr_inventory ci', 'cr.csr_item_id = ci.csr_id', 'left');
      $query = $this->db->get();
      return $query->row();
    }

    function insert_bill($data, $existing_bill, $patient){
        $this->db->insert('csr_billing', $data);
        $this->db->select('*');
        $this->db->from('csr_billing');
        $this->db->where('patient_id', $patient);
        $this->db->order_by('csr_bill_id', 'desc');
        $this->db->limit(1);
        $query_csr_bill = $this->db->get()->row();
        
        if(empty($existing_bill)){
            $data_insert_bill = array("patient_id"=>$patient, "csr_billing_ids"=>$query_csr_bill->csr_bill_id);
            $this->db->insert('billing', $data_insert_bill);
        }else{
            if($existing_bill->rad_billing_ids == ""){
             $data_update_csr_bill = array("csr_billing_ids"=>$query_csr_bill->csr_bill_id);   
            }else{
             $data_update_csr_bill = array("csr_billing_ids"=>$existing_bill->csr_billing_ids.",".$query_csr_bill->csr_bill_id);
            }
            $this->db->where('transaction_id', $existing_bill->transaction_id);
            $this->db->update('billing', $data_update_csr_bill);
        }
    }
    function setstock($csrid,$datainv)
    {
      $this->db->where('csr_id',$csrid);
      $this->db->update('csr_inventory',$datainv);
    }

    //Reject

    function reject_request($id,$datareq)
    {
      $this->db->where('csr_req_id',$id);
      $this->db->update('csr_request',$datareq);
    }

    //Hold

    function hold_request($id,$datareq)
    {
      $this->db->where('csr_req_id',$id);
      $this->db->update('csr_request',$datareq);
    }

    function insert_csr_item_request($data){
      $this->db->insert('csr_request', $data);
    }

    function get_request_by_user($id){
      $this->db->select('*');
      $this->db->from('csr_request a');
      $this->db->join('patient b', 'a.patient_id=b.patient_id','left');
      $this->db->join('csr_inventory c', 'a.csr_item_id=c.csr_id', 'left');
      $this->db->where('a.nurse_id', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_patients(){
      $this->db->select('*');
      $this->db->from('patient');
      $query = $this->db->get();
      return $query->result_array();
    }

    function check_quantity($id){
      $this->db->select('item_stock');
      $this->db->from('csr_inventory');
      $this->db->where('csr_id', $id);
      $query = $this->db->get();
      return $query->row('item_stock');
    }
      
    function get_existing_csr_bill($patient){
        $this->db->select('*');
        $this->db->from('billing');
        $this->db->where("bill_status = 0 AND patient_id ='".$patient."'");
        $query = $this->db->get()->row();
        return $query;
    }
      
    function get_item_quantity($id){
      $this->db->select('*');
      $this->db->from('csr_inventory');
      $this->db->where('csr_id', $id);
      $query = $this->db->get();
      return $query->row('item_stock');
    }
  }
?>
