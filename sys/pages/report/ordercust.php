<?php  session_start(); 
	require_once('../../include/connect.php');
	
	$user_id = $_GET[user];
	$today = date("Y-m-d");
	$sql = "SELECT ord_idref, SUM(ord_qty) qty, SUM(ord_amount) amount
			FROM tb_order_detail 
			WHERE ord_dates = '$today' AND ord_usref = '$user_id'
			GROUP BY ord_idref";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	
	$sql_ordusdetail = "SELECT p.p_name, u.u_name, od.ord_qty, od.ord_amount 
						FROM (tb_order_detail od JOIN tb_user u ON u.u_id = od.ord_usref) 
							  JOIN tb_product p ON p.p_id = od.ord_product 
						WHERE od.ord_dates = '$today' AND od.ord_usref ='$user_id'";
	$result_ordusdetail = mysql_query($sql_ordusdetail);
	$num_ordusdetail = mysql_num_rows($result_ordusdetail);

	
	$sqlcntordus = "SELECT SUM(ord_amount) sumamount, SUM(ord_qty) sumqty FROM tb_order_detail WHERE ord_usref ='$user_id'";
	$resultcntordus = mysql_query($sqlcntordus);
	$rowcntordus = mysql_fetch_array($resultcntordus);
	
	
	$sql_user = "SELECT u_name FROM tb_user WHERE u_id = '$user_id'";
	$result_user = mysql_query($sql_user);
	$rowuser = mysql_fetch_array($result_user);
	
	$sqlCountAllToday = "SELECT SUM(ord_qty) qty, SUM(ord_amount) amount FROM tb_order_detail WHERE ord_dates = '$today' AND ord_usref='$user_id'";
	$result_sqlCountAllToday  = mysql_query($sqlCountAllToday);
	$row_sqlCountAllToday = mysql_fetch_array($result_sqlCountAllToday);
	
	
	/*หน้านี้จะแสดงรายการสั่งซื้อของแต่ละคน ว่ามีกี่ออเดอร์ในวันที่เลือก โดยตารางแรกจะสรุปรวมก่อนว่า คนนี้สั่งกี่ออเดอร์
	
	ตาราง1 
		SELECT ord_idref, SUM(ord_qty) qty, SUM(ord_price_whole)
		FROM tb_order_detail 
		WHERE ord_date = '2016-12-30' AND ord_usref = '2'
		GROUP BY ord_idref 
	
	ตารางที่ 2 จะบอกรายละเอียดว่าคนนี้รวมทุกออเดอร์ สั่งอะไรไปบ้่าง 
	SELECT p.p_name, u.u_name, od.ord_qty, od.ord_price_whole 
	FROM (tb_order_detail od JOIN tb_user u ON u.u_id = od.ord_usref) 
		  JOIN tb_product p ON p.p_id = od.ord_product 
	WHERE od.ord_dates = '2016-12-30' AND od.ord_usref = '$user_id'
	
	*/

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>รายการของคุณ <?php ?></title>

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
                    <h1 class="page-header">ออเดอร์คุณ <?php echo $rowuser[u_name]?> วันนี้</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
			
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                            คุณ <?php echo $rowuser[u_name]?>  มีออเดอร์ <?php echo $num?> รายการ  จำนวน  <?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?>   ชิ้น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>ออเดอร์ที่</th>
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
											<td><?php echo $row[qty]?></td>
											<td><?php echo $row[amount]?></td>
											<td><?php echo $today?></td>
										</tr>
									<?php } ?>
									
									<tr class="odd gradeX" align="center">
                                        <td colspan="3"><?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?>  ชิ้น</td>
                                        <td colspan="3"><?php echo number_format($row_sqlCountAllToday[amount], 2, '.', ',')?>  บาท</td>
										
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
			
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                            คุณ <?php echo $rowuser[u_name]?> มี  รายการ  จำนวน  <?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?>   ชิ้น
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
										for($i=1;$i<=$num_ordusdetail; $i++){
											$row_ordusdetail = mysql_fetch_array($result_ordusdetail);
																			
									?>
										<tr class="odd gradeX">
											<td><?php echo $i;?></td>
											<td><?php echo $row_ordusdetail[p_name]?></td>
											<td><?php echo $row_ordusdetail[ord_qty]?></td>
											<td><?php echo $row_ordusdetail[ord_amount]?></td>
											<td><?php echo $today?></td>
										</tr>
									<?php } ?>
									
									<tr class="odd gradeX" align="center">
                                        <td colspan="3"><?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?>  ชิ้น</td>
                                        <td colspan="3"><?php echo number_format($row_sqlCountAllToday[amount], 2, '.', ',')?>  บาท</td>
										
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

</body>

</html>
