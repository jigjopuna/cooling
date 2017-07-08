<?php session_start(); 
	require_once('../include/connect.php');
	$p_id = trim($_GET['p_id']);
	$p_cate = trim($_GET['p_cate']);

	$sql = "SELECT * FROM tb_product WHERE p_id = '$p_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>อัปเดท Expandtion</title>
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once ('../include/header.php');?>
	
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = '../pages/login/login.php';
				</script>");
		}
	
	?>
	
	<script>
		$(document).ready(function(){
			$('.btn-success').click(validation);
		});
		
		function validation(){
			var p_name = $('#p_name').val();
			var p_numya = $('#p_numya').val();
			var p_model = $('#p_model').val();
			var p_price = $('#p_price').val();
			var p_inlet = $('#p_inlet').val(); 
			var p_outlet = $('#p_outlet').val();
			if((p_name=='') || (p_numya=='') || (p_model=='') || (p_price='') || (p_inlet=='') || (p_outlet=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
			}
		}

	</script>  
</head>

<body>

    <div id="wrapper">
		<?php require_once ('../include/navproduct.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">อัปเดทรายการ Expandtion </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เอ็กแพนชั่น วาว
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <div class="row">
								<form action="../db/updateprod.php" method="post" name="form1" id="form1">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยีห้อ expand</label>
											<input type="text" class="form-control require" id="p_name" name="p_name" value="<?php echo $row['p_name']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">น้ำยา</label>
											<input type="text" class="form-control require" id="p_numya" name="p_numya" value="<?php echo $row['p_numya']?>">
										</div>
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รุ่น / model</label>
											<input type="text" class="form-control require" id="p_model" name="p_model" value="<?php echo $row['p_model']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาเต็ม</label> 
											<input type="text" class="form-control require" id="p_price" name="p_price" value="<?php echo $row['p_price']?>">
										</div>
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อเข้า (นิ้ว)</label>
											<input type="text" class="form-control require" id="p_inlet" name="p_inlet" value="<?php echo $row['p_inlet']?>">
										</div>
										
										
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อออก (นิ้ว)</label>
											<input type="text" class="form-control require" id="p_outlet" name="p_outlet" value="<?php echo $row['p_outlet']?>">
										</div>
										
										<div class="form-group has-success">
											<button type="button" class="btn btn-lg btn-success btn-block">แก้ไข</button>
										</div>
										
									 </div> <!-- row -->
									<input type="hidden" value="<?php echo $p_id?>" name="p_id">
									<input type="hidden" value="<?php echo $p_cate;?>" name="p_cate">	
								</form>
							
                           
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

    <!-- jQuery -->
	
    

    </script>

</body>

</html>
