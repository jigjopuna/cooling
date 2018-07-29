<?php session_start();
	require_once('../include/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#btn').click(function(){
				var qautity = $('#qty').val();
				if(isNaN(qautity)){
					alert('กรุณาใส่จำนวนเงินเป็นตัวเลขค่ะ ');
					return false;
				}else{
					$('#form1').submit();
				}	
			});
		});//end ready
	</script>
    <title>แก้ไขออเดอร์</title>	
	<?php require_once('../include/header.php');?>
	<?php require_once('../include/metatagsys.php');?>
	<?php 
		require_once('../include/inc_role.php');
		if($role['ro_ed_ord_dt']!= 1) exit("<script>alert('ไม่มีสิทธิ์แก้ไขออเดอร์นะคะ');window.location = '../pages/login/login.php';</script>");
			$o_id = trim($_GET['o_id']);
			$t_id = trim($_GET['t_id']); //echo 't_id : '.$t_id.'<br>';
			$sqlt_id = "SELECT t.t_name, t.t_cost_center, orpd.orpd_id, orpd.o_id, orpd.ot_id, orpd.orpd_qty, orpd.orpd_cost
				FROM tb_ord_prod orpd JOIN tb_tools t ON orpd.ot_id = t.t_id
				WHERE orpd.orpd_id = '$t_id'";
			$rowt_id = mysql_fetch_array(mysql_query($sqlt_id));
	?>
</head>
<body>
    <div id="wrapper">
		<?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">แก้ไขออเดอร์</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							แก้ไขออเดอร์ <?php echo $rowt_id['orpd_id']; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/order_detail_edit.php" id="form1" name="form" method="post">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รายการ</label>
											<input type="text" class="form-control" id="phoneno" name="phoneno" disabled value="<?php echo $rowt_id['t_name']; ?>">
										</div>
									</div>

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="qty" name="qty" value="<?php echo $rowt_id['orpd_qty']; ?>">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ยืนยันแก้ไข</button>
										</div>
									</div>
									
									<div class="col-lg-3">
										.
									</div>
									
									<input type="hidden" name="o_ids" id="o_ids" value="<?php echo $o_id;?>">
									<input type="hidden" name="bef_edi" id="bef_edi" value="<?php echo $rowt_id['orpd_qty'];?>">
									<input type="hidden" name="orpd_id" id="orpd_id" value="<?php echo $rowt_id['orpd_id'];?>">
									<input type="hidden" name="ot_id" id="ot_id" value="<?php echo $rowt_id['ot_id'];?>">
									<input type="hidden" name="cost_center" id="cost_center" value="<?php echo $rowt_id['t_cost_center'];?>">
								</form>
							 </div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
        </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->


</body>

</html>
