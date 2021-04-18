<?php session_start();
	  require_once('../sys/include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once ('../sys/include/header_root.php');?>
<?php require_once('../sys/include/metatagsys.php');?>
	<?php 
		$dates = date('Y-m-d');
		$sql_all = "SELECT d.d_id, d.d_prod, d.d_qty, d.d_logger, d.d_price, d.d_date, c.cust_tel, c.cust_name, c.cust_id
					FROM tb_deposit d JOIN tb_customer c ON c.cust_id = d.d_cust  
					ORDER BY d.d_id DESC LIMIT 0,1000";
		$result_all = mysql_query($sql_all);
		$num_all = mysql_num_rows($result_all);
		
		
		
	?>
<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		
	});
</script>
<title>รับฝาก-ออเดอร์</title>
</head>

<body>

    <div id="wrapper">
		<?php 
			require_once ('navext.php');
		?>
        <div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รับฝาก</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รับฝาก
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ลำดับ</th>
                                        <th style='width: 20%;'>ลูกค้า</th>
										<th style='width: 15%;'>สินค้า</th>
										<th style='width: 10%;'>จำนวน (kg)</th>
										<th style='width: 10%;'>ราคา</th>
										<th style='width: 10%;'>ล็อกที่วาง</th>
										<th style='width: 12%;'>เบอร์ติดต่อ</th>
										<th style='width: 10%;'>วันที่ฝาก</th>
									 </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_all; $i++){
										  $row_all = mysql_fetch_array($result_all);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_all['d_id']; ?></td>
											<td><a href="ord_detail_depo.php?depo_id=<?php echo $row_all['d_id'];?>&cust_id=<?php echo $row_all['cust_id'];?>"><?php echo $row_all['cust_name']; ?></td>	
											<td><?php echo $row_all['d_prod']; ?></td>
											<td><?php echo number_format($row_all['d_qty'], 0, '.', ',') ?></td>
											<td><?php echo number_format($row_all['d_price'], 0, '.', ',') ?></td>
											<td><?php echo $row_all['d_logger']; ?></td>
											<td><?php echo $row_all['cust_tel']; ?></td> 
											<td><?php echo $row_all['d_date']; ?></td>
											          
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
