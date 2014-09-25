<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fanpage extends CI_Controller {

	var $appId = "";
	var $appSecret = "";
	var $return_url = ""; 
	var $homeurl = "";  
	var $fbPermissions = ""; 
	var $token = ""; 
	var $page = ""; 
	var $fbuser = "";
	var $caption_post = ""; 
	
	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','fanpage'));
		$this->load->model('m_fanpage');
		$this->initials();
	 }
	 
	function initials(){
	 	$this->initial_fb();
	 }
	
	function initial_fb(){
		$init=$this->m_fanpage->get_app_properties('facebook');
		foreach($init->result() as $r){
			$this->appId = $r->appId; //Facebook App ID
			$this->appSecret = $r->appSecret; // Facebook App Secret
			$this->return_url = $r->return_url;  //return url (url to script)
			$this->homeurl = $r->homeurl;  //return to home
			$this->fbPermissions = $r->fbPermissions;  //Required facebook permissions
			$this->token=$r->token;
			$this->caption_post="Perusahaan Pembuat Website Dynamic";
		}
	}
	
	function initial_twitter(){
		$init=$this->m_fanpage->get_app_properties('twitter');
		foreach($init->result() as $r){
			$this->appId = $r->appId; //Facebook App ID
			$this->appSecret = $r->appSecret; // Facebook App Secret
			$this->token = $r->token;  //return url (url to script)
			$this->token_secret = $r->token_secret;  //return to token secret
		}
	}
	 
	function index(){
		$this->facebook();
	}
	
	function load_header($data){
		$this->load->view('header',$data);
	}
	
	function facebook(){
		$data['title']="Facebook";
		$data['active']="f";
		$data['posting']=$this->m_fanpage->get_all_facebook_posting();
		$this->load_header($data);
		$this->load->view('view_posting',$data);
	}
	
	function twitter(){
		$data['title']="Twitter";
		$data['active']="t";
		$data['posting']=$this->m_fanpage->get_all_twitter_posting();
		$this->load_header($data);
		$this->load->view('view_posting',$data);
	}
	
	function googlep(){
		$data['title']="Google Plus";
		$data['active']="g";
		$data['posting']=$this->m_fanpage->get_all_googleP_posting();
		$this->load_header($data);
		$this->load->view('view_posting',$data);
	}
	
	function post(){
		$q=$this->m_fanpage->get_facebook_posting();
		foreach($q->result() as $res){
			echo $ID=$res->ID_post;
			$fbuser=$res->UID;
			$page=$res->page_id;
			$message=$res->messages;
			$url=$res->url;
			$image=get_image_post($res->image);
			$this->send_message($ID,$fbuser,$page,$message,$url,$image);
		}
	}
	
	function insert_new_facebook(){
		$data['title']="Insert New Facebook";
		$data['active']="f";
		if($_POST){
		 
		}
		$this->load->helper('form');
		$this->load_header($data);
		$this->load->view('new_post',$data);
	}
	
	
	
	#######################################################################################################
	
	function send_message($ID,$fbuser,$page,$message,$url,$image_source){
		$param=array(
			  'appId'  => $this->appId,
			  'secret' => $this->appSecret
			);
		$this->load->library('facebook/facebook',$param);
		$userPageId 	= $page;
		$userMessage 	= $message;
	
		if(strlen($userMessage) < 1)
		{
			//message is empty
			$userMessage = 'No message was entered!';
		}
	
			//HTTP POST request to PAGE_ID/feed with the publish_stream
			$post_url = '/'.$userPageId.'/feed';
			
			$this->facebook->setFileUploadSupport(true);
			$path=str_replace('http://localhost/','/home/public_html/',$image_source);
			echo $img = realpath($path);
			
			//posts message on page statues 
			$msg_body = array(
			'access_token' => $this->token,
			'message' => $userMessage,
			'image' => $img,
			'link'=>$url,
			'caption' => $this->caption_post,
			);
	
		if ($fbuser) {
		  try {
				$postResult = $this->facebook->api($post_url, 'post', $msg_body );
				//$this->m_fanpage->update_facebook_posting_status($ID);
			} catch (FacebookApiException $e) {
				echo $e->getMessage();
		  }
		}
	}
	
}
//end of file
