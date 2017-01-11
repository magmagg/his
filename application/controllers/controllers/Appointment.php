<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Appointment extends CI_Controller{
  function __construct(){
    parent::__construct();
      $this->load->model('Model_user');
      $this->load->model('Model_appointment');
  }
public function viewschedule(){
  $header['title'] = "HIS: View schedule";
  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
  $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
  $user_id = $this->uri->segment(3);
  $data['monday_datas'] = $this->Model_appointment->get_all_scheds_in_monday($user_id);
  $data['tuesday_datas'] = $this->Model_appointment->get_all_scheds_in_tuesday($user_id);
  $data['wednesday_datas'] = $this->Model_appointment->get_all_scheds_in_wednesday($user_id);
  $data['thursday_datas'] = $this->Model_appointment->get_all_scheds_in_thursday($user_id);
  $data['friday_datas'] = $this->Model_appointment->get_all_scheds_in_friday($user_id);
  $data['saturday_datas'] = $this->Model_appointment->get_all_scheds_in_saturday($user_id);
  $data['sunday_datas'] = $this->Model_appointment->get_all_scheds_in_sunday($user_id);
  $this->load->view('users/includes/header', $header);
  $this->load->view('appointment/sched', $data);
  $this->load->view('appointment/footer');
  $this->load->view('includes/toastr.php');
}


public function schedules(){
  $header['title'] = "HIS: My schedule";
  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
  $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
  $data['doctors'] = $this->Model_appointment->get_all_doctors();
  $this->load->view('users/includes/header', $header);
  $this->load->view('appointment/schedules', $data);
  $this->load->view('appointment/footer');
  $this->load->view('includes/toastr.php');
}




public function arrangeSchedule(){
  $header['title'] = "HIS: Arrange schedule";
  $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
  $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
  $data['doctors'] = $this->Model_appointment->get_all_doctors();
  $user_id = $this->uri->segment(3);
  $this->load->view('users/includes/header', $header);
  if($this->Model_appointment->checkuserid($user_id)){
      $data['monday_datas'] = $this->Model_appointment->get_all_scheds_in_monday($user_id);
      $data['tuesday_datas'] = $this->Model_appointment->get_all_scheds_in_tuesday($user_id);
      $data['wednesday_datas'] = $this->Model_appointment->get_all_scheds_in_wednesday($user_id);
      $data['thursday_datas'] = $this->Model_appointment->get_all_scheds_in_thursday($user_id);
      $data['friday_datas'] = $this->Model_appointment->get_all_scheds_in_friday($user_id);
      $data['saturday_datas'] = $this->Model_appointment->get_all_scheds_in_saturday($user_id);
      $data['sunday_datas'] = $this->Model_appointment->get_all_scheds_in_sunday($user_id);
     $this->load->view('appointment/editsched', $data);
  }else{
    $this->load->view('appointment/manageschedule', $data);
  }
  $this->load->view('appointment/footer');
  $this->load->view('includes/toastr.php');
}

public function addschedule(){

  $hiddenid = $this->input->post('hiddenId');
  echo $this->input->post('seletedDay');
  echo $this->input->post('from');
  echo $this->input->post('to');
  echo $this->input->post('description');

  $this->form_validation->set_rules('seletedDay','Day','trim|required|strip_tags');
  $this->form_validation->set_rules('from','Start time','trim|required|strip_tags');
  $this->form_validation->set_rules('to','end time','trim|required|strip_tags');
  $this->form_validation->set_rules('description','description','trim|required|strip_tags');
  
  if($this->form_validation->run()){

     $data = array(
            'user_id' => $hiddenid,
            'startTime' => $this->input->post('from'),
            'endTime' => $this->input->post('to'),
            'description' => $this->input->post('description'),
            'day' => $this->input->post('seletedDay')
          );

          if($this->Model_appointment->checkDuplicateDate($this->input->post('from'), $this->input->post('to'), $hiddenid, $this->input->post('seletedDay'))){

          
                if($this->Model_appointment->insertAppointment($data)){
                    $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                                                        <input type="hidden" id="msg" value="Schedule added successfully.">
                                                                        <input type="hidden" id="type" value="success">' );
                    redirect(base_url().'Appointment/arrangeSchedule/'.$hiddenid, 'refresh');
                                                                        

                }else{
                    $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Warning">
                                                                        <input type="hidden" id="msg" value="something went wrong.">
                                                                        <input type="hidden" id="type" value="warning">' );
                    redirect(base_url().'Appointment/arrangeSchedule/'.$hiddenid, 'refresh');
                }

          }else{

                $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Warning">
                                                                        <input type="hidden" id="msg" value="time range is already taken.">
                                                                        <input type="hidden" id="type" value="warning">' );
                    redirect(base_url().'Appointment/arrangeSchedule/'.$hiddenid, 'refresh');

          }


    

  }else{
     $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Failed">
                               <input type="hidden" id="msg" value="'. validation_errors().'">
                                <input type="hidden" id="type" value="error">' );

        redirect(base_url().'Appointment/arrangeSchedule/'.$hiddenid, 'refresh');

  }



}











}
