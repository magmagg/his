<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Purchasing extends CI_Controller{

    function __construct(){
      parent::__construct();
      $this->load->model('Model_Purchasing');
            $this->load->model('Model_user');
    }


    function CSRInventory()
    {
      $header['title'] = "HIS: CSR Inventory";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csrinventory'] = $this->Model_Purchasing->get_csr_inventory();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('purchasing/csrinventory.php',$data);
      //$this->load->view('users/includes/footer.php');
    }

    function CSRRequests()
    {
      $header['title'] = "HIS: CSR Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csrrequests'] = $this->Model_Purchasing->get_csr_requests();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('purchasing/csrrequests.php',$data);
      //$this->load->view('users/includes/footer.php');
    }

    function PendingCSR(){
      $header['title'] = "HIS: Pending CSR Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csrrequests'] = $this->Model_Purchasing->get_pending_csr_requests();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('purchasing/csrpending.php',$data);
    }

    function OPCSR(){
      $header['title'] = "HIS: On Process CSR Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csrrequests'] = $this->Model_Purchasing->get_onprocess_csr_requests();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('purchasing/csronprocess.php',$data);
    }

    function PurCsrAccRequest()
    {
      $header['title'] = "HIS: CSR Accepted Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['accepted'] = $this->Model_Purchasing->get_acceptedcsr_requests();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('purchasing/csraccrequests.php',$data);
      $this->load->view('users/includes/footer.php');
    }

    function PurCsrRejRequest()
    {
      $header['title'] = "HIS: CSR Rejected Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rejected'] = $this->Model_Purchasing->get_rejectedcsr_requests();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('purchasing/csrrejrequests.php',$data);
      $this->load->view('users/includes/footer.php');
    }

    function accept_csr($id)
    {
      //Accept = 1
      $requesttype = $this->Model_Purchasing->get_request_type($id);
      if($requesttype == "REQ-TYP00001")
      {
        //NEW PRODUCT
      $requestdata = $this->Model_Purchasing->get_request_data($id);
      $data = array('item_name'=>$requestdata->item_name,
                    'item_desc'=>$requestdata->item_name,
                    'item_stock'=>$requestdata->quantity);
      $this->Model_Purchasing->insertnewcsrproduct($data);
      $newstat = array('pur_stat'=>1,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Purchasing->change_pur_status($id,$newstat);
        redirect("Purchasing/CSRRequests");
      } else {
        //RESTOCK
      $requestdata = $this->Model_Purchasing->get_request_data($id);
      $existingstock = $this->Model_Purchasing->get_csr_stock($requestdata->item_id);
      $sumstock = $existingstock + $requestdata->quantity;
      $data = array('item_name'=>$requestdata->item_name,
                    'item_desc'=>$requestdata->item_name,
                    'item_stock'=>$sumstock);
      $this->Model_Purchasing->restockcsrproduct($requestdata->item_id,$data);
      $newstat = array('pur_stat'=>1,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Purchasing->change_pur_status($id,$newstat);
        redirect("Purchasing/CSRRequests");
      }
    }
    function reject_csr($id)
    {
      //Reject = 2
      $newstat = array('pur_stat'=>2,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Purchasing->change_pur_status($id,$newstat);
        redirect("Purchasing/CSRRequests");
    }
    function hold_csr($id)
    {
      //Hold = 3
      $newstat = array('pur_stat'=>3,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Purchasing->change_pur_status($id,$newstat);
        redirect("Purchasing/CSRRequests");
    }

    function add_newproduct(){
      $this->form_validation->set_rules('item_quant', 'Item Quantity', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('item_name', 'Item Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('item_desc', 'Item Description', 'required|trim|xss_clean|strip_tags');

      if($this->form_validation->run()==FALSE){
        echo "Something is wrong";
      } else {
        $data = array('item_stock'=>$this->input->post('item_quant'),
                      'item_desc'=>$this->input->post('item_desc'),
                      'item_name'=>$this->input->post('item_name'));
       $this->Model_Purchasing->insertproduct($data);
       redirect("Purchasing/CSRInventory");
      }
    }

    function update_csr_stock(){
      $new_quantity = $this->input->post('item_stock') + $this->input->post('item_quant');
      $data = array('item_stock'=>$new_quantity);
      $this->Model_Purchasing->update_csr_stock($data, $this->input->post('item_id'));
      redirect(base_url().'Purchasing/CSRInventory');
    }

    //==================================Magno=======================================//

      function pharmacy_inventory()
      {

        $header['title'] = "HIS: Inventory";
        $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
        $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
        $data['items'] = $this->Model_Purchasing->get_pharmacy_inventory();
        $data['inventorycount'] = $this->Model_Purchasing->count_pharmacy_inventory();
        $this->load->view('users/includes/header.php',$header);
        $this->load->view('purchasing/inventory_add_item_modal');
        $this->load->view('purchasing/inventory_delete_item_modal');
        $this->load->view('purchasing/inventory_update_item_modal');
        $this->load->view('purchasing/inventory',$data);
      }

      function update_item_inventory()
      {
        $id = $this->input->post('itemid');

        $data = array('item_name'=>$this->input->post('name'),
                      'item_description'=>$this->input->post('description'),
                      'item_quantity'=>$this->input->post('quantity'),
                      'item_price'=>$this->input->post('price'));

        $this->Model_Purchasing->update_item_inventory($id,$data);
        redirect(base_url()."Purchasing/pharmacy_inventory");
      }

      function delete_item_inventory()
      {
        $id = $this->uri->segment(3);
        $this->Model_Purchasing->delete_item_inventory($id);
        redirect(base_url()."Purchasing/pharmacy_inventory");
      }

      function add_item_inventory()
      {
        $data = array('item_name'=>$this->input->post('name'),
                      'item_description'=>$this->input->post('description'),
                      'item_quantity'=>$this->input->post('quantity'),
                      'item_price'=>$this->input->post('price'));

        $this->Model_Purchasing->add_item_inventory($data);
        redirect(base_url()."Purchasing/pharmacy_inventory");
      }

      function add_item_inventory_import()
      {
        $data['error'] = '';    //initialize image upload error array to empty
            $config['upload_path'] = './csv/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // If upload failed, display error
            if (!$this->upload->do_upload())
            {
                redirect('Purchasing/pharmacy_inventory');
            }
            else
            {
                $file_data = $this->upload->data();
                $file_path =  './csv/'.$file_data['file_name'];
                if ($this->csvimport->get_array($file_path))
                {
                    $csv_array = $this->csvimport->get_array($file_path);
                    foreach ($csv_array as $row)
                    {
                        $insert_data = array(
                            'item_name'=>$row['Name'],
                            'item_description'=>$row['Description'],
                            'item_quantity'=>$row['Quantity'],
                            'item_price'=>$row['Price']
                        );
                        $this->Model_Purchasing->add_item_inventory_import($insert_data);
                    }
                    //$this->session->set_flashdata('csv', '<div class="alert alert-success text-center">Users imported successfully!</div>');
                    redirect(base_url().'Purchasing/pharmacy_inventory');
                } else
                $this->session->set_flashdata('error', "Error occured");
            redirect('Purchasing/pharmacy_inventory');
                }
      }
  }
?>
