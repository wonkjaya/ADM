<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','component_urls','student'));
		$this->load->model('m_student');
	 }
	
	function check_session()
	 {
		$user=$this->session->userdata('siswa');
		if ($user == ''){ redirect('login');}
	 }
	
	function get_nim($user)
	 {
		$nim=$this->session->userdata('NIM');
		if ($nim == ''){
			$q=$this->m_student->get_nim($user);
			$nim='-';
			foreach($q->result() as $r){
			 $nim=$r->NIM;
			}
			$this->session->set_userdata('NIM',$nim);
		}
	 	return $nim=$this->session->userdata('NIM');
	 }
	
	function get_model()
	{
		return $this->m_student;
	}
	
	
	function get_controller()
	{
		return $this;
	}
	
	function view_student_score($id)
	{
		$this->load->helper('form');
		if ($id==""){
			$id=$this->uri->segment(3);
		}
		if (is_numeric($id)){
		 $check=$this->m_student->get_my_profile_info($id);
		 if ($check->num_rows() == 1){
		 	foreach($check->result() as $r){$kelas=$r->student_class;$name=$r->student_name;}
			if ($_POST) {$kelas=$this->input->post('kelas');}
		 	$data['kelas']=$kelas;
			$data['title']=$name;
		 	$data['name']=$name;
		 	$data['model']=$this->get_model();
		 	$data['controller']=$this->get_controller();
		 	$data['hasil']=$this->m_student->get_student_score($id,$kelas);
		 	$this->load->view('student_score_byNIM',$data);
		 }
		}
	}
	
	function get_site_name(){
		$name="http://www.rezstore.com/sekolah";
		$e=explode('/',$name);
		if($e[2]=="rezstore.com" OR $e[2]=="www.rezstore.com" )redirect('http://labs.rezstore.com/sekolah');
	}
	
	
	function index()
	 {
		$this->check_session();
		$this->load->helper('student');
		$user=$this->session->userdata('siswa');
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('profile',$data);
	 }
	
	function get_head($title){
		$data['title']=$title;
		$this->load->view('head');
	}
	
	function profile()
	 { 
		$data['title']="Profil";
		$this->check_session();
		$user=$this->session->userdata('siswa');
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('profile',$data);
	 }
	
	function get_student_profile($user)
	 { 
		$this->load->helper('form');
		$nim=$this->get_nim($user);
		$data['data_profile']=$this->m_student->get_my_profile_info($nim);
		$this->load->view('content-profile',$data);
	 }
	
	function update_student_info()
	 {
	 	$NIM=$this->session->userdata('NIM');			$nama=$this->input->post('nama');
		$jenis_kelamin=$this->input->post('jenis_kelamin');	$agama=$this->input->post('agama');
		$email=$this->input->post('email');			$no_telp=$this->input->post('no_telp');
		$kota=$this->input->post('kota');			$kode_pos=$this->input->post('kode_pos');
		$info=$this->input->post('info');			$siswa_alamat=$this->input->post('siswa_alamat');
		//parent
		$nama_ortu=$this->input->post('nama_ortu');		$agama_ortu=$this->input->post('agama_ortu');
		$jk_ortu=$this->input->post('jk_ortu');			$kota_ortu=$this->input->post('kota_ortu');
		$alamat_ortu=$this->input->post('alamat_ortu');		$kode_post_ortu=$this->input->post('kode_post_ortu');
		$parent_number=$this->input->post('parent_number');
		$this->m_student->update_student_info(
			$NIM, $nama , $jenis_kelamin, $email, $agama, $no_telp, $kota, $kode_pos, $info, $siswa_alamat, 
			$nama_ortu, $agama_ortu, $jk_ortu, $kota_ortu, $alamat_ortu, $kode_post_ortu,$parent_number);
		$this->profile();
	 }
	
	function transkrip()
	 {
	 	$data['title']="Transkrip";
	 	$this->load->helper('form');
	 	$this->check_session();
		$user=$this->session->userdata('siswa');
		$nim=$this->get_nim($user);
		if($_POST){
	 	 $data['kelas']=$this->input->post('kelas');
	 	}else{
	 	 $data['kelas']='';
	 	}
		 $data['score']=$this->m_student->get_student_transkrip($nim,$data['kelas']);
		$data['nim']=$nim;
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('student_transkrip',$data);
	 }
	
	function get_student_transkrip($nim)
	{
		$this->load->helper('form');
		$this->load->view('transkrip',$data);
	}
	
	function score()
	 {
	 	$data['title']="Nilai";
	 	$this->check_session();
		$user=$this->session->userdata('siswa');
	 	$data['kelas']=$this->input->post('kelas');
		$nim=$this->get_nim($user);
		$data['nim']=$this->session->userdata('NIM');
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('student_score',$data);
	 }
	
	function print_score()
	 {
	 	$data['title']="print";
	 	$this->load->helper('form');
		$this->check_session();
		$user=$this->session->userdata('siswa');
		$nim=$this->get_nim($user);
		if($_POST){
			$f_nim=$this->input->post('NIM');
			$f_kelas=$this->input->post('f_kelas');
			$kelas=$this->input->post('kelas');
			$data['siswa']=$this->m_student->get_student_info_from_NIM($f_nim);
		}else{
			$f_nim='';	$f_kelas='';	$kelas='';
		}
		
		$data['f_nim']=$f_nim;
		$data['kelas']=$kelas;
		$data['f_kelas']=$f_kelas;
		if($f_nim != '')
		{
			$data['student_scores']=$this->m_student->get_student_score_where_NIM($f_nim,$f_kelas);
			$data['f_nim']=$f_nim;
		}else{
			$data['myScores']=$this->m_student->get_student_score_where_NIM($nim,$kelas);
		}
			$data['nim']=$this->session->userdata('NIM');
			$data['user']=$user;
			$data['controller']=$this->get_controller();
			$data['model']=$this->get_model();
			$this->load->view('print_score',$data);
	 }
	
	function print_report_this($result)
	{
	}
	
	function get_student_score($nim,$kelas)
	{
		$this->load->helper('form');
		$data['score']=$this->m_student->get_student_score($nim,$kelas);
		$this->load->view('nilaiku',$data);
	}

	function notices()
	{
		$data['title']="Pengumuman";
		$this->check_session();
		$this->load->helper('student');
		$user=$this->session->userdata('siswa');
		$this->load->helper('form');
		if($_POST){
		  $filter=$this->input->post('filter');
			if ($filter != '' and $filter != "Cari Berdasar Kata"){
			  $word=$filter;
			}else{
			  $word='';
			}
		}else{
			$word='';
		}
		$data['notices']=$this->m_student->get_notices($word);
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('notices',$data);
	}
	
	function left_content()
	{
		$user=$this->session->userdata('siswa');
		$this->load->helper('student');
		$data['left']=$this->m_student->get_left_content($user);
		$this->load->view('left',$data);
	}
	
	function get_notice_contents()
	{
		
		$this->load->view('notice_content',$data);
	}
	
	function read_more($id)
	{
		$data['title']="Pengumuman";
		$this->check_session();
		if ($id==""){
		$id=$this->uri->segment(3);
		}
		$data['controller']=$this->get_controller();
		$data['post_detail']=$this->m_student->get_notice_detail($id);
		$this->load->view('notice_detail',$data);
	}
	
	function add_activities()
	 {
	   	$data['title']="Aktifitas";
	   	$this->load->helper('form');
	   	$this->check_session();
		$user=$this->session->userdata('siswa');
		$data['model']=$this->get_model();
		$data['controller']=$this->get_controller();
		$this->load->view('add_activities',$data);
	 }
	 
	function add_new_activities()
	 {
	  	$this->check_session();
	  	if($_POST){
	  		$user=$this->session->userdata('siswa');
		  	$judul=$this->input->post('judul');
		  	$subject=$this->input->post('subject');
		  	$deskripsi=$this->input->post('deskripsi');
		  	$this->m_student->insert_new_activities($user,$judul,$subject,$deskripsi);
		  }
		  redirect(student_site_url('add_activities'));
	 }
	 
	function update_activities()
	 {
	  	$this->check_session();
	  	if($_POST){
	  		$id=$this->input->get('id');
	  		$user=$this->session->userdata('siswa');
		  	$judul=$this->input->post('judul');
		  	$subject=$this->input->post('subject');
		  	$deskripsi=$this->input->post('deskripsi');
		  	$cek=$this->check_user_from_activity($id);
		  	if ($id != '' and $cek == true){
			  	$this->m_student->update_activities($user,$id,$judul,$subject,$deskripsi);
		  	}
		  }
		  redirect(student_site_url('activities'));
	 }
	 
	function check_user_from_activity($id)
	 {
	   $user=$this->session->userdata('siswa');
	   $c=$this->m_student->get_activity_from_id($id,$user);
	   if($c->num_rows() > 0 ){
	     return true;
	   }else{
	     return false;
	   }
	 }
	
	function activities()
	 {
	   	$data['title']="Lihat Aktifitas";
	   	$this->check_session();
		$user=$this->session->userdata('siswa');
	   	if($_GET){
	   	  $delete=$this->input->get('delete');
	   	  $edit=$this->input->get('edit');
	   	  if($delete != ''){
	   	    $id=$delete;
	   	    $q=$this->m_student->delete_activity($id,$user);
	   	    redirect(student_site_url('activities'));
	   	  }else{
	   	    $id=$edit;
	   	    $q=$this->m_student->get_activity_from_id($id,$user);
	   	    if($q->num_rows() > 0){
		   	    $this->load->helper('form');
		   	    $data['model']=$this->get_model();
		   	    $data['edit']=$q;
		   	    $data['controller']=$this->get_controller();
		   	    $this->load->view('add_activities',$data);
	   	    }else{
	   	    	redirect(student_site_url('add_activities'));
	   	    }
	   	  }
	   	}else{
			$data['model']=$this->get_model();
			$data['controller']=$this->get_controller();
			$data['activities']=$this->m_student->get_activities($user);
			$this->load->view('activities',$data);
		}
	 }
	
