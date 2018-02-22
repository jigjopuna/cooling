<?php session_start();
	require_once('../include/connect.php');
	$cate_id = trim($_GET['cate_id']);

	//for left nav menu path include/navproduct.php
	$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>เพิ่มลูกค้า</title>
	
	<?php require_once ('../include/header.php');?>
	<?php require_once('../include/metatagsys.php');?>
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
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			multiList();
			$('#btn').click(validation);

	});//end ready
	
	function multiList(){
		$("#province").load("../../ajax/province_server.php");
		$("#province").change(function(){
	  		 var url = "../../ajax/amphur_server.php";
	  		 var param = "province="+$("#province").val();
	   
		   $.ajax({
				url      : url,
				data     : param,
				dataType : "html",
				type     : "POST",
				success: function(result){
					$("#amphur").html(result);	
				}
			});//end ajax province
		   $("#tumbon").html('');
	    });// end change province
		
		
		$("#amphur").load("../../ajax/amphur_onload.php");
		$("#amphur").change(function(){
			   var url = "../../ajax/tumbon_server.php";
			   var param = "amphur="+$("#amphur").val();
			   
			   $.ajax({
					url      : url,
					data     : param,
					dataType : "html",
					type     : "POST",
					success: function(result){
						$("#tumbon").html(result);	
					}
				});  //end ajax amphur
			});//end change amphur
	
			$("#tumbon").load("../../ajax/tumbon_onload.php");
		}// end fn multiList0
		
		
		function validation(){
			var custname = $('#cust_name').val();
			if(custname==''){
				$('#cust_name ').val("ยังไม่ได้ใส่ชื่อลูกค้า");
			}
			
			if($('#province').val()==0){
				 alert('เลือกจังหวัดด้วยนะค่ะ');
				 return false;
			}
			
			if($('#amphur').val()==0){
				 alert('เลือกอำเภอด้วยนะค่ะ');
				 return false;
			}
			
			if($('#tumbon').val()==0){
				 alert('เลือกตำบลด้วยนะค่ะ');
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
                    <h1 class="page-header">เพิ่มลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มลูกค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="cust_add_save.php" id="form1" name="form" method="post">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อ-นามสกุลลูกค้า </label>
											<input type="text" class="form-control" id="cust_name" name="cust_name">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">บริษัท</label>
											<input type="text" class="form-control" id="cust_corp" name="cust_corp">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จังหวัด </label>
											<select class="form-control" id="province" name="province">
												 							
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อำเภอ </label>
											<select class="form-control" id="amphur" name="amphur">
																				
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ตำบล </label>
											<select class="form-control" id="tumbon" name="tumbon">
												 							
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หมายเลขผู้เสียภาษี</label>
											<input type="text" class="form-control" id="taxid" name="taxid">
										</div>
										
									</div>
									
									<div class="col-lg-3">
									
										
										
										<div class="form-group">
										  <label for="comment">ที่อยู่</label>
										  <textarea class="form-control" rows="5" id="address" name="address"></textarea>
										</div>
										

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รหัสไปรษณีย์</label>
											<input type="text" class="form-control" id="zipcode" name="zipcode">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบอร์ติดต่อ</label>
											<input type="text" class="form-control" id="phoneno" name="phoneno">
										</div>
										
										
										

									</div>
									
									<div class="col-lg-3">
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">Email</label>
											<input type="text" class="form-control" id="email" name="email">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อื่นๆ </label>
											<input type="text" class="form-control" id="other" name="other">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">Line </label>
											<input type="text" class="form-control" id="line_id" name="line_id">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">แผ่นที่</label>
											<input type="text" class="form-control" id="cust_map" name="cust_map">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูลลูกค้า</button>
										</div>
										
									</div>
									
			
			
									<div class="col-lg-3">
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">Email</label>
											<input type="text" class="form-control" id="email" name="email">
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
