<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pharmacy extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
      //Codeigniter : Write Less Do More
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

  function get_all_patients()
  {
    $this->db->select('*');
    $this->db->from('patient');
    $query = $this->db->get();
    return $query->result();
  }

  function insert_pharmacy_request($data)
  {
    $this->db->insert('pharmacy_audit',$data);
  }

  function update_pharmacy_quantity($id,$data)
  {
    $this->db->where('item_id',$id);
    $this->db->update('pharmacy_inventory',$data);
  }

  function get_pharmacy_requests()
  {
    $this->db->select('*');
    $this->db->from('pharmacy_audit');
    $query = $this->db->get();
    return $query->result();
  }

  function process_pharmacy_request_model($id,$data)
  {
      $this->db->where('unique_id',$id);
      $this->db->update('pharmacy_audit',$data);
  }

  function get_unique_ids()
  {
    $this->db->select('unique_id');
    $this->db->from('pharmacy_audit');
    $this->db->distinct();
    $query = $this->db->get();
    return $query->result();
  }

  function get_specific_request($ID)
  {
    $this->db->select('*');
    $this->db->from('pharmacy_audit');
    $this->db->where('unique_id',$ID);
    $query = $this->db->get();
    return $query->result();
  }

  function restore_quantity($item_id,$quantity)
  {
    $string = "item_quantity + {$quantity}";
    $this->db->set('item_quantity',$string,FALSE);
    $this->db->where('item_id',$item_id);
    $this->db->update('pharmacy_inventory');
  }

  //=======================//DRUGS REQUEST//
  function get_drug_inventory()
  {
    $this->db->select('*');
    $this->db->from('drugs');
    $this->db->where('status','1');
    $query = $this->db->get();
    return $query->result();
  }

  function update_drug_quantity($id,$data)
  {
    $this->db->where('drug_code',$id);
    $this->db->update('drugs',$data);
  }

  function get_request_by_user($id){
    $this->db->select('*');
    $this->db->select('p.first_name as P_first_name, p.middle_name as P_middle_name, p.last_name as P_last_name');
    $this->db->from('pharmacy_audit pa');
    $this->db->join('patient p', 'pa.phar_patient = p.patient_id', 'left');
    $this->db->join('users u', 'pa.phar_user_id = u.user_id', 'left');
    $this->db->join('pharmacy_inventory pi', 'pi.item_id = pa.phar_item', 'left');
    $this->db->where('pa.phar_user_id', $id);
    $query = $this->db->get();
    return $query->result_array();
  }

  //=============================RESTOCK MEDICINE=========================//
  function insert_restock_medicine($data)
  {
    $this->db->insert('pharmacy_restock',$data);
  }



}
