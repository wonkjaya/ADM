<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook_post extends CI_Controller {

	var $appId = "";
	var $appSecret = "";
	var $return_url = ""; 
	var $homeurl = "";  
	var $fbPermissions = ""; 
	var $token = ""; 
	var $page = ""; 
	var $fbuser = ""; 
	
	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','facebook'));
		$this->load->model('m_facebook');
		$this->initial();
	 }
	
	function initial(){
		$this->appId = '142895449211373'; //Facebook App ID
		$this->appSecret = '3dbcdb2924d107bd28293f99ba0634e4'; // Facebook App Secret
		$this->return_url = 'http://rezstore.com/facebook/process.php';  //return url (url to script)
		$this->homeurl = 'http://rezstore.com/facebook/';  //return to home
		$this->fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
		$this->fbuser="100005343461657";
		$this->page="338081799692389";
		$this->token="CAACB9nB9ge0BAFzOdce8Y9yqwQbfc2uvvCgFNRvvrqs6x6FN98PsRG1MmiKsxw6DZAxOwqEtBQfQAZAtrXMaLsThTZBl279QC20dGskPGbNJhx7UtiOxEEr8AxzHK6ciAlZAYxCDBJcngM2wmMNz1Jn1cIZCAGix9YWMckTTZAU6ndSlsvz7kwckFJ77N5EB1sRHJBAcCPg24CCajLnGrQ";
	}
	 
	function index(){
		$this->home();
	}
	
	function home(){
		$data['title']="";
		$this->load->view('view_posting',$data);
	}
	
	function send_message($message,$url,$image_source){
		$param=array(
			  'appId'  => $this->appId,
			  'secret' => $this->appSecret
			);
		$this->load->library('facebook/facebook',$param);
		$userPageId 	= $this->page;
		$userMessage 	= $message;
	
		if(strlen($userMessage)<1)
		{
			//message is empty
			$userMessage = 'No message was entered!';
		}
	
			//HTTP POST request to PAGE_ID/feed with the publish_stream
			$post_url = '/'.$userPageId.'/feed';
		
			//posts message on page statues 
			$msg_body = array(
			'access_token' => $this->token,
			'message' => $userMessage,
			'link'=>$url,
			'source'=>$image_source,
			'caption' => "Perusahaan Pembuat Website Dynamic",
			);
	
		if ($this->fbuser) {
		  try {
				$postResult = $this->facebook->api($post_url, 'post', $msg_body );
			} catch (FacebookApiException $e) {
			echo $e->getMessage();
		  }
		}
	}
	
}
//end of file
