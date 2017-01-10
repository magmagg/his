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

      function checkDuplicateDate($start, $end, $id, $day){
        $this -> db ->select('*');
        $this -> db ->from('doctor_schedules');
        $this -> db ->where('user_id', $id);
        $this -> db ->where('day', $day);
        $this -> db ->where('startTime >=', $start);
        $this -> db ->where('endTime <=', $end);
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

      
      function get_all_doctors(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('type_id', 2);
        $query = $this->db->get();
        return $query->result_array();
      }

      function checkuserid($id){
           $this->db->select('*');
           $this->db->from('users');
           $this->db->where('user_id', $id);
              $query = $this->db->get();
               $numrows = $query->num_rows();
                if($numrows == 0){
                  return false;
                }else{
                  return true;
                }
      }


      function get_all_scheds_in_sunday($id){
          $this -> db ->select('*');
          $this -> db ->from('doctor_schedules');
          $this -> db ->where('user_id', $id);
          $this -> db ->where('day', 'Sunday');
          $query = $this->db->get();
          return $query->result_array();
      }

      function get_all_scheds_in_monday($id){
          $this -> db ->select('*');
          $this -> db ->from('doctor_schedules');
          $this -> db ->where('user_id', $id);
          $this -> db ->where('day', 'Monday');
          $query = $this->db->get();
          return $query->result_array();
      }

       function get_all_scheds_in_tuesday($id){
          $this -> db ->select('*');
          $this -> db ->from('doctor_schedules');
          $this -> db ->where('user_id', $id);
          $this -> db ->where('day', 'Tuesday');
          $query = $this->db->get();
          return $query->result_array();
      }

       function get_all_scheds_in_wednesday($id){
          $this -> db ->select('*');
          $this -> db ->from('doctor_schedules');
          $this -> db ->where('user_id', $id);
          $this -> db ->where('day', 'Wednesday');
          $query = $this->db->get();
          return $query->result_array();
      }

       function get_all_scheds_in_thursday($id){
          $this -> db ->select('*');
          $this -> db ->from('doctor_schedules');
          $this -> db ->where('user_id', $id);
          $this -> db ->where('day', 'Thursday');
          $query = $this->db->get();
          return $query->result_array();
      }

       function get_all_scheds_in_friday($id){
          $this -> db ->select('*');
          $this -> db ->from('doctor_schedules');
          $this -> db ->where('user_id', $id);
          $this -> db ->where('day', 'Friday');
          $query = $this->db->get();
          return $query->result_array();
      }

       function get_all_scheds_in_saturday($id){
          $this -> db ->select('*');
          $this -> db ->from('doctor_schedules');
          $this -> db ->where('user_id', $id);
          $this -> db ->where('day', 'Saturday');
          $query = $this->db->get();
          return $query->result_array();
      }




  }
