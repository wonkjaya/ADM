<script src="<?php echo tinymce_url('tinymce.min.js');?>"></script>	<script>		 tinymce.init({selector:'textarea'});	</script>		<section id="main" class="column">				<h4 class="alert_info">Selamat Datang Di <?php echo get_school_name(); ?></h4>			<article class="module width_full">		<header><h3 style="width:200px;"> View Messages</h3>		<ul class="tabs">	   			<li><a href="#tab1">Compose</a></li>			</ul>		</header>		<div class="module_content">			<article class="stats_graph">		<div class="tab_container">				<div id="tab1" class="tab_content">				<?php 				$link=admin_site_url('send_message');				if(!isset($username))$username="";				echo form_open($link);?>				<table class="tablesorter" cellspacing="0">				<tr> 				 <td>Tujuan</td> <td><?php echo form_input('userTo',$username,'maxlength="'.strlen($username).'"'); ?></td>				</tr>				<tr> 				 <td>Content</td> <td><?php echo form_textarea('content'); ?></td>				</tr>				<tr> 				 <td></td> <td><?php echo form_submit('submit','Kirim'); ?></td>				</tr>				</table>				<?php echo form_close(); ?>				</div><!-- end of #tab1 -->			    </div><!-- end of .tab_container -->			</article><!-- end of stats article -->					<div class="clear"></div>		</div>	</article><!--module width_full-->			</section></body></html>