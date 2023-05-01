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
		$sql_all = "SELECT *
					FROM ((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) 
					      JOIN tb_service s ON s.fix_ord = o.o_id) 
						  JOIN province p ON p.id = o.o_cuprovin 
					WHERE o.o_type = 30
					";
		$result_all = mysql_query($sql_all);
		$num_all = mysql_num_rows($result_all);
		
		$sql_cusprod = "SELECT * FROM tb_cus_prod_type";
		$result_cusprod = mysql_query($sql_cusprod);
		$num_cusprod = mysql_num_rows($result_cusprod);
		
	?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<title>เซอร์วิส รายการ</title>
<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		//$('#date_pay, #date_delivery').datepicker({dateFormat: 'yy-mm-dd'});
		$("#serv_prov").load("../../ajax/province_server.php");
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var serv_prov = $('#serv_prov').val();
			
			
			
			if(search_custname==''){
				alert("ใส่ชื่อลูกค้าด้วยนะค่ะ"); 
				return false;
			}else if(serv_prov <= 1){
				alert("เลือกจังหวัดด้วยนะค่ะ"); 
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
                    <h1 class="page-header">เพิ่มงานเซอร์วิส</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							งาน Service
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/addservice.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
									</div>
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จังหวัดหน้างาน</label>
											<select class="form-control" id="serv_prov" name="serv_prov">
												<option value="1">เลือกจังหวัด</option> 
											</select>
										</div>
									</div>
																		
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อาการเสีย </label>
											<input type="text" class="form-control" id="broken" name="broken" value="ห้องไม่เย็น">
										</div>
									</div>
									
									
									<div class="col-lg-3">
										
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
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ออเดอร์ลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								งานเซอร์วิส
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ลำดับ</th>
                                        <th style='width: 15%;'>ลูกค้า</th>
										 <th style='width: 10%;'>อาการ</th>
										<th style='width: 10%;'>จังหวัด</th>
                                        <th style='width: 10%;'>วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_all; $i++){
										  $row_all = mysql_fetch_array($result_all);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_all['o_id']; ?></td>  
											<td><?php echo $row_all['cust_name']; ?></td>
											<td><?php echo $row_all['fix_broken']; ?></td>
											<td><?php echo $row_all['pro_name']; ?></td>
											<td><?php echo $row_all['o_date']; ?></td>
										</tr>
									<?php } ?>

                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
