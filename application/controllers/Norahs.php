<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Norahs extends CI_Controller{

    function __construct(){
      parent::__construct();
      $this->load->model('Model_core');
        if($this->session->userdata("user_loggedin")==TRUE){
          redirect(base_url()."Dashboard");
        }
    }

    function index(){
      $this->load->view('loginpage.php');
      $this->load->view('includes/toastr.php');
    }

    function checkLogin(){
      $user_username = $this->input->post('user_username');
      $user_password = $this->input->post('user_password');
      $submit_btn = $this->input->post('submit');
      if(!isset($submit_btn)){
        //successfully entered
        $this->form_validation->set_rules('user_username','Employee Username','trim|required|strip_tags');
        $this->form_validation->set_rules('user_password','Employee Password','trim|required|strip_tags');
        if($this->form_validation->run() == TRUE){
          //Success
          $user_username = remove_invisible_characters($user_username);
          $user_username = htmlspecialchars($user_username);
          $user_password = remove_invisible_characters($user_password);
          $user_password = htmlspecialchars($user_password);
          $user_password = sha1($user_password);

          $data['check'] = $this->Model_core->checkLogin($user_username,$user_password);
          if(count($data['check'])>0){
            foreach($data['check'] as $user_details){
              $user_session = array(
                  "user_id"=>$user_details->user_id,
                  "type_id"=>$user_details->type_id,
                  "user_firstname"=>$user_details->first_name,
                  "user_middlename"=>$user_details->middle_name,
                  "user_lastname"=>$user_details->last_name,
                  "user_username"=>$user_details->username,
                  "user_email"=>$user_details->email,
                  "user_gender"=>$user_details->gender,
                  "user_contactnumber"=>$user_details->contact_number,
                  "user_birthday"=>$user_details->birthdate,
                  "user_employmentdate"=>$user_details->employment_date,
                  "user_status"=>$user_details->status,
                  "user_controller_type"=>$user_details->controller_type,
                  "defaultpassword"=>$user_details->default_password,
                  "user_loggedin"=>TRUE
                );
              $this->session->set_userdata($user_session);
              redirect(base_url()."Dashboard");
            }
          }else{
            //Unsuccess
            $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Error">
                                      <input type="hidden" id="msg" value="Invalid username and password.">
                                      <input type="hidden" id="type" value="error">' );
            $this->index();
          }
        }else{
          //Unsuccess
          $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Error">
                                    <input type="hidden" id="msg" value="'. validation_errors().'">
                                    <input type="hidden" id="type" value="error">' );
          $this->index();
        }
      }else{
        //Unsuccess
        echo "Wrong password and Username!";
        $this->index();
      }
    }
  }
?>
