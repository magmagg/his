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
      $data['pending_requests'] = $this->Model_Csr->get_nurse_requests();
      $this->load->view("users/includes/header.php",$header);
      $this->load->view('csr/pendingrequest.php',$data);
      $this->load->view('includes/toastr.php');
    }

    function AcceptedRequests()
    {
      $header['title'] = "HIS: CSR Accepted Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['accepted_requests'] = $this->Model_Csr->get_nurse_acceptedrequests();
      $this->load->view("users/includes/header.php",$header);
      $this->load->view("csr/acceptedrequest.php",$data);
    }

    function RejectedRequests()
    {
      $header['title'] = "HIS: CSR Rejected Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rejected_requests'] = $this->Model_Csr->get_nurse_rejectedrequests();
      $this->load->view("users/includes/header.php",$header);
      $this->load->view("csr/rejectedrequest.php",$data);
    }

    function ReleasedRequests(){
      $header['title'] = "HIS: CSR Released Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['released_requests'] = $this->Model_Csr->get_nurse_releasedrequests();
      $this->load->view("users/includes/header.php",$header);
      $this->load->view("csr/releasedrequest.php",$data);
    }

    function ListofProducts()
    {
      $header['title'] = "HIS: CSR Product List";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csrinventory'] = $this->Model_Csr->get_csr_inventory();
      $this->load->view("users/includes/header.php",$header);
      $this->load->view('csr/listofproducts.php',$data);
      $this->load->view('includes/toastr.php');
    }

    function RequestRestock($id)
    {
      $header['title'] = "HIS: CSR Request Restock";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['restock'] = $this->Model_Csr->restockdata($id);
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('csr/restock.php',$data);
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
    }

    function RequestItem(){
      $header['title'] = "HIS: CSR Request Item";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csrinventory'] = $this->Model_Csr->get_csr_inventory();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('csr/requestitem.php', $data);
      $this->load->view('includes/toastr.php');
    }

    function insert_csr_item_request(){
      $data = array(
                  "nurse_id"=>$this->session->userdata('user_id'),
                  "csr_item_id"=>$this->input->post('item'),
                  "item_quant"=>$this->input->post('quantity')
                  );
      $this->Model_Csr->insert_csr_item_request($data);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Successfully requested item">
                                <input type="hidden" id="type" value="success">');
      redirect(base_url().'Csr/RequestItem');
    }

    function ViewRequest(){
      $header['title'] = "HIS: CSR Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csr_request'] = $this->Model_Csr->get_request_by_user($this->session->userdata('user_id'));
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('csr/csr_list_of_requests.php', $data);
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
       $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                 <input type="hidden" id="msg" value="Requested new CSR item">
                                 <input type="hidden" id="type" value="success">' );
       redirect("Csr/ListofProducts");
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
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Requested for CSR item restock">
                                <input type="hidden" id="type" value="success">' );
      redirect("Csr/ListofProducts");
    }

    function csr_accept_request($id)
    {

      $datareq = array('csr_status' =>1,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      //CSR REQUEST
      $this->Model_Csr->accept_request($id,$datareq);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Approved CSR request">
                                <input type="hidden" id="type" value="success">' );
      redirect("Csr/PendingRequests");
    }

    function release_csr_item($id)
    {
      //1
      $request_quantity = $this->Model_Csr->get_request_quant($id);
      $csrid = $this->Model_Csr->get_csrid($id);
      $stock_quantity = $this->Model_Csr->get_stock_quant($csrid);
      $stock_sum = $stock_quantity - $request_quantity;
      $datareq = array('csr_status' =>3,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $datainv = array('item_stock' => $stock_sum);

      //CSR REQUEST
      $this->Model_Csr->accept_request($id,$datareq);
      //CSR INVENTORY
      $this->Model_Csr->setstock($csrid,$datainv);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Released CSR item">
                                <input type="hidden" id="type" value="success">' );
      redirect("Csr/PendingRequests");
    }

    function csr_reject_request($id)
    {
      //2
       $datareq = array('csr_status' =>2,
                        'date_altered_status'=>date('Y-m-d H:i:s'));
       $this->Model_Csr->reject_request($id,$datareq);
       $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Rejected">
                                 <input type="hidden" id="msg" value="Rejected CSR item request">
                                 <input type="hidden" id="type" value="error">' );
        redirect("Csr/PendingRequests");
    }

    function csr_hold_request($id)
    {
      //3
      $datareq = array('csr_status' =>3,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Csr->hold_request($id,$datareq);
      redirect("Csr/PendingRequests");
    }


  }
?>
