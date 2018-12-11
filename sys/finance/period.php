<?php session_start();
	  require_once('../include/connect.php');
	
	$sql = "SELECT cust_id, cust_name, countpay, paysum
			FROM (tb_customer c JOIN tb_orders o ON c.cust_id = o.o_cust) JOIN (SELECT ordp.o_id orderidpay, count(ordp.pay_id) countpay,  sum(ordp.pay_amount) paysum
					FROM tb_ord_pay ordp
					GROUP BY ordp.o_id 
					ORDER BY ordp.pay_id DESC) AS A ON A.orderidpay  = o.o_id
			order by c.cust_id desc";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
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
                    <h1 class="page-header">ชำระงวด</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ชำระงวด
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ลูกค้า</th>                                     
                                        <th>จำนวนงวดที่ชำระ</th>
                                        <th>ยอดเงินรวม</th>
                                   
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  
									  ?>
									<tr class="gradeA"> 
											<td><?php echo number_format($row['cust_id'], 0, '.', ','); ?></td>
											<td><?php echo $row['cust_name']; ?></td>
											<?php if($row['countpay']==3) { ?>
												<td style="background-color: #315ab2; color:red; font-weight:bold;"><?php echo $row['countpay']; ?></td>
											<?php } else { ?>
													
													<td><?php echo $row['countpay']; ?></td>
											<?php } ?>
											<td><?php echo number_format($row['paysum'], 0, '.', ','); ?></td>
											
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