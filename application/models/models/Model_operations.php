<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Model_operations extends CI_Model{
  function get_list_of_operations(){
    $this->db->select('*');
    $this->db->from('operations');
    $query = $this->db->get();
    return $query->result_array();
  }

  function change_operation_status($status, $id){
    $data = array("status"=>$status);
    $this->db->where('operation_id', $id);
    $this->db->update('operations', $data);
    return true;
  }

  function insert_operation($data){
    $this->db->insert('operations', $data);
    return true;
  }

  function update_operation($data, $id){
    $this->db->where('operation_id', $id);
    $this->db->update('operations', $data);
    return true;
  }
}
?>
