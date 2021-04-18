<?php session_start();
	  require_once('../include/connect.php');
	  $sql_prod = "SELECT * FROM tb_cus_prod_type"; $result_prod = mysql_query($sql_prod); $num_prod = mysql_num_rows($result_prod);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
	<?php 
		$dates = date('Y-m-d');
	
		
		
	?>
	<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<script>
	$(document).ready(function(){
		$('#btn').click(validation);
		$('#date_pay, #date_delivery').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_custplt.php",
				minLength: 1
		});
		
		function validation(){
			
			var search_custname = $('#search_custname').val();
			var ord_qty = $('#ord_qty').val(); 
			var prod = $('#prod').val();
			var ord_temp = $('#ord_temp').val();
			var logger = $('#logger').val();
			if(search_custname==''){
				alert("เลือกรหัสลูกค้าด้วยนะค่ะ"); 
				return false;
			}else if((ord_temp=='') ||isNaN(ord_temp)){
				alert("ใส่อุณหภูมิเป็นตัวเลขด้วยนะค่ะ"); 
				return false;				
			}else if((ord_qty=='') ||isNaN(ord_qty)){
				alert("ใส่จำนวนที่ฝากด้วย"); 
				return false;				
			}else if(prod==''){
				alert("ใส่รายการสินค้าด้วยนะค่ะ"); 
				return false;				
			}else if(logger==''){
				alert("เลือกชั้นวางด้วย"); 
				return false;				
			}else{
				$('#form1').submit();				
			}
		}		
	});
	
	
	
</script>
<title>ฝากอาหาร</title>
</head>

<body>

    <div id="wrapper">
		<?php 
			require_once('../include/inc_role.php'); 
			require_once ('../include/navplt.php');
			if($ro_order!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูออเดอร์นะคะ'); window.location = '../index.php';</script>");}
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ฝากอาหาร</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มออเดอร์ฝากอาหาร : 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/add_ord_deposit.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ลูกค้า </label>
											<input type="text" class="form-control search_tool" id="search_custname" name="search_custname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทสินค้า</label>
											<select class="form-control" id="prod_type" name="prod_type">
											<?php for($i=1; $i<=$num_prod; $i++) { 
												$row_prod = mysql_fetch_array($result_prod);
											?>
												<option value="<?php echo $row_prod['cusp_id']?>"><?php echo $row_prod['cusp_name']?></option>
											
											<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> สินค้าที่ฝาก</label>
											<input type="text" class="form-control" id="prod" name="prod">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิที่ฝาก</label>
											<input type="text" class="form-control" id="ord_temp" name="ord_temp" value="-18">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน (กิโล) </label>
											<input type="text" class="form-control" id="ord_qty" name="ord_qty" value="">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ล็อคที่ฝากสินค้า</label>
											<input type="text" class="form-control" id="logger" name="logger" value="A1">
										</div>
									</div>
									
										
										
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รวมราคา</label>
											<input type="text" class="form-control" id="ord_price" name="ord_price" value="1000">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
									</div>
									
									
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ใบเสนอราคา</label>
											<input type="file" class="form-control require" id="ord_quotation" name="ord_quotation">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">เพิ่มออเดอร์</button>
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
