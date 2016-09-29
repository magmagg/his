<?php
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Model_user');
    }

    function index(){
      $user_type = $this->session->userdata("user_controller_type");
      $header['title'] = "HIS: ".$user_type." Dashboard";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $this->load->view('users/includes/header.php',$header);

      if($user_type == "Admin"){
        $this->load->view('users/dashboards/admin_dashboard.php');
      }else if($user_type == "Doctor"){
        $this->load->view('users/dashboards/doctor_dashboard.php');
      }else if($user_type == "Nurse"){
        $data['number_of_patients'] = $this->Model_user->fetch_count_all_patients();
        $data['number_of_nurses'] = $this->Model_user->fetch_count_all_nurse();
        $this->load->view('users/dashboards/nurse_dashboard.php', $data);
      }else if($user_type == "Radiology"){
        $this->load->view('users/dashboards/radiology_dashboard.php');
      }else if($user_type == "Pharmacy"){
        $this->load->view('users/dashboards/pharmacy_dashboard.php');
      }else if($user_type == "Laboratory"){
        $this->load->view('users/dashboards/laboratory_dashboard.php');
      }else if($user_type == "Purchasing"){
        $this->load->view('users/dashboards/purchasing_dashboard.php');
      }else if($user_type == "Accounting"){
        $this->load->view('users/dashboards/accounting_dashboard.php');
      }else if($user_type == "Csr"){
        $this->load->view('users/dashboards/csr_dashboard.php');
      }else if($user_type == "Billing Clerk"){
        $this->load->view('users/dashboards/billing_clerk_dashboard.php');
      }else if($user_type == "Cashier"){
        $this->load->view('users/dashboards/cashier_dashboard.php');
      }else if($user_type == "Housekeeping"){
        $this->load->view('users/dashboards/housekeeping_dashboard.php');
      }else if($user_type == "Management"){
        $this->load->view('users/dashboards/management_dashboard.php');
      }else if($user_type == "Admission"){
        $this->load->view('users/dashboards/admission_dashboard.php');
      }else if($user_type == "Laboratory Chief"){
        //$this->load->view('users/dashboards/labchief_dashboard.php');
      }else if($user_type == "Management"){
        $this->load->view('users/dashboards/radchief_dashboard.php');
      }elseif($user_type == "Purchasing"){
        $this->load->view('users/dashboards/purchasing_dashboard.php');
      }else{
        echo "Contact your app support";
      }

      $this->load->view('users/includes/footer.php');
    }

    function logout(){
      $this->session->sess_destroy();
      redirect(base_url());
    }
  }
?>
