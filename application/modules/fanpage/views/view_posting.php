        <form action="" method="post">
          <table width="100%" class="table table-hover">
            <thead>
              <tr>
                <th width="34" scope="col">No</th>
                <th width="136" scope="col">Tanggal</th>
                <th width="102" scope="col">Nama</th>
                <th width="509" scope="col">Text</th>
                <th width="129" scope="col">Url Share</th>
                <th width="171" scope="col">Image</th>
                <th width="90" scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $prefix=str_replace(' ','_',strtolower($title));
		$no=1;
		if (!isset($posting)){exit();}
		 foreach($posting->result() as $r){
			 $id=$r->ID_post;
			 $tgl=$r->date_post;
			 $pageid=$r->page_id;
			 $pagename="rezstore indonesia";
			 $message=substr($r->messages,0,40);
			 $url=substr($r->url,0,40);
			 $image=$r->image;
			 if($image != ""){
			 	$image=img(array("src"=>get_image_post($image),"width"=>"50px","height"=>"50px",'class'=>'img-rounded'));
			 }
			 
			 $status=$r->status;
			 $post="";
			 if($prefix=="facebook"){$post=anchor(get_url("post_to_fb_fanpage/".$id),"P",'class="btn btn-primary"');}
			 	elseif($prefix=="twitter"){$post=anchor(get_url("post_to_twt_fanpage/".$id),"P",'class="btn btn-primary" title="Post"');}
			 $bg="";
			 if($no%2 == 0){$bg="#B9B9B9;";}
			 if ($status==1){$bg="";$url_actions="";}else{$bg="#F4B4B4;";
			 	$url_actions=
			 	'<div class="btn-group">'.
			 	anchor(get_url('edit/'.$prefix.'/'.$id),'E','class="btn btn-default" title="Edit"').nbs(2).
	 			anchor($this->uri->uri_string()."#",'D','class="btn btn-danger" title="Delete" id="delete" onclick="delete_record(\''.$active.'\','.$id.');"')
	 			.$post.'</div>';
			 }
              echo "<tr>
		        <td width='34' style='background:$bg'>$no</td>
		        <td>".$tgl."</td>
		        <td>".$pagename."</td>
		        <td>".$message."</td>
		        <td>".$url."</td>
		        <td>".$image."</td>
		        <td width='190'>".$url_actions."</td>
              </tr>";
              $no++;
              }
              ?>
              <tr class="footer">
                <td colspan="7" align="right">
                    <a href="<?php echo get_url('insert_new_'.$prefix); ?>" class="btn btn-default">Input Data</a>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
            <script>
            	function delete_record(type,ID){
            	 if (ID !== ""){
            	 	if (confirm("hapus???") == 1){
            	 		url="<?php echo get_url('delete/"+ type +"/"+ ID +"'); ?>";
		    	 	document.location=url;
            	 	}
            	 }
            	}
            </script>
