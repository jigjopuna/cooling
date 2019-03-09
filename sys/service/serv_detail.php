<?php session_start();
	  require_once('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
<?php 
	require_once ('../include/header.php');
	require_once('../include/metatagsys.php');
	$fixid = trim($_GET['fixid']);
	$custname = trim($_GET['custname']);
	
	/*echo 'fixid: '.$fixid.'<br>';
	echo 'cust_id: '.$custname.'<br>';*/
?>
	
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		function validation(){
			var ahlai = $('#ahlai').val();
			var ahlaicost = $('#ahlaicost').val();
			if(ahlai==''){
				alert("ใส่อะไหล่ด้วยนะค่ะ"); 
				return false;
			}else if(ahlaicost==''){
				alert("ใส่ราคาด้วยนะค่ะ"); 
				return false;
			}else{
				$('#form1').submit();				
			}
		}		
	});
</script>
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
                    <h1 class="page-header">งานเซอร์วิส <?php echo $custname?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มรายการอะไหล่
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/service/addprodserv.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อะไหล่ </label>
											<input type="text" class="form-control" id="ahlai" name="ahlai">
										</div>
									</div>
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคา</label>
											<input type="text" class="form-control" id="ahlaicost" name="ahlaicost">
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึก</button>
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
		
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
