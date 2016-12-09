<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Admitting extends CI_Controller{

  function __construct(){
    parent::__construct();
      $this->load->model('Model_user');
      $this->load->model('Model_admitting');
  }

  public function EmergencyRoom(){
    $header['title'] = "HIS: Emergency Room Admission";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['emergency_room_data'] = $this->Model_admitting->get_available_beds_from_emergency_room();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choose_er_room.php', $data);
  }

  public function DirectRoomAdmission(){
    $header['title'] = "HIS: Direct Room Admission";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['rooms'] = $this->Model_admitting->get_room_list_for_directadmission();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choose_direct_room.php', $data);
  }

  function ChooseBed(){
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['beds'] = $this->Model_admitting->get_available_beds_for_directadmission($this->uri->segment(3));
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choose_bed.php', $data);
  }

  function ChoosePatientToDR(){
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['patients'] = $this->Model_admitting->get_non_admitted_patient_list();
    $data['bed_id'] = $this->uri->segment(3);
    $data['roomid'] = $this->uri->segment(4);
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choosepatient_to_dr.php', $data);
  }


  public function AdmittedPatients($id = null){
    $header['title'] = "HIS: Admitted Patients";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $this->load->view('users/includes/header.php',$header);
    if(empty($id)){
      $data['rooms'] = $this->Model_admitting->get_room_list();
      $this->load->view('admitting/roomlist.php', $data);
    }else{
      $data['beds'] = $this->Model_admitting->get_admitted_patient($id);
      $this->load->view('admitting/viewadmittedpatient.php', $data);
    }
    $this->load->view('includes/toastr.php');
  }

  public function ChoosePatient(){
    $header['title'] = "HIS: Choose Patient";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['patients'] = $this->Model_admitting->get_non_admitted_patient_list();
    $data['bed_id'] = $this->uri->segment(3);
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choosepatient_to_er.php', $data);
  }

  function admit_patient_to_ER(){
    $bed_id = $this->uri->segment(3);
    $patient = $this->input->post('patient');
    $data_bedstable = array(
                  "bed_patient"=>$patient
                );
    $data_admission_schedule = array(
                                      "admission_date"=>date('Y-m-d H:i:s'),
                                      "patient_id"=>$patient,
                                      "bed"=>$bed_id,
                                      "status"=>1
                                    );
    $data_admitting_resident = array(
                                      "user_id"=>$this->session->userdata("user_id"),
                                      "patient_id"=>$patient,
                                      "user_id_fk"=>$this->session->userdata("user_id")
                                    );
    $data_update_patient_status = array(
                                        "patient_status"=>1
                                      );

    $sql = $this->Model_admitting->admit_patient($data_bedstable, $data_admission_schedule, $data_admitting_resident, $data_update_patient_status, $bed_id, $patient);
    $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                              <input type="hidden" id="msg" value="Patient has been admitted.">
                              <input type="hidden" id="type" value="success">' );

    redirect(base_url().'Admitting/AdmittedPatients/1', 'refresh');
  }

  function admit_patient_to_dr(){
    $bed_id = $this->uri->segment(3);
    $roomid = $this->uri->segment(4);
    $patient = $this->input->post('patient');
    $data_bedstable = array(
                  "bed_patient"=>$patient
                );
    $data_admission_schedule = array(
                                      "admission_date"=>date('Y-m-d H:i:s'),
                                      "patient_id"=>$patient,
                                      "status"=>1
                                     );
    $data_admitting_resident = array(
                                      "user_id"=>$this->session->userdata("user_id"),
                                      "patient_id"=>$patient,
                                      "user_id_fk"=>$this->session->userdata("user_id")
                                    );
   $data_update_patient_status = array(
                                        "patient_status"=>2
                                      );
   $sql = $this->Model_admitting->admit_patient($data_bedstable, $data_admission_schedule, $data_admitting_resident, $data_update_patient_status, $bed_id, $patient);
   redirect(base_url().'Admitting/AdmittedPatients/'.$roomid, 'refresh');
  }

  function DischargePatient(){
    $data_discharge = array("status"=>2);
    $data_update_bed = array("bed_patient"=>NULL);
    $data_update_patient = array("patient_status"=>0);
    $this->Model_admitting->dischargepatient($data_discharge, $data_update_bed, $data_update_patient, $this->uri->segment(3), $this->uri->segment(4));
    redirect($this->agent->referrer(), 'refresh');
  }

  function TransferRoom(){
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['rooms'] = $this->Model_admitting->get_room_list_for_directadmission();
    $data['patientid'] = $this->uri->segment(3);
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choose_room_to_transfer.php', $data);
  }

  function ChooseBedToTransfer(){
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['beds'] = $this->Model_admitting->get_available_beds_for_directadmission($this->uri->segment(4));
    $data['patientid'] = $this->uri->segment(3);
    $data['roomid'] = $this->uri->segment(4);
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('admitting/choose_bed_to_transfer.php', $data);
  }

  function TransferPatient($patientid, $bedid, $roomid){
    $data_remove_patient_from_prev_bed = array("bed_patient"=>NULL);
    $data_transfer_patient_to_new_bed = array("bed_patient"=>$patientid);
    $update_patient_status = array("patient_status"=>2);
    $this->Model_admitting->transfer_patient($data_remove_patient_from_prev_bed, $data_transfer_patient_to_new_bed, $update_patient_status, $bedid, $patientid);
    redirect(base_url().'Admitting/AdmittedPatients/'.$roomid);
  }
}
?>
