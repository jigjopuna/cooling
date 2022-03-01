<?php session_start();
	  require_once('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	require_once ('../include/header.php');
	require_once('../include/metatagsys.php');
	require_once('../include/inc_role.php');
?>
	<?php 
		$dates = date('Y-m-d');
		
		
			$sql_all = "SELECT o.o_id, o.o_date, c.cust_name,  c.cust_tel, c.cust_lineid, p.pro_name, o.o_width, o.o_size, o.o_high
						FROM (tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust) JOIN  province p ON o.o_cuprovin = p.id
						WHERE o.o_type = 600";
			$result_all = mysql_query($sql_all);
			$num_all = mysql_num_rows($result_all);
		
		
		
	?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		
	});
</script>
<title>ออเดอร์ IoT</title>
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
                    <h1 class="page-header">ออเดอร์ IoT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ออเดอร์ IoT
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ลำดับ</th>
                                        <th style='width: 15%;'>ลูกค้า</th>
										<th style='width: 10%;'>จังหวัด</th>
                                        <th style='width: 10%;'>ขนาดห้อง</th>
										<th style='width: 5%;'>Line ลูกค้า</th>
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
											<td><a href="order_detail.php?o_id=<?php echo $row_all['o_id'];?>&cust_name=<?php echo $row_all['cust_name'];?>"><?php echo $row_all['cust_name']; ?></a></td>
											<td><?php echo $row_all['pro_name']; ?></td>
											<td><?php echo $row_all['o_width'].' x '.$row_all['o_size'].' x '.$row_all['o_high']; ?></td>
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
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ออเดอร์ IoT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
