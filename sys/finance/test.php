<?php session_start();
	  require_once('../include/connect.php');
	
	//รายจ่ายของแต่ละคน 7 วันล่าสุด
	$sql_out7d = "SELECT e.e_name, SUM(p.po_price) price7
			FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer
			WHERE p.po_date <= curdate() and p.po_date >= DATE_SUB(curdate(),INTERVAL 7 day)
			GROUP BY p.po_buyer 
			ORDER BY p.po_buyer";
			
	//รายจ่ายของแต่ละคน 14 วันล่าสุด
	$sql_out14d = "SELECT e.e_name, SUM(p.po_price) price14
			FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer
			WHERE p.po_date <= curdate() and p.po_date >= DATE_SUB(curdate(),INTERVAL 14 day)
			GROUP BY p.po_buyer
			ORDER BY p.po_buyer";
	
	//รายจ่ายของแต่ละคน 30 วันล่าสุด
	$sql_out30d = "SELECT e.e_name, SUM(p.po_price) price30
			FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer
			WHERE p.po_date <= curdate() and p.po_date >= DATE_SUB(curdate(),INTERVAL 30 day)
			GROUP BY p.po_buyer 
			ORDER BY p.po_buyer";
	
	$result_out7d = mysql_query($sql_out7d);
	$num_out7d = mysql_num_rows($result_out7d);
	
	$result_out14d = mysql_query($sql_out14d);
	$num_out14d = mysql_num_rows($result_out14d);
	
	$result_out30d = mysql_query($sql_out30d);
	$num_out30d = mysql_num_rows($result_out30d);
	
	
	//ยอดเงินโอนเข้าของแต่ละคน 7 วันล่าสุด
	$sql_in7d = "SELECT e.e_name, SUM(pay_amount) pay_amount7
				FROM tb_ord_pay op JOIN tb_emp e ON op.o_emp_receive = e.e_id
				WHERE op.pay_date <= curdate() and op.pay_date >= DATE_SUB(curdate(),INTERVAL 7 day)
				GROUP BY op.o_emp_receive 
				ORDER BY op.o_emp_receive";
				
	//ยอดเงินโอนเข้าของแต่ละคน 14 วันล่าสุด
	$sql_in14d = "SELECT e.e_name, SUM(pay_amount) pay_amount14
				FROM tb_ord_pay op JOIN tb_emp e ON op.o_emp_receive = e.e_id
				WHERE op.pay_date <= curdate() and op.pay_date >= DATE_SUB(curdate(),INTERVAL 14 day)
				GROUP BY op.o_emp_receive
				ORDER BY op.o_emp_receive";
				
	//ยอดเงินโอนเข้าของแต่ละคน 30 วันล่าสุด
	$sql_in30d = "SELECT e.e_name, SUM(pay_amount) pay_amount30
				FROM tb_ord_pay op JOIN tb_emp e ON op.o_emp_receive = e.e_id
				WHERE op.pay_date <= curdate() and op.pay_date >= DATE_SUB(curdate(),INTERVAL 30 day)
				GROUP BY op.o_emp_receive 
				ORDER BY op.o_emp_receive";
				
	$result_in7d = mysql_query($sql_in7d);
	$num_in7d = mysql_num_rows($result_in7d);
	
	$result_in14d = mysql_query($sql_in14d);
	$num_in14d = mysql_num_rows($result_in14d);
	
	$result_in30d = mysql_query($sql_in30d);
	$num_in30d = mysql_num_rows($result_in30d);
					
	
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
		$('.btn-success').click(validation);
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var payinqty = $('#payinqty').val();
			var paydate = $('#paydate').val();
			if((search_custname=='') || (payinqty=='') || (paydate=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
			}
		}
		
	});
	
</script>

</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ยอดจ่าย</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ยอดจ่ายแยกตามวัน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>                                     
                                        <th>30 วัน</th>
										<th>14 วัน</th>
										<th>7 วัน</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									
										for($i=1; $i<=$num_out7d; $i++){
											 $row_out7d = mysql_fetch_array($result_out7d);
											 $a[$i] = $row_out7d['price7'];
										}
										
										for($i=1; $i<=$num_out14d; $i++){
											 $row_out14d = mysql_fetch_array($result_out14d);
											 $b[$i] = $row_out14d['price14'];
										}
										
										
									?>
                                    
									<?php 
										for($i=1; $i<=$num_out30d; $i++){
										  $row_out30d = mysql_fetch_array($result_out30d);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_out30d['e_name']; ?></td>
											<td><?php echo number_format($row_out30d['price30'], 0, '.', ','); ?></td>
											<td><?php echo number_format($b[$i], 0, '.', ','); ?></td>
											<td><?php echo number_format($a[$i], 0, '.', ','); ?></td>												
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
                    <h1 class="page-header">ยอดรับ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ยอดรับแยกตามวัน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>                                     
                                        <th>30 วัน</th>
										<th>14 วัน</th>
										<th>7 วัน</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									
										for($i=1; $i<=$num_in7d; $i++){
											 $row_in7d = mysql_fetch_array($result_in7d);
											 $d[$i] = $row_in7d['pay_amount7'];
										}
										
										for($i=1; $i<=$num_in14d; $i++){
											 $row_in14d = mysql_fetch_array($result_in14d);
											 $c[$i] = $row_in14d['pay_amount14'];
										}
										
										
									?>
                                    
									<?php 
										for($i=1; $i<=$num_in30d; $i++){
										  $row_in30d = mysql_fetch_array($result_in30d);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_in30d['e_name']; ?></td>
											<td><?php echo number_format($row_in30d['pay_amount30'], 0, '.', ','); ?></td>
											<td><?php echo number_format($c[$i], 0, '.', ','); ?></td>
											<td><?php echo number_format($d[$i], 0, '.', ','); ?></td>												
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
