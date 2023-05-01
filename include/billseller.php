			<div id="contact" style="/*background-color:pink;*/ margin-top:20px; overflow:hidden;">
				<div id="contact" style="/*background-color:orange;*/ height:120px; float:left; width: 55%; border: 1px dashed black;  border-radius: 10px;" >
					<p style="padding-left: 20px;">รหัสร้านค้า/ Code : <br>
					ร้านค้า / Name : <?php echo $row_cust['cust_name']; ?><br> 
					ที่อยู่ / Address: 
					
					<br> 
					โทรศัพท์ / Tel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $row_cust['cust_tel']?><br>
					เลขที่ประจำตัวผู้เสียภาษี / Tax ID : <?php echo $row_cust['cust_tax']?></p>
				</div>
				<div id="docs" style="/*background-color:red;*/ height:120px; float:left; width: 40%; border: 1px dashed black;  border-radius: 10px; margin-left:10px;">
					<p style="padding-left: 20px;">วันที่ / Date : <?php echo $vatdate;?><br>  					
					
					เลขที่ /  No. : 
					
					<br>
					 </p>
				</div>
			</div>