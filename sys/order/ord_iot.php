<?php session_start();
	  require_once('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
	<?php 
		$dates = date('Y-m-d');
		
		
		$sql_cusprod = "SELECT * FROM tb_cus_prod_type";
		$result_cusprod = mysql_query($sql_cusprod);
		$num_cusprod = mysql_num_rows($result_cusprod);
		
		$sql_ordtype = "SELECT * FROM tb_ord_type WHERE ort_type LIKE '1%' ORDER BY ort_name DESC";
		$result_ordtype = mysql_query($sql_ordtype);
		$num_ordtype = mysql_num_rows($result_ordtype);
		
	?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		$('#date_pay, #date_delivery').datepicker({dateFormat: 'yy-mm-dd'});
		$("#ord_prov").load("../../ajax/province_server.php");
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var payinqty = $('#payinqty').val();
			var paydate = $('#paydate').val(); 
			var date_delivery = $('#date_delivery').val();
			var cusprod = $('#cusprod').val();
			var ord_price = $('#ord_price').val();
			var ord_type = $('#ord_type').val();
			var ord_prov = $('#ord_prov').val();
			
			
			if((search_custname=='') || (payinqty=='') || (paydate=='') || (date_delivery='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
				return false;
			}else if(ord_prov < 1){
				alert("เลือกจังหวัดหน้างานด้วยนะคะ"); 
				return false;
			}else if(cusprod==0){
				alert("ใส่ประเภทสินค้าด้วยนะค่ะ"); 
				return false;
			}else if(ord_type==0){
				alert("เลือกประเภทห้องเย็นด้วยนะคะ"); 
				return false;
			}else if(ord_price < 1){
				alert("ใส่ราขายด้วยนะคะ"); 
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
                    <h1 class="page-header">เพิ่มออเดอร์ IoT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มออเดอร์ IoT
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/add_ord_iot.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
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
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จังหวัดหน้างาน</label>
											<select class="form-control" id="ord_prov" name="ord_prov">
												<option value="1">เลือกจังหวัด</option> 
											</select>
										</div>
										
										
									</div>
									
									
									<div class="col-lg-3">
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กว้าง </label>
											<input type="text" class="form-control" id="ord_width" name="ord_width" value="2.4">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว </label>
											<input type="text" class="form-control" id="ord_size" name="ord_size" value="3.0">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง </label>
											<input type="text" class="form-control" id="ord_high" name="ord_high" value="2.4">
										</div>
										
										
										
										
										
										
										
									</div>
																		
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ใบเสนอราคา</label>
											<input type="file" class="form-control require" id="ord_quotation" name="ord_quotation">
										</div>
										
										
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทสินค้าที่เก็บ</label>
											<select class="form-control" id="cusprod" name="cusprod">
												<option value="0">เลือกประเภทสินค้า</option> 
												<?php 
													for($i=1; $i<=$num_cusprod; $i++) { 
														$row_cusprod = mysql_fetch_array($result_cusprod);
												?>
													<option value="<?php echo $row_cusprod['cusp_id']; ?>"><?php echo $row_cusprod['cusp_name'];?></option>
												
												<?php } ?>
												
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สินค้าที่เก็บ</label>
											<input type="text" class="form-control" id="cusproduct" name="cusproduct">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาขาย</label>
											<input type="text" class="form-control" id="ord_price" name="ord_price" value="51360">
										</div>
									</div>
									
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กำหนดส่ง</label>
											<input type="text" class="form-control" id="date_delivery" name="date_delivery">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอม 220/380</label>
											<select class="form-control" id="voltage" name="voltage">
												<option value="380">380</option>
												<option value="220">220</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกออเดอร์ใหม่</button>
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
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
