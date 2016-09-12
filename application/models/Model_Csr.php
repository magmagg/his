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

    //PRODUCTS REQUESTS

    function get_accepted_request()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
      $this->db->where('pur_stat',1);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_rejected_request()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
      $this->db->where('pur_stat',2);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_hold_request()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
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
  }
?>
