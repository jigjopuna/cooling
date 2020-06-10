<?php session_start();
	  require_once('../include/connect.php');
	  $ord_id = trim($_GET['o_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		
		function validation(){
			$('#form1').submit();		
		}		
	});
</script>
<title>เตรียมของเสร็จหรือยัง</title>
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
                    <h1 class="page-header">เตรียมของ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เปลี่ยนสถานะเตรียมของ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/prepare_edit.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เตรียมของเสร็จแล้ว</label>
											<input type="checkbox" class="form-control" id="ord_prepare" name="ord_prepare">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">อัปเดท</button>
										</div>
										
									</div>
									
									
									<div class="col-lg-3">
										<input type="hidden" value="<?php echo $ord_id; ?>" name="ord_id">
									</div>
																		
									<div class="col-lg-3">
										
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
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
