<?php

class Administrations extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->helper(array('html','url'));
}

function get_userdata(){
	$this->load->library('session');
	return $this->session->userdata('user_account');
}

function index(){
 echo "(*_*)";
 redirect('fanpage');
}


}
?>