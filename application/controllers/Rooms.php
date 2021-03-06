<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
  class Rooms extends CI_Controller{
    function __construct(){
      parent::__construct();
      $this->load->model('Model_Rooms');
      $this->load->model('Model_user');
    }
    function index()
    {
      $this->load->view("includes/header.php");
      $this->load->view("rooms/index.php");
      $this->load->view("includes/footer.php");
    }
    function RoomType()
    {
      $header['title'] = "HIS: Rooms: Room Types";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['roomtypes'] = $this->Model_Rooms->get_roomtype_List();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/roomtypelist.php', $data);
      //$this->load->view('rooms/includes/footer.php');
    }
    function insert_roomtype(){
      $this->form_validation->set_rules('roomname', 'Room Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('roomprice', 'Room Price', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('roomdesc', 'Room Description', 'required|trim|xss_clean|strip_tags');
      if($this->form_validation->run() == FALSE){
        echo validation_errors();
      }else{
        $data = array(
                      'room_name' => $this->input->post('roomname'),
                      'room_description' => $this->input->post('roomdesc'),
                      'room_price' => $this->input->post('roomprice')
                     );
        $insertroomtype = $this->Model_Rooms->insertroomtype($data);
        redirect(base_url()."Rooms/RoomType");
      }
    }

    function UpdateRoomType($id){
      $header['title'] = "HIS: Rooms: Update Room Type";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['roomtype'] = $this->Model_Rooms->get_room_type($id);
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/updateroomtype.php', $data);
      $this->load->view('users/includes/footer.php');
    }

    function update_roomtype(){
      $this->form_validation->set_rules('roomname', 'Room Name', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('roomprice', 'Room Price', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('roomdesc', 'Room Description', 'required|trim|xss_clean|strip_tags');
      if($this->form_validation->run() == FALSE){
        echo validation_errors();
      }else{
        $data = array(
                      'room_name' => $this->input->post('roomname'),
                      'room_description' => $this->input->post('roomdesc'),
                      'room_price' => $this->input->post('roomprice')
                     );
        $this->Model_Rooms->updateroomtype($data, $this->input->post('roomid'));
        redirect(base_url()."Rooms/RoomType");
      }
    }
    /************************************************************************/
    function Rooms(){
      $header['title'] = "HIS: Rooms: Room List";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rooms'] = $this->Model_Rooms->get_room_list();
      $data['roomtypes'] = $this->Model_Rooms->get_roomtype_List();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/roomlist.php', $data);
      //$this->load->view('rooms/includes/footer.php');
    }
    function insert_room(){
      $this->form_validation->set_rules('roomtype', 'Room Type', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('roomloc', 'Room Location', 'required|trim|xss_clean|strip_tags');
      if($this->form_validation->run() == FALSE){
        echo validation_errors();
      }else{
        $data = array(
                      'room_type' => $this->input->post('roomtype'),
                      'room_location' => $this->input->post('roomloc'),
                      'occupancy_status' => 1,
                      'maintenance_status' => 1
                    );
        $insertroomtype = $this->Model_Rooms->insertroom($data);
        $beddata = array(
                        'bed_roomid' => $insertroomtype
                        );
        $bednum = $this->input->post('bednum');
        for($i=1;$i<=$bednum;$i++)
        {
            $this->Model_Rooms->insertbedsinroom($beddata);
        }
        redirect(base_url()."Rooms/Rooms");
      }
    }

    function ViewRoom($id){
      $header['title'] = "HIS: Rooms: View Room";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['roomdata'] = $this->Model_Rooms->get_room_data($id);
      $data['roomid'] = $id;
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/viewroom.php', $data);
      $this->load->view('users/includes/footer.php');
    }

    function UpdateRoom($id){
      $header['title'] = "HIS: Rooms: Update Room";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rooms'] = $this->Model_Rooms->get_single_room_type($id);
      $data['roomtypes'] = $this->Model_Rooms->get_roomtype_List();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/updateroom.php', $data);
      $this->load->view('users/includes/footer.php');
    }
    function ReportBed($id = NULL){
      $header['title'] = "HIS: Report Bed";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rooms'] = $this->Model_Rooms->get_room_list();
      $this->load->view('users/includes/header.php',$header);
      if(empty($id)){
        $this->load->view('rooms/roomlist_for_reporting.php', $data);
      }else{
        $data['roomdata'] = $this->Model_Rooms->get_room_data($id);
        $this->load->view('rooms/viewroom_for_reporting.php', $data);
      }
      $this->load->view('includes/toastr.php');
    }
    function ForCleaning(){
      $data = array("bed_maintenance"=>1);
      $this->Model_Rooms->update_bed($data, $this->uri->segment(3));
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Successfully reported bed for cleaning.">
                                <input type="hidden" id="type" value="success">');
      redirect(base_url()."Rooms/ReportBed");
    }
    function ForMaintenance(){
      $data = array("bed_maintenance"=> 2);
      $this->Model_Rooms->update_bed($data, $this->uri->segment(3));
      $this->session->set_flashdata('msg', '<input type="hidden" id="title" value="Success">
                                <input type="hidden" id="msg" value="Successfully reported bed for maintenance.">
                                <input type="hidden" id="type" value="success">');
      redirect(base_url()."Rooms/ReportBed");
    }
    function update_room($id){
      $this->form_validation->set_rules('roomtype', 'Room Type', 'required|trim|xss_clean|strip_tags');
      $this->form_validation->set_rules('roomloc', 'Room Location', 'required|trim|xss_clean|strip_tags');
      if($this->form_validation->run() == FALSE){
        echo validation_errors();
      }else{
        $data = array(
                      'room_type' => $this->input->post('roomtype'),
                      'room_location' => $this->input->post('roomloc')
                     );
        $this->Model_Rooms->updateroom($data, $id);
        redirect(base_url()."Rooms/Rooms");
      }
    }

     function add_bed($id){
      $beddata = array(
                      'bed_roomid' => $id
                      );
      $bednum = $this->input->post('bednum');
      for($i=1;$i<=$bednum;$i++)
      {
          $this->Model_Rooms->insertbedsinroom($beddata);
      }
      redirect(base_url()."Rooms/ViewRoom/".$id);
    }

    function remove_bed($roomid, $id){
      $this->Model_Rooms->removebed($id);
      redirect(base_url()."Rooms/ViewRoom/".$roomid);
    }
    /************************************************************************/
    function OperationRoom(){
      $header['title'] = "HIS: Rooms: Operation Room List";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rooms'] = $this->Model_Rooms->get_operation_room_list();
      $data['roomtypes'] = $this->Model_Rooms->get_roomtype_List();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/roomlist.php', $data);
    }

    /************************************************************************/
    function EmergencyRoom(){
      $header['title'] = "HIS: Rooms: Operation Room List";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rooms'] = $this->Model_Rooms->get_emergency_room_list();
      $data['roomtypes'] = $this->Model_Rooms->get_roomtype_List();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/roomlist.php', $data);
    }
    /************************************************************************/
    function ICU(){
      $header['title'] = "HIS: Rooms: Operation Room List";
      $header['tasks'] = $this->Model_user->get_tasks($this->session->userdata('type_id'));
      $header['permissions'] = $this->Model_user->get_permissions($this->session->userdata('type_id'));
      $data['rooms'] = $this->Model_Rooms->get_icu_list();
      $data['roomtypes'] = $this->Model_Rooms->get_roomtype_List();
      $this->load->view('users/includes/header.php',$header);
      $this->load->view('rooms/roomlist.php', $data);
    }
    /************************************************************************/
  }
?>
