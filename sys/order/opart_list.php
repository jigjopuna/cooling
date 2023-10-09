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
		/*$sql_all = "SELECT c.cust_name, c.cust_lineid, c.cust_tel, t.t_id, o.o_id, o.o_date, t.t_name, t.t_cost, o.o_price, op.pay_amount, b.bk_name, op.pay_date
					FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id)
						  JOIN tb_ord_pay op ON op.o_id = o.o_id)
						  JOIN tb_bank b ON b.bk_id = op.pay_bank)
						  JOIN tb_tools t ON t.t_id = o.o_part_id
					WHERE o.o_type LIKE '4%' ORDER BY o.o_id DESC LIMIT 0, 300";
		*/
		
		$sql_all = "SELECT c.cust_name, c.cust_lineid, c.cust_tel, t.t_id, o.o_note, o.o_id, o.o_date, t.t_name, t.t_model, t.t_cost, o.o_price, o.o_qty
					FROM (tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id)
						  JOIN tb_tools t ON t.t_id = o.o_part_id
					WHERE o.o_type LIKE '4%' ORDER BY o.o_id DESC LIMIT 0, 300";
		$result_all = mysql_query($sql_all);
		$num_all = mysql_num_rows($result_all);
		
		
		$sql_part = "SELECT t.t_name, ib.bas_prod, SUM(ib.bas_qty) quantity
					 FROM (tb_basket b JOIN tb_inbasket ib ON b.b_id = ib.bas_id) 
						   JOIN tb_tools t ON t.t_id = ib.bas_prod
					 WHERE b.b_status = 1  
					 GROUP BY ib.bas_prod";
					 
		$result_part = mysql_query($sql_part);
		$num_part = mysql_num_rows($result_part);

		
		
		
	?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		
	});
</script>
<title>ออเดอร์อะไหล่</title>
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
                    <h1 class="page-header">ออเดอร์อะไหล่</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ออเดอร์อะไหล่
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 3%;'>ลำดับ</th>
                                        <th style='width: 15%;'>ลูกค้า</th>
										<th style='width: 30%;'>รายการ</th>
										<th style='width: 9%;'>ราคาขาย</th>
										<th style='width: 9%;'>ราคาทุน</th>
										<th style='width: 12%;'>เบอร์ติดต่อ</th>
										<th style='width: 9%;'>วันที่ออเดอร์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_all; $i++){
										  $row_all = mysql_fetch_array($result_all);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_all['o_id']; ?></td>
											<td><a href="order_part_detail.php?o_id=<?php echo $row_all['o_id'];?>&cust_name=<?php echo $row_all['cust_name'];?>"><?php echo $row_all['cust_name']; ?></td>	
											<td><?php echo $row_all['t_name'].' '.$row_all['t_model']; ?> (<?php echo $row_all['t_id']; ?>)</td>
											<td><?php echo number_format($row_all['o_price'], 0, '.', ',') ?></td>
											<td><?php echo number_format($row_all['t_cost'], 0, '.', ',').' x '. $row_all['o_qty'];?></td>	
											<td><?php echo $row_all['cust_tel'].' ('.$row_all['cust_lineid'].')'; ?></td> 
											<td><?php echo date("d-m-Y", strtotime($row_all['o_date'])); ?></td>
											          
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
								
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>
										<th>จำนวน</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_part; $i++){
										  $row_part = mysql_fetch_array($result_part);
									  ?>
										<tr class="gradeA">
											<td><?php echo $i; ?></td>
											<td><a href="opart_detail.php?t_id=<?php echo $row_part['bas_prod'];?>&t_name=<?php echo $row_part['t_name'];?>" target="_blank"><?php echo $row_part['t_name']?></a></td>
											<td><?php echo number_format($row_part['quantity'], 0, '.', ',') ?></td>
											          
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
