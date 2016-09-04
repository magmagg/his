<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');

  class Model_core extends CI_Model{
  	function __construct(){
  		parent::__construct();
  	}

  	function checkLogin($user_username,$user_password){
  		$where = array(
  				"u.username"=>$user_username,
  				"u.password"=>$user_password,
  				"u.status"=>1
  			);
      $this->db->select('*');
      $this->db->from('users u');
      $this->db->join('user_type ut', 'u.type_id=ut.type_id', 'left');
      $this->db->where($where);
  		$data = $this->db->get();
  		return $data->result();
  	}

    function fetchAllUserTypes(){
      $this -> db ->select('*');
      $this -> db ->from('user_type');
      $data = $this->db->get();
      return $data->result_array();
    }



  }
 ?>
