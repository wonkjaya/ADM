<center><br>
<?php
$n=explode('-',$bulan);
$b=$n[1];
?>
<table width="60%" id="item" style='margin-bottom:20px;'>
        <tr>
             <td colspan="5"><center><?php /*echo '<form method="get">'.
             				'Bulan: '.combo_bulan($b).
             				' tahun: '.combo_tahun('2','2013').
             				form_submit('submit','filter').
             				form_close(); */?></center></td>
        </tr>
        <tr>
             <td class="td-head" colspan="5">Jurnal View</td>
        </tr>
        <tr style='text-align:center;'>
             <td class="td-kecil" colspan=2>Tanggal</td>
             <td class="td-kecil">Keterangan</td>
             <td class="td-kecil">debit</td>
             <td class="td-kecil">kredit</td>
        </tr>
<?php
foreach($query->result() as $row)
 {
    $t=$row->tanggal;
         if ($t != ''){
           $expr=explode('-',"$t");
                 $y=$expr[0];
                 $m=$expr[1];
                 $d=$expr[2];
                 $dt=$d.'-'.$m.'-'.$y;
         }else{$thn='';$t='';}?>
		        <tr>
		             <!--<td class="td-kecil">NO</td>-->
		             <td class="td-kecil" colspan=5><?php echo '<b>'.$dt.'</b>'; ?></td>
		        </tr>
     <?php 
       $jvt=$this->model_pembukuan->jurnal_view_tree($t,0);
       if ($jvt->num_rows() > 0)
        {
         $tmp_id=0;$n=1;
         $jvtres=$jvt->result();
		foreach ($jvtres as $data){
		if($tmp_id != $data->ID_jurnal){?>
		          <td class="td-kecil"><?php echo ''; ?></td>
                          <td class="td-kecil"><?php echo ''; ?></td>
                          <td class="td-kecil" style="font-style:italic; color:grey;"><?php echo ucwords($data->keterangan); ?></td>
                          <td class="td-kecil" colspan=2><?php echo anchor("pembukuan/delete_jurnal?id=".$data->ID_jurnal,"Delete"); ?></td>
<?php		}

                $tmp_id=$data->ID_jurnal;
		echo "<tr>";
		if ($data->kredit > '0'){$spasi = str_repeat(nbs(5),1);}else{$spasi = '';}
			?>
                          <td class="td-kecil"><?php echo ''; ?></td>
                          <td class="td-kecil"><?php echo ''; ?></td>
                          <td class="td-kecil"><?php echo $spasi.$data->nama_akun; ?></td>
                          <td class="td-kecil" style="text-align:right;"><?php echo number_format($data->debet); ?></td>
                          <td class="td-kecil" style="text-align:right;"><?php echo number_format($data->kredit); ?></td>
                        <?php
                echo "</tr>";
		$n++;
		}
	} else {
		echo '';
	}
 }
 
?>
			<tr style='text-align:center;'>
			     <td class="td-kecil" colspan=4></td>
			     <td class="td-kecil"><a href="<?php echo site_url('pembukuan/pembukuan/convert_jurnal/'.$bulan);?>"><button>Download PDF</button></a></td>
			</tr>
		        
		   </table>
</center>
