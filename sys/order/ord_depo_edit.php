<?php session_start();
	  require_once('../include/connect.php');
	  
	  $dep_id = trim($_GET['depo_id']);
	  $draw_id = trim($_GET['draw_id']);
	  $row_dep = mysql_fetch_array(mysql_query("SELECT * FROM tb_deposit WHERE d_id = '$dep_id'"));
	  
	  
	  $product = $row_dep['d_prod'];
	  $dep_qty = $row_dep['d_qty'];
	  $cust_id = $row_dep['d_cust'];
	  $row_cust = mysql_fetch_array(mysql_query("SELECT * FROM tb_customer WHERE cust_id = '$cust_id'"));
	  
	  $custname = $row_cust['cust_name'];

	  $qty_draw = 0;
	  
	  if($draw_id!=''){
		$row_draw = mysql_fetch_array(mysql_query("SELECT w_did, SUM(w_qty) sumberk FROM tb_withdraw WHERE w_did = '$draw_id' GROUP BY w_did"));
		$qty_draw = $row_draw['sumberk'];
	  }
	  
	  
	  
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
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		function validation(){
			
			var search_custname = $('#search_custname').val();
			var draw_prod_qty = parseInt($('#draw_prod_qty').val());
			var ord_qty = parseInt($('#ord_qty').val());
			var berk = parseInt($('#berk').val());
			var sumberk = parseInt(draw_prod_qty+berk);
			var compare = parseInt(ord_qty-sumberk);
			
			if(search_custname==''){
				alert("เลือกรหัสลูกค้าด้วยนะค่ะ"); 
				return false;
			}else if((draw_prod_qty=='') ||isNaN(draw_prod_qty)){
				alert("ใส่จำนวนที่เบิกด้วย"); 
				return false;				
			}else if(compare < 0){
				/*alert(ord_qty);
				alert(draw_prod_qty);
				alert(berk);
				alert(sumberk);
				alert(compare);*/
				alert("เบิกเกินจำนวนที่ฝาก"); 
				return false;				
			}
			else{
				$('#form1').submit();				
			}
		}		
	});
	
	
	
</script>
<title>เบิกสินค้าที่ฝากไว้</title>
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
                    <h1 class="page-header">เบิกสินค้าที่ฝาก <?php echo $custname;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เบิกสินค้าที่ฝากไว้ : 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/edit_depo.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ลูกค้า </label>
											<input disabled type="text" class="form-control search_tool" id="search_custname" name="search_custname" value="<?php echo $custname?>">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> สินค้าที่ฝาก</label>
											<input type="text" class="form-control" id="prod" name="prod" value="<?php echo $product?>" disabled>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ล็อคที่ฝากสินค้า</label>
											<input type="text" class="form-control" id="logger" name="logger" value="<?php echo $row_dep['d_logger'];?>">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-3">
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน (กิโล) </label>
											<input type="text" class="form-control" id="ord_qty" name="ord_qty" value="<?php echo $dep_qty;?>" disabled >
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบิกไปแล้ว</label>
											<input type="text" class="form-control" id="berk" name="berk" value="<?php echo $qty_draw;?>" disabled >
										</div>
										
										
									</div>
									
										
										
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบิกสินค้า (kg)</label>
											<input type="text" class="form-control" id="draw_prod_qty" name="draw_prod_qty" value="">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รวมราคา</label>
											<input type="text" class="form-control" id="ord_price" name="ord_price" value="<?php echo $row_dep['d_price'];?>" disabled>
										</div>
										
										
										
									</div>
									
									
									
									<div class="col-lg-3">
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">เบิกสินค้า</button>
										</div>
										
										<input type="hidden" name="drawid" value="<?php echo $draw_id; ?>">
										<input type="hidden" name="depid" value="<?php echo $dep_id; ?>">
										<input type="hidden" name="custname" value="<?php echo $custname; ?>">
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
