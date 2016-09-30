<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class UserManagement extends CI_Controller{

  function __construct(){
    parent::__construct();
      $this->load->model('Model_user');
      $this->load->model('Model_usermanagement');

  }

  public function user(){
	  $data['users'] = $this->Model_user->get_users();
	  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
	  $data['usertypes'] = $this->Model_user->get_user_type();
    $data['specializations'] = $this->Model_user->get_doctor_specializations();
	  $this->load->view('users/includes/header', $header);
    $this->load->view('usermanagement/users',$data);
	  $this->load->view('includes/toastr.php');
  }

  function insert_user(){
	    $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('firstname', 'First Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('middlename', 'Middle Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|strip_tags|is_unique[users.username]');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|strip_tags|is_unique[users.email]');
      $this->form_validation->set_rules('gender', 'Gender', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('birthday', 'birthday', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('mobile_number', 'Phone number', 'required|trim|xss_clean|strip_tags');

      if($this->form_validation->run() == FALSE){
  		 $validation_errors = validation_errors();
  		 $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Error">
                      						  <input type="hidden" id="msg" value="'. validation_errors().'">
                      						  <input type="hidden" id="type" value="error">' );
  		 redirect(base_url().'usermanagement/User');

      }else{
        $data = array("type_id"=>$this->input->post('usertype'),
                      "username"=>$this->input->post('username'),
                      "password"=>sha1("pharmacist"),
                      "email"=>$this->input->post('email'),
                      "first_name"=>$this->input->post('firstname'),
                      "last_name"=>$this->input->post('lastname'),
                      "middle_name"=>$this->input->post('middlename'),
                      "birthdate"=>$this->input->post('birthday'),
                      "contact_number"=>$this->input->post('mobile_number'),
                      "gender"=>$this->input->post('gender'),
                      "status"=>1,
                      "employment_date"=>date('Y-m-d'),
                    );
        $user_id = $this->Model_user->insert_user($data);
        if($this->input->post('usertype') == 2){
          $data = array("user_id"=>$user_id->user_id, "spec_id"=>$this->input->post('specialization'), "user_id_fk"=>$user_id->user_id);
          $this->Model_user->insert_doctor_information($data);
        }
		    //Set Message for Toastr
        $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                    						  <input type="hidden" id="msg" value="Successfully Added User">
                    						  <input type="hidden" id="type" value="success">' );
        redirect(base_url().'usermanagement/User');
      }
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

  public function DoctorSchedule(){
    $header['title'] = "HIS: Doctors";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['doctors_information'] = $this->Model_user->get_doctors_information();
    $this->load->view('users/includes/header', $header);
    $this->load->view('usermanagement/doctorsinformation',$data);
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

  function update_doctor_schedule(){
    $data = array('start_time'=>$this->input->post('updatestarttime'), 'end_time'=>$this->input->post('updateendtime'));
    $this->Model_user->update_doctor_schedule($data, $this->input->post('userid '));
    redirect(base_url().'UserManagement/DoctorSchedule');
  }

}
