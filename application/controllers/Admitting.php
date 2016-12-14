<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Admitting extends CI_Controller{

  function __construct(){
    parent::__construct();
      $this->load->model('Model_user');
      $this->load->model('Model_admitting');
  }

  function EmergencyRoom(){
    $header['title'] = "HIS: Emergency Room Admission";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    if($this->uri->segment(3) == FALSE){
      $data['emergency_room'] = $this->Model_admitting->get_emergency_rooms();
      $this->load->view('admitting/choose_er_room.php', $data);
    }else{
      $data['emergency_room_beds'] = $this->Model_admitting->get_emergency_room_beds($this->uri->segment(3));
      $this->load->view('admitting/choose_er_bed.php', $data);
    }
    $this->load->view('admitting/footer.php');
  }

  function DirectRoom(){
    $header['title'] = "HIS: Emergency Room Admission";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    if($this->uri->segment(3) == FALSE){
      $data['direct_room'] = $this->Model_admitting->get_direct_rooms();
      $this->load->view('admitting/choose_direct_room.php', $data);
    }else{
      $data['direct_room_beds'] = $this->Model_admitting->get_direct_room_beds($this->uri->segment(3));
      $this->load->view('admitting/choose_direct_room_bed.php', $data);
    }
    $this->load->view('admitting/footer.php');
  }

  function ICU(){
    $header['title'] = "HIS: Emergency Room Admission";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    if($this->uri->segment(3) == FALSE){
      $data['icu_room'] = $this->Model_admitting->get_icu_rooms();
      $this->load->view('admitting/choose_icu_room.php', $data);
    }else{
      $data['icu_room_beds'] = $this->Model_admitting->get_icu_room_beds($this->uri->segment(3));
      $this->load->view('admitting/choose_icu_bed.php', $data);
    }
    $this->load->view('admitting/footer.php');
  }

  function OperatingRoom(){
    $header['title'] = "HIS: Emergency Room Admission";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    if($this->uri->segment(3) == FALSE){
      $data['operating_room'] = $this->Model_admitting->get_operating_rooms();
      $this->load->view('admitting/choose_operating_room.php', $data);
    }else{
      $data['operation_room_beds'] = $this->Model_admitting->get_operating_room_beds($this->uri->segment(3));
      $this->load->view('admitting/choose_operating_room_bed.php', $data);
    }
    $this->load->view('admitting/footer.php');
  }

  function ChoosePatient(){
    $header['title'] = "HIS: Choose Patient";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['patients'] = $this->Model_admitting->get_non_admitted_patient_list();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choosepatient.php', $data);
    $this->load->view('admitting/footer.php');
  }

  function AdmittedPatients(){
    $header['title'] = "HIS: Choose Patient";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['direct_room'] = $this->Model_admitting->get_direct_rooms();
    $data['operating_room'] = $this->Model_admitting->get_operating_rooms();
    $data['emergency_room'] = $this->Model_admitting->get_emergency_rooms();
    $data['icu_room'] = $this->Model_admitting->get_icu_rooms();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choose_room_to_view', $data);
    $this->load->view('admitting/footer');
  }

  function DirectRoomPatients(){
    $header['title'] = "HIS: Direct Room Patients";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    $data['direct_room_patients'] = $this->Model_admitting->get_direct_rooms_admitted();
    $this->load->view('admitting/choose_direct_room_patients', $data);
    $this->load->view('admitting/footer');
  }

  function EmergencyRoomPatients(){
    $header['title'] = "HIS: Emergency Room Patients";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    $data['emergency_room_patients'] = $this->Model_admitting->get_emergency_room_admitted();
    $this->load->view('admitting/choose_emergency_room_patients', $data);
    $this->load->view('admitting/footer');
  }

  function OperatingRoomPatients(){
    $header['title'] = "HIS: Operating Room Patients";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    $data['operating_room_patients'] = $this->Model_admitting->get_operating_room_admitted();
    $this->load->view('admitting/choose_operating_room_patients', $data);
    $this->load->view('admitting/footer');
  }

  function ICUPatients(){
    $header['title'] = "HIS: ICU Patients";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    $data['icu_room_patients'] = $this->Model_admitting->get_icu_room_admitted();
    $this->load->view('admitting/choose_icu_room_patients', $data);
    $this->load->view('admitting/footer');
  }

  function TransferPatient(){
    $header['title'] = "HIS: Transfer Patients";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    if(!$this->uri->segment(3)){
      $data['patients'] = $this->Model_admitting->get_admitted_patients();
      $this->load->view('admitting/choosepatient_transfer.php', $data);
    }else{
      $data['direct_room'] = $this->Model_admitting->get_direct_rooms();
      $data['operating_room'] = $this->Model_admitting->get_operating_rooms();
      $data['emergency_room'] = $this->Model_admitting->get_emergency_rooms();
      $data['icu_room'] = $this->Model_admitting->get_icu_rooms();
      $this->load->view('admitting/chooseroom_transfer', $data);
    }
    $this->load->view('admitting/footer');
  }

  function DirectRoomTransfer(){
    $header['title'] = "HIS: Direct Room Patient Transfer";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['patient_detail'] = $this->Model_admitting->get_patient_detail($this->uri->segment(3));
    $data['direct_room'] = $this->Model_admitting->get_direct_rooms();
    $this->load->view('users/includes/header.php',$header);
  }

  function EmergencyRoomTransfer(){
    $header['title'] = "HIS: Direct Room Patient Transfer";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
  }

  function OperatingRoomTransfer(){
    $header['title'] = "HIS: Direct Room Patient Transfer";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
  }

  function ICUTransfer(){
    $header['title'] = "HIS: Direct Room Patient Transfer";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
  }

  function admitpatient(){
    $room = $this->uri->segment(3);
    $bed = $this->uri->segment(4);
    $patient = $this->uri->segment(5);
    $data_beds = array(
                  "bed_patient"=>$this->uri->segment(5)
                );

    $data_admission = array(
                                      "admission_date"=>date('Y-m-d H:i:s'),
                                      "patient_id"=>$patient,
                                      "bed"=>$bed
                                    );

    if(preg_match("/^[ER]{2}/", $room)){
      $data_patient_status = array("patient_status"=>1, "date_admitted"=>date('Y-m-d H:i:s'));
      $this->Model_admitting->admit_patient_to_er($bed, $patient, $data_beds, $data_admission, $data_patient_status);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                              <input type="hidden" id="msg" value="Patient has been admitted to the Emergency.">
                              <input type="hidden" id="type" value="success">' );
    }else if(preg_match("/^[OR]{2}/", $room)){
      $data_patient_status = array("patient_status"=>4, "date_admitted"=>date('Y-m-d H:i:s'));
      $this->Model_admitting->admit_patient_to_or($bed, $patient, $data_beds, $data_admission, $data_patient_status);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Patient has been admitted to the Operating.">
                                <input type="hidden" id="type" value="success">' );
    }else if(preg_match("/^[ICU]{3}/", $room)){
      $data_patient_status = array("patient_status"=>3, "date_admitted"=>date('Y-m-d H:i:s'));
      $this->Model_admitting->admit_patient_to_icu($bed, $patient, $data_beds, $data_admission, $data_patient_status);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Patient has been admitted to the ICU.">
                                <input type="hidden" id="type" value="success">' );
    }else{
      $data_patient_status = array("patient_status"=>2, "date_admitted"=>date('Y-m-d H:i:s'));
      $this->Model_admitting->admit_patient_to_direct_room($bed, $patient, $data_beds, $data_admission, $data_patient_status);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Patient has been admitted to room.">
                                <input type="hidden" id="type" value="success">' );
    }
    redirect(base_url().'Dashboard', 'refresh');
  }
}
?>
