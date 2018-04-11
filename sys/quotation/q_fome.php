<?php session_start();
	require_once('../include/connect.php');
	$cate_id = trim($_GET['cate_id']);

	//for left nav menu path include/navproduct.php
	$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//Product Expandtion
	$sql_all = "SELECT * FROM tb_product WHERE p_cate = '$cate_id' ORDER BY p_id DESC";
	$result_all = mysql_query($sql_all);
	$num_all = mysql_num_rows($result_all);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>ต้นทุนผนังห้องเย็นและอุปกรณ์</title>
	
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once ('../include/header.php');?>
	<?php require_once('../include/inc_role.php'); ?>
	<script>
		$(document).ready(function(){	
			$('#btn').click(validation);	
		});
	
	function validation(){
		  var r_width = $("#r_width").val();
		  if(r_width==''){
				alert('กรุณาใส่ความกว้างของห้องด้วยค่ะ');
				//$('#r_width').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_width))){
				alert('กรุณาใส่ความกว้างของห้องด้วยตัวเลขค่ะ');
				//$("#r_width").css("background-color","pink");
				return false;
		  }
		  
		  
		  var r_length = $("#r_length").val();
		  if(r_length==''){
				alert('กรุณาใส่ความยาวของห้องด้วยค่ะ');
				//$('#r_length').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_length))){
				alert('กรุณาใส่ความยาวของห้องด้วยตัวเลขค่ะ');
				//$('#r_length').css("background-color","pink");
				return false;
		  }
		  
		  
		  
		  var r_height = $("#r_height").val();
		  if(r_height==''){
				alert('กรุณาใส่ความสูงของห้องด้วยค่ะ');
				//$('#r_height').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_height))){
				alert('กรุณาใส่ความสูงของห้องด้วยตัวเลขค่ะ');
				//$("#r_height").css("background-color","pink");
				return false;
		  }  
		  
		  
		  var qty = $("#qty").val();
		  if(qty==''){
			  $("#qty").val(1000);
		  }
		  
		  var temp_before = $("#temp_before").val();
		  if(temp_before==''){
			  $("#temp_before").val(20);
		  }
		  
		  
		  
		  var temp_before = $("#temp_before").val();
		  if(temp_before==''){
				alert('กรุณาใส่อุณหภูมิด้วยค่ะ');
				//$('#temp_before').css("background-color","pink");
				return false;
			   }
				if((isNaN(temp_before))){
				alert('กรุณาใส่อุณหภูมิด้วยค่ะ');
				//$("#temp_before").css("background-color","pink");
				return false;
		  }
	      $('#form1').submit();
	}
	</script>  
</head>

<body>

    <div id="wrapper">
		<?php require_once ('../include/navproduct.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ต้นทุนผนังห้องเย็นและอุปกรณ์</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ต้นทุนผนังห้องเย็นและอุปกรณ์
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/fome.php" id="form1" name="form" method="post">
									<div class="col-lg-4">
										.
									</div>
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> กว้าง </label>
											<input type="text" class="form-control" id="r_width" name="r_width">
										</div>

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว</label>
											<input type="text" class="form-control" id="r_length" name="r_length">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง</label>
											<input type="text" class="form-control" id="r_height" name="r_height">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิที่ต้องการ  </label>
											<select class="form-control" id="temparature" name="temparature">
												<!--<option value="1">10 องศา ถึง 0</option>	
												<option value="2">0 องศา ถึง - 20</option>-->	
												<option value="1">25 องศา</option>	
												<option value="2">18 องศา</option>
												<option value="3">15 องศา</option>	
												<option value="4"> -5 องศา</option>	
												<option value="5">-12 องศา</option>	
												<option value="6">-15 องศา</option>
												<option value="7">-25 องศา</option>	
												<option value="8">-30 องศา</option>	
												<option value="9">-40 องศา</option>												
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ระยะเวลาลดอุณหภูมิสินค้า  </label>
											<select class="form-control" id="timeperiod" name="timeperiod">
												 <option value="18">18</option>
												<option value="12">12</option>
												<option value="8">8</option>
												<option value="6">6</option>								
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิสินค้าก่อนเข้าห้อง</label>
											<input type="text" class="form-control" id="temp_before" name="temp_before">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ปริมาณสินค้า/วัน</label>
											<input type="text" class="form-control" id="qty" name="qty">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">แสดงใบเสนอราคา</button>
										</div>

									</div>
									
									<div class="col-lg-4">
									.
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
	
    

    </script>

</body>

</html>
