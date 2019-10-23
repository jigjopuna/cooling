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
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
	.r_box { height: 100px; background:#EEEEEE; max-width: 200px; margin-top: 10px;}
	.r_box p { 
		text-align: center; 
		vertical-align: middle; line-height: 90px;  
		font-family: 'Kanit', sans-serif; 
		font-size:18px; 
		font-weight:bold;
	 }
</style>
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
                    <h1 class="page-header">เพิ่มออเดอร์ ลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							 เลือกประเภทออเดอร์
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-2">
										<a href="ord_room.php"><div id="r_sumred" class="r_box"><p>ห้องเย็น</p></div></a>
									</div>
									
									
									<div class="col-lg-3">
										<a href="ord_iot.php"><div id="r_embed" class="r_box"><p>IoT</p></div></a>
									</div>
									
																		
									<div class="col-lg-3">
									   <a href="service.php"><div id="" class="r_box"><p>งานเซอร์วิส</p></div></a>
									</div>
									
									
									<div class="col-lg-3">
										<a href="ord_part.php"><div id="" class="r_box"><p>อะไหล่</p></div></a>
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
