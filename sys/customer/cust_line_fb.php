<?php session_start();
	  require_once('../include/connect.php');
	  
	$dates = date('Y-m-d');
	$sql = "SELECT * FROM tb_line_fb_status ORDER BY tb_flsname";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<script>
		$(document).ready(function(){
			multiList();
			$('#btn').click(validation);
			

	});//end ready
	
	function multiList(){
		$("#province").load("../../ajax/province_server.php");
		//$('#datecontact').datepicker({dateFormat: 'yy-mm-dd'});
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
			if($('#chk_custallow:checked').length != 1){
				//ให้ข้อมูล
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
				
				var phoneno = $('#phoneno').val();
				if(phoneno==''){
					alert('ใส่เบอร์ลูกค้าด้วย');
					return false;
				}
	
			}// end if ให้ข้อมูล
			
			var custname = $('#cust_name').val();
			if(custname==''){
				alert('ยังไม่ได้ใส่ชื่อลูกค้า');
				return false;
			}
			
			
			
			
			$('#form1').submit();
			
		}
	</script>  
    <title>ผู้ติดต่อ</title>	
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
                    <h1 class="page-header">ผู้ติดต่อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							รายละเอียดผู้ติดต่อ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/cust/lineface.php" id="form1" name="form" method="post">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">facebook</label>
											<input type="radio" class="form-control" name="referer" value="facebook">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">Line</label>
											<input type="radio" class="form-control" name="referer" value="line">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อื่นๆ</label>
											<input type="radio" class="form-control" name="referer" value="others">
										</div>
										
										
									</div>

									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อ Line/Facebook</label>
											<input type="text" class="form-control" id="cust_name" name="cust_name">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จังหวัด </label>
											<select class="form-control" id="province" name="fb_province">
												 							
											</select>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สถานะ </label>
											<select class="form-control" id="fb_status" name="fb_status">
												<option value="">เลือกสถานะงาน</option> 
												<?php 
													for($i=1; $i<=$num; $i++){
														$row = mysql_fetch_array($result);												
												?>						
												<option value="<?php echo $row['tb_fls']?>"><?php echo $row['tb_flsname']?></option>	
												<?php } ?>
											</select>
										</div>
									</div>
									
			
			
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบอร์ติดต่อ</label>
											<input type="text" class="form-control" id="fb_phoneno" name="fb_phoneno">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="datecontact" name="datecontact" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกผู้ติดต่อ</button>
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
