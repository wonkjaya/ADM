<aside id="sidebar" class="column">
		
		<hr/>
		<h3>Content</h3>
		<ul class="toggle">
			<li class="icn_new_article"><?php echo anchor(teacher_site_url('add_student_score'),'Tambah Nilai'); ?></li>
			<li class="icn_edit_article"><?php echo anchor(teacher_site_url('viewScore'),'Lihat Nilai'); ?></li>
			<li class="icn_categories"><?php echo anchor(teacher_site_url('notifications'),'Pengumuman'); ?></li>
			<!--<li class="icn_tags"><?php echo anchor(teacher_site_url('complains'),'Lihat Komplain'); ?></li>-->
		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<li class="icn_add_user"><?php echo anchor(teacher_site_url('profile'),'My Profile'); ?></li>
			<li class="icn_view_users"><?php echo anchor(teacher_site_url('studentDatas'),'Data Siswa'); ?></li>
			<li class="icn_profile"><?php echo anchor(teacher_site_url('teacherDatas'),'Data Guru'); ?></li>
		</ul>
		<!--<h3>Media</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="#">File Manager</a></li>
			<li class="icn_photo"><a href="#">Gallery</a></li>
			<li class="icn_audio"><a href="#">Audio</a></li>
			<li class="icn_video"><a href="#">Video</a></li>
		</ul>-->
		<h3>Account</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_security"><a href="#">Security</a></li>
			<li class="icn_jump_back"><?php echo anchor(teacher_site_url('logout'),"Logout");?></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Created By <a href="http://www.code.rezstore.com" target="blank">REZCode</a></strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->
