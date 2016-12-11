<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_admitting extends CI_Model{
    /*Admitting*/
    public function get_non_admitted_patient_list(){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_status', 0);
      $query = $this->db->get();
      return $query->result_array();
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

    function dischargepatient($data_discharge, $data_update_bed, $data_update_patient, $patient_id, $bed_id){
      $this->db->where('patient_id', $patient_id);
      $this->db->update('patient', $data_update_patient);

      $this->db->where('patient_id', $patient_id);
      $this->db->update('admission_schedule', $data_discharge);

      $this->db->where('bed_id', $bed_id);
      $this->db->update('beds', $data_update_bed);
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

    /*Emergency*/
    function get_emergency_rooms(){
      $this->db->select('*');
      $this->db->from('room_emergency');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_emergency_room_beds($id){
      $this->db->select('*');
      $this->db->from('beds_emergency be');
      $this->db->join('room_emergency re', 're.er_id=be.bed_roomid', 'left');
      $this->db->join('patient p', 'p.patient_id=be.bed_patient', 'left');
      $this->db->where('be.bed_roomid', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function admit_patient_to_er($bed, $patient, $data_beds, $data_admission, $data_patient_status){
      $this->db->where('bed_id' ,$bed);
      $this->db->update('beds_emergency', $data_beds);

      $this->db->insert('admission_emergency_room', $data_admission);

      $this->db->where('patient_id', $patient);
      $this->db->update('patient', $data_patient_status);
    }

    function get_emergency_room_admitted(){
      $this->db->select('*');
      $this->db->from('admission_emergency_room aer');
      $this->db->join('patient p', 'p.patient_id = aer.patient_id', 'left');
      $this->db->join('beds_emergency be', 'be.bed_id = aer.bed', 'left');
      $this->db->join('room_emergency re', 'be.bed_roomid = re.er_id', 'left');
      $this->db->where('aer.status', 0);
      $query = $this->db->get();
      return $query->result_array();
    }
    /*Emergency*/

      /*ICU*/
      function get_icu_rooms(){
        $this->db->select('*');
        $this->db->from('room_intensive');
        $query = $this->db->get();
        return $query->result_array();
      }

      function get_icu_room_beds($id){
        $this->db->select('*');
        $this->db->from('beds_intensive bi');
        $this->db->join('room_intensive ri', 'ri.icu_id=bi.bed_roomid', 'left');
        $this->db->join('patient p', 'p.patient_id=bi.bed_patient', 'left');
        $this->db->where('bi.bed_roomid', $id);
        $query = $this->db->get();
        return $query->result_array();
      }

      function admit_patient_to_icu($bed, $patient, $data_beds, $data_admission, $data_patient_status){
        $this->db->where('bed_id' ,$bed);
        $this->db->update('beds_intensive', $data_beds);

        $this->db->insert('admission_intensive_room', $data_admission);

        $this->db->where('patient_id', $patient);
        $this->db->update('patient', $data_patient_status);
      }

      function get_icu_room_admitted(){
        $this->db->select('*');
        $this->db->from('admission_intensive_room air');
        $this->db->join('patient p', 'p.patient_id = air.patient_id', 'left');
        $this->db->join('beds_intensive bi', 'bi.bed_id = air.bed', 'left');
        $this->db->join('room_intensive ri', 'bi.bed_roomid = ri.icu_id', 'left');
        $this->db->where('air.status', 0);
        $query = $this->db->get();
        return $query->result_array();
      }
      /*ICU*/

      /*OR*/
      function get_operating_rooms(){
        $this->db->select('*');
        $this->db->from('room_operation');
        $query = $this->db->get();
        return $query->result_array();
      }

      function get_operating_room_beds($id){
        $this->db->select('*');
        $this->db->from('beds_operation bo');
        $this->db->join('room_operation ro', 'ro.or_id=bo.bed_roomid', 'left');
        $this->db->join('patient p', 'p.patient_id=bo.bed_patient', 'left');
        $this->db->where('bo.bed_roomid', $id);
        $query = $this->db->get();
        return $query->result_array();
      }

      function admit_patient_to_or($bed, $patient, $data_beds, $data_admission, $data_patient_status){
        $this->db->where('bed_id' ,$bed);
        $this->db->update('beds_operation', $data_beds);

        $this->db->insert('admission_operating_room', $data_admission);

        $this->db->where('patient_id', $patient);
        $this->db->update('patient', $data_patient_status);
      }

      function get_operating_room_admitted(){
        $this->db->select('*');
        $this->db->from('admission_operating_room aor');
        $this->db->join('patient p', 'p.patient_id = aor.patient_id', 'left');
        $this->db->join('beds_operation bo', 'bo.bed_id = aor.bed', 'left');
        $this->db->join('room_operation ro', 'bo.bed_roomid = ro.or_id', 'left');
        $this->db->where('aor.status', 0);
        $query = $this->db->get();
        return $query->result_array();
      }
      /*OR*/

      /*Direct Room*/
      function get_direct_rooms(){
        $this->db->select('*');
        $this->db->from('rooms r');
        $this->db->join('room_type rt', 'r.room_type = rt.room_type_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
      }

      function get_direct_room_beds($id){
        $this->db->select('*');
        $this->db->from('beds b');
        $this->db->join('rooms r', 'r.room_id=b.bed_roomid', 'left');
        $this->db->join('patient p', 'p.patient_id=b.bed_patient', 'left');
        $this->db->where('b.bed_roomid', $id);
        $query = $this->db->get();
        return $query->result_array();
      }

      function admit_patient_to_direct_room($bed, $patient, $data_beds, $data_admission, $data_patient_status){
        $this->db->where('bed_id' ,$bed);
        $this->db->update('beds', $data_beds);

        $this->db->insert('admission_schedule', $data_admission);

        $this->db->where('patient_id', $patient);
        $this->db->update('patient', $data_patient_status);

        $this->db->select('*');
        $this->db->from('beds b');
        $this->db->join('rooms r', 'b.bed_roomid = r.room_id', 'left');
        $this->db->join('room_type rt', 'r.room_type = rt.room_type_id', 'left');
        $this->db->where('b.bed_id', $bed);
        $query = $this->db->get()->row();

        $data_bed_billing = array(
                                "description"=>$query->room_name." Bill",
                                "bill_name"=>$query->room_name." Bill",
                                "bed_rate"=>$query->room_price,
                                "price"=>$query->room_price,
                                "patient_id"=>$patient
                              );
        $this->db->insert('bed_billing', $data_bed_billing);
      }

      function get_direct_rooms_admitted(){
        $this->db->select('*');
        $this->db->from('admission_schedule as');
        $this->db->join('patient p', 'p.patient_id = as.patient_id', 'left');
        $this->db->join('beds b', 'b.bed_id = as.bed', 'left');
        $this->db->join('rooms r', 'b.bed_roomid = r.room_id', 'left');
        $this->db->join('room_type rt', 'r.room_type = rt.room_type_id', 'left');
        $this->db->where('as.status', 0);
        $query = $this->db->get();
        return $query->result_array();
      }
      /*Direct Room*/
    }
?>
