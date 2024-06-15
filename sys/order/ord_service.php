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
		
		
		$sql_all = "SELECT *
					FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) 
					      JOIN tb_service s ON s.fix_ord = o.o_id) 
						  JOIN province p ON p.id = o.o_cuprovin) 
						  JOIN tb_ord_status ost ON ost.ost_id = o.o_status
					WHERE o.o_type = 30
					";
		$result_all = mysql_query($sql_all);
		$num_all = mysql_num_rows($result_all);
		
		
	

		
		
		
	?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		
	});
</script>
<title>ออเดอร์ Service</title>
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
                    <h1 class="page-header">เซอร์วิส</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								SERVICE
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ลำดับ</th>
                                        <th style='width: 15%;'>ลูกค้า</th>
										<th style='width: 8%;'>สถานะ</th>
										<th style='width: 15%;'>รายการ</th>
										<th style='width: 6%;'>ราคา</th>
										<th style='width: 10%;'>Line ลูกค้า</th>
										<th style='width: 10%;'>เบอร์ติดต่อ</th>
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
											
											<?php if($row_all['o_status']==5) { ?>
												<td style="background-color: #315ab2; color:red; font-weight:bold;"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } else if($row_all['o_status']==1) { ?>
												<td style="background-color: #f7f3ba"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } else if($row_all['o_status']==7){ ?>
												<td style="background-color: #feacc3"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<? } else if($row_all['o_status']==6) { ?>
												<td style="background-color: #baf7ee"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } else if($row_all['o_status']==9){?>
												<td style="background-color: #fc637c; font-weight:bold;"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } else{ ?>
												<td><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php }  ?>
											
											
											<td> <?php echo $row_all['fix_broken']; ?></td>
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
