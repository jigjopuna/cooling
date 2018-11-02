			<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:150px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;" >
					<p style="padding-left: 20px;">Code : TP0<?php echo $row_order['o_id'];?><br>
					Customer Name : <?php echo $row_cust['cust_name']; ?><br> 
					Address: 
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
					Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $row_cust['cust_tel']?><br>
					Tax ID : <?php echo $row_cust['cust_tax']?></p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:150px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;"> Date : <?php echo $vatdate;?><br>  					
					
					Order No. : 
					
					<?php 
						if($row_order['o_vat']==1){ 
							echo '000'.$cust_ordno;
						} else { 
							echo 'T000'.$ord_id;
						}
				    ?><br>
					Sell type : Cash<br> </p>
				</div>
			</div>