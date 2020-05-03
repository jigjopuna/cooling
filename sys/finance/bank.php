<?php session_start();
	  require_once('../include/connect.php');
	
	$bankid = trim($_GET['bankid']);
	$sql = "SELECT o.o_id, c.cust_name, op.pay_amount, ot.ort_name, o.o_date, op.pay_date 
			FROM ((tb_ord_pay op JOIN tb_orders o ON o.o_id = op.o_id)
				  JOIN tb_customer c ON c.cust_id = o.o_cust) 
				  JOIN tb_ord_type ot ON ot.ort_type = o.o_type
			WHERE op.pay_bank = '$bankid'";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$banks = mysql_fetch_array(mysql_query("SELECT bk_name FROM tb_bank WHERE bk_id ='$bankid'"));
	$bankname = $banks['bk_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>สรุปเงินเข้า</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			$('#btn_tr').click(validation_tr);
			$('#podate, #tr_date').datepicker({dateFormat: 'yy-mm-dd'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
				
		});
		
	</script> 
</head>

<body>

    <div id="wrapper">
        <?php 
			require_once ('../include/navproduct.php');
			if($ro_finance!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูการเงินนะคะ'); window.location = '../index.php';</script>");}
		?>
		
        <div id="page-wrapper">
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">สรุปเงินเข้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								สรุปเงินเข้า <?php echo $bankname;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>เลขออเดอร์</th>
                                        <th>ลูกค้า</th>                                     
                                        <th>ยอดเข้า (บาท)</th>
										<th>ประเภทออเดอร์</th>
										<th>วันที่สั่งซื้อ</th>
										<th>วันที่ชำระเงิน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  
									  ?>
									<tr class="gradeA"> 
										
										<td><?php echo $row['o_id']; ?></td>
										<td><?php echo $row['cust_name']; ?></td>
										<td><?php echo number_format($row['pay_amount'], 0, '.', ','); ?></td>
										<td><?php echo $row['ort_name']; ?></td>
										<td><?php echo $row['o_date']; ?></td>
										<td><?php echo $row['pay_date']; ?></td>
										
											
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

   
	<div id="role" style="display:none"><?php echo $rolepo;?></div>
</body>

</html>