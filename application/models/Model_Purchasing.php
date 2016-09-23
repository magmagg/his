<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_Purchasing extends CI_Model{

    function get_csr_inventory()
    {
      $this->db->select('*');
      $this->db->from('csr_inventory');
      $query = $this->db->get();
      return $query->result_array();
    }


    function get_csr_requests()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_pending_csr_requests(){
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
      $this->db->where('a.pur_stat', 0);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_onprocess_csr_requests(){
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
      $this->db->where('a.pur_stat', 3);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_request_data($id)
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr');
      $this->db->where('purchase_id',$id);
      $query = $this->db->get();
      return $query->row();
    }
    function get_request_type($id)
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr');
      $this->db->where('purchase_id',$id);
      $query = $this->db->get();
      return $query->row('request_type');
    }
    function change_pur_status($id,$newstat)
    {
      $this->db->where('purchase_id',$id);
      $this->db->update('purchasing_csr',$newstat);
    }
    function insertnewcsrproduct($data)
    {
      $this->db->insert('csr_inventory',$data);
    }
    function get_csr_stock($id)
    {
      $this->db->select('*');
      $this->db->from('csr_inventory');
      $this->db->where('csr_id',$id);
      $query = $this->db->get();
      return $query->row('item_stock');
    }
    function restockcsrproduct($id,$data)
    {
      $this->db->where('csr_id',$id);
      $this->db->update('csr_inventory',$data);
    }
    function get_acceptedcsr_requests()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
      $this->db->where('pur_stat',1);
      $query = $this->db->get();
      return $query->result_array();
    }
    function get_rejectedcsr_requests()
    {
      $this->db->select('*');
      $this->db->from('purchasing_csr a');
      $this->db->join('users u','a.requester_id=u.user_id','left');
      $this->db->join('purchase_req_type p', 'a.request_type=p.pur_req_id', 'left');
      $this->db->where('pur_stat',2);
      $query = $this->db->get();
      return $query->result_array();
    }

    function insertproduct($data){
      $this->db->insert('csr_inventory', $data);
    }

    function update_csr_stock($data, $id){
      $this->db->where('csr_id', $id);
      $this->db->update('csr_inventory', $data);
    }

    /*Pharmacy Inventory*/
    function get_pharmacy_inventory()
    {
      $this->db->select('*');
      $this->db->from('pharmacy_inventory');
      $query = $this->db->get();
      return $query->result();
    }

    function count_pharmacy_inventory()
    {
      $this->db->select('*');
      $this->db->from('pharmacy_inventory');
      $query = $this->db->get();
      return $query->num_rows();
    }

    function update_item_inventory($id, $data)
    {
      $this->db->where('item_id', $id);
      $this->db->update('pharmacy_inventory', $data);
    }

    function delete_item_inventory($id)
    {
      $this->db->where('item_id',$id);
      $this->db->delete('pharmacy_inventory');
    }

    function add_item_inventory($data)
    {
      $this->db->insert('pharmacy_inventory',$data);
    }

    function add_item_inventory_import($data)
    {
      $this->db->insert('pharmacy_inventory',$data);
    }

  }
?>
