<?php session_start();
	  require_once('../include/connect.php');
	  
	  $sql = "SELECT * FROM tb_machine_set WHERE set_type = 3";
	  $result = mysql_query($sql );
	  $num = mysql_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ห้องอย่างเดียว</title>
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
                    <h1 class="page-header">ราคาห้อง</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ขอใบเสนอราคาห้องอย่างเดียว
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/onlyrooms.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กว้าง</label>
											<input type="text" class="form-control" id="r_width" name="r_width" value="2.4">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว</label>
											<input type="text" class="form-control" id="r_lenght" name="r_lenght" value="4.0">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง</label>
											<input type="text" class="form-control" id="r_high" name="r_high" value="2.4">
										</div>
										
										
									</div>
									
									
									
									
									<div class="col-lg-3">
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
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
										</div>
										
									</div>
									
																		
									<div class="col-lg-3">
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
											<label class="control-label" for="inputSuccess">โชว์  VAT (จริงๆ รวมไปแล้ว)</label>
											<input type="checkbox" class="form-control" id="intvat" name="intvat">
										</div>
									</div>
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูกว้าง เมตร</label>
											<input type="text" class="form-control" id="d_width" name="d_width" value="1.0">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูสูง เมตร</label>
											<input type="text" class="form-control" id="d_high" name="d_high" value="2.0">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">พื้น</label>
											<select class="form-control" id="floor1" name="floor1">
												<option value="1">อลูมิเนียมลายกันลื่น</option>
												<option value="2">ปูน</option>
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
