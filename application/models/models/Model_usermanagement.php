<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Model_usermanagement extends CI_Model{

    function fetch_tasks(){
    $this->db->select('*');
    $this->db->from('task');
    $query = $this->db->get();
    return $query->result_array();
    }

    function get_usertypes(){
      $this->db->select('*');
      $this->db->from('user_type');
      $query = $this->db->get();
      return $query->result_array();
    }

    function fetch_permissions(){
      $this->db->select('*');
      $this->db->from('permission');
      $query = $this->db->get();
      return $query->result_array();
    }

    function fetchPermittedViews(){
    $this->db->select('*');
    $this->db->from('permission_usertype');
    $query = $this->db->get();
    return $query->result_array();
  }


  function insertRole($data){
      $sql = $this->db->insert('user_type', $data);
        if($sql){
          return true;
        }else{
          return false;
        }
    }

    function getTaskIdforPermission($id){
      $this->db->select('task_id');
      $this->db->from('permission');
      $this->db->where('permission_id', $id);
      $query = $this->db->get();
      return $query->result_array();
  }

    function deleteAllUserTypeById($id){
      $this->db->where('user_type_id',$id);
      $this->db->delete('permission_usertype');
    }
    function deleteAllTaskUserTypeById($id){
      $this->db->where('user_type_id',$id);
      $this->db->delete('task_usertype');
    }

    function checkExistingTaskUserType($taskId,$userTypeId){
      $this->db->select('task_usertype_id');
      $this->db->from('task_usertype');
      $this->db->where('task_id', $taskId);
      $this->db->where('user_type_id', $userTypeId);
      $query = $this->db->get();

          if($query->num_rows() > 0){
              return false;
          }else{
              return true;
          }

    }

    function insertPermissionUserType($permissionArrays){

        foreach ($permissionArrays as $permissionArray => $value) {
            $data = array(
              'user_type_id' => $this->input->post('hiddenUserTypeId'),
              'permission_id' => $value,
              'access' => 1

            );
          $sql =  $this->db->insert('permission_usertype', $data);

            $taskId = $this->Model_usermanagement->getTaskIdforPermission($value);
            $newTaskId = "";
            foreach ($taskId as $taskID) {
                $newTaskId = $taskID['task_id'];
            }

            $var = array(
              'task_id' => $newTaskId,
              'user_type_id' => $this->input->post('hiddenUserTypeId')
            );
                if($this->Model_usermanagement->checkExistingTaskUserType($newTaskId, $this->input->post('hiddenUserTypeId'))){
                    $sqlquery = $this->db->insert('task_usertype', $var);
                }


        }
    }







}
