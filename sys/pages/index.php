<?php 
	session_start();
	require_once ('../include/connect.php');
	
	$u_id = $_SESSION[ss_uid];
	$today = date("Y-m-d");

	
	
	$sql_sumord = "select sum(o_cost) cost, sum(o_price) price, sum(o_com) com from tb_orders
					where o_date='$today' and o_return = 0 and o_cancel = 0 
					";
	$result_sumord = mysql_query($sql_sumord);
	$row_sumord = mysql_fetch_array($result_sumord);
	
	$sql_contord = "select count(o_id) contordtoday from tb_orders
				where o_date='$today' and o_return = 0 and o_cancel = 0 
					";
	$result_contord  = mysql_query($sql_contord );
	$row_contord  = mysql_fetch_array($result_contord );
	
	
	
	$sql3 = "SELECT * FROM tb_orders WHERE o_date <= curdate() and o_date >= DATE_SUB(curdate(),INTERVAL 3 day) ORDER BY o_id DESC";
	$result3 = mysql_query($sql3);
	$num3 = mysql_num_rows($result3);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">

    <title>ระบบ Lazada</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- LightBOx -->
	<script src="../plugin/lightbox/js/jquery-1.11.0.min.js"></script>
	<link href="../plugin/lightbox/css/lightbox.css" rel="stylesheet">
	<link href="../plugin/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css">
	
	<script src="../plugin/lightbox/js/lightbox.min.js"></script>
	<script src="../plugin/jquery-ui-1.9.1.custom.min.js"></script>
	<script>
		$(document).ready(function(){
			$('button.btn-success').click(submitform);
			
			$(".shipstatus").each(function(){
				if($(this).text()=='ยังไม่ได้ส่ง'){
					$(this).css("background-color", "yellow");
				}else if ($(this).text()=='คืนของ'){
					$(this).css("background-color", "red");
					
				}
			});

		});
		
		function submitform(){
			var chklazid = $('#o_lazid').val();
			if(chklazid=="") { alert("ใส่ข้อมูลให้ครบนะค่ะ"); return false; }
			$('#ordform').submit();
			
		}
	</script>


    <style>
		.split-type { background-color: #ebf3aa !important;  }
		
	</style>

</head>

<body>

    <div id="wrapper">
		<?php 
			/*if($u_id==""){
				exit("
				<script>
					alert('กรุณา login ก่อนนะคะ');
					window.location = 'login.php';
				</script>");
				}*/
		?>
        <!-- Navigation -->
        <?php require_once ('../include/navcust.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">สรุปยอดซื้อ ร้าน VR PHONE</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<p>ไม่นับออเดอร์ที่คืน หรือ ยกเลิก</p>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php echo number_format($row_sumord[price], 0, '.', ','); ?></div>
                                    <div>ยอดขายวันนี้</div>
                                </div>
                            </div>
                        </div>
                        <a href="custreport/custordtoday.php">
                            <div class="panel-footer">
                                <span class="pull-left">ออเดอร์ <?php echo $row_contord[contordtoday]; ?> ชิ้น วันนี้</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php echo number_format($row_sumord[cost], 0, '.', ','); ?>
									</div>
                                    <div>ต้นทุนวันนี้</div>
                                </div>
                            </div>
                        </div>
                        <a href="custreport/custordreport.php">
                            <div class="panel-footer">
                                <span class="pull-left">ดูเพิ่มเติม</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($row_sumord[com], 2, '.', ','); ?></div>
                                    <div>ค่าคอมวันนี้</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">ดูเพิ่มเติม</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($row_sumord[price]-($row_sumord[cost]+$row_sumord[com]), 2, '.', ','); ?></div>
                                    <div>กำไรวันนี้</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">ดูเพิ่มเติม</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							กรอกข้อมูล ออเดอร์
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order_save.php" method="post" name="ordform" id="ordform">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> Order Lazada ID</label>
											<input type="text" class="form-control" id="o_lazid" name="o_lazid">
										</div>

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> จำนวน/ชิ้น </label>
											<input type="text" class="form-control" id="o_qty " name="o_qty">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เวลา </label>
											<input type="text" class="form-control" id="o_hour" name="o_hour">
										</div>
										
										
										


									</div>
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อสินค้า </label>
											<input type="text" class="form-control" id="o_prodname" name="o_prodname">
										</div>

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อลูกค้า</label>
											<input type="text" class="form-control" id="o_custname" name="o_custname">
										</div>

									</div>
									
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> SKU </label>
											<input type="text" class="form-control" id="o_prodsku " name="o_prodsku">
										</div>


										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="o_date" name="o_date" value="<?php echo $today;?>">
										</div>
										
										<div class="form-group has-success">
											<button type="button" class="btn btn-lg btn-success btn-block">บันทึก</button>
										</div>

									</div>
									
								</form>
							 </div> <!-- row -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							รายละเอีดยออเดอร์
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
										<th>Order ID</th>
                                        <th>ชื่อสินค้า</th>	
                                        <th>ต้นทุน</th>
                                        <th>ราคาขาย</th>
										<th>คอม</th>
                                        <th>สถานะ</th><!-- กำลังส่ง ยกเลิก คืนของ -->
										<th>วันที่</th>
                                    </tr>
                                </thead>
								<!--
									$sql3 = "SELECT * FROM tb_orders WHERE o_dates <= curdate() and o_dates >= DATE_SUB(curdate(),INTERVAL 5 day) ORDER BY o_id DESC";
									$result3 = mysql_query($sql3);
									$num3 = mysql_num_rows($result3);
									
									ถ้าส่งแล้วให้ขึ้นส่งของ แล้วเช็คต่อว่ามี การคืนหรือยกเลิกไหม ถ้ามีให้แสดง
									
									รายได้ต้องไม่คำนวณรายการที่ยกเลิกหรือคืนของ
								-->
                                <tbody>			
									<?php
										for($i=1;$i<=$num3; $i++){
											$row3 = mysql_fetch_array($result3);
											
											if($row3[o_ship]==0){ // not ship
												$shipstatus = "ยังไม่ได้ส่ง";
											}else{  //ship
												if(($row3[o_return]== 1) || ($row3[o_cancel]== 1)){
													if($row3[o_return]== 1){
														$shipstatus = "คืนของ";
													}
													if($row3[o_cancel]== 1){
														$shipstatus = "ยกเลิก";
													}
													
												}else{
													$shipstatus = "จัดส่งแล้ว";
												}	
											}
																			
									?>
										<tr class="odd gradeX">
											<td><?php echo $i;?></td>
											<td><?php echo "<a href='order/ordercust.php?orderno=$row3[o_id]'>".$row3[o_lazid]."</a>"?></td>
											<td><?php echo $row3[o_prodname];?></td>
											<td><?php echo number_format($row3[o_cost], 0, '.', ',') ?></td>
											<td><?php echo number_format($row3[o_price], 0, '.', ',') ?></td>
											<td><?php echo number_format($row3[o_com], 2, '.', ',') ?></td>												
											<td class="shipstatus"><?php echo $shipstatus; ?></td>
											<td><?php echo $row3[o_date]. ' | '. $row3[o_hour]; ?></td>
										</tr>
									<?php } ?>
                                </tbody>
								</table>
						 
							 </div> <!-- row -->
                           
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

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
<!--
https://startbootstrap.com/template-categories/all/
https://startbootstrap.com/template-overviews/sb-admin-2/
 http://stackoverflow.com/questions/4383914/how-to-get-single-value-from-php-array
-->
</body>

</html>
