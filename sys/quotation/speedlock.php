<?php session_start();
	  require_once('../include/connect.php');
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
		selectcomp();
		$('#btn').click(validation);
		$('#date_pay').datepicker({dateFormat: 'yy-mm-dd'});
		$('#sizes').change(selectcomp);
		$('#ord_temp').change(selectcomp);
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust_q.php",
				minLength: 1
		});
		function selectcomp(){
			var size = $('#sizes').val();
			var ord_temp = $('#ord_temp').val();
			if(size == 1) {
				if(ord_temp >= -18){
					$('#comp').val('Copeland 3HP');
					$('#model').val('ZB 21 KQE');
					$('#comprice').val(42075);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
					
				}else{
					$('#comp').val('Bitzer 3HP');
					$('#model').val('FT-L3Y 4FES-3Y');
					$('#comprice').val(57000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
				}
				
			}else if (size == 2){
				if(ord_temp >= -18){
					$('#comp').val('Copeland 4HP');
					$('#model').val('ZB 29 KQE');
					$('#comprice').val(44000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
					
				}else{
					$('#comp').val('Bitzer 3HP');
					$('#model').val('FT-L3Y 4FES-3Y');
					$('#comprice').val(57000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
				}	
				
			}else if (size == 3){
				if(ord_temp >= -18){
					$('#comp').val('Copeland 5HP');
					$('#model').val('ZB 38 KQE');
					$('#comprice').val(52000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
					
				}else{
					$('#comp').val('Bitzer 3HP');
					$('#model').val('FT-L3Y 4FES-3Y');
					$('#comprice').val(57000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
				}	
			}else if (size == 4){
				if(ord_temp >= -18){
					$('#comp').val('Copeland 6HP');
					$('#model').val('ZB 45 KQE');
					$('#comprice').val(56000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
					
				}else{
					$('#comp').val('Bitzer 3HP');
					$('#model').val('FT-L3Y 4FES-3Y');
					$('#comprice').val(57000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
				}	
			}else if (size == 5){
				if(ord_temp >= -18){
					$('#comp').val('Copeland 6HP');
					$('#model').val('ZB 45 KQE');
					$('#comprice').val(56000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
					
				}else{
					$('#comp').val('Bitzer 3HP');
					$('#model').val('FT-L3Y 4FES-3Y');
					$('#comprice').val(57000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
				}	
			}else if (size == 6){
				if(ord_temp >= -18){
					$('#comp').val('Copeland 6HP');
					$('#model').val('ZB 45 KQE');
					$('#comprice').val(56000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
					
				}else{
					$('#comp').val('Bitzer 3HP');
					$('#model').val('FT-L3Y 4FES-3Y');
					$('#comprice').val(57000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
				}	
			}else if (size == 7){
				if(ord_temp >= -18){
					$('#comp').val('Copeland 6HP');
					$('#model').val('ZB 45 KQE');
					$('#comprice').val(56000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
					
				}else{
					$('#comp').val('Bitzer 3HP');
					$('#model').val('FT-L3Y 4FES-3Y');
					$('#comprice').val(57000);
					$('#coilyen').val('ALFA BLEH252A7');
					$('#coilyenprice').val(35000);
				}	
			}	
		}
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var ord_temp = $('#ord_temp').val();
			var ship_cost = $('#ship_cost').val();
			var voltage = $('#voltage').val();
			var sizes = $('#sizes').val(); 
			
			var ord_price = $('#ord_price').val();
			
			if(search_custname==''){
				alert("ใส่ชื่อลูกค้าด้วยนะคะ"); 
				return false;
			}else if((ord_temp=='') ||isNaN(ord_temp)){
				alert("ใส่อุณหภูมิเป็นตัวเลขด้วยนะค่ะ"); 
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
			if($ro_order!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูออเดอร์นะคะ'); window.location = '../index.php';</script>");}
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ขอใบเสนอราคา Speed Lock</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ขอใบเสนอราคา Speed Lock
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/speedlock.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ </label>
											<input type="text" class="form-control" id="ord_temp" name="ord_temp" value="-18">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ขนาดห้อง</label>
											<select class="form-control" id="sizes" name="sizes">
												<option value="1">2.4 x 2.4 x 2.4</option> 
												<option value="2">2.4 x 3.6 x 2.4</option> 
												<option value="3">2.4 x 4.8 x 2.4</option> 
												<option value="4">2.4 x 6.0 x 2.4</option> 
												<option value="5">3.6 x 3.6 x 2.4</option> 
												<option value="6">3.6 x 4.8 x 2.4</option> 
												<option value="7">3.6 x 6.0 x 2.4</option> 
											</select>
										</div>
		
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอมเพรสเซอร์</label>
											<input type="text" class="form-control" id="comp" name="comp">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาคอมเพรสเซอร์</label>
											<input type="text" class="form-control" id="comprice" name="comprice">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอม 220/380</label>
											<select class="form-control" id="voltage" name="voltage">
												<option value="380">380</option>
												<option value="220">220</option>
											</select>
										</div>	
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โมเดล</label>
											<input type="text" class="form-control" id="model" name="model">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอล์ยเย็น </label>
											<input type="text" class="form-control" id="coilyen" name="coilyen">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาคอล์ยเย็น </label>
											<input type="text" class="form-control" id="coilyenprice" name="coilyenprice">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ออก VAT</label>
											<input type="checkbox" class="form-control" id="ord_vat" name="ord_vat" checked>
										</div>

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
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าขนส่ง </label>
											<input type="text" class="form-control" id="ship_cost" name="ship_cost" value="6000">
										</div>
										
									</div>

									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
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
