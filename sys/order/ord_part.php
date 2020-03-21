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
		$("#search_tool").autocomplete({
				source: "../../ajax/search_tool.php",
				minLength: 1
		});
		function validation(){
			
			var search_tool = $('#search_tool').val();
			var ord_qty = $('#ord_qty').val();
			if((search_tool=='') || (ord_qty=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
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
                    <h1 class="page-header">ขายอะไหล่</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ตะกร้าเลขที่ : 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/addord_part.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่ออะไหล่ (สินค้า) </label>
											<input type="text" class="form-control search_tool" id="search_tool" name="search_tool">
										</div>
										
									</div>
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน(ชิ้น) </label>
											<input type="text" class="form-control" id="ord_qty" name="ord_qty" value="1">
										</div>
									</div>
										
										
									<div class="col-lg-3">
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">เพิ่มของเข้าตะกร้า</button>
										</div>
									</div>
									
									
									<div class="col-lg-3">
											
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
