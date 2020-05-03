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
			if($role['ro_quotation'] == 2){ exit("<script>alert('กำลังไปที่หน้าใบเสนอราคานะคะ'); window.location = 'q.php';</script>");}
			require_once ('../include/navproduct.php');
			
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เลือกรูปแบบ </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เลือกรูปแบบ ขอใบเสนอราคา
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/speedlock_advance.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-2">
										<a href="cust_q.php"><div id="r_sumred" class="r_box"><p>ห้องสำเร็จ</p></div></a>
									</div>
									
									
									<div class="col-lg-3">
										<a href="speedlock_advance.php"><div id="r_embed" class="r_box"><p>ห้องฝั่ง สปีดล็อค</p></div></a>
									</div>
									
																		
									<div class="col-lg-3">
									   <a href="airblast.php"><div id="r_blast" class="r_box"><p>Blast freeze</p></div></a>
									</div>
									
									
									<div class="col-lg-3">
										<a href="condensing.php"><div id="r_machine" class="r_box"><p>เครื่องอย่างเดียว</p></div></a>
									</div>
									
									
									<div class="col-lg-3">
										<a href="rooms.php"><div id="r_room" class="r_box"><p>ห้องอย่างเดียว</p></div></a>
									</div>
									
									
									<div class="col-lg-3">
										<a href="iots.php"><div id="r_iot" class="r_box"><p>IoT</p></div></a>
									</div>
									
									<div class="col-lg-3">
										<a href="../../admin/part.php"><div id="r_rai" class="r_box"><p>อะไหล่เก่า TCL</p></div></a>
									</div>
									
									<div class="col-lg-3">
										<a href="../../admin/partnew.php"><div id="" class="r_box"><p>อะไหล่ใหม่ cpn</p></div></a>
									</div>
									
									<div class="col-lg-3">
										<a href="q_fome.php"><div id="r_rai" class="r_box"><p>ต้นทุนโฟม</p></div></a>
									</div>
									
									<div class="col-lg-2">
										
									</div>
									
									<div class="col-lg-3">
										<a href="q.php"><div id="r_rai" class="r_box"><p>ห้องฝั่งแบบเดิม</p></div></a>
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
