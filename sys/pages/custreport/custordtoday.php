<?php  session_start(); 
	require_once('../../include/connect.php');
	$today = date("Y-m-d");
	$u_id = $_SESSION[ss_uid];
	
	//นับออเดอร์ของลูกค้าทั้งหมดที่ซื้อวันนี้
	$sql_cntusord = "select count(*) cnt from tb_order o WHERE o.o_user= '$u_id' AND o.o_date = '$today'";
					
	$result_cntusord = mysql_query($sql_cntusord);
	$num_cntusord = mysql_num_rows($result_cntusord);
	$row_cntusord = mysql_fetch_array($result_cntusord);
	//echo $num_cntusord. ' | '. $row_cntusord[cnt];
	
	//นับจำนวนชิ้นทั้งหมดที่ซื้อวันนี้
	$sql_cntqty = "SELECT SUM(ord_qty) sumqty, SUM(ord_amount) sumamount 
				   FROM tb_order_detail 
				   WHERE ord_usref = '$u_id' AND ord_dates = '$today'";
					
	$result_cntqty  = mysql_query($sql_cntqty );
	$num_cntqty  = mysql_num_rows($result_cntqty );
	$row_cntqty  = mysql_fetch_array($result_cntqty );
	
	
	//10 ออเดอร์ล่าสุด
	// 1.รวมราคาและจำนวนทั้งหมดของลูกค้าก่อน คำนวณแยกตามออเดอร์  แล้ว join กับตาราง tb_order เพื่อจะเอาวันที่สั่งออเดอร์มาแสดง
	
	$sql_lasttenord = "SELECT sumorder.qty, sumorder.amount, o.o_date
				FROM tb_order o,  (

						SELECT ord_idref, SUM( ord_qty ) qty, SUM( ord_amount ) amount
						FROM tb_order_detail
						WHERE ord_usref =  '$u_id' AND ord_dates = '$today'
						GROUP BY ord_idref
						) AS sumorder
						
				WHERE sumorder.ord_idref = o.o_id
				ORDER BY o.o_id 
				LIMIT 0 , 10";
	$result_lasttenord = mysql_query($sql_lasttenord);
	$num_lasttenord = mysql_num_rows($result_lasttenord );

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>รายการออเดอร์วันนี้ทั้งหมด</title>
	<meta name="description" content="">
	<?php require_once ('../../include/header.php');?>
</head>

<body>

    <div id="wrapper">
		<?php 
			if($u_id==""){
				exit("
				<script>
					alert('กรุณา login ก่อนนะคะ');
					window.location = 'login.php';
				</script>");
				}
		?>
        <!-- Navigation -->
        <?php require_once ('../../include/navcust-sub.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ออเดอร์ทั้งหมด</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
								ออเดอร์ทั้งหมดที่เคยซื้อมี  <?php echo number_format($row_cntusord[cnt], 0, '.', ',') ?> ออเดอร์   จำนวน  <?php echo number_format($row_cntqty[sumqty], 0, '.', ',') ?>  ชิ้น  <?php echo number_format($row_cntqty[sumamount], 0, '.', ',') ?> บาท
                        </div>
						<div class="panel-heading"> .
                        </div>
						<div class="panel-heading"> 
								10 ออเดอร์ ล่าสุด
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>จำนวนชิ้น</th>
                                        <th>ราคา (บาท)</th>
										<th>เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										for($i=1;$i<=$num_lasttenord; $i++){
											$row_lasttenord = mysql_fetch_array($result_lasttenord);
																			
									?>
										<tr class="odd gradeX">
											<td><?php echo $i;?></td>
											<td><?php echo $row_lasttenord[qty];?></td>
											<td><?php echo $row_lasttenord[amount];?></td>
											<td><?php echo $row_lasttenord[o_date];?></td>
										</tr>
									<?php } ?>
									
									<tr class="odd gradeX" align="center">
                                        <td colspan="3"><?php //echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?>  ชิ้น</td>
                                        <td colspan="3"><?php //echo number_format($row_AmountToday[amount], 2, '.', ',')?>  บาท</td>
										
                                    </tr>
                                 
                                    
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php require_once ('../../include/footer.php');?>

<!--

-->
</body>

</html>
