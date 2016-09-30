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

  function reject_pharmacy_request()
  {
    $postid = $this->uri->segment(3);
    $data = array('phar_stat'=>3);
    $this->Model_pharmacy->process_pharmacy_request_model($postid,$data);
    redirect('Pharmacy/process_pharmacy_request');
  }

  function view_one_request()
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

  //====================================Drugs pharmacy request===========================//
  function drug_pharmacy_request()
  {
    $header['title'] = "HIS: Pharmacy Inventory";
    $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
    $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
    $data['items'] = $this->Model_pharmacy->get_drug_inventory();
    $data['patients'] = $this->Model_pharmacy->get_all_patients();
    $this->load->view('users/includes/header.php',$header);

    $this->load->view('pharmacy/pharmacy_request',$data);
    $this->load->view('pharmacy/pharmacy_request_modal');
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
    $this->load->view('pharmacy/drugs_process_pharmacy_request',$data);
  }

  function drug_view_one_request()
  {
    $id = $this->uri->segment('3');

    $data['details'] = $this->Model_pharmacy->get_specific_request($id);
    $data['items'] = $this->Model_pharmacy->get_drug_inventory();
    $data['id'] = $id;
    $this->load->view('pharmacy/header');
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
    $this->load->view('pharmacy/header');
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
  function drugs_restock_medicine()
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

    redirect('Pharmacy/restock_medicine');
  }
}
