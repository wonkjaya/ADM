<!doctype html>
<html lang="en">

<?php 
if(!isset($title))$title="";
$controller->get_head($title); ?>


<body>

	<?php  $controller->get_header();?>
	
	<?php  $controller->get_leftside();?>
	
	<section id="main" class="column">
		<?php 
		if (!isset($err) OR $err=='')$pesan= "Selamat Datang Di ". get_school_name();  else $pesan= $err; 
		if (!isset($err) OR $err=='')$style="";else $style="style='background:#E5EEB3'"; 
		?>
		<h4 class="alert_info"<?php echo $style; ?>><?php echo $pesan; ?></h4>
		
		<article class="module width_full">
			<header><h3>Daftar Teman</h3></header>
			<?php
			  echo form_open(student_site_url('students'));
			  echo nbs().dropdown_kelas('kelas',$kls,$model);
			  echo nbs().dropdown_jurusan('jurusan',$jur,$model);
			  echo form_submit('submit','Cari');
			  echo form_close();
			  ?>
			<div id="students-container">
			  <?php 
			  foreach($siswa->result() as $object){
			  	$nim=$object->NIM;
			  	$foto=$object->student_photo;
			  	$name=ucwords($object->student_name);
			  	if(strlen($name) > 14){$name=substr($name,0,12).'...';}
			  	$arr_img=anchor(student_site_url('student_profiles/'.$nim),"<img src=".student_image_upload($foto,'')." width='100%' height='100%'>");
			    echo "<p class='students-main-content'>";
			  	echo "<photo class='student_image'>".$arr_img."</photo>";
			  	echo "<photo class='student_name'>".$name."</photo>";
			    echo "</p>";
			  }?>
			</div>

		</article><!--module width_full-->
		
	</section>


</body>

</html>
