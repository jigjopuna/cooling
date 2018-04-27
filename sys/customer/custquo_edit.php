<?php session_start();
	require_once('../include/connect.php');
	$custquo_id = trim($_GET['custquo_id']);
	
	//$row = mysql_fetch_array(mysql_query("SELECT * FROM tb_quo_cust WHERE qcust_id = '$custquo_id'"));
	
	
	$row = mysql_fetch_array(mysql_query("SELECT * 
										 FROM (((tb_quo_cust q JOIN province p ON p.id=q.qcust_prov)
												JOIN amphur a ON a.id = q.qcuat_amphur)
												JOIN tumbon t ON t.id = q.qcust_tumbon)
										 WHERE qcust_id = '$custquo_id'"));
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
			//$("#province").load("../../ajax/province_server.php");
			
				 var url = "../../ajax/province_update.php";
				 var param = "province="+$("#province").val();   
			   $.ajax({
					url      : url,
					data     : param,
					dataType : "html",
					type     : "POST",
					success: function(result){
						$("#province").html(result);	
					}
				});	  

			
			
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
			});
		
		}
		
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
	
			}// end if ให้ข้อมูล
			
			var custname = $('#cust_name').val();
			if(custname==''){
				alert('ยังไม่ได้ใส่ชื่อลูกค้า');
				return false;
			}
			
			var phoneno = $('#phoneno').val();
			if(phoneno==''){
				alert('ใส่เบอร์ลูกค้าด้วย');
				return false;
			}
			
			
			$('#form1').submit();
			
		}
	</script>  
	
	<?php require_once('../include/header.php');?>
    <title>เพิ่มลูกค้า</title>	
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once('../include/inc_role.php'); ?>

</head>

<body>

    <div id="wrapper">
		<?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เพิ่มลูกค้า เพื่อขอใบเสนอราคา</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มลูกค้า เพื่อขอใบเสนอราคา
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/cust/custq_edit_save.php" id="form1" name="form" method="post">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อ-นามสกุลลูกค้า </label>
											<input type="text" class="form-control" id="cust_name" name="cust_name" value="<?php echo $row['qcust_name']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบอร์ติดต่อ</label>
											<input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo $row['qcust_tel']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้าไม่ให้ข้อมูล</label>
											<input type="checkbox" class="form-control" id="chk_custallow" name="chk_custallow">
										</div>
									</div>

									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จังหวัด </label>
											<select class="form-control" id="province" name="province">
												 <option value="<?php echo $row['qcust_prov']?>"><?php echo $row['pro_name']?></option>										
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อำเภอ </label>
											<select class="form-control" id="amphur" name="amphur">
												<option value="<?php echo $row['qcuat_amphur']?>"><?php echo $row['amp_name']?></option>					
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ตำบล </label>
											<select class="form-control" id="tumbon" name="tumbon">
												 <option value="<?php echo $row['qcust_tumbon']?>"><?php echo $row['tum_name']?></option>								
											</select>
										</div>
									</div>
									
									<div class="col-lg-3">
										
										<div class="form-group">
										  <label for="comment">ที่อยู่</label>
										  <textarea class="form-control" rows="5" id="address" name="address"><?php echo $row['qcust_addr']?></textarea>
										</div>
										

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รหัสไปรษณีย์</label>
											<input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo $row['qcust_zip']?>">
										</div>
									</div>
									
			
			
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หมายเลขผู้เสียภาษี</label>
											<input type="text" class="form-control" id="taxid" name="taxid" value="<?php echo $row['qcust_tax']?>">
										</div>
										
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูลลูกค้า</button>
										</div>
										
									</div>
									<input type="hidden" name="custquo_id" value="<?php echo $custquo_id;?>">
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
