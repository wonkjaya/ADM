<script> function del(ID,NIM){   var c=confirm("hapus??");   var url="<?php echo admin_site_url('delete_score','id="+ ID +"&NIM="+ NIM +"'); ?>";	if (c==true){	 window.location=url;	} }</script>	<section id="main" class="column">				<h4 class="alert_info">Selamat Datang Di <?php echo get_school_name(); ?></h4>				<article class="module width_full">			<header><h3 style="width:200px;">Daftar Nilai Siswa</h3>			<ul class="tabs">	   			<li><a href="#tab1">Harian</a></li>	    			<li><a href="#tab2">Semester</a></li>	    			<li><a href="#tab3">Pending</a></li>			</ul>			</header>			<div class="module_content">				<article class="stats_graph">					<header><h3 class="tabs_involved" style="width:76%;">						<?php echo form_open();							echo text_input('NIM',$nim,'style="width:100px;" placeholder="NIM"');							echo dropdown_class_filter('kelas',$kelas,$model);							echo dropdown_subject_filter('subject',$subject,$model);							echo form_submit(array('name'=>'submit','value'=>'Cari','style'=>'padding:5px;'));							echo form_close(); ?></h3></header>			<div class="tab_container">				<div id="tab1" class="tab_content">					<table class="tablesorter" cellspacing="0"> 					<thead> 						<tr> 		   				<th>NIM</th> 		   				<th width="40">Kelas</th>		    				<th>Nama-Pelajaran</th> 		    				<th>UH-1</th> 		    				<th>UH-2</th>		    				<th>UH-3</th>		    				<th>UH-4</th>		    				<th>UH-5</th>		    				<th>UH-6</th>		    				<th>UH-7</th>		    				<th>UH-8</th>		    				<th>UH-9</th>		    				<th>UH-10</th>		    				<th>RR</th>		    				<th colspan=2></th>						</tr> 					</thead> 					<tbody> 				<?php									foreach($nilai->result() as $row){										echo "<tr> ";						echo "<td >".$row->NIM."</td>";						echo "<td >".ucwords($row->class)."</td>";						echo "<td >".$row->subject_name."</td>";				  if($row->u1 < 60){$bg="red";}elseif($row->u1>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u1."</td>";				  if($row->u2 < 60){$bg="red";}elseif($row->u2>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u2."</td>";				  if($row->u3 < 60){$bg="red";}elseif($row->u3>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u3."</td>";				  if($row->u4 < 60){$bg="red";}elseif($row->u4>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u4."</td>";				  if($row->u5 < 60){$bg="red";}elseif($row->u5>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u5."</td>";				  if($row->u6 < 60){$bg="red";}elseif($row->u6>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u6."</td>";				  if($row->u7 < 60){$bg="red";}elseif($row->u7>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u7."</td>";				  if($row->u8 < 60){$bg="red";}elseif($row->u8>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u8."</td>";				  if($row->u9 < 60){$bg="red";}elseif($row->u9>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u9."</td>";				   if($row->u10 < 60){$bg="red";}elseif($row->u10>100){$bg="yellow";}else {$bg="";}						echo "<td bgcolor=$bg>".$row->u10."</td>";						echo "<td>". ($row->u1 + $row->u2 + $row->u3 + $row->u4 + $row->u5 + $row->u6 + $row->u7 + $row->u8 + $row->u9 + 10)/10 ."</td>";						echo "<td>". 							anchor(admin_site_url('edit_score','id='.$row->ID_test.'&NIM='.$row->NIM),"<div class='edit-button' title='Edit this'></div>"). 						"</td> 						<td>". 							"<div class='delete-button' onclick=del('$row->ID_test','$row->NIM'); title='Delete this'></div>". 						"</td>";						echo "</tr> ";					}					?>											</tbody> 					</table>				</div><!-- end of #tab1 -->					<div id="tab2" class="tab_content">					<table class="tablesorter" cellspacing="0"> 					<thead> 						<tr> 		   				<th width="40">NIM</th> 		    				<th width="40">Kelas</th>  		    				<th>Nama-Pelajaran</th>		    				<th>Mid-Semester 1</th> 		    				<th>Semester-1</th>		    				<th>Mid-Semester 2</th> 		    				<th>Semester-2</th>		    				<th>RR</th>						</tr> 					</thead> 					<tbody>					<?php					foreach($nilai->result() as $row){						$bg="";				 						echo "<tr> ";						echo "<td bgcolor=$bg>".$row->NIM."</td>";		    				echo "<td bgcolor=$bg>".ucwords($row->class)."</td>";		    				echo "<td bgcolor=$bg>".$row->subject_name."</td>";		    			if($row->mid_semester1 < 60){$bg="red";}elseif($row->mid_semester1 >100){$bg="yellow";}else {$bg="";}		    				echo "<td bgcolor=$bg>".$row->mid_semester1."</td>";	    				if($row->semester1 < 60){$bg="red";}elseif($row->semester1 >100){$bg="yellow";}else {$bg="";}		    				echo "<td bgcolor=$bg>".$row->semester1."</td>";		    			if($row->mid_semester2 < 60){$bg="red";}elseif($row->mid_semester2 >100){$bg="yellow";}else {$bg="";}		    				echo "<td bgcolor=$bg>".$row->mid_semester2."</td>";		    			if($row->semester2 < 60){$bg="red";}elseif($row->semester2>100){$bg="yellow";}else {$bg="";}		    				echo "<td bgcolor=$bg>".$row->semester2."</td>";		    				echo "<td> </td>";		    				echo "<td>". 							anchor(admin_site_url('edit_score','id='.$row->ID_test.'&NIM='.$row->NIM),"<div class='edit-button' title='Edit this'></div>"). 						"</td> 						<td>". 							"<div class='delete-button' onclick=delete_score('$row->ID_test','$row->NIM'); title='Delete this'></div>". 						"</td>";						echo "</tr> ";												}					?>					</tbody> 					</table>				</div><!-- end of #tab2 -->				<div id="tab3" class="tab_content">					<table class="tablesorter" cellspacing="0"> 					<thead> 						<tr> 		   				<th width="40">NIM</th> 		    				<th width="10">Kelas</th>  		    				<th>Nama-Pelajaran</th>		    				<th>UH-1</th> 		    				<th>UH-2</th>		    				<th>UH-3</th>		    				<th>UH-4</th>		    				<th>UH-5</th>		    				<th>UH-6</th>		    				<th>UH-7</th>		    				<th>UH-8</th>		    				<th>UH-9</th>		    				<th>UH-10</th>		    				<th>MidSmtr-1</th> 		    				<th>Smtr-1</th>		    				<th>MidSmtr-2</th> 		    				<th>Smtr-2</th>		    				<th></th>						</tr> 					</thead> 					<tbody>					<?php					echo form_open();					foreach($pending->result() as $row){						$bg="";							echo "<tr> ";						echo "<td bgcolor=$bg>".$row->NIM."</td>";		    				echo "<td bgcolor=$bg>".ucwords($row->class)."</td>";		    				echo "<td bgcolor=$bg>".$row->subject_name."</td>";			    			if($row->u1 < 60){$bg="red";}elseif($row->u1>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u1."</td>";						if($row->u2 < 60){$bg="red";}elseif($row->u2>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u2."</td>";						if($row->u3 < 60){$bg="red";}elseif($row->u3>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u3."</td>";						if($row->u4 < 60){$bg="red";}elseif($row->u4>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u4."</td>";						if($row->u5 < 60){$bg="red";}elseif($row->u5>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u5."</td>";						if($row->u6 < 60){$bg="red";}elseif($row->u6>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u6."</td>";						if($row->u7 < 60){$bg="red";}elseif($row->u7>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u7."</td>";						if($row->u8 < 60){$bg="red";}elseif($row->u8>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u8."</td>";						if($row->u9 < 60){$bg="red";}elseif($row->u9>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u9."</td>";						if($row->u10 < 60){$bg="red";}elseif($row->u10>100){$bg="yellow";}else {$bg="";}							echo "<td bgcolor=$bg>".$row->u10."</td>";			    			if($row->mid_semester1 < 60){$bg="red";}elseif($row->mid_semester1 >100){$bg="yellow";}else {$bg="";}			    				echo "<td bgcolor=$bg>".$row->mid_semester1."</td>";		    				if($row->semester1 < 60){$bg="red";}elseif($row->semester1 >100){$bg="yellow";}else {$bg="";}			    				echo "<td bgcolor=$bg>".$row->semester1."</td>";			    			if($row->mid_semester2 < 60){$bg="red";}elseif($row->mid_semester2 >100){$bg="yellow";}else {$bg="";}			    				echo "<td bgcolor=$bg>".$row->mid_semester2."</td>";			    			if($row->semester2 < 60){$bg="red";}elseif($row->semester2>100){$bg="yellow";}else {$bg="";}			    				echo "<td bgcolor=$bg>".$row->semester2."</td>";		    				echo "<td>".form_checkbox('selected[]', $row->ID_test)."</td>";						echo "</tr> ";						}						$option=array('1'=>'Publish','2'=>'Hapus');						echo "<tr>							<td>".form_dropdown('action',$option,'class="set_action"')."</td>							<td>".form_submit('submit','Lakukan')."</td>						      </tr>";					echo form_close();					?>					</tbody> 					</table>				</div><!-- end of #tab2 -->				    </div><!-- end of .tab_container -->				</article><!-- end of stats article -->						<div class="clear"></div>			</div>		</article><!--module width_full-->	</section></body></html>