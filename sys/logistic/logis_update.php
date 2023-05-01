<?php session_start();
	  require_once('../include/connect.php');
	
	$jid = $_GET['j_id'];
	
	$result = mysql_query("SELECT * FROM tb_journey WHERE j_id = $jid");
	$row = mysql_fetch_array($result);	
	
	$e_id = $row['j_emp'];
	
	
	
	$sqlv = "SELECT * FROM tb_vehicle";
	$resultv = mysql_query($sqlv);
	$numv = mysql_num_rows($resultv);

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>บันทึกเดินทาง</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php'); ?>




<script>
	$(document).ready(function(){ 
		$('#btn-save').click(validation);
		$('#date1, #date2').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		$("#search_emp").autocomplete({
				source: "../../ajax/search_emp.php",
				minLength: 1
		});
		
		$("#search_ord").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
		});
		
		function validation(){
			
			var kilo01 = $('#kilo1').val();
			var cars = $('#car').val();
			var j_name = $('#j_name').val();
			
			
			if(kilo01 == '' || isNaN(kilo01)){
				alert("ใส่เลขกิโลให้ถูกต้อง ด้วยนะคะ"); 
				return false;
				
			}else if(j_name ==''){
				alert("ใส่รายการเดินทาง ด้วยนะคะ"); 
				return false;
				
			}else if(cars == 0){
				alert("เลือกรถ ด้วยนะคะ"); 
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

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">การเดินทาง</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							การเดินทาง
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/logistic/edit_logis.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> รถ</label>
											<select class="form-control" id="car" name="car">
												
												<option value="0">เลือกรถ</option> 
												<?php 
													for($i=1; $i<=$numv; $i++){
														$rowv = mysql_fetch_array($resultv);
													
												?>						
												<option value="<?php echo $rowv['v_id']?>" <?php if( $rowv['v_id']==$row['j_car']) echo "selected" ?>><?php echo $rowv['v_name']?></option>
												
												<?php } ?> 
												
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รายละเอียดเดินทาง</label>
											<input type="text" class="form-control require" id="j_name" name="j_name" value="<?php echo $row['j_name']?>">
										</div>
										
										
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลขกิโล เริ่ม</label>
											<input type="text" class="form-control" id="kilo1" name="kilo1" value="<?php echo $row['j_kilo1']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่เดินทาง</label>
											<input type="text" class="form-control" id="date1" name="date1" value="<?php echo $row['j_time1'];?>">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลขกิโล สุดท้าย</label>
											<input type="text" class="form-control" id="kilo2" name="kilo2" value="<?php echo $row['j_kilo2']?>">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่กลับ</label>
											<input type="text" class="form-control" id="date2" name="date2" value="<?php echo $row['j_time2'];?>">
										</div>
										
										
										<div class="form-group has-success">
											<button id="btn-save" type="button" class="btn btn-lg btn-success btn-block">อัปเดทการเดินทาง</button>
										</div>
									</div>
									<input type="hidden" class="form-control require" id="jid" name="jid" value="<?php echo $jid;?>">
								</form>
							 </div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>		
        </div>
		
		
		
		
            
            
			
			<div class="row">
                <div class="col-lg-3">
                 Journy id  =  <?php echo $jid;?><br>&nbsp;<br>
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
