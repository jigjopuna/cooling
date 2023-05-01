<?php session_start();
	  require_once('../include/connect.php');
	  
	  $sql = "SELECT * FROM tb_machine_set WHERE set_type = 3 ORDER BY set_id DESC";
	  $result = mysql_query($sql );
	  $num = mysql_num_rows($result);
	  
	  $sql_sale = "SELECT e.e_id, e.e_name, e.e_tel FROM tb_emp e JOIN tb_role r  ON e.e_id = r.ro_emp_id WHERE r.ro_quotation != 0 AND e_publish = 1"; 
	  $result_sale = mysql_query($sql_sale); 
	  $num_sale = mysql_num_rows($result_sale);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Air Blast</title>
<?php 
	require_once ('../include/header.php');
	require_once('../include/metatagsys.php');
	$dates = date('Y-m-d');
?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('#btn').click(validation);
		$('#date_pay').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust_q.php",
				minLength: 1
		});
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var ord_temp = $('#ord_temp').val();
			var ship_cost = $('#ship_cost').val();
			var voltage = $('#voltage').val();
			var sizes = $('#sizes').val(); 
			var prods = $('#prods').val();
			
			var ord_price = $('#ord_price').val();
			
			if(search_custname==''){
				alert("ใส่ชื่อลูกค้าด้วยนะคะ"); 
				return false;
			}else if((ord_temp=='') ||isNaN(ord_temp)){
				alert("ใส่อุณหภูมิเป็นตัวเลขด้วยนะค่ะ"); 
				return false;				
			}else if(prods==''){
				alert("ใส่สินค้าด้วยนะคะ"); 
				return false;
			}else{
				$('#form1').submit();				
			}
		}		
	});

</script>
</head>
<body>
    <div id="wrapper">
		<?php 
			require_once('../include/inc_role.php'); 
			require_once ('../include/navproduct.php');
			if($ro_order!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูออเดอร์นะคะ'); window.location = '../index.php';</script>");}
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ขอใบเสนอราคา Blast Freeze</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ขอใบเสนอราคา Blast Freeze
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/blast.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname" value="6">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กว้าง</label>
											<input type="text" class="form-control" id="r_width" name="r_width" value="4.00">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว</label>
											<input type="text" class="form-control" id="r_lenght" name="r_lenght" value="6.00">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง</label>
											<input type="text" class="form-control" id="r_high" name="r_high" value="4.00">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สินค้า (เช่น หมู ปลา ทุเรียน)</label> 
											<input type="text" class="form-control" id="prods" name="prods" value="อาหาร"> 
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ปริมาณสินค้าเข้าต่อรอบ (kg)</label>
											<input type="text" class="form-control" id="qtyperday" name="qtyperday" value="1000">
										</div>
									</div>
									
									
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โฟม</label>
											<select class="form-control" id="foam" name="foam">
												<option value="1" selected>PU</option>
												<option value="2">PS</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โฟมกี่นิ้ว</label>
											<select class="form-control" id="foaminch" name="foaminch">
												<option value="5">5</option>
												<option value="6" selected >6</option>
												<option value="8">8</option>
												<option value="10">10</option>
												<option value="12">12</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลือกขนาดแรงม้า</label>
											<select class="form-control" id="mach" name="mach">
												<?php
													for($i=1; $i <= $num; $i++){
														$row = mysql_fetch_array($result);
												?>
												<option value="<?php echo $row['set_id']?>"><?php echo $row['set_name']?></option>
												<?php } ?>
											</select>
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ระยะเวลาลดอุณหภูมิ (ชม.)</label>
											<input type="text" class="form-control" id="hours" name="hours" value="6"> 
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ <strong><u>ก่อนเข้า</u></strong> ห้องเย็น (องศา)</label>
											<input type="text" class="form-control" id="tempbefore" name="tempbefore" value="20">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หัวบิลบริษัท</label><br>
											<input type="radio" value="1" name="corp" checked> CPN
											<input type="radio" value="2" name="corp" style="margin-left:50px;" >  CHK
										</div>
										
									</div>
									
																		
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ </label>
											<input type="text" class="form-control" id="ord_temp" name="ord_temp" value="-40">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าขนส่ง </label>
											<input type="text" class="form-control" id="ship_cost" name="ship_cost" value="8000">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตู</label>
											<select class="form-control" id="doortype" name="doortype">
												<option value="1">บานสวิง</option>
												<option value="2">บานเลื่อน</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กำไร % </label>
											<input type="text" class="form-control" id="percent" name="percent" value="40">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">พนักงานขาย</label>
											<select class="form-control" id="sale_id" name="sale_id">
												<?php for($i=1; $i<=$num_sale; $i++) { 
													$row_sale = mysql_fetch_array($result_sale);
												?>
													<option value="<?php echo $row_sale['e_id']?>" <?php if($e_id==$row_sale['e_id']){ ?> selected <?php } ?> >
														<?php echo $row_sale['e_name']?>
													</option>
											
												<?php } ?>
											</select>
										</div>
									</div>
									
									<!--<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โชว์  VAT (จริงๆ รวมไปแล้ว)</label>
											<input type="checkbox" class="form-control" id="intvat" name="intvat">
									</div>-->
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูกว้าง เมตร</label>
											<input type="text" class="form-control" id="d_width" name="d_width" value="1.5">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูสูง เมตร</label>
											<input type="text" class="form-control" id="d_high" name="d_high" value="2.0">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">พื้น</label>
											<select class="form-control" id="floor1" name="floor1">
												<option value="1">อลูมิเนียมลายกันลื่น</option>
												<option value="2" selected>ปูน</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ส่วนลด</label>
											<input type="text" class="form-control" id="discount" name="discount" value="10000">
										</div>
										
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ขอใบเสนอราคา</button>
										</div>
										
									</div>
									
								</form>
							 </div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
