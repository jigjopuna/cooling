<?php session_start();
	  require_once('../include/connect.php');
	  
	  $sql_com = "SELECT * FROM tb_com_brand"; $result_com = mysql_query($sql_com); $num_com = mysql_num_rows($result_com);
	  $sql_coil = "SELECT * FROM tb_cooling_brand"; $result_coil = mysql_query($sql_coil); $num_coil = mysql_num_rows($result_coil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
			var hp = $('#hp').val();
			var voltage = $('#voltage').val();
			var r_width = $('#r_width').val(); 
			var r_lenght = $('#r_lenght').val();
			var r_high = $('#r_high').val();
			var ord_color = $('#ord_color').val(); 
			
			var ord_price = $('#ord_price').val();
			if((search_custname=='') || (voltage==0) || (r_width==0) || (r_lenght==0)){
				alert("ใส่ข้อมูลให้ครบและถูกต้องนะค่ะ"); 
				return false;
			}else if((ord_price==0) || (isNaN(ord_price))){
				alert("ใส่ราคาขายให้ถูกต้องด้วยนะค่ะ"); 
				return false;				
			}else if((ord_temp=='') ||isNaN(ord_temp)){
				alert("ใส่อุณหภูมิเป็นตัวเลขด้วยนะค่ะ"); 
				return false;				
			}
			else if((hp=='') ||isNaN(hp)){
				alert("ใส่แรงม้าด้วยค่ะ"); 
				return false;				
			}
			else{
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
			//if($ro_order!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูออเดอร์นะคะ'); window.location = '../index.php';</script>");}
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ขอใบเสนอราคา ห้องสำเร็จ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ขอใบเสนอราคา ห้องสำเร็จ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/quotations.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทห้อง</label>
											<select class="form-control" id="r_type" name="r_type">
												<option value="2">ห้องมือสอง</option> 
												<option value="1">ห้องใหม่</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ </label>
											<input type="text" class="form-control" id="ord_temp" name="ord_temp" value="-16">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอม 220/380</label>
											<select class="form-control" id="voltage" name="voltage">
												<option value="380">380</option>
												<option value="220">220</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สินค้า (เช่น หมู ปลา ทุเรียน)</label> 
											<input type="text" class="form-control" id="prods" name="prods" value="" placeholder="หมู"> 
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ปริมาณสินค้าเข้าต่อวัน (kg)</label>
											<input type="text" class="form-control" id="qtyperday" name="qtyperday" value="500">
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ปริมาณเต็มความจุ (ตัน)</label>
											<input type="text" class="form-control" id="maxqty" name="maxqty" value="4">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ระยะเวลาลดอุณหภูมิ (ชม.)</label>
											<input type="text" class="form-control" id="hours" name="hours" value="18">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กว้าง </label>
											<input type="text" class="form-control" id="r_width" name="r_width" value="2.40">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว </label>
											<input type="text" class="form-control" id="r_lenght" name="r_lenght" value="6.00">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง </label>
											<input type="text" class="form-control" id="r_high" name="r_high" value="2.30">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โฟม</label>
											<select class="form-control" id="foam" name="foam">
												<option value="1">PU</option>
												<option value="2">PS</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โฟมกี่นิ้ว</label>
											<select class="form-control" id="foaminch" name="foaminch">
												<option value="4">4</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สี</label>
											<input type="text" class="form-control" id="ord_color" name="ord_color" value="สีฟ้ามาตราฐาน">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ <strong><u>ก่อนเข้า</u></strong> ห้องเย็น (องศา)</label>
											<input type="text" class="form-control" id="tempbefore" name="tempbefore" value="5">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ออก VAT</label>
											<input type="checkbox" class="form-control" id="ord_vat" name="ord_vat" checked
											>
										</div>
										
										<!--<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="ord_qty" name="ord_qty" value="1">
										</div>-->
									</div>
									
																		
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ของแถม</label>
											<input type="text" class="form-control" id="gift" name="gift">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รายการเพิ่มเติม</label>
											<input type="text" class="form-control" id="additional" name="additional">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคา รายการเพิ่มเติม</label>
											<input type="text" class="form-control" id="additional_price" name="additional_price">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลือกขนาดแรงม้า HP</label>
											<input type="text" class="form-control" id="hp" name="hp" value="3">
										</div>
										

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอมเพรสเซอร์</label>
											<select class="form-control" id="comp_name" name="comp_name">
											<?php for($i=1; $i<=$num_com; $i++) { 
												$row_com = mysql_fetch_array($result_com);
											?>
												<option value="<?php echo $row_com['comp_id']?>"><?php echo $row_com['com_brand']?></option>
											
											<?php } ?>
											</select>
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอยล์เย็น</label>
											<select class="form-control" id="coil_name" name="coil_name">
											<?php for($i=1; $i<=$num_coil; $i++) { 
												$row_coil = mysql_fetch_array($result_coil);
											?>
												<option value="<?php echo $row_coil['cool_id']?>"><?php echo $row_coil['cool_brand']?></option>
											
											<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รุ่นคอมเพรสเซอร์</label>
											<input type="text" class="form-control" id="comp_model" name="comp_model" placeholder="4PE-12">
										</div>
										
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาขาย</label>
											<input type="text" class="form-control" id="ord_price" name="ord_price">
										</div>
									</div>

									
									
									<div class="col-lg-3">
										<!--<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ตำแหน่งคอล์ยร้อน</label>
											<select class="form-control" id="ord_coilh" name="ord_coilh">
												<option value="4">ด้านหลัง</option> 
												<option value="2">ด้านข้างซ้าย</option>
												<option value="3">ด้านข้างขวา</option>
												<option value="5">ด้านบน</option>	
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ตำแหน่งประตู</label>
											<select class="form-control" id="ord_door" name="ord_door">
												<option value="1">ด้านหน้า</option> 
												<option value="2">ด้านข้างซ้าย</option>
												<option value="3">ด้านข้างขวา</option>	
											</select>
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ตำแหน่งแผงไฟ</label>
											<select class="form-control" id="ord_control" name="ord_control">
												<option value="1">ด้านหน้า</option> 
												<option value="2">ด้านข้างซ้าย</option>
												<option value="3">ด้านข้างขวา</option>	
											</select>
										</div>-->
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตู</label>
											<select class="form-control" id="doortype" name="doortype">
												<option value="1">บานสวิง</option>
												<option value="2">บานเลื่อน</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูกว้าง เมตร</label>
											<input type="text" class="form-control" id="d_width" name="d_width" value="1.0">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูสูง เมตร</label>
											<input type="text" class="form-control" id="d_high" name="d_high" value="2.0">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กำไร % </label>
											<input type="text" class="form-control" id="percent" name="percent" value="40">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบ็ดเตล็ด</label>
											<input type="text" class="form-control" id="bedtaled" name="bedtaled" value="43000">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าขนส่ง </label>
											<input type="text" class="form-control" id="ship_cost" name="ship_cost" value="6000">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าแรง</label>
											<input type="text" class="form-control" id="labors" name="labors" value="40000">
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
