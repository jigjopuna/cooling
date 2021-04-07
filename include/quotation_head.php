
	<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<span>ชื่อลูกค้า : <?php echo $cust_name; ?></span> <br>
					<span>
						ที่อยู่ :   
						<?php 
							echo $row['qcust_addr']; 
							if($cust_province > 90){
								if($cust_province==102){
									echo '<br>แขวง'. $row['tum_name'].' '.$row['amp_name'].' '.$row['pro_name'];
									
								}else{
									echo '<br>ตำบล'. $row['tum_name'].' อำเภอ'.$row['amp_name'].' จังหวัด'.$row['pro_name'];
									
								}
								echo ' '.$row['cust_zip'];
							}
							
						?> 
						
					
					</span><br>
					<span>โทร :  <?php echo $row['qcust_tel']; ?> </span><br>
					<span>หมายเลขประจำตัวผู้เสียภาษี :  <?php echo $row['qcust_tax']; ?> </span><br>
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span class="intopic" style="font-size:18px;"><strong>Quotation ใบเสนอราคา</strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ผู้ขาย :  <?php echo $sale_name.' '.$sale_lname; ?> </span><br>
					<span>โทร :  <?php echo $sale_tel;?> </span><br>
					<span>Email: <?php echo $sale_email;?> </span>
				</div><!--end oweneraddress-->
			</div><!--end contect_detail-->
