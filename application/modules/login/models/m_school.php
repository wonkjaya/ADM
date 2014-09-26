<?php
class M_school extends CI_Model
{
  function get_user_type()
   {
   	$sql="SELECT * FROM user_type";
  	return $this->db->query($sql);
   }
  
  function select_user_where($user)
   {
   	$user=$this->db->escape($user);
   	$sql="SELECT * FROM user_accounts where username= $user ";
  	return $this->db->query($sql);
   }
  
  function select_top10_where($class,$major,$subject)
   {
   	$class=$this->db->escape($class);
   	$major=$this->db->escape($major);
   	$subject=$this->db->escape($subject);
   	$sql="SELECT students.student_name,students.student_class,student_details.student_address, student_details.student_photo, student_test_report.* 
			FROM student_test_report 
			LEFT JOIN students ON students.NIM = student_test_report.NIM 
			LEFT JOIN student_details ON students.NIM = student_details.NIM 
			where students.student_class= $class and students.student_major= $major and student_test_report.subject_code=$subject
			ORDER BY students.NIM
			LIMIT 10";
  	return $this->db->query($sql);
   }
   
  function get_score($nim,$class)
   {
     $nim=$this->db->escape($nim);
     $class=$this->db->escape($class);
       $sql="SELECT student_test_report.*, students.*, majors.major_name, subject.subject_name FROM student_test_report 
      		LEFT JOIN students ON students.NIM = student_test_report.NIM 
      		LEFT JOIN subject ON subject.subject_code = student_test_report.subject_code
     		LEFT JOIN majors ON majors.major_code = students.student_major
     		where student_test_report.NIM= $nim and student_test_report.class = $class";
     return $this->db->query($sql);
   }
   
  function get_major()
  {
    $sql="SELECT major_code,major_name from majors where activated = 1";
    return $this->db->query($sql);
  }
   
  function get_subject()
  {
    $sql="SELECT subject_code,subject_name from subject where activated = 1";
    return $this->db->query($sql);
  }
   
  function get_class()
  {
    $sql="SELECT class_code,class_name from classes where activated = 1";
    return $this->db->query($sql);
  }
  
  function get_class_name($id)
  {
    $id=$this->db->escape($id);
    $sql="SELECT class_name from classes where class_code=$id LIMIT 1";
    return $this->db->query($sql);
  }
   
  function get_nim()
  {
    //$nim=$this->db->escape($nim);where nim LIKE $nim
    $sql="SELECT NIM,student_name from students  ";
    return $this->db->query($sql);
  }
   
  function get_student_list($class,$major)
  {
    $class=$this->db->escape($class);
    $major=$this->db->escape($major);
    $sql="SELECT students.*, student_details.student_photo from students LEFT JOIN student_details 
    	  ON students.NIM=student_details.NIM where student_class = $class and student_major=$major";
    return $this->db->query($sql);
  }


}
//end of file 