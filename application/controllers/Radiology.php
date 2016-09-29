<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Radiology extends CI_Controller{

    function __construct(){
      parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('Model_radiology');
    }

    function ViewRequest(){
      $header['title'] = "HIS: View Radiology Request";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['radiology_requests'] = $this->Model_radiology->get_radiology_request($this->session->userdata('user_id'));
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('radiology/radiology_requests.php', $data);
      $this->load->view('includes/toastr.php');
    }

    function MakeRadiologyRequest(){
      $header['title'] = "HIS: Make Radiology Request";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['radiology_exams'] = $this->Model_radiology->get_radiology_exams();
      $data['patients'] = $this->Model_radiology->get_patient_list();
      $this->load->view('users/includes/header.php', $header);
      $this->load->view('radiology/makeradiologyrequst.php', $data);
    }

    function Maintenance(){
      $header['title'] = "HIS: Radiology Maintenance";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['radiology_exams'] = $this->Model_radiology->get_radiology_exams();
      $this->load->view('users/includes/header.php', $header);
      $this->load->view('radiology/maintenance.php', $data);
      $this->load->view('includes/toastr.php');
    }

    function InactiveExams(){
      $header['title'] = "HIS: Inactive Exams";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['radiology_exams'] = $this->Model_radiology->get_inactive_radiology_exams();
      $this->load->view('users/includes/header.php', $header);
      $this->load->view('radiology/inactive_exams.php', $data);
      $this->load->view('includes/toastr.php');
    }

    function RadiologyRequests(){
      $header['title'] = "HIS: All Radiology Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['radiology_requests'] = $this->Model_radiology->get_radiology_requests();
      $data['total_radiology_request'] = $this->Model_radiology->count_all_radiology_request();
      $data['total_pending_request'] = $this->Model_radiology->count_pending_radiology_request();
      $this->load->view('users/includes/header.php', $header);
      $this->load->view('radiology/radiology_requests.php', $data);
    }

    function PendingRadiologyRequests(){
      $header['title'] = "HIS: Pending Radiology Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['radiology_requests'] = $this->Model_radiology->get_pending_requests();
      $data['total_radiology_request'] = $this->Model_radiology->count_all_radiology_request();
      $data['total_pending_request'] = $this->Model_radiology->count_pending_radiology_request();
      $this->load->view('users/includes/header.php', $header);
      $this->load->view('radiology/pending_requests.php', $data);
      $this->load->view('includes/toastr.php');
    }

    function approve_request($trans_id){
      $data = array('request_status'=>1);
      $this->Model_radiology->approve_request($trans_id, $data);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Approved radiology request">
                                <input type="hidden" id="type" value="success">' );
      redirect(base_url().'Radiology/PendingRadiologyRequests');
    }

    function DeactivateExam($id){
      $data = array('exam_status'=>0);
      $this->Model_radiology->deactivate($id, $data);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Deactivated radiology exam">
                                <input type="hidden" id="type" value="success">' );
      redirect(base_url()."Radiology/Maintenance", "refresh");
    }

    function ActivateExam($id){
      $data = array('exam_status'=>1);
      $this->Model_radiology->activate($id, $data);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Activated radiology exam">
                                <input type="hidden" id="type" value="success">' );
      redirect(base_url()."Radiology/InactiveExams", "refresh");
    }


    function insert_radiology_exam(){
      $this->form_validation->set_rules('name', 'Exam Name', 'required|trim');
      $this->form_validation->set_rules('description', 'Exam Description', 'required|trim');
      $this->form_validation->set_rules('price', 'Exam Price', 'required|trim');
      if($this->form_validation->run() == FALSE){
        echo validation_errors();
      }else{
        $data = array(
                      'exam_name'=>$this->input->post('name'),
                      'exam_description'=>$this->input->post('description'),
                      'exam_price'=>$this->input->post('price'),
                      'exam_status'=>1
                     );
        $this->Model_radiology->insert_radiology_exam($data);
        $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                    						  <input type="hidden" id="msg" value="Added new radiology exam">
                    						  <input type="hidden" id="type" value="success">' );
        redirect(base_url()."Radiology/Maintenance", "refresh");
      }
    }

    function insert_request(){
      $this->form_validation->set_rules('exams[]', 'Radiology Exams', 'required|trim');
      $this->form_validation->set_rules('patient', 'Patient', 'required|trim');
      $this->form_validation->set_rules('note', 'Request Note', 'trim|xss_clean|strip_tags');
      if($this->form_validation->run() == FALSE){
        echo validation_errors();
      }else{
        $exams = $this->input->post('exams[]');
        for($i = 0; $i<count($exams); $i++){
          $data_radiology_request = array(
                        'exam_id'=>$exams[$i],
                        'patient_id'=>$this->input->post('patient'),
                        'request_date'=>date('Y-m-d'),
                        'user_id_fk'=>$this->session->userdata('user_id'),
                        'req_notes'=>$this->input->post('note')
                       );
          $request = $this->Model_radiology->insert_request($data_radiology_request);
          $data_radiology_pat = array(
                                      'rad_reqid'=>$request->request_id,
                                      'pat_id'=>$this->input->post('patient'),
                                      'request_status'=>0
                                     );
          $this->Model_radiology->insert_radiology_pat($data_radiology_pat);
        }
        $name = $request->first_name." ".$request->middle_name." ".$request->last_name;
        $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                    						  <input type="hidden" id="msg" value="Successfully requested radiology exam for '.$name.'">
                    						  <input type="hidden" id="type" value="success">' );
        redirect(base_url()."Radiology/ViewRequest");
      }
    }

  }
?>
