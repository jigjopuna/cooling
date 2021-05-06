<?php session_start();
	  require_once('../include/connect.php');
	  $cust_id = trim($_GET['cust_id']);
	
	  $cust = mysql_fetch_array(mysql_query("SELECT * 
											 FROM (((tb_cust_depo c JOIN province p ON p.id=c.cuplt_province)
													JOIN amphur a ON a.id=c.cuplt_amphur)
													JOIN tumbon t ON t.id = c.cuplt_tumbon )
											 WHERE cuplt_id = '$cust_id'"));
											 
		$mapcust = $cust['cust_location'];
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
		<?php 
			require_once('../include/inc_role.php'); 
			require_once ('../include/navplt.php');
			if($ro_order!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูออเดอร์นะคะ'); window.location = '../order/ord_plt.php';</script>");}
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">แก้ไขข้อมูลลูกค้า PLT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							แก้ไขข้อมูลลูกค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="cust_edit_save_plt.php" id="form1" name="form" method="post">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อ-นามสกุลลูกค้า </label>
											<input type="text" class="form-control" id="cust_name" name="cust_name" value="<?php echo $cust['cuplt_name']?>">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จังหวัด </label>
											<select class="form-control" id="province" name="province">
												 <option value="<?php echo $cust['cuplt_province']?>"><?php echo $cust['pro_name']?></option>					
											</select>
											
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อำเภอ </label>
											<select class="form-control" id="amphur" name="amphur">
												<option value="<?php echo $cust['cuplt_amphur']?>"><?php echo $cust['amp_name']?></option>								
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ตำบล </label>
											<select class="form-control" id="tumbon" name="tumbon">
												<option value="<?php echo $cust['cuplt_tumbon']?>"><?php echo $cust['tum_name']?></option>											 							
											</select>
										</div>
										
										<div class="form-group">
										  <label for="comment">Token ไลน์</label>
										  <textarea class="form-control" rows="5" id="token" name="token"><?php echo $cust['cuplt_token']?></textarea>
										</div>
										
									</div>
									
									
									
									
									<div class="col-lg-3">
										<div class="form-group">
										  <label for="comment">ที่อยู่</label>
										  <textarea class="form-control" rows="5" id="address" name="address"><?php echo $cust['cuplt_address']?></textarea>
										</div>
										

										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รหัสไปรษณีย์</label>
											<input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo $cust['cuplt_zip']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบอร์ติดต่อ</label>
											<input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo $cust['cuplt_tel']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หมายเลขผู้เสียภาษี</label>
											<input type="text" class="form-control" id="taxid" name="taxid" value="<?php echo $cust['cuplt_tax']?>">
										</div>
									</div>
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">Email</label>
											<input type="text" class="form-control" id="email" name="email" value="<?php echo $cust['cuplt_email']?>">
										</div>
										
										
									
										
																			
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">Line </label>
											<input type="text" class="form-control" id="line_id" name="line_id" value="<?php echo $cust['cuplt_lineid']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">แผ่นที่</label>
											<input type="text" class="form-control" id="cust_map" name="cust_map" value="<?php echo $mapcust;?>">
										</div>
										
										<div class="form-group has-success">
											<?php if($mapcust!= '') { ?>
												<a href="https://www.google.com/maps/?q=<?php echo $mapcust;?>"><button id="" type="button" class="btn btn-lg btn-success btn-block">แผ่นที่</button></a>
											<?php } else { ?>
												<button id="" type="button" class="btn btn-lg btn-block">No Maps</button>
											<?php } ?>
										</div>
									</div>
									

									
									
									
									<div class="col-lg-3">
									
										<div class="form-group has-success">
												<label class="control-label" for="inputSuccess">อุณหภูมิต่ำสุด</label>
												<input type="text" class="form-control" id="temp_min" name="temp_min" value="<?php echo $cust['cuplt_mintemp']?>">
											</div>
											
											<div class="form-group has-success">
												<label class="control-label" for="inputSuccess">อุณหภูมิสูงสุด</label>
												<input type="text" class="form-control" id="temp_max" name="temp_max" value="<?php echo $cust['cuplt_maxtemp']?>">
											</div>
											
											<div class="form-group has-success">
												<label class="control-label" for="inputSuccess">ระยะเวลา (ชั่วโมง)</label>
												<select class="form-control" name="temp_period" id="temp_period"> 
													<option value="3">3 </option>
													<option value="4">4 </option>
													<option value="5">5 </option>
													<option value="6">6 </option>
												</select>
											</div>
											
											<div class="form-group has-success">
												<label class="control-label" for="inputSuccess">แสดงผล</label>
												<input type="checkbox" class="form-control" id="sendline" name="sendline" checked="<?php if($cust['cuplt_notify']==1) echo 'checked'?>">
											</div>
										
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูลลูกค้า</button>
										</div>
										
									</div>
									
									<input type="hidden" name="cust_id" value="<?php echo $cust_id?>">
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