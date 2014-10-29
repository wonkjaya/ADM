<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aktivitas_harian  extends CI_Controller {

function __construct(){
	parent::__construct();
	$this->load->helper(array('html','url'));
	$this->load->model('m_aktivitas');
	$this->load->helper('aktivitas_harian');
}

function index(){
	$this->view_activity();
}

function load_header($data=""){
	$data['type']="activity";
	$this->load->view('templates/adm_header',$data);
	$this->load->view('templates/menus',$data);
}

function get_username(){
	$this->load->library("session");
	$username=$this->session->userdata("user_account");
	if($username == "")redirect('login');
	return $username;
}

function view_activity(){
	$this->load->helper('form');
	$user=$this->get_username(); 
	$data['q']=$this->m_aktivitas->view_activity($user);
	$this->load_header();
	$this->load->view('view_aktivitas',$data);
	}

function new_activity(){
	if($_POST){
		$user=$this->get_username(); 
		$date=$this->input->post('tanggal');
		$text=$this->input->post('text');
		if($date != "" AND $text !=""){
			$this->m_aktivitas->insert_db($user,$date,$text);
		}
		redirect (get_site_url('view_activity'));		
	}
	$this->load->helper('form');
	$data['title']="New Activity";
	$this->load_header($data);
	$this->load->view('input_aktivitas');
}

function edit($id){
if($id == "")exit;
	if($_POST)
	{			
		$user=$this->get_username();
		$date=$this->input->post('tanggal');
		$activity=$this->input->post('text');
		if($date != "" AND $activity !=""){
			$this->m_aktivitas->update_db($id,$user,$date,$activity);
		}
		redirect (get_site_url('view_activity'));
	}else{
		$this->load->helper('form');
		$data['title']="Edit Activity";
		$data['edit']=$this->m_aktivitas->select_activity($id);
		$this->load_header($data);
		$this->load->view('input_aktivitas',$data);
	}
	
}



}
	
	?>
