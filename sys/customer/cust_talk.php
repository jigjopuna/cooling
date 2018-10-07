<?php session_start();
	require_once('../include/connect.php');
	$cate_id = trim($_GET['cate_id']);

	//for left nav menu path include/navproduct.php
	$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sql_status = "SELECT * FROM tb_ord_status WHERE ost_type = 0";
	$result_status = mysql_query($sql_status);
	$num_status = mysql_num_rows($result_status);
	
	
	$sql_rt = "SELECT * FROM tb_room_type";
	$result_rt = mysql_query($sql_rt);
	$num_rt = mysql_num_rows($result_rt);
	

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			multiList();
			$('#btn').click(validation);
		});//end ready
	
	function multiList(){
		$("#province").load("../../ajax/province_server.php");
	}
	
	function validation(){
			var custname = $('#cust_name').val();
			var work_status = $('#work_status').val();
			
			if(custname==''){
				alert('ยังไม่ได้ใส่ชื่อลูกค้า');
				return false;
			}
			if(work_status==0){
				alert('เลือกสถานะงานด้วย');
				return false;
			}
			$('#form1').submit();		
		}
	</script>  
    <title>ปิดการขายลูกค้าใหม่</title>	
	<?php require_once('../include/header.php');?>
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once('../include/inc_role.php'); ?>

</head>

<body>

    <div id="wrapper">
		<?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ปิดการขายลูกค้าใหม่</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ปิดการขายลูกค้าใหม่
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/cust/custtalk.php" id="form1" name="form" method="post" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อ/บริษัท ลูกค้า </label>
											<input type="text" class="form-control" id="cust_name" name="cust_name">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบอร์ติดต่อ</label>
											<input type="text" class="form-control" id="phoneno" name="phoneno">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทห้อง</label>
											<select class="form-control" id="roomtype" name="roomtype">	
												<option value="0"> อื่นๆ</option>
												<?php 
													for($i=1; $i<=$num_rt; $i++){
														$row_rt = mysql_fetch_array($result_rt);
												?>
												<option value="<?php echo $row_rt['rm_id']?>" selected> <?php echo $row_rt['rm_type']?></option>
													<?php } ?>
											</select>
										</div>
										
									</div>

									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จังหวัด </label>
											<select class="form-control" id="province" name="province">		
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สถานะงาน</label>
											<select class="form-control" id="work_status" name="work_status">
												<option value="0">เลือกสถานะงาน</option>
												<?php 
													for($i=1; $i<=$num_status; $i++){
														$row_status = mysql_fetch_array($result_status);
												?>
												<option value="<?php echo $row_status['ost_id']?>"> <?php echo $row_status['ost_status']?></option>
													<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รูปภาพ</label>
											<input type="file" class="form-control require" id="photos" name="photos">
										</div>
										
										
									</div>
									
									<div class="col-lg-3">
										
										<div class="form-group">
										  <label for="comment">ข้อมูลเพิ่มเติม</label>
										  <textarea class="form-control" rows="5" id="notes" name="notes"></textarea>
										</div>
									</div>
									
			
			
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อ Line</label>
											<input type="text" class="form-control" id="line" name="line">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อ Facebook</label>
											<input type="text" class="form-control" id="facebook" name="facebook">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูลลูกค้า</button>
										</div>
										
									</div>
									
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
