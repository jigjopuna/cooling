<?php  
	require_once('../../include/connect.php');

	$orderno = $_GET[orderno];
	$today = date("Y-m-d");
	$sql = "SELECT *
			FROM tb_orders
			WHERE o_id = '$orderno'
			";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>ออเดอร์ลูกค้า</title>
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<?php require_once ('../../include/header.php');?>

</head>

<body>

    <div id="wrapper">
		<?php require_once ('../../include/navadmin-sub.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ออเดอร์เลขที่  <?php echo $row[o_lazid];?>&nbsp;| &nbsp; สินค้าคือ <?php echo $row[o_prodname]?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							 ลูกค้า : <?php echo $row[o_custname];?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <div class="row">
								<form action="../../db/order_update.php" method="post" name="ordform" id="ordform">
									<div class="col-lg-4">
									
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> Order Lazada ID</label>
											<input type="text" class="form-control" id="o_lazid" name="o_lazid" value="<?php echo $row[o_lazid];?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> จำนวน/ชิ้น </label>
											<input type="text" class="form-control" id="o_qty " name="o_qty" value="<?php echo $row[o_qty]; ?>" >
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เวลา </label>
											<input type="text" class="form-control" id="o_hour" name="o_hour" value="<?php echo $row[o_hour]; ?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ต้นทุน</label>
											<input type="text" class="form-control" id="o_cost" name="o_cost" value="<?php echo $row[o_cost]?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ส่ง</label>
											<input type="checkbox" class="form-control" id="o_ship" name="o_ship" 
											<?php  if($row[o_ship]==1){ echo 'checked';  ?>
												
											<?php } ?>
											
											>
										</div>


									</div>
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อสินค้า </label>
											<input type="text" class="form-control" id="o_prodname" name="o_prodname" value="<?php echo $row[o_prodname]?>">
										</div>

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อลูกค้า</label>
											<input type="text" class="form-control" id="o_custname" name="o_custname" value="<?php echo $row[o_custname]?>">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาขาย</label>
											<input type="text" class="form-control" id="o_price" name="o_price" value="<?php echo $row[o_price]?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คืนของ</label>
											<input type="checkbox" class="form-control" id="o_return" name="o_return" 
											<?php  if($row[o_return]==1){ echo 'checked';  ?>
												
											<?php } ?>
											
											>
										</div>

									</div>
									
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> SKU </label>
											<input type="text" class="form-control" id="o_prodsku " name="o_prodsku" value="<?php echo $row[o_prodsku]?>">
										</div>


										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="o_date" name="o_date" value="<?php echo $row[o_date];?>">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">บิล</label>
											<input type="text" class="form-control" id="o_bill" name="o_bill" value="<?php echo $row[o_bill]?>">
										</div>
										
																			
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าคอม</label>
											<input type="text" class="form-control" id="o_com" name="o_com" value="<?php echo $row[o_com]?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยกเลิก</label>
											<input type="checkbox" class="form-control" id="o_cancel" name="o_cancel" 
											<?php  if($row[o_cancel]==1){ echo 'checked';  ?>
												
											<?php } ?>
											
											>
										</div>
										
						
									</div><!-- end last col4 -->
									<input type="hidden" value="<?php echo $orderno;?>" name="orderno">
									<input type="submit" value="บันทึก">			
								</form>
							 </div> <!-- row -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>

    </script>

</body>

</html>
