<?php session_start();
	  require_once('../include/connect.php');
	
	//payout
	$sqlout = "SELECT e.e_id, e.e_name, SUM(po_price) poprice FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id  GROUP BY po_buyer";
	$resultout= mysql_query($sqlout);
	$numout = mysql_num_rows($resultout);
	
	//payin
	$sqlin = "SELECT e.e_id, e.e_name, SUM(o.pay_amount) payamount FROM tb_ord_pay o JOIN tb_emp e ON o.o_emp_receive = e.e_id GROUP BY o.o_emp_receive";
	$resultin = mysql_query($sqlin);
	$numin = mysql_num_rows($resultin);
	
	$today = date("Y-m-d");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = '../pages/login/login.php';
				</script>");
		}
	
	?>
	
	<script>
		$(document).ready(function(){
			
		});
	</script> 
</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
		
		    
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">สรุปรายรับ / รายจ่าย (รวมทุกคน)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								สรุปรายจ่าย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>                                     
                                        <th>รายจ่าย</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$numout; $i++){
										  $rowout = mysql_fetch_array($resultout);
									  ?>
										<tr class="gradeA">
											<td><a href="outpayeachother.php?e_id=<?php echo $rowout['e_id']; ?>"><?php echo $rowout['e_name']; ?></a></td>
											<td><?php echo number_format($rowout['poprice'], 0, '.', ','); ?></td>
												
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
								สรุปรายรับ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>                                     
                                        <th>รายรับ</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$numin; $i++){
										  $rowin = mysql_fetch_array($resultin);
									  ?>
										<tr class="gradeA">
											<td><a href="outpayeachother.php?e_id=<?php echo $rowin['e_id']; ?>"><?php echo $rowin['e_name']; ?></a></td>
											<td><?php echo number_format($rowin['payamount'], 0, '.', ','); ?></td>												
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
