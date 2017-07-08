<?php 
	session_start();
	require_once ('../../include/connect.php');
	
	$admin_id = $_SESSION[ss_adminid];
	$today = date("Y-m-d");

	$sql_user = "SELECT * FROM tb_user WHERE u_id = '$u_id'";
	$result_user = mysql_query($sql_user);
	$row_user = mysql_fetch_array($result_user);
	
	
	$sql = "SELECT * 
			FROM tb_product p JOIN tb_product_type pt ON p.p_type = pt.pt_id
			ORDER BY p_id";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//ยอดรวมของลูคค้าในวันนั้น
	
	$sqlcountorder = "SELECT COUNT( * ) countorder
					FROM tb_order o, tb_user u, (

					SELECT ord_idref, SUM( ord_qty ) qty, SUM( ord_amount ) amount
					FROM tb_order_detail
					WHERE ord_dates =  '$today'
					GROUP BY ord_idref
					) AS sumorder
					WHERE sumorder.ord_idref = o.o_id
					AND o.o_user = u.u_id
					AND u.u_id ='$u_id'";
	$resultcountorder = mysql_query($sqlcountorder);
	$rowcountorder = mysql_fetch_array($resultcountorder);
	//print_r($rowcountorder);
	
	//นับยอดรวม 
	$sql_countPieceToday = "SELECT SUM(ord_qty) qty FROM tb_order_detail WHERE ord_dates = '$today' AND ord_usref = '$u_id'";
	$result_countPieceToday = mysql_query($sql_countPieceToday);
	$row_countPieceToday = mysql_fetch_array($result_countPieceToday);
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>ออเดอร์ลูกค้า</title>
	<meta name="description" content="">
	<?php require_once ('../../include/header.php');?>

    <style>
		.split-type { background-color: #ebf3aa !important;  }
		
	</style>

</head>

<body>

    <div id="wrapper">
		<?php 
			if($admin_id!= 1){
				exit("
				<script>
					alert('กรุณา login ที่เป็น admin ก่อนนะคะ');
					window.location = '../login.php';
				</script>");
				}
		?>
        <!-- Navigation -->
        <?php require_once ('../include/navcust.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">สรุปยอดซื้อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							รายการสินค้า <button type="button" class="btn btn-success">เพิ่มสินค้า</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<form action="../db/order_save.php" method="post" name="ordform" id="ordform">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>รูป</th>
                                        <th>ชื่อเค้ก</th>
                                        <th><a href="#"><button type="button" class="btn btn-success">แก้ไข</button></a></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										for($i=1;$i<=$num; $i++){
											$row = mysql_fetch_array($result);
																			
									?>
									
									<?php if($i==1) { //ถ้าเป็นครั้งแรกให้แสดงชื่อประเภทเค้กได้เลย ถ้าไม่เท่ากับ 1 ให้เช็คก่อนจนกว่าจะเปลี่ยนประเภท เพราะ 1 ประเภทมีหลายสินค้า?>
										<tr class="split-type"><td colspan="2"><?php echo $row[pt_name];?></td><td colspan="2"></td></tr>
										<?php $chktype = $row[p_type];?>
									<?php } ?>
									
									
									<?php if($chktype!= $row[p_type]) { ?>
									    <tr class="split-type"><td colspan="2"><?php echo $row[pt_name];?></td><td colspan="2"></td></tr>
										<?php $chktype = $row[p_type]; ?>
									<?php } ?>
									
										<tr class="odd gradeX">
											<td><?php echo $row[p_id]?></td>
											<td><img src="../pinto.jpg"/></td>
											<td><?php echo $row[p_name]?></td>
											<td>
												<input type="hidden" name="product_id[]" value="<?php echo $row[p_id]?>">
												<input type="hidden" name="wholsale_price[]" value="<?php echo $row[p_wholsale_price]?>">
												<input type="hidden" name="user_id" value="<?php echo $u_id;?>"> 
												<input type="text" name="qty[]" class="form-control" value="0">
											</td>
										</tr>
									<?php } ?>
                                    
                                </tbody>
                            </table>
							<button type="button" class="btn btn-success">สั่งซื้อ</button>
							</form>
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

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	<script>
		$(document).ready(function(){
			$('button.btn-success').click(submitform);

		});
		
		function submitform(){
			$('#ordform').submit();
			
		}
	</script>
<!--
https://startbootstrap.com/template-categories/all/
https://startbootstrap.com/template-overviews/sb-admin-2/
-->
</body>

</html>