#==================================================================================================#
	 
	function consultation()
	{
		$this->check_session();
		$this->load->helper('student');
		$user=$this->session->userdata('siswa');
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['teach']=$this->m_student->get_teachers();
		$this->load->view('consultations',$data);
	}
	
	function friends()
	{
		$this->check_session();
		$this->load->helper('student');
		$user=$this->session->userdata('siswa');
		$this->set_nim($user);
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['friend']=$this->m_student->get_friends($user);
		$this->load->view('friends',$data);
	}
	
	function chats($NIK)
	{
		//$this->load->helper('student');
		$this->check_session();
		if ($NIK == ""){
			$NIK=$this->uri->segment(3);
		}
		$user=$this->session->userdata('siswa');
		$this->set_nim($user);
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['chat_to']=$this->m_student->get_username_from_NIK($NIK);
		$this->load->view('chats',$data);
	}
	
	function get_chats($user,$to)
	{
		$data['chats']=$this->m_student->get_chats($user,$to);
		$this->load->view('chats_content',$data);
	}
	
	function footer_content()
	{
		
	}
	
	function get_header()
	{
		$this->load->view('header');
	}
	
	function get_leftside()
	{
		$this->load->view('leftside');
	}
	
	function get_major($maj)
	{
		$major=$this->m_student->get_major($maj);
		foreach($major as $r ){return $r->major_name;}
	}
	
	function logout()
	{
		$user=$this->session->userdata('siswa');
		$this->check_session();
		$this->session->unset_userdata('siswa');
		$this->session->unset_userdata('NIM');
		$this->index();
	}
	
	function problem_report($id,$type)
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('siswa');
		$nim=$this->session->userdata('NIM');
		if ($id == ""){
			$id=$this->uri->segment(3);
			$type=$this->uri->segment(4);
		}
		if($type != 1 and $type != 2 and $type != 3 and $type != 4 and $type != 5 and $type != 6 and $type != 7 ){$type=1;}
		if($type ==1)$value=" 'Nilai' Dengan ID Tes $id bahwa ...";
		if($type ==2)$value=" 'Absensi' Dengan ID Absensi $id Bahwa... ";
		if($type ==3)$value=" 'Pengajar' Yang Bernama [nama] Karena ...";
		if($type ==4)$value=" 'Fasilitas'  Yang Ada Di Sekolah Ini...";
		if($type ==5)$value=" 'Sistem Pembelajaran' Yang Ada Di Sekolah Ini... ";
		if($type ==6)$value=" 'Antar Siswa' ";
		if($type ==7)$value=" lain yang berhubungan dengan ... ";
		$data['value'] ="Saya Mempunyai Masalah mengenai".$value;
		if($_POST){
			$subject=$this->input->post('subject');
			$description=$this->input->post('penjelasan');
			if($description != ""){
				$this->m_student->insert_new_report_problem($nim,$subject,$description);
			}
		}
		$data['problem']=$this->m_student->get_my_report($nim);
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		if(is_numeric($id) and !empty($id)){
			$cek=$this->m_student->get_ID_nilai_report($nim,$id);
			if ($cek->num_rows() > 0){
				$data['hasil']=$cek;
				//$this->load->view('report_problem',$data);
			}
		}
			$this->load->view('report_problem',$data);
		
	}
	
	function lihat_problem(){
	 $this->check_session();
	 $nim=$this->session->userdata('NIM');
	 $id=$this->input->get('id');
	 $data['controller']=$this->get_controller();
	 $data['problem']=$this->m_student->lihat_problem($id,$nim);
	 $this->load->view('lihat_problem',$data);
	}
	
	function delete_problem(){
	 $this->check_session();
	 $nim=$this->session->userdata('NIM');
	 $id=$this->input->get('id');
	 $this->m_student->delete_problem($id,$nim);
	 redirect('siswa/student/problem_report');
	}
	
