  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">  <script src="//code.jquery.com/jquery-1.10.2.js"></script>    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script> <script>  $(function() {    var availableTags = [          ];    $( "#autocomplete" ).autocomplete({      //source: availableTags      source: ["search.php"]//availableTags//"<?php array('rohman','ewrwe','assds');?>"    });  });  </script><?phpif(isset($action)){ foreach($nilai->result() as $r){	$ID_test=$r->ID_test;	$nim=$r->NIM;	$kelas=$r->class; $scode=$r->subject_code;	$u1=$r->u1;	$u2=$r->u2;	$u3=$r->u3;	$u4=$r->u4;	$u5=$r->u5;	$u6=$r->u6;	$u7=$r->u7;	$u8=$r->u8;	$u9=$r->u9;	$u10=$r->u10;	$ms1=$r->mid_semester1;	$s1=$r->semester1;	$ms2=$r->mid_semester2;	$s2=$r->semester2;	$action1=teacher_site_url('update_score/ulangan_harian','id='.$ID_test.'&nim='.$nim);	$action2=teacher_site_url('update_score/ulangan_smtr','id='.$ID_test.'&nim='.$nim); }}else{	$ID_test="";	$nim="";	$kelas=""; $scode="";	$u1="";	$u2="";	$u3="";	$u4="";	$u5="";	$u6="";	$u7="";	$u8="";	$u9="";	$u10="";	$ms1="";	$s1="";	$ms2="";	$s2="";	$action1=teacher_site_url('insert_new_score/ulangan_harian');	$action2=teacher_site_url('update_smtr');}?>	<section id="main" class="column">		<?php		if($error == '') {			$pesan="Selamat Datang Di Smk 03 Pancasila Ambulu";			$class='alert_info';		}else{			$pesan=$error;			$class='alert_error';		}		?>		<h4 class="<?php echo $class; ?>"><?php echo $pesan; ?></h4>				<article class="module width_full">			<header><h3 style="width:200px;">Input Nilai Siswa</h3>			<ul class="tabs">		   			<li><a href="#tab1">Harian</a></li>		    		<li><a href="#tab2">Semester</a></li>				</ul>			</header>			<div class="module_content">				<article class="stats_graph">			<div class="tab_container">				<div id="tab1" class="tab_content">					<table class="tablesorter" cellspacing="0"> 					<tbody> <?php echo form_open($action1); ?>			<tr> 			<td width="100px">NIM</td><td width="20"><?php echo auto_input('nim',$nim,'id="auto"'); ?></td>			<td width="20px"></td>			<td width="100px">Kelas</td><td width="20px"><?php echo dropdown_class('kelas',$kelas,$model); ?></td>			</tr> 			<tr> 			<td>Pelajaran</td><td><?php echo $subject_name[0]; ?></td>			<td></td>			<td>Ujian 2</td><td><?php echo input_number('u2',$u2); ?></td>			</tr> 			<tr> 			<td>Ujian 1</td><td><?php echo input_number('u1',$u1); ?></td>			<td></td>			<td>Ujian 4</td><td><?php echo input_number('u4',$u4); ?></td>			</tr>			<tr> 			<td>Ujian 3</td><td><?php echo input_number('u3',$u3); ?></td>			<td></td>			<td>Ujian 6</td><td><?php echo input_number('u6',$u6); ?></td>			</tr>			<tr> 			<td>Ujian 5</td><td><?php echo input_number('u5',$u5); ?></td>			<td></td>			<td>Ujian 8</td><td><?php echo input_number('u8',$u8); ?></td>			</tr>			<tr> 			<td>Ujian 7</td><td><?php echo input_number('u7',$u7); ?></td>			<td></td>			<td>Ujian 10</td><td><?php echo input_number('u10',$u10); ?></td>			</tr>			<tr> 			<td>Ujian 9</td><td colspan=5><?php echo input_number('u9',$u9); ?></td>			</tr>						<tr> 		    				<td colspan="7"><?php echo form_submit('submit','Simpan').form_reset('reset','Kosongkan').form_close().form_button('button','Cancel'); ?></td>						</tr>						 					</tbody> 					</table>					</div><!-- end of #tab1 -->						<div id="tab2" class="tab_content">					<table class="tablesorter" cellspacing="0"> 					<tbody> 						<tr> <?php echo form_open($action2); ?>		    				<td width="100px">NIM</td><td width="20">:</td> <td><?php echo text_input('nim',$nim); ?></td>		    				<td width="20px"></td>		    				<td width="100px">Kelas</td><td width="20px">:</td><td><?php echo dropdown_class('kelas',$kelas,$model); ?></td>						</tr> 						<tr> 		    				<td>MID Semester 1</td><td>:</td> <td><?php echo input_number('msmtr1',$ms1); ?></td>		    				<td></td>		    				<td>Semester 1</td><td>:</td><td><?php echo input_number('smtr1',$s1); ?></td>						</tr> 						<tr> 		    				<td>MID Semester 2</td><td>:</td> <td><?php echo input_number('msmtr2',$ms2); ?></td>		    				<td></td>		    				<td>Semester 2</td><td>:</td><td><?php echo input_number('smtr2',$s2); ?></td>						</tr>						<tr> 		    				<td colspan="7"><?php echo form_submit('submit','Simpan').form_reset('reset','Kosongkan').form_close().form_button('button','Cancel'); ?></td>						</tr>					</tbody> 					</table>				</div><!-- end of #tab2 -->				    </div><!-- end of .tab_container -->				</article><!-- end of stats article -->						<div class="clear"></div>			</div>		</article><!--module width_full-->	</section></body></html>