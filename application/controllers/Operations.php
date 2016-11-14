<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Operations extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('Model_user');
    $this->load->model('Model_operations');
  }

  function OperationsList(){
    $header['title'] = "HIS: Emergency Room Admission";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['operations'] = $this->Model_operations->get_list_of_operations();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('operations/list_of_operations.php',$data);
    $this->load->view('includes/toastr.php');
  }

  function change_operation_status(){
    $success = $this->Model_operations->change_operation_status($this->uri->segment(3), $this->uri->segment(4));
    if($success){
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Successfully updated operation.">
                                <input type="hidden" id="type" value="success">');
                                redirect(base_url()."Operations/OperationsList");

    }else{
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Something is not right.">
                                <input type="hidden" id="type" value="success">');
                                redirect(base_url()."Operations/OperationsList");
    }
  }

  function insert_operation(){
    $this->form_validation->set_rules('name', 'Operation Name', 'xss_clean|strip_tags|required|is_unique[operations.operation_name]');
    $this->form_validation->set_rules('price', 'Price', 'xss_clean|strip_tags|required');
    if($this->form_validation->run() == FALSE){
      $validation_errors = validation_errors();
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Error">
                                   <input type="hidden" id="msg" value="'. validation_errors().'">
                                   <input type="hidden" id="type" value="error">' );
      redirect(base_url()."Operations/OperationsList");
    }else{
      $data = array(
        "operation_name"=>$this->input->post('name'),
        "price"=>$this->input->post('price'),
        "status"=>1
      );
      $this->Model_operations->insert_operation($data);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Successfully Added Operation">
                                <input type="hidden" id="type" value="success">' );
      redirect(base_url()."Operations/OperationsList");
    }
  }

  function update_operation(){
    if($this->input->post("originalname") != $this->input->post("updatename")){
      $isunique = "|is_unique[operations.operation_name]";
    }else{
      $isunique = "";
    }

    $this->form_validation->set_rules('updatename', 'Operation Name', 'xss_clean|strip_tags|required'.$isunique);
    $this->form_validation->set_rules('updateprice', 'Price', 'xss_clean|strip_tags|required');
    if($this->form_validation->run() == FALSE){
      $validation_errors = validation_errors();
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Error">
                                   <input type="hidden" id="msg" value="'. validation_errors().'">
                                   <input type="hidden" id="type" value="error">' );
      redirect(base_url().'Operations/OperationsList');
    }else{
      $data = array(
        "operation_name"=>$this->input->post('updatename'),
        "price"=>$this->input->post('updateprice')
      );
      $this->Model_operations->update_operation($data, $this->input->post('updateid'));
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Successfully updated operation.">
                                <input type="hidden" id="type" value="success">' );
      redirect(base_url().'Operations/OperationsList');
    }
  }
}
?>
