<?php session_start();
	  require_once('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	require_once ('../include/header.php');
	require_once('../include/metatagsys.php');
	require_once('../include/inc_role.php');
?>
	<?php 
		$dates = date('Y-m-d');
		
		
			$sql_all = "SELECT  ot.ort_name, o.o_id, o.o_prepare, o.o_date, c.cust_name, c.cust_corp, c.cust_tel, c.cust_lineid, p.pro_name, o.o_status, o.o_temp, o.o_width, o.o_high, o.o_voltage, o.o_size, ost.ost_status 
						FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) JOIN province p ON o.o_cuprovin = p.id) 
							 JOIN tb_ord_status ost ON ost.ost_id = o.o_status) 
							 JOIN tb_ord_type ot ON ot.ort_type = o.o_type
						WHERE o.o_type LIKE '1%'
						ORDER BY o.o_id DESC LIMIT 0, 500";
			$result_all = mysql_query($sql_all);
			$num_all = mysql_num_rows($result_all);
		
		
		
	?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		
	});
</script>
<title>ออเดอร์ห้องเย็น</title>
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
                    <h1 class="page-header">ออเดอร์ห้องเย็น</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ออเดอร์ห้องเย็น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ลำดับ</th>
                                        <th style='width: 15%;'>ลูกค้า</th>
										 <th style='width: 10%;'>สถานะ</th>
										<th style='width: 10%;'>จังหวัด</th>
                                        <th style='width: 10%;'>ขนาดห้อง</th>
										<th style='width: 5%;'>Line ลูกค้า</th>
										<th style='width: 5%;'>คอม 220/380</th>
										<th style='width: 15%;'>เบอร์ติดต่อ</th>
										<th style='width: 10%;'>ห้อง</th>
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
											
											
											<?php if($row_all['o_prepare']==1) { ?>
												<td style="background-color: #79f699;  font-weight:bold;"><a href="order_detail.php?o_id=<?php echo $row_all['o_id'];?>&cust_name=<?php echo $row_all['cust_name'];?>"><?php echo $row_all['cust_name']; ?></a></td>	
											<?php } else  { ?>
											    <td><a href="order_detail.php?o_id=<?php echo $row_all['o_id'];?>&cust_name=<?php echo $row_all['cust_name'];?>"><?php echo $row_all['cust_name']; ?></a></td>	
											<?php } ?>
											
											
											
											
											   
											
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
											
											<td><a href="prepare.php?o_id=<?php echo $row_all['o_id'];?>"><?php echo $row_all['pro_name']; ?></a></td>
											
											<?php if($row_all['o_newold'] == 1) { ?>
												<td><?php echo $row_all['o_width'].' x '.$row_all['o_size'].' x '.$row_all['o_high']; ?></td>
											<?php } else { ?>
												<td style="color:red; font-weight:bold;"><?php echo $row_all['o_width'].' x '.$row_all['o_size'].' x '.$row_all['o_high']; ?></td>
											<?php } ?>
											
											<td><?php echo $row_all['cust_lineid']; ?></td>
											<td><?php echo $row_all['o_voltage']; ?></td>
											<td><?php echo $row_all['cust_tel']; ?></td> 
											<td><?php echo $row_all['ort_name']; ?></td> 
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
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ออเดอร์ IoT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
