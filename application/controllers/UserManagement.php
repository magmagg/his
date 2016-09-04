<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class UserManagement extends CI_Controller{

  function __construct(){
    parent::__construct();
      $this->load->model('Model_user');
      $this->load->model('Model_usermanagement');
  }


  public function rolesandpermission(){
      $header['title'] = "HIS: Roles & Permissions";
      $data['task_names'] = $this->Model_usermanagement->fetch_tasks();
      $data['user_types'] = $this->Model_usermanagement->get_usertypes();
      $data['permissions'] = $this->Model_usermanagement->fetch_permissions();
      $data['permittedViews'] = $this->Model_usermanagement->fetchPermittedViews();
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $this->load->view('users/includes/header', $header);
      $this->load->view('usermanagement/rolesandpermission',$data);

  }

  function addrole(){
    $this->form_validation->set_rules('rolename', 'Role name', 'required|trim|xss_clean|strip_tags');
    $this->form_validation->set_rules('desc', 'Description', 'required|trim|xss_clean|strip_tags');

      if($this->form_validation->run()){

        $data = array(
          'name' => $this->input->post('rolename'),
          'description' => $this->input->post('desc')

        );
        if($this->Model_usermanagement->insertRole($data)){

          $this->rolesandpermission();
        }else{


        }

      }else{
        $this->rolesandpermission();

      }

  }

  function updatePermission(){


      $this->form_validation->set_rules('name', 'Role Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('permissions[]', 'Permissions', 'required');

        if($this->form_validation->run()){
          $permissionArrays = $this ->input ->post('permissions');
            if($this->input->post('name') == $this->input->post('oldName')){
                    $this->Model_usermanagement->deleteAllTaskUserTypeById($this->input->post('hiddenUserTypeId'));
                    $this->Model_usermanagement->deleteAllUserTypeById($this->input->post('hiddenUserTypeId'));
                    $this->Model_usermanagement->insertPermissionUserType($permissionArrays);
                    $this->rolesandpermission();
            }else{

            }
        }else{

        }



    }






}
