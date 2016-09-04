<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_admitting extends CI_Model{
    /*Admitting*/
    public function get_available_beds_from_emergency_room(){
      $this->db->select('*');
      $this->db->from('beds b');
      $this->db->join('rooms r', 'r.room_id=b.bed_roomid', 'left');
      $this->db->join('room_type rt', 'r.room_id=rt.room_type_id', 'left');
      $this->db->join('patient p', 'p.patient_id=b.bed_patient', 'left');
      $this->db->where('r.room_type', 1);
      $this->db->where('b.bed_patient', NULL);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_non_admitted_patient_list(){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_status', 0);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function admit_patient($data_bedstable, $data_admission_schedule, $data_admitting_resident, $data_update_patient_status, $bed_id, $patient){
      $this->db->where('bed_id', $bed_id);
      $this->db->update('beds', $data_bedstable);

      $this->db->insert('admission_schedule', $data_admission_schedule);
      $this->db->insert('admitting_resident', $data_admitting_resident);

      $this->db->where('patient_id', $patient);
      $this->db->update('patient', $data_update_patient_status);
    }

    public function get_room_list()
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

    function get_admitted_patient($id){
      $this->db->select('*');
      $this->db->from('beds a');
      $this->db->join('rooms b', 'a.bed_roomid=b.room_id', 'left');
      $this->db->join('patient c', 'a.bed_patient=c.patient_id', 'left');
      $this->db->where('a.bed_patient !=', NULL);
      $this->db->where('a.bed_roomid', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function dischargepatient($data_discharge, $data_update_bed, $data_update_patient, $patient_id, $bed_id){
      $this->db->where('patient_id', $patient_id);
      $this->db->update('patient', $data_update_patient);

      $this->db->where('patient_id', $patient_id);
      $this->db->update('admission_schedule', $data_discharge);

      $this->db->where('bed_id', $bed_id);
      $this->db->update('beds', $data_update_bed);
    }

    function get_room_list_for_directadmission(){
      $this->db->select('*');
      $this->db->from('rooms a');
      $this->db->join('room_type b', 'a.room_type=b.room_type_id', 'left');
      $this->db->where('a.room_type !=', 1);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_available_beds_for_directadmission($id){
      $this->db->select('*');
      $this->db->from('beds a');
      $this->db->join('rooms b', 'b.room_id=a.bed_roomid', 'left');
      $this->db->join('room_type c', 'b.room_id=c.room_type_id', 'left');
      $this->db->join('patient d', 'd.patient_id=a.bed_patient', 'left');
      $this->db->where('b.room_type', $id);
      $this->db->where('a.bed_patient', NULL);
      $query = $this->db->get();
      return $query->result_array();
    }

    function transfer_patient($data_remove_patient_from_prev_bed, $data_transfer_patient_to_new_bed, $update_patient_status, $bedid, $patientid){
      $this->db->where('bed_patient', $patientid);
      $this->db->update('beds', $data_remove_patient_from_prev_bed);

      $this->db->where('bed_id', $bedid);
      $this->db->update('beds', $data_transfer_patient_to_new_bed);

      $this->db->where('patient_id', $patientid);
      $this->db->update('patient', $update_patient_status);
    }
    /*Admitting*/
  }
?>
