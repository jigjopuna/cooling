<?php session_start();
	  require_once('../include/connect.php');
	  
	  $sql_sale = "SELECT e.e_id, e.e_name, e.e_tel FROM tb_emp e JOIN tb_role r  ON e.e_id = r.ro_emp_id WHERE r.ro_quotation != 0 AND e_publish = 1"; 
	  $result_sale = mysql_query($sql_sale); 
	  $num_sale = mysql_num_rows($result_sale);
	 
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
		$('#date').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust_q.php",
				minLength: 1
		});
		
		$(".search_tool").autocomplete({
				source: "../../ajax/search_tool.php",
				minLength: 1
		});
		
		
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var search_tool = $('#search_tool').val();
			
			
			var hp = $('#hp').val();
			
			var ord_price = $('#ord_price').val();
			
			if(search_custname==''){
				alert("ใส่ชื่อลูกค้าด้วยนะคะ"); 
				return false;
			}else if((search_tool=='') ||isNaN(search_tool)){
				alert("เลือกสินค้าด้วยนะค่ะ"); 
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
								<form action="../../admin/partnew.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname" value="6">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> สินค้า/รายการ </label>
											<input type="text" class="form-control search_tool ui-autocomplete-input" id="search_tool" name="search_tool" autocomplete="off">
										</div>
										
									</div>
									
									
									
									
									<div class="col-lg-3">
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="qty" name="qty" value="1">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date" name="date" value="<?php echo $dates;?>">
										</div>
										
									</div>
									
																		
									<div class="col-lg-3">
										
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
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เงินเข้าบัญชี</label><br>
											<input type="radio" value="1" name="bank_acc" checked> บริษัท
											<input type="radio" value="2" name="bank_acc"> เดชาธร
										</div>
										
										
									</div>
									
									
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าขนส่ง</label>
											<input type="text" class="form-control" id="shipcost" name="shipcost" value="200">
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
