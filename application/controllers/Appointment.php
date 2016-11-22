<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Appointment extends CI_Controller{

  function __construct(){
    parent::__construct();
      $this->load->model('Model_user');
      $this->load->model('Model_appointment');
  }



public function viewschedule(){
  $header['title'] = "HIS: View schedules";
  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
  $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
  $this->load->view('users/includes/header', $header);

}


public function myschedule(){
  $header['title'] = "HIS: My schedule";
  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
  $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
  $data['appointments'] = $this->Model_appointment->fetchAllAppointments();
  $this->load->view('users/includes/header', $header);
  $this->load->view('appointment/mysched', $data);
  $this->load->view('users/includes/footer');
  $this->load->view('includes/toastr.php');
}


public function addAppointment(){

if($this->input->post('from') == null  && $this->input->post('end') == null ){
  $this->form_validation->set_rules('adate', 'Date', 'required');
}
if($this->input->post('adate') == null){
  $this->form_validation->set_rules('from', 'start', 'required');
  $this->form_validation->set_rules('end', 'end', 'required');
}
  $this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean|strip_tags');
  $this->form_validation->set_rules('adescription', 'Description', 'required|trim|xss_clean|strip_tags');
    if($this->form_validation->run()){

          if(empty($this->input->post('adate'))){
              $start = $this->input->post('from');
              $end = $this->input->post('end');
          }
          if(empty($this->input->post('from'))){
              $start = $this->input->post('adate');
              $end = '';
          }


          $data = array(
            'user_id' => $this->session->userdata("user_id"),
            'title' => $this->input->post('title'),
            'startDate' => $start,
            'endDate' => $end,
            'description' => $this->input->post('adescription')
          );

          if($this->Model_appointment->checkDuplicateDate($start)){



                  if($this->Model_appointment->insertAppointment($data)){


                    $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                                              <input type="hidden" id="msg" value="Appointment added successfully.">
                                                              <input type="hidden" id="type" value="success">' );
                    $this->myschedule();
                  }else{

                    $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Warning">
                                                              <input type="hidden" id="msg" value="Appointment added successfully.">
                                                              <input type="hidden" id="type" value="warning">' );
                    $this->myschedule();

                  }

           }else{

             $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Warning">
                                                       <input type="hidden" id="msg" value="you already have an appointment on that time.">
                                                       <input type="hidden" id="type" value="warning">' );
             $this->myschedule();

           }


    }else{

      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Failed">
                               <input type="hidden" id="msg" value="'. validation_errors().'">
                                <input type="hidden" id="type" value="error">' );
      $this->myschedule();

    }

}



}
