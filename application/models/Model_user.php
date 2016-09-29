<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_user extends CI_Model{
	function get_users(){
	  $query = $this->db->query("select * from users a
                                 join user_type b on a.type_id = b.type_id");
      return $query->result_array();

	}

	function get_user_type(){
      $query = $this->db->query("select * from user_type");
      return $query->result_array();
    }

    function get_doctor_specializations(){
      $this->db->select('*');
      $this->db->from('doctor_specializations');
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_tasks($type_id)
    {
      $this->db->select('*');
      $this->db->from('task_usertype tu');
      $this->db->join('task t','tu.task_id=t.task_id','left');
      $this->db->where('user_type_id',$type_id);
      $query = $this->db->get();
      return $query->result_array();
    }

    function get_permissions($type_id)
    {
      $where = "user_type_id ='$type_id' and access='1'";
      $this->db->select('*');
      $this->db->from('permission_usertype pu');
      $this->db->join('permission p','pu.permission_id=p.permission_id','left');
      $this->db->where($where);
      $query = $this->db->get();
      return $query->result_array();
    }

	function insert_user($data){
      $this->db->insert('users', $data);
      $this->db->select('*');
      $this->db->from('users');
      $this->db->order_by("user_id", "desc");
      $this->db->limit(1);
      $query = $this->db->get();
      return $query->row();
    }

    function fetch_count_all_patients(){
      $this->db->select('*');
      $this->db->from('patient');
      $query = $this->db->get();
      return $query->num_rows();
    }

    function fetch_count_all_nurse(){
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('type_id', 3);
      $query = $this->db->get();
      return $query->num_rows();
    }

    function insert_doctor_information($data){
      $this->db->insert('doctor_information', $data);
    }

    function get_doctors_information(){
      $this->db->select('*');
      $this->db->from('doctor_information di');
      $this->db->join('users u', 'di.user_id = u.user_id', 'left');
      $query = $this->db->get();
      return $query->result_array();
    }

    function update_doctor_schedule($data, $id){
      $this->db->where('user_id', $id);
      $this->db->update('doctor_information', $data);
    }

  }
?>
