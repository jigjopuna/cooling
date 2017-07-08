<span>เรียน : 
						<?php 
						    //$cust_name = 2; $cust_address=3;
							if($cust_name=='' || $cust_address=='') { 
						?>		
						    <a href="register.php?r_width=<?php echo $r_width;?>&r_length=<?php echo $r_length;?>&r_height=<?php echo $r_height;?>&temparature=<?php echo $temparature;?>&temp_before=<?php echo $temp_before;?>&timeperiod=<?php echo $timeperiod;?>&qty=<?php echo $qty;?>">คลิก เพื่อกรอกชื่อ ทีอยู่</a> 
						
						<?php } else {  ?>
							<?php echo $cust_name;?>
						<?php } ?>
					</span> 
					<span><strong></strong></span><br>
					<span>ที่อยู่ :  	

					<?php /*if($row_custaddr['id']==102) {
						
						  echo $cust_address; echo '  '.$row_custaddr['tum_name']; echo '  '.$row_custaddr['amp_name']; echo '  '.$row_custaddr['pro_name']; echo '  '.$custzip;
						 
						 }else{
							
						  echo $cust_address; if($cust_name!='' && $cust_address!='') { echo '  ต.'; } echo $row_custaddr['tum_name']; if($cust_name!='' && $cust_address!='') { echo '  อ.';} echo $row_custaddr['amp_name']; if($cust_name!='' && $cust_address!='') { echo '  จ.';} echo $row_custaddr['pro_name']; echo '  '.$custzip;
						 }*/
					
					?>
					<?php ?></span><br>
					<span>โทร :  	<?php echo $cust_tel;?></span><br>
					<span>Email:  	<?php echo $cust_email;?></span>