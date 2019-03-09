<?php session_start();
	  require_once('../include/connect.php');
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
		
		$cuseid = trim($_GET['cuse_id']);
		
		$curstatu = mysql_fetch_array(mysql_query("SELECT * FROM  tb_custsell WHERE cuse_id = '$cuseid'"));
		$curstaid = $curstatu['cuse_id']; 
		
		$sql = "SELECT * FROM tb_ord_status WHERE ost_type = 0";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
	?>
</head>
<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เปลี่ยนสถานะงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เปลี่ยนสถานะงาน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/cust/custtalk_edits.php" id="form1" name="form" method="post" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สถานะงาน </label>
										    <select class="form-control" id="cu_status" name="cu_status">
											<?php 
												for($i=1; $i<=$num; $i++){
													$row = mysql_fetch_array($result);												
											?>						
												<option value="<?php echo $row['ost_id']?>" <?php if($row['ost_id']==$curstaid) echo "selected" ?>><?php echo $row['ost_status']?></option>
												
											<?php } ?>
										</select>
										</div>
									
										
									</div>
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูล</button>
										</div>
									</div>
	
									<div class="col-lg-4">
										<input type="hidden" name="linecust" value="<?php echo $curstaid; ?>">
									</div>
									
								</form>
							 </div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