//=======================================STUDENTS====================================
	function students($err='')
	 {
		$data['title']="Teman";
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('siswa');
		$nim=$this->session->userdata('NIM');
		$jurusan='ipa';$kelas='x';
		if($_POST){$jurusan=$this->input->post('jurusan'); $kelas=$this->input->post('kelas');}
		if ($jurusan=="" OR $kelas==""){$jurusan='ipa';$kelas='x';}
		$query=$this->m_student->get_students_where_class($data['kls']=$kelas,$data['jur']=$jurusan);
		if ($err != '') $data['err']=$err;
		$data['siswa']=$query;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('students',$data);
	 } 
	 
	 function teachers($err='') 
	 {
		$data['title']="Guru";
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('siswa');
		$nim=$this->session->userdata('NIM');
		$find='a';
		if($_POST){$find=$this->input->post('find');} 
		$query=$this->m_student->get_teacher_where($find);
		if ($err!='')$data['err']=$err;
		$data['siswa']=$query;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('teachers',$data);
	 } 
	 
	 function teacher_profile($nik)
	 {
		$data['title']="Profil Guru";
		$this->check_session();
		if ($nik==""){
		 $nik=$this->uri->segment(3);
		}
		$query=$this->m_student->get_teacher_profile($nik);
		$data['siswa']=$query;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('teacher_profiles',$data);
	 } 
	 
	 function student_profiles($student_nim)
	 {
		$data['title']="profile";
		$this->check_session();
		$user=$this->session->userdata('siswa');
		$nim=$this->session->userdata('NIM');
		if ($student_nim==""){
			$student_nim=$this->uri->segment(3);
		}
		$query=$this->m_student->get_students_where_nim($student_nim);
		$data['siswa']=$query;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('student_profiles',$data);
	 } 
	
	//+=====================================
	function get_chats_unread($user='')
	{
		if($user == '')$user=$this->session->userdata('siswa');
		$messages=$this->m_student->get_chats_unread(0,$user);//0 menandakan bahwa untuk mendapatkan jumlah messages
		return anchor('siswa/student/show_unread_messages',$messages->num_rows().' Messages');
	}
	
	function show_unread_messages()
	{
		$data['title']="chat";
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('siswa');
		if($_POST){
		  $tujuan=explode(',',$this->input->post('tujuan'));
		  $text="<p style='text-align:justify;'>".$this->input->post('text')."</p>";
		  foreach($tujuan as $obj){
			$this->m_student->insert_new_compose($obj,$user,$text);	
		  }
		  $_POST=NULL;
		}
		$data['u']=$user;
		$data['outbox']=$this->m_student->get_outbox($user);
		$data['messages']=$this->m_student->get_all_chats($user);//1 menandakan bahwa untuk mendapatkan jumlah messages setelah digroup
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$this->load->view('user_chats',$data);
	}
	
	function detail_messages()
	{
		$data['title']="chat";
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('siswa');
		$data['u']=$user;
			$id=$this->input->get('id');
			if($user == '')$user=$this->session->userdata('siswa');
			$msg=$this->m_student->get_chats_where($id);
			foreach($msg->result() as $r){
				$from=$r->user_from;
				$to=$r->user_to;
				$this->m_student->update_messages_state($from,$to);
			}
			if(!isset($from))$from='';
			$data['outbox']=$this->m_student->get_outbox($user);
			$data['detail']=$this->m_student->get_chats_groupFrom($from,$user);
			$data['controller']=$this->get_controller();
			$data['model']=$this->get_model();
			$this->load->view('user_chats',$data);
	}
	
	function send_teacher_message()
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('siswa');
		$nik=$this->input->get('id');
		$userTo=$this->m_student->get_userTeacher_from_nik($nik);
		if ($userTo == ''){
			echo "Data dengan ID = $nik Tidak Ditemukan";
			exit();
		}else{
			$data['controller']=$this->get_controller();
			$data['user_to']=$userTo;
			$data['type']="t";
			$this->load->view('send_message',$data);
		}
	}
	
	function send_friend_message()
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('siswa');
		$nim=$this->input->get('id');
		$userTo=$this->m_student->get_StudentUser_from_nim($nim);
		if ($userTo == ''){
			echo "Data dengan ID = $nik Tidak Ditemukan";
			exit();
		}else{
			$data['controller']=$this->get_controller();
			$data['user_to']=$userTo;
			$data['type']="s";
			$this->load->view('send_message',$data);
		}
	}
	
	function send()
	{
		$this->check_session();
		$user=$this->session->userdata('siswa');
		$userTo=$this->input->post('id');
		$content=$this->input->post('content');
		$to=$this->input->get('to');
		if ($to == 's'){
			$name=$this->m_student->get_StudentNama_from_user($userTo);
		}else{
			$name=$this->m_student->get_TeacherNama_from_user($userTo);		
		}
		if ($userTo == '' or $content == ''){
			echo "Data Tidak Tersedia";
			exit();
		}else{
			$this->m_student->insert_new_message($user,$userTo,$content);
			if ($to == 's'){
				$this->students('Pesan Berhasil Dikirim Ke '.$name.'!!!');
			}else{
				$this->teachers('Pesan Berhasil Dikirim Ke '.$name.'!!!');		
			}
			
		}
	}
	
	function token_input($type)
	{
		$user=$this->session->userdata('siswa');
		$clue=$this->input->get('q');
		if ($type==""){
			$type=$this->uri->segment(3);
		}
		if ($type=='') $tp="all_user";
		if ($type="all_user"){
			$q=$this->m_student->get_all_user($clue,$user);
		}
		echo json_encode($q);
	}
	
}
//end of file
