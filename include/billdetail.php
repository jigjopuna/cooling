			<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;" >
					<p style="padding-left: 20px;">รหัสลูกค้า / Code : TP0<?php echo $row_order['o_id'];?><br>
					นามลูกค้า / Name : <?php echo $row_cust['cust_name']; ?><br> 
					ที่อยู่ / Address: 
					<?php 
						echo $row_cust['cust_address'].' '; 
						if($row_cust['cust_province']==102){
							echo 'แขวง'. $row_cust['tum_name'].' '.$row_cust['amp_name'].' '.$row_cust['pro_name'];
						}else{
							echo 'ตำบล'. $row_cust['tum_name'].' อำเภอ'.$row_cust['amp_name'].' จังหวัด'.$row_cust['pro_name'];
						}
						echo ' '.$row_cust['cust_zip'];					
					?>
					<br> 
					โทรศัพท์ / Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $row_cust['cust_tel']?><br>
					เลขที่ประจำตัวผู้เสียภาษี / Tax ID : <?php echo $row_cust['cust_tax']?></p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $vatdate;?><br>  					
					
					เลขที่ใบกำกับ / Order No. : 
					
					<?php 
						if($num_chkvat==1){ 
							echo '00'.$row_vat;
						} else { 
							echo 'T000'.$ord_id;
						}
				    ?><br>
					ชนิดการขาย : <br> </p>
				</div>
			</div>