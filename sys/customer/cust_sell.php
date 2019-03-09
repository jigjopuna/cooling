<?php session_start();
	  require_once('../include/connect.php');
	  $e_id = $_SESSION['ss_emp_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
		});//end ready
	
	function validation(){
			var line = $('#line').val();
			if(line==0){
				alert('กรอกข้อมูลด้วยนะคะ');
				return false;
			}
			$('#form1').submit();		
		}
	</script>  
	<?php 
		require_once('../include/header.php');
		require_once('../include/metatagsys.php');
		require_once('../include/inc_role.php');
		
		$sql = "SELECT e.e_name, cu.cuse_id, cu.cuse_line, cu.cuse_date, o.ost_status 
				FROM  (tb_custsell cu JOIN tb_emp e ON cu.cuse_sell_id = e.e_id)
					   JOIN tb_ord_status o ON o.ost_id	 = cu.cuse_status";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		$sql_status = "SELECT * FROM tb_ord_status WHERE ost_type = 0";
		$result_status = mysql_query($sql_status);
		$num_status = mysql_num_rows($result_status);
	?>
</head>
<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ผู้รับผิดชอบ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ผู้ที่คุยกับลูกค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/cust/custtalk.php" id="form1" name="form" method="post" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อ Line ลูกค้า </label>
											<input type="text" class="form-control" id="line" name="line">
										</div>								
									</div>

									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สถานะงาน</label>
											<select class="form-control" id="cust_status" name="cust_status">
												<option value="23">กำลังคุยกับลูกค้า</option> 
												<?php 
													for($i=1; $i<=$num_status; $i++) { 
														$row_status = mysql_fetch_array($result_status);
												?>
													<option value="<?php echo $row_status['ost_id']; ?>"><?php echo $row_status['ost_status'];?></option>
												
												<?php } ?>
												
											</select>
										</div>
									
										
									</div>
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูล</button>
										</div>
									</div>
	
									<div class="col-lg-3">

									</div>
									
								</form>
							 </div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
        </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ข้อมูลผู้ติดต่อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ลูกค้ารอจ่ายมัดจำ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>Line ลูกค้า</th>
										<th>ผู้ดูแล</th>
										<th>สถานะงาน</th>
										<th>วันที่</th>
										
                                    </tr>
                                </thead>  
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['cuse_id']; ?></td>
											<td><?php echo $row['cuse_line']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><a href="custalk_edit.php?cuse_id=<?php echo $row['cuse_id'];?>"><?php echo $row['ost_status']; ?></a></td>
											<td><?php echo $row['cuse_date']; ?></td>
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
