<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_pharmacy');
    $this->load->model('Model_user');
  }
  /*=========================================================================================================================*/
  function pharmacy_request()
  {
    $header['title'] = "HIS: Pharmacy Inventory";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
    $data['patients'] = $this->Model_pharmacy->get_all_patients();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/pharmacy_request',$data);
    $this->load->view('pharmacy/pharmacy_request_modal');
  }

  function pharmacy_request_submit()
  {
    $quantity = $this->input->post('quantity');
    $itemid = $this->input->post('itemid');
    $price = $this->input->post('price');
    $patientid = $this->input->post('patientid');
    $userid = $this->session->userdata('user_id');
    $unique_id = bin2hex(mcrypt_create_iv(5, MCRYPT_DEV_URANDOM));

    foreach($quantity as $key => $q)
    {
      if($q == 0)
      {
        unset($quantity[$key]);
        unset($itemid[$key]);
        unset($price[$key]);
      }
    }
    $quantity = array_values($quantity);
    $itemid = array_values($itemid);
    $price = array_values($price);

    foreach($price as $key => $p)
    {
      $price[$key] = $p * $quantity[$key];
    }

    foreach($itemid as $key => $i)
    {
      $data = array('phar_item'=>$i,
                    'phar_user_id'=>$userid,
                    'phar_patient'=>$patientid,
                    'quant_requested'=>$quantity[$key],
                    'total_price'=>$price[$key],
                    'phar_stat'=>0,
                    'unique_id'=>$unique_id);
      $this->Model_pharmacy->insert_pharmacy_request($data);
    }

    redirect('Pharmacy/pharmacy_request');
  }

  function process_pharmacy_request()
  {
    $header['title'] = "HIS: Request";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
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

    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/release_request_modal');
    $this->load->view('pharmacy/process_pharmacy_request',$data);
  }

  function accept_pharmacy_request()
  {
    $postid = $this->uri->segment(3);
    $data = array('phar_stat'=>1);
    $this->Model_pharmacy->process_pharmacy_request_model($postid,$data);
    redirect('Pharmacy/process_pharmacy_request');
  }

  function release_pharmacy_request()
  {
    $auditid = $this->uri->segment(3);
    $data['details'] = $this->Model_pharmacy->get_specific_request($auditid);
    $itemid = array();
    $quantity = array();
    $price;
    foreach($data['details'] as $d)
    {
      $itemid[] = $d->phar_item;
      $quantity[] = $d->quant_requested;
      $patientid = $d->phar_patient;
      $price += $d->total_price;
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

      $data['checkpharmbilling'] = $this->Model_pharmacy->check_if_with_pharm_billing($patientid);

      if($data['checkpharmbilling'])
      {

      }
      else
      {
        $data = array('price'=>$price,
                      'patient_id'=>$patientid);
        $this->Model_pharmacy->insert_pharmacy_billing($data);
        $data['id'] = $this->Model_pharmacy->get_last_pharmacy_id();
        foreach($data['id'] as $i)
        {
          $billing_id = $i->pharm_bill_id;
        }

        $data['checkbilling'] = $this->Model_pharmacy->check_if_with_billing($patientid);

        if($data['checkbilling'])
        {
          foreach($data['checkbilling'] as $b)
          {
            $transaction_id = $b->transaction_id;
            $data = array('pharm_billing_ids'=>$billing_id);
            $this->Model_pharmacy->update_billing_from_pharma($transaction_id,$data);
          }
        }
        else
        {
          $data = array('pharm_billing_ids'=>$billing_id);
          $this->Model_pharmacy->insert_new_billing($data);
        }
      }



    $data = array('phar_stat'=>2);


    $this->Model_pharmacy->process_pharmacy_request_model($auditid,$data);
    redirect('Pharmacy/process_pharmacy_request');
  }

  function reject_pharmacy_request()
  {
    $postid = $this->uri->segment(3);
    $data = array('phar_stat'=>3);
    $this->Model_pharmacy->process_pharmacy_request_model($postid,$data);
    redirect('Pharmacy/process_pharmacy_request');
  }

  function view_one_request()
  {
    $header['title'] = "HIS: Request";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $id = $this->uri->segment('3');

    $data['details'] = $this->Model_pharmacy->get_specific_request($id);
    $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
    $data['id'] = $id;
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/accept_pharmacy_request_modal');
    $this->load->view('pharmacy/reject_pharmacy_request_modal');
    $this->load->view('pharmacy/view_one_request',$data);
  }

  //====================================Drugs pharmacy request===========================//
  function drug_pharmacy_request()
  {
    $header['title'] = "HIS: Pharmacy Inventory";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['items'] = $this->Model_pharmacy->get_drug_inventory();
    $data['patients'] = $this->Model_pharmacy->get_all_patients();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('includes/toastr.php');

    $this->load->view('pharmacy/drugs_pharmacy_request',$data);
    $this->load->view('pharmacy/drugs_pharmacy_request_modal');

  }

  function drug_pharmacy_request_submit()
  {
    $quantity = $this->input->post('quantity');
    $itemid = $this->input->post('itemid');
    $price = $this->input->post('price');
    $patientid = $this->input->post('patientid');
    $userid = $this->session->userdata('user_id');
    $unique_id = bin2hex(mcrypt_create_iv(5, MCRYPT_DEV_URANDOM));


    foreach($quantity as $key => $q)
    {
      if($q == 0)
      {
        unset($quantity[$key]);
        unset($itemid[$key]);
        unset($price[$key]);
      }
    }
    $quantity = array_values($quantity);
    $itemid = array_values($itemid);
    $price = array_values($price);

    foreach($price as $key => $p)
    {
      $price[$key] = $p * $quantity[$key];
    }


    foreach($itemid as $key => $i)
    {
      $data = array('phar_item'=>$i,
                    'phar_user_id'=>$userid,
                    'phar_patient'=>$patientid,
                    'quant_requested'=>$quantity[$key],
                    'total_price'=>$price[$key],
                    'phar_stat'=>0,
                    'unique_id'=>$unique_id);
      $this->Model_pharmacy->insert_pharmacy_request($data);
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
    $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                              <input type="hidden" id="msg" value="Successfully requested medicine">
                              <input type="hidden" id="type" value="success">');
    redirect('Pharmacy/pharmacy_request');
    redirect('Pharmacy/drug_pharmacy_request');

  }

  function drug_process_pharmacy_request()
  {
    $data['requests'] = $this->Model_pharmacy->get_pharmacy_requests();
    $header['title'] = "HIS: Pharmacy Inventory";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
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

    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/release_request_modal');
    $this->load->view('pharmacy/drugs_process_pharmacy_request',$data);
  }

  function drug_view_one_request()
  {
    $id = $this->uri->segment('3');

    $data['details'] = $this->Model_pharmacy->get_specific_request($id);
    $data['items'] = $this->Model_pharmacy->get_drug_inventory();
    $data['id'] = $id;
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/accept_pharmacy_request_modal');
    $this->load->view('pharmacy/reject_pharmacy_request_modal');
    $this->load->view('pharmacy/drugs_view_one_request',$data);
  }

  function drug_accept_pharmacy_request()
  {
    $postid = $this->uri->segment(3);
    $data = array('phar_stat'=>1);
    $this->Model_pharmacy->process_pharmacy_request_model($postid,$data);
    redirect('Pharmacy/drug_process_pharmacy_request');
  }

  function drug_reject_pharmacy_request()
  {
    $postid = $this->uri->segment(3);
    $data = array('phar_stat'=>3);
    $this->Model_pharmacy->process_pharmacy_request_model($postid,$data);
    redirect('Pharmacy/drug_process_pharmacy_request');
  }

  function drug_release_pharmacy_request()
  {

    $id = $this->uri->segment('3');
    $data['details'] = $this->Model_pharmacy->get_specific_request($id);
    $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
    $data['id'] = $id;
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/accept_pharmacy_request_modal');
    $this->load->view('pharmacy/reject_pharmacy_request_modal');
    $this->load->view('pharmacy/view_one_request',$data);

    $auditid = $this->uri->segment(3);
    $data['details'] = $this->Model_pharmacy->get_specific_request($auditid);
    $itemid = array();
    $quantity = array();
    foreach($data['details'] as $d)
    {
      $itemid[] = $d->phar_item;
      $quantity[] = $d->quant_requested;
    }

      $data['items'] = $this->Model_pharmacy->get_drug_inventory();

      foreach($data['items'] as $d)
      {
        foreach($itemid as $key => $i)
        {
          if($d->drug_code == $i)
          {
            $newquantity = $d->drug_quantity - $quantity[$key];
            $data = array('drug_quantity'=>$newquantity);
            $this->Model_pharmacy->update_drug_quantity($d->drug_code,$data);
          }
        }
      }

    $data = array('phar_stat'=>2);
    $this->Model_pharmacy->process_pharmacy_request_model($auditid,$data);
    redirect('Pharmacy/drug_process_pharmacy_request');

  }

  //==========================VIEW REqueSTS=========================//
  function ViewRequest(){
    $header['title'] = "HIS: Pharmacy Requests";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['pharmacy_request'] = $this->Model_pharmacy->get_request_by_user($this->session->userdata('user_id'));
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/view_pharmacy_request.php', $data);
  }


  //=========================Restock MEDICINE=====================//
  function restock_medicine()
  {
    $header['title'] = "HIS: Pharmacy Inventory";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/restock_medicine',$data);
    $this->load->view('pharmacy/pharmacy_request_modal');
  }

  function restock_medicine_submit()
  {
    $quantity = $this->input->post('quantity');
    $itemid = $this->input->post('itemid');
    $userid = $this->session->userdata('user_id');
    $unique_id = bin2hex(mcrypt_create_iv(5, MCRYPT_DEV_URANDOM));


    foreach($quantity as $key => $q)
    {
      if($q == 0)
      {
        unset($quantity[$key]);
        unset($itemid[$key]);
      }
    }
    $quantity = array_values($quantity);
    $itemid = array_values($itemid);

    foreach($itemid as $key => $i)
    {
      $data = array('phar_item'=>$i,
                    'phar_user_id'=>$userid,
                    'quant_requested'=>$quantity[$key],
                    'phar_stat'=>0,
                    'unique_id'=>$unique_id);
      $this->Model_pharmacy->insert_restock_medicine($data);
    }

    redirect('Pharmacy/restock_medicine');
  }

  //=====================RESTOCK MEDICINE DRUGS========================//
  function drug_restock_medicine()
  {
    $header['title'] = "HIS: Pharmacy Inventory";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['items'] = $this->Model_pharmacy->get_drug_inventory();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/drugs_restock_medicine',$data);
    $this->load->view('pharmacy/pharmacy_request_modal');
  }

  function drug_restock_medicine_submit()
  {
    $quantity = $this->input->post('quantity');
    $itemid = $this->input->post('itemid');
    $userid = $this->session->userdata('user_id');
    $unique_id = bin2hex(mcrypt_create_iv(5, MCRYPT_DEV_URANDOM));


    foreach($quantity as $key => $q)
    {
      if($q == 0)
      {
        unset($quantity[$key]);
        unset($itemid[$key]);
      }
    }
    $quantity = array_values($quantity);
    $itemid = array_values($itemid);

    foreach($itemid as $key => $i)
    {
      $data = array('phar_item'=>$i,
                    'phar_user_id'=>$userid,
                    'quant_requested'=>$quantity[$key],
                    'phar_stat'=>0,
                    'unique_id'=>$unique_id);
      $this->Model_pharmacy->insert_restock_medicine($data);
    }

    redirect('Pharmacy/drug_restock_medicine');
  }

  //========================REQUEST NEW MED=============================//
  function request_medicine()
  {
    $header['title'] = "HIS: Request medicine";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['items'] = $this->Model_pharmacy->get_all_drug_inventory_status_zero();
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/pharmacy_request_modal');
    $this->load->view('Pharmacy/request_medicine_view',$data);
  }

  function request_medicine_submit()
  {
    $itemids = $this->input->post('itemids');
    $userid = $this->session->userdata('user_id');

    $unique_id = bin2hex(mcrypt_create_iv(5, MCRYPT_DEV_URANDOM));

    foreach($itemids as $i)
    {
      $data = array('requestor_id'=>$userid,
                    'drug_code'=>$i,
                    'req_status'=>0,
                    'unique_id'=>$unique_id
                  );
      $this->Model_pharmacy->insert_request_medicine($data);
    }
    redirect('Pharmacy/request_medicine');
  }

  function View_submitted_pharmacy_request()
  {
    $header['title'] = "HIS: View pharmacy request";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['requests'] = $this->Model_pharmacy->get_pharmacy_requests_specific($this->session->userdata('user_id'));
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
        $date        = $nd->date_req;
        $status     = $nd->phar_stat;

      }
      $data['table_details'][$d->unique_id] = array('price'=>$totalprice,
                                                    'date'=>$date,
                                                    'quantity'=>$quantity,
                                                    'patient'=>$patient,
                                                    'status'=>$status,
                                                    'unique_id'=>$d->unique_id);
    }

    $this->load->view('users/includes/header',$header);
    $this->load->view('pharmacy/view_submitted_pharmacy_request',$data);
  }

  function View_one_submitted_pharmacy_request()
  {
    $header['title'] = "HIS: View pharmacy request";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $id = $this->uri->segment('3');

    $data['details'] = $this->Model_pharmacy->get_specific_request($id);
    $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
    $data['id'] = $id;
    foreach($data['details'] as $d)
    {
      if($d->phar_stat == 2)
      {
        $data['released'] = 1;
      }
      else
      {
        $data['released'] = 0;
      }
    }
    $this->load->view('users/includes/header',$header);
    $this->load->view('pharmacy/View_one_submitted_pharmacy_request',$data);
  }

  function nurse_return_medicine()
  {
    $header['title'] = "HIS: Return medicine";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $id = $this->uri->segment('3');

    $data['details'] = $this->Model_pharmacy->get_specific_request($id);
    $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
    $data['id'] = $id;
    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/pharmacy_request_modal');
    $this->load->view('pharmacy/nurse_return_medicine',$data);
  }

  function submit_nurse_return_medicine()
  {
    $quantity = $this->input->post('quantity');
    $itemid = $this->input->post('itemid');
    $price = $this->input->post('price');
    $patientid = $this->input->post('patientid');
    $userid = $this->session->userdata('user_id');
    $unique_audit_id = $this->input->post('uniqueid');
    $unique_id = bin2hex(mcrypt_create_iv(5, MCRYPT_DEV_URANDOM));

    $data['nurse_id'] = $this->Model_pharmacy->get_nurse_id($userid);
    foreach($data['nurse_id'] as $d)
    {
      $userid = $d->nurse_id;
    }
    foreach($quantity as $key => $q)
    {
      if($q == 0)
      {
        unset($quantity[$key]);
        unset($itemid[$key]);
        unset($price[$key]);
      }
    }
    $quantity = array_values($quantity);
    $itemid = array_values($itemid);
    $price = array_values($price);

    foreach($price as $key => $p)
    {
      $price[$key] = $p * $quantity[$key];
    }

    foreach($itemid as $key => $i)
    {
      $data = array('phar_item'=>$i,
                    'phar_nurse_id'=>$userid,
                    'phar_patient'=>$patientid,
                    'quant_requested'=>$quantity[$key],
                    'total_price'=>$price[$key],
                    'phar_stat'=>0,
                    'unique_id'=>$unique_id,
                    'unique_audit_id'=>$unique_audit_id);
      $this->Model_pharmacy->submit_nurse_return_medicine($data);
    }

    redirect('Pharmacy/View_submitted_pharmacy_request');
  }

  //=========process return medicine nurse================//
  function process_nurse_return_medicine()
  {
    $header['title'] = "HIS: Process nurse requests";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['requests'] = $this->Model_pharmacy->get_nurse_return_requests();

    $data['unique_ids'] = $this->Model_pharmacy->get_unique_ids_return();
    $data['table_details'] = array();
    foreach($data['unique_ids'] as $d)
    {
      $data['new_details'] = $this->Model_pharmacy->get_nurse_return_requests_specific($d->unique_id);
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
        $requestedby = $nd->phar_nurse_id;
        $date        = $nd->date_req;
        $status    = $nd->phar_stat;

      }
      $data['table_details'][$d->unique_id] = array('price'=>$totalprice,
                                                    'date'=>$date,
                                                    'quantity'=>$quantity,
                                                    'requestedby'=>$requestedby,
                                                    'patient'=>$patient,
                                                    'status'=>$status,
                                                    'unique_id'=>$d->unique_id,
                                                    'unique_audit_id'=>$nd->unique_audit_id);
    }

    $this->load->view('users/includes/header.php',$header);
    $this->load->view('pharmacy/release_request_modal');
    $this->load->view('pharmacy/process_nurse_return_medicine',$data);
  }

    function view_one_nurse_return_request()
    {
      $header['title'] = "HIS: View return requests";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $id = $this->uri->segment('3');

      $data['details'] = $this->Model_pharmacy->get_nurse_return_requests_specific($id);
      $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
      $data['id'] = $id;
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('pharmacy/accept_pharmacy_request_modal');
      $this->load->view('pharmacy/reject_pharmacy_request_modal');
      $this->load->view('pharmacy/view_one_nurse_return_request',$data);
    }

    function accept_nurse_return_request()
    {
      $postid = $this->uri->segment(3);
      $data = array('phar_stat'=>1);
      $this->Model_pharmacy->process_nurse_return_model($postid,$data);
      redirect('Pharmacy/process_nurse_return_medicine');
    }

    function release_nurse_return_request()
    {
      $auditid = $this->uri->segment(3);
      $data['details'] = $this->Model_pharmacy->get_nurse_return_requests_specific($auditid);
      $data['details1'] = $this->Model_pharmacy->get_specific_request($auditid);
      $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();

      $itemid = array();
      $quantity = array();
      foreach($data['details'] as $d)
      {
        $itemid[] = $d->phar_item;
        $quantity[] = $d->quant_requested;
      }

      foreach($data['details1'] as $d)
      {
        foreach($itemid as $key => $i)
        {
          if($d->phar_item == $i)
          {
            $priceper = $d->total_price / $d->quant_requested;
            $pricetosubtract = $priceper * $quantity[$key];
            $newprice = $d->total_price - $pricetosubtract;
            $newquantity = $d->quant_requested - $quantity[$key];
            $data = array('quant_requested'=>$newquantity,
                          'total_price'=>$newprice);
            $this->Model_pharmacy->update_pharmacy_audit($d->phar_aud_id,$data);
          }
        }
      }

      $data['details1'] = $this->Model_pharmacy->get_specific_request($auditid);
      $totalprice;
      foreach($data['details1'] as $d)
      {
        $totalprice += $d->total_price;
        $patientid = $d->phar_patient;
      }
      $data = array('price'=>$totalprice);
      $this->Model_pharmacy->update_pharm_billing($patientid,$data);

      $data['items'] = $this->Model_pharmacy->get_pharmacy_inventory();
      foreach($data['items'] as $d)
      {
        foreach($itemid as $key => $i)
        {
          if($d->item_id == $i)
          {
            $newquantity = $d->item_quantity + $quantity[$key];
            $data = array('item_quantity'=>$newquantity);
            $this->Model_pharmacy->update_pharmacy_quantity($d->item_id,$data);
          }
        }
      }

      $data = array('phar_stat'=>2);
      $this->Model_pharmacy->process_nurse_return_model($auditid,$data);
      redirect('Pharmacy/process_nurse_return_medicine');
    }

    function reject_nurse_return_request()
    {
      $postid = $this->uri->segment(3);
      $data = array('phar_stat'=>3);
      $this->Model_pharmacy->process_nurse_return_model($postid,$data);
      redirect('Pharmacy/process_nurse_return_medicine');
    }
}
