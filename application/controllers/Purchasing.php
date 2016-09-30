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
      $this->load->view('includes/toastr.php');
    }

    function CSRRequests()
    {
      $header['title'] = "HIS: CSR Requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['csrrequests'] = $this->Model_Purchasing->get_csr_requests();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('purchasing/csrrequests.php',$data);
      $this->load->view('includes/toastr.php');
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
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Approved CSR item request">
                                <input type="hidden" id="type" value="success">' );
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
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Approved CSR item request">
                                <input type="hidden" id="type" value="success">' );
        redirect("Purchasing/CSRRequests");
      }
    }

    function reject_csr($id)
    {
      //Reject = 2
      $newstat = array('pur_stat'=>2,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Purchasing->change_pur_status($id,$newstat);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Rejected">
                                <input type="hidden" id="msg" value="Rejected CSR request">
                                <input type="hidden" id="type" value="error">' );
      redirect("Purchasing/CSRRequests");
    }

    function hold_csr($id)
    {
      //Hold = 3
      $newstat = array('pur_stat'=>3,
                       'date_altered_status'=>date('Y-m-d H:i:s'));
      $this->Model_Purchasing->change_pur_status($id,$newstat);
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="On Process">
                                <input type="hidden" id="msg" value="CSR request on process">
                                <input type="hidden" id="type" value="warning">' );
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
       $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                 <input type="hidden" id="msg" value="Added new CSR item">
                                 <input type="hidden" id="type" value="success">' );
       redirect("Purchasing/CSRInventory");
      }
    }

    function update_csr_stock(){
      $new_quantity = $this->input->post('item_stock') + $this->input->post('item_quant');
      $data = array('item_stock'=>$new_quantity);
      $this->Model_Purchasing->update_csr_stock($data, $this->input->post('item_id'));
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Updated CSR stock">
                                <input type="hidden" id="type" value="success">' );
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
        $this->load->view('includes/toastr.php');
      }

      function update_item_inventory()
      {
        $id = $this->input->post('itemid');

        $data = array('item_name'=>$this->input->post('name'),
                      'item_description'=>$this->input->post('description'),
                      'item_quantity'=>$this->input->post('quantity'),
                      'item_price'=>$this->input->post('price'));

        $this->Model_Purchasing->update_item_inventory($id,$data);
        $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Rejected">
                                  <input type="hidden" id="msg" value="Updated pharmacy inventory">
                                  <input type="hidden" id="type" value="error">' );
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
        $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Rejected">
                                  <input type="hidden" id="msg" value="Added new medicine">
                                  <input type="hidden" id="type" value="error">' );
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
                    $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Rejected">
                                              <input type="hidden" id="msg" value="Added new medicine">
                                              <input type="hidden" id="type" value="error">' );
                    redirect(base_url().'Purchasing/pharmacy_inventory');
                } else
                $this->session->set_flashdata('error', "Error occured");
            redirect('Purchasing/pharmacy_inventory');
                }
      }

      //==================DRUUGS===========================//
      function drug_inventory()
      {
        $header['title'] = "HIS: Inventory";
        $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
        $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
        $data['items'] = $this->Model_Purchasing->get_drug_inventory();
        $data['inventorycount'] = $this->Model_Purchasing->count_drug_inventory();
        $this->load->view('users/includes/header.php',$header);
        $this->load->view('purchasing/drugs_add_item_modal');
        $this->load->view('purchasing/drugs_delete_item_modal');
        $this->load->view('purchasing/drugs_update_item_modal');
        $this->load->view('purchasing/drugs_inventory',$data);
      }

      function update_drug_inventory()
      {
        $id = $this->input->post('itemid');

        $data = array('drug_name'=>$this->input->post('name'),
                      'packaging_desc'=>$this->input->post('description'),
                      'drug_quantity'=>$this->input->post('quantity'),
                      'drug_price'=>$this->input->post('price'));

        $this->Model_Purchasing->update_drug_inventory($id,$data);
        redirect(base_url()."Purchasing/drug_inventory");
      }

      function delete_drug_inventory()
      {
        $id = $this->uri->segment(3);
        $this->Model_Purchasing->delete_drug_inventory($id);
        redirect(base_url()."Purchasing/drug_inventory");
      }

      function add_drug_inventory()
      {
        $data = array('drug_code'=>$this->input->post('drug_code'),
                      'drug_name'=>$this->input->post('drug_name'),
                      'generic_code'=>$this->input->post('generic_code'),
                      'generic_name'=>$this->input->post('generic_name'),
                      'strength_code'=>$this->input->post('strength_code'),
                      'strength_desc'=>$this->input->post('strength_desc'),
                      'form_code'=>$this->input->post('form_code'),
                      'form_desc'=>$this->input->post('form_desc'),
                      'packaging_code'=>$this->input->post('packaging_code'),
                      'packaging_desc'=>$this->input->post('packaging_desc'),
                      'brand_code'=>$this->input->post('brand_code'),
                      'brand_name'=>$this->input->post('brand_name'),
                      'manufacturer_name'=>$this->input->post('manufacturer_name'),
                      'status'=>1,
                      'drug_price'=>$this->input->post('drug_price'),
                      'drug_quantity'=>$this->input->post('drug_quantity'));

        $this->Model_Purchasing->add_drug_inventory($data);
        redirect(base_url()."Purchasing/drugs_inventory");
      }

      function add_drug_import()
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
                redirect('Purchasing/drug_inventory');
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
                          'drug_code'=>$row['drug_code'],
                          'drug_name'=>$row['drug_name'],
                          'generic_code'=>$row['generic_code'],
                          'generic_name'=>$row['generic_name'],
                          'strength_code'=>$row['strength_code'],
                          'strength_desc'=>$row['strength_desc'],
                          'form_code'=>$row['form_code'],
                          'form_desc'=>$row['form_desc'],
                          'packaging_code'=>$row['packaging_code'],
                          'packaging_desc'=>$row['packaging_desc'],
                          'brand_code'=>$row['brand_code'],
                          'brand_name'=>$row['brand_name'],
                          'manufacturer_name'=>$row['manufacturer_name'],
                          'status'=>$row['status'],
                          'drug_price'=>$row['drug_price'],
                          'drug_quantity'=>$row['drug_quantity']
                        );
                        $this->Model_Purchasing->add_drug_inventory($insert_data);
                    }
                    //$this->session->set_flashdata('csv', '<div class="alert alert-success text-center">Users imported successfully!</div>');
                    redirect(base_url().'Purchasing/drug_inventory');
                } else
                $this->session->set_flashdata('error', "Error occured");
            redirect('Purchasing/drug_inventory');
                }
      }

      //==============================DRUGS ACTIVATE=====================================//
      function all_drug_inventory()
      {
        $header['title'] = "HIS: Inventory";
        $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
        $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
        $data['items'] = $this->Model_Purchasing->get_all_drug_inventory();
        $this->load->view('users/includes/header.php',$header);
        $this->load->view('purchasing/all_activate_drug_modal');
        $this->load->view('purchasing/all_deactivate_drug_modal');
        $this->load->view('purchasing/all_drugs_inventory',$data);
      }

      function deactivate_drug()
      {
        $id = $this->uri->segment(3);
        $data = array('status'=>0);
        $this->Model_Purchasing->process_drug($id,$data);
        redirect(base_url()."Purchasing/all_drug_inventory");
      }

      function activate_drug()
      {
        $id = $this->uri->segment(3);
        $data = array('status'=>1);
        $this->Model_Purchasing->process_drug($id,$data);
        redirect(base_url()."Purchasing/all_drug_inventory");
      }

      //=========================RESTOCK MEDICINE PROCESS====================//
      function restock_medicine_view_all()
      {
        $data['requests'] = $this->Model_pharmacy->get_pharmacy_requests();
        //$data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
        //$data['patient'] = $this->Model_pharmacy->get_all_patients();

        $data['unique_ids'] = $this->Model_pharmacy->get_unique_ids();
        $data['table_details'] = array();
        foreach($data['unique_ids'] as $d)
        {
          $data['new_details'] = $this->Model_pharmacy->get_specific_request($d->unique_id);
          $totalprice = 0;
          $quantity = 0;
          $patient;
          $requestedby;
          $date;
          $status;
          foreach($data['new_details'] as $nd)
          {
            $totalprice += $nd->total_price;
            $quantity   += $nd->quant_requested;
            $patient     = $nd->phar_patient;
            $requestedby = $nd->phar_user_id;
            $date        = $nd->date_req;
            $status    = $nd->phar_stat;

          }
          $data['table_details'][$d->unique_id] = array('price'=>$totalprice,
                                                        'date'=>$date,
                                                        'quantity'=>$quantity,
                                                        'requestedby'=>$requestedby,
                                                        'patient'=>$patient,
                                                        'status'=>$status,
                                                        'unique_id'=>$d->unique_id);
        }

        $this->load->view('pharmacy/header');
        $this->load->view('pharmacy/release_request_modal');
        $this->load->view('pharmacy/process_pharmacy_request',$data);
      }

      function accept_restock_request()
      {
        $postid = $this->uri->segment(3);
        $data = array('phar_stat'=>1);
        $this->Model_pharmacy->process_pharmacy_request_model($postid,$data);
        redirect('Pharmacy/process_pharmacy_request');
      }

      function release_restock_request()
      {
        $auditid = $this->uri->segment(3);
        $data['details'] = $this->Model_pharmacy->get_specific_request($auditid);
        $itemid = array();
        $quantity = array();
        foreach($data['details'] as $d)
        {
          $itemid[] = $d->phar_item;
          $quantity[] = $d->quant_requested;
        }

          $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();

          foreach($data['items'] as $d)
          {
            foreach($itemid as $key => $i)
            {
              if($d->item_id == $i)
              {
                $newquantity = $d->item_quantity - $quantity[$key];
                $data = array('item_quantity'=>$newquantity);
                $this->Model_pharmacy->update_pharmacy_quantity($d->item_id,$data);
              }
            }
          }

        $data = array('phar_stat'=>2);
        $this->Model_pharmacy->process_pharmacy_request_model($auditid,$data);
        redirect('Pharmacy/process_pharmacy_request');
      }

      function reject_restock_request()
      {
        $postid = $this->uri->segment(3);
        $data = array('phar_stat'=>3);
        $this->Model_pharmacy->process_pharmacy_request_model($postid,$data);
        redirect('Pharmacy/process_pharmacy_request');
      }

      function view_one_restock_request()
      {
        $id = $this->uri->segment('3');

        $data['details'] = $this->Model_pharmacy->get_specific_request($id);
        $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
        $data['id'] = $id;
        $this->load->view('pharmacy/header');
        $this->load->view('pharmacy/accept_pharmacy_request_modal');
        $this->load->view('pharmacy/reject_pharmacy_request_modal');
        $this->load->view('pharmacy/view_one_request',$data);
      }

  }
?>
