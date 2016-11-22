<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_appointment extends CI_Model{

      function insertAppointment($data){
        $sql = $this->db->insert('doctor_schedules', $data);
          if($sql){
            return true;
          }else{
            return false;
          }
      }

      function checkDuplicateDate($date){
        $this -> db ->select('*');
        $this -> db ->from('doctor_schedules');
        $this -> db ->where('user_id', $this->session->userdata("user_id"));
        $this -> db ->where('startDate', $date);
        $query = $this->db->get();
        $numrows = $query->num_rows();
          if($numrows > 0){
            return false;
          }else{
            return true;
          }
      }

      function fetchAllAppointments(){
        $this -> db ->select('*');
        $this -> db ->from('doctor_schedules');
        $this -> db ->where('user_id', $this->session->userdata("user_id"));
        $query = $this->db->get();
        return $query->result_array();
      }




  }
