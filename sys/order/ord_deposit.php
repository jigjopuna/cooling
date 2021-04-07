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
		$sql_all = "SELECT o.o_id, c.cust_name, c.cust_lineid, c.cust_tel, o.o_price, o.o_qty, o.o_date
					FROM tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust 
					WHERE o.o_type LIKE '5%' 
					ORDER BY o.o_id DESC LIMIT 0, 300";
		$result_all = mysql_query($sql_all);
		$num_all = mysql_num_rows($result_all);
		
		
		
	?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		
	});
</script>
<title>รับฝาก-ออเดอร์</title>
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
                                        <th style='width: 15%;'>ลูกค้า</th>
										<th style='width: 15%;'>จำนวน (kg)</th>
										<th style='width: 10%;'>ราคา</th>
										<th style='width: 10%;'>Line ลูกค้า</th>
										<th style='width: 15%;'>เบอร์ติดต่อ</th>
										<th style='width: 10%;'>วันที่ออเดอร์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_all; $i++){
										  $row_all = mysql_fetch_array($result_all);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_all['o_id']; ?></td>
											<td><a href="order_detail.php?o_id=<?php echo $row_all['o_id'];?>&cust_name=<?php echo $row_all['cust_name'];?>"><?php echo $row_all['cust_name']; ?></td>	
											<td><?php echo number_format($row_all['o_qty'], 0, '.', ',') ?></td>
											<td><?php echo number_format($row_all['o_price'], 0, '.', ',') ?></td>
											<td><?php echo $row_all['cust_lineid']; ?></td>
											<td><?php echo $row_all['cust_tel']; ?></td> 
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
