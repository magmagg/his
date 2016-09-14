<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');

  class Model_housekeeping extends CI_Model{

    function get_room_with_bed_reported(){
      $this->db->select('*');
      $this->db->from('beds b');
      $this->db->join('rooms r', 'b.bed_roomid = r.room_id', 'left');
      $this->db->join('room_type rt', 'rt.room_type_id = r.room_type', 'left');
      $this->db->where('b.bed_maintenance !=', 0);
      $query = $this->db->get();
      return $query->result_array();
    }

    function update_bed($id, $data){
      $this->db->where("bed_id", $id);
      $this->db->update('beds', $data);
    }

  }
?>
