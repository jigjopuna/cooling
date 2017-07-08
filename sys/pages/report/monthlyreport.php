<?php  
	require_once('../../include/connect.php');

	$today = date("Y-m-d");
	$sedates = date('Y');
	$chk_month = date('m');
	$reportmonth = $sedates.'-'.$chk_month.'%';
	
	
	 $paramweek1    = $sedates.'-'.$chk_month.'-'.'01';
	 $paramweek1end    = $sedates.'-'.$chk_month.'-'.'08';
	 $paramweek2    = $sedates.'-'.$chk_month.'-'.'09';
	 $paramweek2end    = $sedates.'-'.$chk_month.'-'.'16';
	 $paramweek3    = $sedates.'-'.$chk_month.'-'.'17';
	 $paramweek3end    = $sedates.'-'.$chk_month.'-'.'24';
	 $paramweek4    = $sedates.'-'.$chk_month.'-'.'25';
	 $paramweek4end    = $sedates.'-'.$chk_month.'-'.'31';

	 $w1 = mysql_fetch_array(mysql_query("SELECT sum(o_price) price, sum(o_cost) cost, sum(o_com) com, count(o_id)cntord FROM tb_orders WHERE o_date BETWEEN '$paramweek1' AND '$paramweek1end'"));
	 $w2 = mysql_fetch_array(mysql_query("SELECT sum(o_price) price, sum(o_cost) cost, sum(o_com) com, count(o_id)cntord FROM tb_orders WHERE o_date BETWEEN '$paramweek2' AND '$paramweek2end'"));
	 $w3 = mysql_fetch_array(mysql_query("SELECT sum(o_price) price, sum(o_cost) cost, sum(o_com) com, count(o_id)cntord FROM tb_orders WHERE o_date BETWEEN '$paramweek3' AND '$paramweek3end'"));
	 $w4 = mysql_fetch_array(mysql_query("SELECT sum(o_price) price, sum(o_cost) cost, sum(o_com) com, count(o_id)cntord FROM tb_orders WHERE o_date BETWEEN '$paramweek4' AND '$paramweek4end'"));
	 
	 $summont = mysql_fetch_array(mysql_query("SELECT sum(o_price) price, sum(o_cost) cost, count(o_cost) com FROM tb_orders WHERE o_date LIKE '$reportmonth%' "));





	

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>รายงานเดือน ปัจจุบัน</title>
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
                    <h1 class="page-header">รายงานยอดขาย</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							รายงานเดือน <?php echo $sedates.'-'.$chk_month; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <div class="row">
								<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
									<!--<tr align="center">
										<th colspan="6">.</th>
                                    </tr>-->
                                    <tr>
										<th>สัปดาห์ที่</th>
										<th>ยอดขาย</th>
                                        <th>ต้นทุน</th>	
                                        <th>ค่าคอม</th>
                                        <th>จำนวนออเดอร์</th>
										<th>กำไร</th>
                                    </tr>
                                </thead>
                                <tbody>	
										<tr>
											<td><?php echo $paramweek1, ' | ', $paramweek1end; ?></td>
											<td><?php echo number_format($w1[price], 0, '.', ',') ?></td>
											<td><?php echo number_format($w1[cost], 0, '.', ',') ?></td>	
											<td><?php echo number_format($w1[com], 2, '.', ',') ?></td>
											<td><?php echo number_format($w1[cntord], 0, '.', ',') ?></td>
											<td><?php echo number_format($w1[price]-($w1[cost]+$w1[com]), 2, '.', ',') ?></td>	
											
										</tr>
										
										<tr>
											<td><?php echo $paramweek2, ' | ', $paramweek2end; ?></td>
											<td><?php echo number_format($w2[price], 0, '.', ',') ?></td>
											<td><?php echo number_format($w2[cost], 0, '.', ',') ?></td>	
											<td><?php echo number_format($w2[com], 2, '.', ',') ?></td>
											<td><?php echo number_format($w2[cntord], 0, '.', ',') ?></td>
											<td><?php echo number_format($w2[price]-($w2[cost]+$w2[com]), 2, '.', ',') ?></td>	
											
										</tr>
										
										<tr>
											<td><?php echo $paramweek3, ' | ', $paramweek3end; ?></td>
											<td><?php echo number_format($w3[price], 0, '.', ',') ?></td>
											<td><?php echo number_format($w3[cost], 0, '.', ',') ?></td>	
											<td><?php echo number_format($w3[com], 2, '.', ',') ?></td>
											<td><?php echo number_format($w3[cntord], 0, '.', ',') ?></td>
											<td><?php echo number_format($w3[price]-($w3[cost]+$w3[com]), 2, '.', ',') ?></td>	
											
										</tr>
										
										<tr>
											<td><?php echo $paramweek4, ' | ', $paramweek4end; ?></td>
											<td><?php echo number_format($w4[price], 0, '.', ',') ?></td>
											<td><?php echo number_format($w2[cost], 0, '.', ',') ?></td>	
											<td><?php echo number_format($w2[com], 2, '.', ',') ?></td>
											<td><?php echo number_format($w4[cntord], 0, '.', ',') ?></td>
											<td><?php echo number_format($w1[price]-($w1[cost]+$w1[com]), 2, '.', ',') ?></td>	
											
										</tr>
									
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
