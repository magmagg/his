<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Model_Rooms extends CI_Model{
  function get_roomtype_List()
  {
    $this->db->select('*');
    $this->db->from('room_type');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_room_type($id)
  {
    $this->db->select('*');
    $this->db->from('room_type');
    $this->db->where('room_type_id',$id);
    $query = $this->db->get();
    return $query->row();
  }

  function get_single_room_type($id){
    $this->db->select('*');
    $this->db->from('rooms');
    $this->db->where('room_id',$id);
    $query = $this->db->get();
    return $query->row();
  }

  function get_room_list()
  {
    $this->db->select('*');
    $this->db->from('rooms a');
    $this->db->join('room_type b', 'a.room_type=b.room_type_id', 'left');
    $this->db->join('occupancy c', 'a.occupancy_status=c.occupancy_status_id', 'left');
    $this->db->join('maintenance d', 'a.maintenance_status=d.maintenance_status_id', 'left');
    $this->db->order_by('a.room_id','asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_operation_room_list()
  {
    $this->db->select('*');
    $this->db->from('room_operation ro');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_operating_room_data($id){
    $this->db->select('*');
    $this->db->from('beds_operation bo');
    $this->db->join('room_operation ro', 'bo.bed_roomid = ro.or_id', 'left');
    $this->db->join('maintenance m', 'bo.bed_maintenance = m.maintenance_status_id', 'left');
    $this->db->join('patient p', 'bo.bed_patient=p.patient_id','left');
    $this->db->where('bo.bed_roomid', $id);
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_room_data($id)
  {
    $this->db->select('*');
    $this->db->from('beds a');
    $this->db->join('rooms b', 'b.room_id=a.bed_roomid','left');
    $this->db->join('patient c', 'a.bed_patient=c.patient_id','left');
    $this->db->where('a.bed_roomid',$id);
    $query = $this->db->get();
    return $query->result_array();
  }

  function insertroomtype($data){
    $this->db->insert('room_type', $data);
  }

  function insertroom($data)
  {
    $this->db->insert('rooms',$data);
    $room_id = $this->db->insert_id();
    return $room_id;
  }

  function insertoperatingroom($data){
    $this->db->insert('room_operation', $data);

    $this->db->select('or_id');
    $this->db->from('room_operation');
    $this->db->order_by('UPPER(or_id)', 'desc');
    $this->db->limit(1);
    $room_id = $this->db->get()->row()->or_id;
    return $room_id;
  }

  function insertbedsinroom($data){
    $this->db->insert('beds',$data);
  }

  function insertbedsinoperatingroom($data){
    $this->db->insert('beds_operation',$data);
  }

  function removebed($id){
    $this->db->where('bed_id',$id);
    $this->db->delete('beds');
  }

  function updateroom($data, $id){
    $this->db->where('room_id',$id);
    $this->db->update('rooms',$data);
  }

  function updateroomtype($data,$id){
    $this->db->where('room_type_id', $id);
    $this->db->update('room_type', $data);
  }

  function update_bed($data, $id){
    $this->db->where('bed_id', $id);
    $this->db->update('beds', $data);
  }
}
?>
