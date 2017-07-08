<?php  session_start(); ?>
<?php 

	require_once('../../include/connect.php'); 
	$today = date("Y-m-d");
	$admin_id = $_SESSION[ss_adminid];
	$sql = "SELECT *
			FROM  tb_product p, tb_product_type pt, 
				(SELECT p.p_id, SUM( od.ord_qty ) qty, SUM( od.ord_amount ) amount
				FROM tb_order_detail od
				 JOIN tb_product p ON p.p_id = od.ord_product
				WHERE od.ord_dates =  '$today'
				GROUP BY p.p_id) AS sumorder
			WHERE p.p_id = sumorder.p_id AND pt.pt_id = p.p_type
			ORDER BY p.p_type";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sqlCountAllToday = "SELECT SUM(ord_qty) qty, SUM(ord_amount) amount FROM tb_order_detail WHERE ord_dates = '$today'";
	$result_sqlCountAllToday  = mysql_query($sqlCountAllToday);
	$row_sqlCountAllToday = mysql_fetch_array($result_sqlCountAllToday);
	


?>
<!DOCTYPE html>
<html lang="en">

<head>

    

    <title>รายการออเดอร์วันนี้ทั้งหมด</title>
	<meta name="description" content="">
	<?php require_once ('../../include/header.php');?>
	

</head>

<body>

    <div id="wrapper">
        <?php require_once ('../../include/navadmin-sub.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รวมออเดอร์ลูกค้าทั้งหมดวันนี้</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                               จำนวน  <?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?> ชิ้น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>ชนิดเค้ก</th>
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
									
									<?php if($i==1) { //ถ้าเป็นครั้งแรกให้แสดงชื่อประเภทเค้กได้เลย ถ้าไม่เท่ากับ 1 ให้เช็คก่อนจนกว่าจะเปลี่ยนประเภท เพราะ 1 ประเภทมีหลายสินค้า?>
										<tr><td colspan="2"><?php echo $row[pt_name];?></td><td colspan="3"><?php echo $num_sumtype;?></td></tr>
										<?php $chktype = $row[p_type];?>
									<?php } ?>
									
									
									<?php if($chktype!= $row[p_type]) { ?>
									    
										<!--<tr><td colspan='2'>รวม 1 </td><td><?php //echo $row[p_type]  /*number_format($items[$row[p_type]-$a]['ord_qty'], 0, '.', ',')*/; ?></td><td><?php //echo number_format($items[$row[p_type]-$a]['ord_amount'], 0, '.', ',') ;  ?></td><td></td><tr>   -->
										<tr><td colspan="2"><?php echo $row[pt_name];?></td><td colspan="3"></td></tr>
										<?php $chktype = $row[p_type]; ?>
									<?php } ?>
									
											<tr class="odd gradeX">
												<td><?php echo $i/*.' | '. $chktype. ' |  '.$row[p_type]*/ ;?></td>
												<td><?php echo $row[p_name]?></td>
												<td><?php echo number_format($row[qty], 0, '.', ',') ?></td>
												<td><?php echo number_format($row[amount], 0, '.', ',')?></td>
												<td><?php echo date("Y-m-d");?></td>
											</tr>

										
									<?php } //end for ?>
									
										<!--<tr><td colspan='2'>รวม</td><td><?php //echo number_format($items[$countarr-1]['ord_qty'], 0, '.', ',') ; ?></td><td><?php //echo number_format($items[$countarr-1]['ord_amount'], 0, '.', ',') ;  ?></td><td></td><tr>   -->
										
									
									
										<tr class="odd gradeX" align="center">
											<td colspan="3"><?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',')?> ชิ้น</td>
											<td colspan="3"><?php echo number_format($row_sqlCountAllToday[amount], 2, '.', ',')?> บาท</td>
											
											
										</tr>
									
                                    
                                </tbody>
							</form>
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

    <?php require_once ('../../include/footer.php');?>
</body>

</html>
