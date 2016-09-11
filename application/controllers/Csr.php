<?php
//CSR CONTROLLER
  if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Csr extends CI_Controller{

    function __construct(){
      parent::__construct();
      $this->load->model('Model_Csr');
      $this->load->model('Model_user');
    }

    function PendingRequests()
    {
       $header['title'] = "HIS: CSR Pending Requests";
       $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
       $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
        $data['nursetocsr'] = $this->Model_Csr->get_nurse_requests();
        $this->load->view("users/users/includes/header.php",$header);
        $this->load->view('csr/pendingrequest.php',$data);
        $this->load->view("users/users/includes/footer.php");
    }

    function AcceptedRequests()
    {
      $header['title'] = "HIS: CSR Accepted Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['nursetocsr'] = $this->Model_Csr->get_nurse_acceptedrequests();
      $this->load->view("users/includes/header.php",$header);
      $this->load->view("csr/acceptedrequest.php",$data);
      $this->load->view("users/includes/footer.php");
    }

    function RejectedRequests()
    {
      $header['title'] = "HIS: CSR Rejected Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['nursetocsr'] = $this->Model_Csr->get_nurse_rejectedrequests();
      $this->load->view("users/includes/header.php",$header);
      $this->load->view("csr/rejectedrequest.php",$data);
      $this->load->view("users/includes/footer.php");
    }

    function ListofProducts()
    {
      $header['title'] = "HIS: CSR Product List";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
        $data['csrinventory'] = $this->Model_Csr->get_csr_inventory();
        $this->load->view("users/includes/header.php",$header);
        $this->load->view('csr/listofproducts.php',$data);
        $this->load->view("users/includes/footer.php");
    }

    function RequestRestock($id)
    {
      $header['title'] = "HIS: CSR Request Restock";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['restock'] = $this->Model_Csr->restockdata($id);
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('csr/restock.php',$data);
      $this->load->view('users/includes/footer.php');
    }

    function RequestHistory()
    {
      $header['title'] = "HIS: CSR Request History";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['accepted'] = $this->Model_Csr->get_accepted_request();
      $data['rejected'] = $this->Model_Csr->get_rejected_request();
      $data['hold']     = $this->Model_Csr->get_hold_request();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('csr/requesthistory.php',$data);
      $this->load->view('users/includes/footer.php');
    }

    function add_newproduct(){
      $this->form_validation->set_rules('itemreq', 'Item Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('itemquant', 'Item Name', 'required|trim|xss_clean|strip_tags');

      if($this->form_validation->run()==FALSE){
        echo "Something is wrong";
      } else {
        $new = $this->Model_Csr->reqtypenewproduct();
        $data = array('requester_id'=>$_SESSION['user_id'],
                      'item_id'=>NULL,
                      'quantity'=>$this->input->post('itemquant'),
                      'request_type'=>$new,
                      'item_name'=>$this->input->post('itemreq'));
       $this->Model_Csr->requestproduct($data);
       redirect("ListofProducts");
      }
    }

    function request_restock($id)
    {
      $itemname = $this->input->post('productname');
      $itemquant = $this->input->post('productquant');

      $restock = $this->Model_Csr->reqtyperestock();
      $data = array('requester_id'=>$_SESSION['user_id'],
                    'item_id'=>$id,
                    'quantity'=>$itemquant,
                    'request_type'=>$restock,
                    'item_name'=>$itemname);
      $this->Model_Csr->restockproduct($data);
      redirect("ListofProducts");
    }

    function csr_accept_request($id)
    {
      //1
      $request_quantity = $this->Model_Csr->get_request_quant($id);
      $csrid = $this->Model_Csr->get_csrid($id);
      $stock_quantity = $this->Model_Csr->get_stock_quant($csrid);
      $stock_sum = $stock_quantity - $request_quantity;
      $datareq = array('csr_status' =>1,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $datainv = array('item_stock' => $stock_sum);

      //CSR REQUEST
      $this->Model_Csr->accept_request($id,$datareq);
      //CSR INVENTORY
      $this->Model_Csr->setstock($csrid,$datainv);
      redirect("PendingRequests");

    }

    function csr_reject_request($id)
    {
      //2
       $datareq = array('csr_status' =>2,
                        'date_altered_status'=>date('Y-m-d H:i:s'));
       $this->Model_Csr->reject_request($id,$datareq);
        redirect("PendingRequests");
    }

    function csr_hold_request($id)
    {
      //3
      $datareq = array('csr_status' =>3,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Csr->hold_request($id,$datareq);
      redirect("PendingRequests");
    }
?>
