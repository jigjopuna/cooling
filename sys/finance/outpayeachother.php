<?php session_start();
	  require_once('../include/connect.php');
	  
	  $e_id = trim($_GET['e_id']);
	
	//payout
	$sqlout = "SELECT e.e_id, e.e_name, p.po_name, p.po_qty, p.po_price, p.po_shop, p.po_comment, p.po_bill_img, p.po_date FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE e.e_id='$e_id'";
	$resultout= mysql_query($sqlout);
	$numout = mysql_num_rows($resultout);
	
	//payin
	$sqlin = "SELECT e.e_id, e.e_name, op.o_id, op.pay_amount, op.pay_bill, op.pay_date, c.cust_name 
			  FROM ((tb_ord_pay op JOIN tb_emp e ON op.o_emp_receive = e.e_id) JOIN tb_orders o ON o.o_id = op.o_id) JOIN tb_customer c ON c.cust_id = o.o_cust
			  WHERE e.e_id='$e_id'";
	$resultin = mysql_query($sqlin);
	$numin = mysql_num_rows($resultin);
	
	/*$today = date("Y-m-d");*/
	
	//show emp name

	$row_empname = mysql_fetch_array(mysql_query("SELECT e_name FROM tb_emp WHERE e_id='$e_id'"));
	
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
                    <h1 class="page-header">สรุปรายรับ / รายจ่าย (<?php echo $row_empname['e_name']?>)</h1>
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
                                        <th>รายการ</th>                                     
                                        <th>จำนวน</th>
                                        <th>ราคา</th>
                                        <th>ร้านค้า</th>
										<th>คนจ่าย</th>
										<th>คอมเม้นท์</th>
										<th>วันที่</th>
										<th>เอกสาร</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$numout; $i++){
										  $rowout = mysql_fetch_array($resultout);
									  ?>
										<tr class="gradeA">
											<td><a href="order_detail.php?o_id=<?php echo $rowout['po_id'] ?>"><?php echo $rowout['po_name']; ?></td>
											<td><?php echo number_format($rowout['po_qty'], 0, '.', ''); ?></td>
											<td><?php echo number_format($rowout['po_price'], 0, '.', ','); ?></td>
											<td><?php echo $rowout['po_shop']; ?></td>
											<td><?php echo $rowout['e_name']; ?></td>
											<td><?php echo $rowout['po_comment']; ?></td>
											<td><?php echo $rowout['po_date']; ?></td>
											<td><a href="../../images/bill/<?php echo $rowout['po_bill_img'];?>" target="_blank">ดูบิล</a></td>											
										</tr>
									<?php } ?>

                                    
                                </tbody>
                            </table>
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
                                        <th>รับจากลูกค้า</th>                                     
                                        <th>จำนวนเงิน</th>
                                        <th>วันที่</th>
										<th>ผู้รับเงิน</th>
										<th>ดูบิล</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$numin; $i++){
										  $rowin = mysql_fetch_array($resultin);
									  ?>
										<tr class="gradeA">
											<td><a href="../order/order_detail.php?o_id=<?php echo $rowin['o_id'] ?>"><?php echo $rowin['cust_name']; ?></td>
											<td><?php echo number_format($rowin['pay_amount'], 0, '.', ','); ?></td>
											<td><?php echo $rowin['pay_date']; ?></td>
											<td><?php echo $rowin['e_name']; ?></td>
											<td><a href="../images/receive/<?php echo $rowin['pay_bill'];?>" target="_blank">ดูบิล</a></td>											
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
