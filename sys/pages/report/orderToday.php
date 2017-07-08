<?php  session_start(); 
	require_once('../../include/connect.php');
	$today = date("Y-m-d");
	$sql = /*"SELECT 
			FROM tb_order_detail od JOIN tb_user u ON u.u_id = od.ord_usref
			WHERE od.ord_dates =  '$today'";*/
			
			/*"SELECT u.u_name, SUM(od.ord_qty) qty, SUM(od.ord_amount) amount
			FROM tb_order_detail od JOIN tb_user u ON u.u_id = od.ord_usref
			WHERE od.ord_dates =  '$today'
			GROUP BY u.u_name";*/
			"SELECT u.u_id, u.u_name, sumorder.qty, sumorder.amount
			FROM tb_order o, tb_user u, 
				   (SELECT ord_idref, SUM(ord_qty) qty, SUM(ord_amount) amount
					FROM tb_order_detail
					WHERE ord_dates = '$today'  
					GROUP BY ord_idref) AS sumorder
			WHERE sumorder.ord_idref = o.o_id AND o.o_user = u.u_id
			
			";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sqlCountOrder = "SELECT COUNT(*) counts FROM tb_order_detail WHERE ord_dates = '$today'";
	$resultCountOrder = mysql_query($sqlCountOrder);
	$row_CountOrder = mysql_fetch_array($resultCountOrder);
	
	$sqlCountAllToday = "SELECT SUM(ord_qty) qty FROM tb_order_detail WHERE ord_dates = '$today'";
	$result_sqlCountAllToday  = mysql_query($sqlCountAllToday);
	$row_sqlCountAllToday = mysql_fetch_array($result_sqlCountAllToday);
	
	$sqlAmountToday = "SELECT SUM(ord_amount) amount FROM tb_order_detail WHERE ord_dates = '$today'";
	$result_AmountToday = mysql_query($sqlAmountToday);
	$row_AmountToday = mysql_fetch_array($result_AmountToday);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>รายการออเดอร์วันนี้</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once ('../../include/navadmin.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ออเดอร์วันนี้</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                            ออเดอร์วันนี้ มีทั้งหมด <?php echo number_format($num, 0, '.', ',') ?> ออเดอร์   จำนวน  <?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?>  ชิ้น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>จำนวนชิ้น</th>
                                        <th>ราคา (บาท)</th>
										<th>เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										for($i=1;$i<=$num; $i++){
											$row = mysql_fetch_array($result);
																			
									?>
										<tr class="odd gradeX">
											<td><?php echo $i;?></td>
											<td><?php echo "<a href='ordercust.php?user=$row[u_id]'>".$row[u_name]."</a>"?></td>
											<td><?php echo number_format($row[qty], 0, '.', ',') ?></td>
											<td><?php echo number_format($row[amount], 0, '.', ',') ?></td>
											<td><?php echo $today?></td>
										</tr>
									<?php } ?>
									
									<tr class="odd gradeX" align="center">
                                        <td colspan="3"><?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?>  ชิ้น</td>
                                        <td colspan="3"><?php echo number_format($row_AmountToday[amount], 2, '.', ',')?>  บาท</td>
										
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
<!--
(SELECT ord_idref, SUM(ord_qty) qty, SUM(ord_amount) amount
FROM tb_order_detail
WHERE ord_dates = '2016-12-30' AND ord_usref = 2 
GROUP BY ord_idref) AS sumorder

SELECT u.u_id, u.u_name, sumorder.qty, sumorder.amount
FROM tb_order o, tb_user u, 
	   (SELECT ord_idref, SUM(ord_qty) qty, SUM(ord_amount) amount
		FROM tb_order_detail
		WHERE ord_dates = '2016-12-30' AND ord_usref = 2 
		GROUP BY ord_idref) AS sumorder
WHERE sumorder.ord_idref = o.o_id AND o.o_user = u.u_id
-->
</body>

</html>
