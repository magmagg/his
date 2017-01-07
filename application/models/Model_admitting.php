<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_admitting extends CI_Model{
    /*Admitting*/

    function admitpatient($room, $bed, $patient, $data_beds, $data_admission, $data_patient_status){
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
                                "price"=>$query->room_price,
                                "patient_id"=>$patient
                              );
        $this->db->insert('bed_billing', $data_bed_billing);
    }

    function remove_patient_from_previous_admit($patient){
        $data = array("bed_patient"=>NULL);
        $this->db->where('bed_patient', $patient);
        $this->db->update('beds', $data);

        $this->db->select('*');
        $this->db->from('bed_billing');
        $this->db->where('patient_id', $patient);
        $this->db->order_by('bed_bill_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        $data_bill = array("bed_bill_status"=>1);
        $this->db->where('bed_bill_id',$query->row()->bed_bill_id);
        $this->db->update('bed_billing', $data_bill);

        $data_admission = array("status"=>1);
        $this->db->where('patient_id', $patient);
        $this->db->update('admission_schedule', $data_admission);
    }

    function get_patients(){
      $this->db->select('*');
      $this->db->from('patient');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_non_admitted_patient_list(){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_status', 0);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_admitted_patients(){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_status !=', 0);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_patient_detail($id){
      $this->db->select('*');
      $this->db->from('patient');
      $this->db->where('patient_id', $id);
      $query = $this->db->get();
      return $query->row();
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
      $this->db->from('rooms a');
      $this->db->join('room_type b', 'a.room_type=b.room_type_id', 'left');
      $this->db->where('b.room_name = "Emergency Room"');
      $this->db->join('occupancy c', 'a.occupancy_status=c.occupancy_status_id', 'left');
      $this->db->join('maintenance d', 'a.maintenance_status=d.maintenance_status_id', 'left');
      $this->db->order_by('a.room_id','asc');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_emergency_room_beds($id){
      $this->db->select('*');
      $this->db->from('beds b');
      $this->db->join('rooms r', 'r.room_id=b.bed_roomid', 'left');
      $this->db->join('patient p', 'p.patient_id=b.bed_patient', 'left');
      $this->db->where('b.bed_roomid', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_emergency_room_admitted(){
      $this->db->select('*');
      $this->db->from('admission_schedule as');
      $this->db->join('patient p', 'p.patient_id = as.patient_id', 'left');
      $this->db->join('beds b', 'b.bed_id = as.bed', 'left');
      $this->db->join('rooms r', 'b.bed_roomid = r.room_id', 'left');
      $this->db->join('room_type rt', 'r.room_type = rt.room_type_id', 'left');
      $this->db->where('rt.room_name = "Emergency Room"');
      $this->db->where('as.status', 0);
      $query = $this->db->get();
      return $query->result_array();
    }

    function remove_patient_from_er($patient){
        $data = array("bed_patient"=>NULL);
        $this->db->where('bed_patient', $patient);
        $this->db->update('beds_emergency', $data);

        $this->db->select('*');
        $this->db->from('bill_er');
        $this->db->where('patient_id', $patient);
        $this->db->order_by('bill_er_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        $data_bill = array("bill_status"=>1);
        $this->db->where('bill_er_id',$query->row()->bill_er_id);
        $this->db->update('bill_er', $data_bill);

        $data_admission = array("status"=>1);
        $this->db->where('patient_id', $patient);
        $this->db->update('admission_emergency_room', $data_admission);
    }
    /*Emergency*/

      /*ICU*/
      function get_icu_rooms(){
       $this->db->select('*');
       $this->db->from('rooms a');
       $this->db->join('room_type b', 'a.room_type=b.room_type_id', 'left');
       $this->db->where('b.room_name = "ICU"');
       $this->db->join('occupancy c', 'a.occupancy_status=c.occupancy_status_id', 'left');
       $this->db->join('maintenance d', 'a.maintenance_status=d.maintenance_status_id', 'left');
       $this->db->order_by('a.room_id','asc');
       $query = $this->db->get();
       return $query->result_array();
      }

      function get_icu_room_beds($id){
        $this->db->select('*');
        $this->db->from('beds b');
        $this->db->join('rooms r', 'r.room_id=b.bed_roomid', 'left');
        $this->db->join('patient p', 'p.patient_id=b.bed_patient', 'left');
        $this->db->where('b.bed_roomid', $id);
        $query = $this->db->get();
        return $query->result_array();
      }

      function get_icu_room_admitted(){
        $this->db->select('*');
        $this->db->from('admission_schedule as');
        $this->db->join('patient p', 'p.patient_id = as.patient_id', 'left');
        $this->db->join('beds b', 'b.bed_id = as.bed', 'left');
        $this->db->join('rooms r', 'b.bed_roomid = r.room_id', 'left');
        $this->db->join('room_type rt', 'r.room_type = rt.room_type_id', 'left');
        $this->db->where('rt.room_name = "ICU"');
        $this->db->where('as.status', 0);
        $query = $this->db->get();
        return $query->result_array();
      }

      function remove_patient_from_icu($patient){
        $data = array("bed_patient"=>NULL);
        $this->db->where('bed_patient', $patient);
        $this->db->update('beds_intensive', $data);

        $this->db->select('*');
        $this->db->from('bill_icu');
        $this->db->where('patient_id', $patient);
        $this->db->order_by('bill_icu_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        $data_bill = array("bill_status"=>1);
        $this->db->where('bill_icu_id',$query->row()->bill_icu_id);
        $this->db->update('bill_icu', $data_bill);

        $data_admission = array("status"=>1);
        $this->db->where('patient_id', $patient);
        $this->db->update('admission_intensive_room', $data_admission);
      }
      /*ICU*/

      /*OR*/
      function get_operating_rooms(){
        $this->db->select('*');
        $this->db->from('rooms a');
        $this->db->join('room_type b', 'a.room_type=b.room_type_id', 'left');
        $this->db->where('b.room_name = "Operating Room"');
        $this->db->join('occupancy c', 'a.occupancy_status=c.occupancy_status_id', 'left');
        $this->db->join('maintenance d', 'a.maintenance_status=d.maintenance_status_id', 'left');
        $this->db->order_by('a.room_id','asc');
        $query = $this->db->get();
        return $query->result_array();
      }

      function get_operating_room_beds($id){
        $this->db->select('*');
        $this->db->from('beds b');
        $this->db->join('rooms r', 'r.room_id=b.bed_roomid', 'left');
        $this->db->join('patient p', 'p.patient_id=b.bed_patient', 'left');
        $this->db->where('b.bed_roomid', $id);
        $query = $this->db->get();
        return $query->result_array();
      }

      function get_operating_room_admitted(){
        $this->db->select('*');
        $this->db->from('admission_schedule as');
        $this->db->join('patient p', 'p.patient_id = as.patient_id', 'left');
        $this->db->join('beds b', 'b.bed_id = as.bed', 'left');
        $this->db->join('rooms r', 'b.bed_roomid = r.room_id', 'left');
        $this->db->join('room_type rt', 'r.room_type = rt.room_type_id', 'left');
        $this->db->where('rt.room_name = "Operating Room"');
        $this->db->where('as.status', 0);
        $query = $this->db->get();
        return $query->result_array();
      }

      function remove_patient_from_or($patient){
        $data = array("bed_patient"=>NULL);
        $this->db->where('bed_patient', $patient);
        $this->db->update('beds_operation', $data);

        $this->db->select('*');
        $this->db->from('bill_or');
        $this->db->where('patient_id', $patient);
        $this->db->order_by('bill_or_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        $data_bill = array("bill_status"=>1);
        $this->db->where('bill_or_id',$query->row()->bill_or_id);
        $this->db->update('bill_or', $data_bill);

        $data_admission = array("status"=>1);
        $this->db->where('patient_id', $patient);
        $this->db->update('admission_operation_room', $data_admission);
      }
      /*OR*/

      /*Direct Room*/
      function get_direct_rooms(){
        $this->db->select('*');
        $this->db->from('rooms a');
        $this->db->join('room_type b', 'a.room_type=b.room_type_id', 'left');
        $this->db->where('b.room_name != "Emergency Room" AND b.room_name != "Operating Room" AND b.room_name !="ICU"');
        $this->db->join('occupancy c', 'a.occupancy_status=c.occupancy_status_id', 'left');
        $this->db->join('maintenance d', 'a.maintenance_status=d.maintenance_status_id', 'left');
        $this->db->order_by('a.room_id','asc');
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

      function get_direct_rooms_admitted(){
        $this->db->select('*');
        $this->db->from('admission_schedule as');
        $this->db->join('patient p', 'p.patient_id = as.patient_id', 'left');
        $this->db->join('beds b', 'b.bed_id = as.bed', 'left');
        $this->db->join('rooms r', 'b.bed_roomid = r.room_id', 'left');
        $this->db->join('room_type rt', 'r.room_type = rt.room_type_id', 'left');
        $this->db->where('rt.room_name != "Emergency Room" AND rt.room_name != "Operating Room" AND rt.room_name !="ICU"');
        $this->db->where('as.status', 0);
        $query = $this->db->get();
        return $query->result_array();
      }

      function remove_patient_from_dr($patient){
        $data = array("bed_patient"=>NULL);
        $this->db->where('bed_patient', $patient);
        $this->db->update('beds', $data);

        $this->db->select('*');
        $this->db->from('bed_billing');
        $this->db->where('patient_id', $patient);
        $this->db->order_by('bed_bill_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        $data_bill = array("bed_bill_status"=>1);
        $this->db->where('bed_bill_id',$query->row()->bed_bill_id);
        $this->db->update('bed_billing', $data_bill);

        $data_admission = array("status"=>1);
        $this->db->where('patient_id', $patient);
        $this->db->update('admission_schedule', $data_admission);
      }
      /*Direct Room*/
    }
?>
