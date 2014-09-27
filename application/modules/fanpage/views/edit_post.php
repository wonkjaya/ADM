<?php
if (!isset($edit_post)){
	echo "Data Tidak Tersedia !!";
	exit();
}
?>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
                      <li><a href="#" class="current"><span>Dashboard</span></a></li>
           </ul>
        </div>
    </div>
<!-- TABS END -->    
</div>
<div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="dashboard"><?php echo ucfirst($title); ?> Fanpage</h1>
    </div>
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed">
        	<img src="<?php echo get_images_icon('user.gif');?>" width="16" height="16" alt="Latest Registered Users" /> 
        		Data Posting 
        </div>
	<div class="portlet-content nopadding">
	<script src="<?php echo get_js_family('jquery-1.5.2.min.js');?>"></script>
	<script src="<?php echo get_js_family('jquery-ui.js');?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_jquery_css('style.css'); ?>">
	<script>
	  $(function() {
	    $( "#date" ).datepicker({ dateFormat: 'dd-mm-yy' });
	  });
	</script>
	<style>td{ vertical-align:top;}</style>
        <?php
        
        foreach($edit_post->result() as $row){
         $id=$row->ID_post;
	 $tgl=$row->date_post;
	 	$dt=new DateTime($tgl);
	 	$tgl=date_format($dt,'d-m-Y');
	 $pageid=$row->page_id;
	 $message=substr($row->messages,0,40);
	 $url=substr($row->url,0,40);
	 $img=$row->image;
	 if($img != ""){
	 	$image=img(array("src"=>get_image_post($img),"width"=>"50px","height"=>"50px"));
	 }else{
	 	$image="";
	 }
        }
        $arr=array();
        if ($active == "f"){
		$fanpage=$this->m_fanpage->get_fb_page();
        }elseif($active == "t"){
        	$fanpage= $this->m_fanpage->get_twitter_page();
        }else{
        }
        foreach($fanpage->result() as $res){
          $arr[$res->page_id]=$res->pagename;
        }
        echo "<table style='margin-left:50px;'>";
		echo form_open_multipart();
		 echo "<tr style='border-bottom:0px solid;'>
		 	<td>Tanggal</td> <td>:</td>
		 	 <td>".input('date_post',$tgl,'id="date"')."</td>
		 	</tr>";
		 echo "<tr style='border-bottom:0px solid;'>
		 	<td>Page</td> <td>:</td>
		 	 <td>".dropdown('page_id',$arr,$pageid)."</td>
		 	</tr>";
		 echo "<tr style='border-bottom:0px solid;'>
		 	<td>Message</td> <td>:</td>
		 	 <td>".textarea('messages',$message)."</td>
		 	</tr>";
		 echo "<tr style='border-bottom:0px solid;'>
		 	<td>Url Share</td> <td>:</td>
		 	 <td>".input('url',$url)."</td>
		 	</tr>";
		 echo "<tr style='border-bottom:0px solid;'>
		 	<td colspan=2>".form_hidden('image',$img)."</td>
		 	 <td style='padding:4px;'>".$image."</td>
		 	</tr>";
		 echo "<tr style='border-bottom:0px solid;'>
		 	<td>Image</td> <td>:</td>
		 	 <td>".upload('userfile',$image)."</td>
		 	</tr>";
		 echo "<tr style='border-bottom:0px solid;text-align:right;'>
		 	 <td colspan=3>".submit('submit','Simpan')."</td>
		 	</tr>";
		echo form_close();
        echo "</table>";
        ?>
	</div>
      </div>
<!--  END #PORTLETS -->  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
  </div>
</div>
<!-- WRAPPER END -->
<!-- FOOTER START -->
<div class="container_16" id="footer">
Website Administration by <a href="../index.htm">WebGurus</a></div>
<!-- FOOTER END -->
</body>
