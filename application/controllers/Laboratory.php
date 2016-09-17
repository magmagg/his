<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Laboratory extends CI_Controller{

    function __construct(){
      parent::__construct();
      $this->load->model('Model_Laboratory');
      $this->load->model('Model_user');
    }

    function LaboratoryRequests(){
      $header['title'] = "HIS: Laboratory Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['laboratoryreq'] = $this->Model_Laboratory->get_laboratoryrequest_list();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/laboratoryrequest.php',$data);
    }

    function ShowLabReq($id){
      $header['title'] = "HIS: Laboratory: Show Laboratory Request";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['requestno'] = $id;
      $data['laboratorytopatient'] = $this->Model_Laboratory->get_laboratorytopatient_data($id);
      $data['laboratorytouser'] =  $this->Model_Laboratory->get_laboratorytouser_data($id);
      $data['laboratorytolabrequest'] = $this->Model_Laboratory->get_laboratorytorequest_data($id);
      $data['laboratorytospecimen'] = $this->Model_Laboratory->get_laboratorytospecimen_data($id);
      $data['laboratorytoremarks'] = $this->Model_Laboratory->get_laboratorytoremarks_data($id);
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/showlaboratoryrequest.php',$data);
    }


    function MakeLaboratoryRequests(){
      $header['title'] = "HIS: Laboratory: Create Laboratory Request";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['patientlist'] = $this->Model_Laboratory->get_patient_list();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/makelaboratoryrequest.php',$data);
    }

    function MakeLaboratoryRequests2(){
      $header['title'] = "HIS: Laboratory: Create Laboratory Request";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $patient = $this->input->post('patient');
      if($patient==""){
        redirect(base_url()."Laboratory/MakeLaboratoryRequests");
      }else{
        $data['labexamtype'] = $this->Model_Laboratory->get_all_examtype();
        $data['urgencycat'] = $this->Model_Laboratory->get_all_urgencycategory();
        $data['fastingcat'] = $this->Model_Laboratory->get_all_fastingcategory();
        $data['patient'] = $this->Model_Laboratory->get_single_patient($patient);
        $data['specimen'] = $this->Model_Laboratory->get_all_labspec();
        $this->load->view('users/includes/header.php',$header);
        $this->load->view('laboratory/makelaboratoryrequest2.php',$data);
      }
    }

    function AppofReq(){
      $header['title'] = "HIS: Laboratory: Approval of Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['laboratoryreq'] = $this->Model_Laboratory->get_laboratoryrequest_list();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/approvalofrequest.php',$data);
    }

    function ApproveLabReq($id)
    {
          $data = array('lab_status'=>2);
          $this->Model_Laboratory->approvelabreq($id,$data);
          redirect(base_url()."Laboratory/AppofReq");
    }

    function LabAccRequest()
    {
      $header['title'] = "HIS: Laboratory: Accepted Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['acceptedreq'] = $this->Model_Laboratory->get_accepted_labreq();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/labaccrequest.php',$data);
    }

    function CancelLabReq($id)
    {
            $data = array('lab_status'=>3);
            $this->Model_Laboratory->cancellabreq($id,$data);
            redirect(base_url()."Laboratory/AppofReq");
    }

     function LabRejRequest()
    {
      $header['title'] = "HIS: Laboratory: Rejected Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rejectedreq'] = $this->Model_Laboratory->get_rejected_labreq();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/labrejrequest.php',$data);
    }

    function LabExamCateg(){
      $header['title'] = "HIS: Laboratory: Laboratory Examination Categories";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['examcateg'] = $this->Model_Laboratory->get_all_examcateg();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/labexamcateg.php',$data);
    }

    function EditExamCateg($id){
      $header['title'] = "HIS: Laboratory: Edit Examination Category";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['examcateg'] = $this->Model_Laboratory->get_examcateg($id);
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/editexamcateg.php',$data);
    }

    function LabExamType(){
      $header['title'] = "HIS: Laboratory: Examination Types";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['examtype'] = $this->Model_Laboratory->get_all_examtype();
      $data['examcateg'] = $this->Model_Laboratory->get_all_examcateg();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/labexamtype.php',$data);
    }

    function EditExamType($id){
      $header['title'] = "HIS: Laboratory: Edit Examination Type";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['examtype'] = $this->Model_Laboratory->get_specific_examtype($id);
      $data['examcateg'] = $this->Model_Laboratory->get_all_examcateg();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/editexamtype.php',$data);
    }

    function LabExamSpec(){
      $header['title'] = "HIS: Laboratory: Laboratory Specimens";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['labspec'] = $this->Model_Laboratory->get_all_labspec();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/labexamspec.php',$data);
    }

    function EditSpec($id){
      $header['title'] = "HIS: Laboratory: Edit Specimen";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['spec'] = $this->Model_Laboratory->get_specific_specimen($id);
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('laboratory/editspec.php',$data);
    }

     function insert_patient_thrulaboratory(){
       $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('firstname', 'First Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('middlename', 'Middle Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('gender', 'Gender', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('age', 'Age', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('birthday', 'Birthday', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('birthplace', 'Birthplace', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('occupation', 'Occupation', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('religion', 'Religion', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('nationality', 'Nationality', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('address', 'Address', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('telephone_number', 'Telephone number', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('mobile_number', 'Mobile number', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|strip_tags');

      if($this->form_validation->run() == FALSE){
        echo "may mali";
      }else{
        $data = array(
          'first_name' => $this->input->post('firstname'),
          'last_name' => $this->input->post('lastname'),
          'middle_name' => $this->input->post('middlename'),
          'gender' => $this->input->post('gender'),
          'age' => $this->input->post('age'),
          'birthdate' => $this->input->post('birthday'),
          'birthplace' => $this->input->post('birthplace'),
          'occupation' => $this->input->post('occupation'),
          'religion' => $this->input->post('religion'),
          'nationality' => $this->input->post('nationality'),
          'present_address' => $this->input->post('address'),
          'telephone_number' => $this->input->post('telephone_number'),
          'mobile_number' => $this->input->post('mobile_number'),
          'email' => $this->input->post('email'),
          'patient_status' => "0",
          'date_registered' => date('Y-m-d'),
        );

        $insertpatient = $this->Model_Laboratory->insertpatient($data);
          redirect(base_url()."Laboratory/MakeLaboratoryRequests");

      }
     }

     function insert_category(){
       $this->form_validation->set_rules('categname', 'Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('categdesc', 'Description', 'required|trim|xss_clean|strip_tags');

       if($this->form_validation->run() == FALSE){
         echo "Something's Wrong";
       } else {
         $data = array ('exam_cat_name' => $this->input->post('categname'),
                        'exam_cat_desc' => $this->input->post('categdesc'));
          $insertcategory = $this->Model_Laboratory->insertcategory($data);
          redirect(base_url()."Laboratory/LabExamCateg");
       }
     }

     function update_examination_category($id)
     {
       $this->form_validation->set_rules('catname', 'Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('catdesc', 'Description', 'required|trim|xss_clean|strip_tags');

       if($this->form_validation->run()==FALSE){
         echo "Something's Wrong";
       } else {
         $data = array ('exam_cat_name' => $this->input->post('catname'),
                        'exam_cat_desc' => $this->input->post('catdesc'));
          $insertcategory = $this->Model_Laboratory->updatecategory($id,$data);
          redirect(base_url()."Laboratory/LabExamCateg");
       }
     }

     function update_exam_type($id)
     {
       $this->form_validation->set_rules('typename', 'Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('typecateg', 'Category', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('typedesc', 'Description', 'required|trim|xss_clean|strip_tags');

       if($this->form_validation->run()==FALSE){
         echo "Something's Wrong";
       } else {
         $data = array ('lab_exam_type_name' => $this->input->post('typename'),
                        'lab_exam_type_category_id' => $this->input->post('typecateg'),
                        'lab_exam_type_description' => $this->input->post('typedesc'));
          $insertcategory = $this->Model_Laboratory->updateexamtype($id,$data);
          redirect(base_url()."Laboratory/LabExamType");
       }
     }

     function insert_examtype(){
       $this->form_validation->set_rules('typename', 'Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('examcateg', 'Category', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('typedesc', 'Description', 'required|trim|xss_clean|strip_tags');

       if($this->form_validation->run()==FALSE){
         echo "Something's Wrong";
       } else {
         $data = array('lab_exam_type_name' => $this->input->post('typename'),
                       'lab_exam_type_category_id' => $this->input->post('examcateg'),
                       'lab_exam_type_description' => $this->input->post('typedesc'));
        $insertetype = $this->Model_Laboratory->insertexamtype($data);
              redirect(base_url()."Laboratory/LabExamType");
       }
     }

     function insert_labspecimen()
     {
       $this->form_validation->set_rules('specname', 'Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('specdesc', 'Description', 'required|trim|xss_clean|strip_tags');

       if($this->form_validation->run()==FALSE)
       {
         echo "Something is Wrong";
       }
       else
       {
         $data = array('specimen_name' => $this->input->post('specname'),
                       'specimen_description' => $this->input->post('specdesc'));
         $this->Model_Laboratory->insertspecimen($data);
         redirect(base_url()."Laboratory/LabExamSpec");
       }
     }

     function update_lab_specimen($id){
       $this->form_validation->set_rules('specname', 'Name', 'required|trim|xss_clean|strip_tags');
       $this->form_validation->set_rules('specdesc', 'Description', 'required|trim|xss_clean|strip_tags');

       if($this->form_validation->run()==FALSE)
       {
         echo "Something is Wrong";
       }
       else
       {
         $data = array('specimen_name' => $this->input->post('specname'),
                       'specimen_description' => $this->input->post('specdesc'));
         $this->Model_Laboratory->updatespecimen($id,$data);
         redirect(base_url()."Laboratory/LabExamSpec");
       }
     }

     function insert_laboratoryrequest()
     {
       $this->form_validation->set_rules('labremark', 'Remark', 'required|trim|xss_clean|strip_tags');

       if($this->form_validation->run()==FALSE)
       {
         echo "Something is Wrong";
       }
       else {
         $specimens = $this->input->post('specimens');
         $data1 = array('user_id_fk'=>$_SESSION['user_id'],
                       'lab_patient'=>$this->input->post('patientid'),
                       'lab_date_req'=>date('Y-m-d H:i:s'),
                       'lab_patient_checkin'=>$this->input->post('patientchckin'),
                       'urgency_cat_fk'=>$this->input->post('urgency'),
                       'fasting_cat_fk'=>$this->input->post('fasting'),
                       'exam_type_fk'=>$this->input->post('laboratoryexam'));
            $id = $this->Model_Laboratory->insertlaboratoryrequest($data1);

         foreach($specimens as $spec){
           $data2 = array('lab_req_id'=>$id,
                          'specimen_id'=>$spec);
            $this->Model_Laboratory->insertrequestspecimen($data2);

         }

         $data3 = array('remark'=>$this->input->post('labremark'),
                        'rem_date'=>date('Y-m-d'),
                      'lab_id_fk'=>$id,
                      'user_id_fk'=>$_SESSION['user_id']);
            $this->Model_Laboratory->insertrequestremark($data3);
          redirect(base_url()."Laboratory/LaboratoryRequests");
       }
      }


    function logout(){
      $this->session->sess_destroy();
      redirect(base_url());
    }
  }
?>
