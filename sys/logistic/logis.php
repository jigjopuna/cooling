<?php session_start();
	  require_once('../include/connect.php');
	
	
	$sql = "SELECT * FROM tb_vehicle";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$today = date("Y-m-d");
	
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>บันทึกเดินทาง</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php'); ?>


<?php
	
	$sql_vehicle = "SELECT * FROM tb_journey j JOIN tb_vehicle v on j.j_car = v.v_id WHERE j_emp = $e_id";
	$result_vehicle = mysql_query($sql_vehicle);
	$num_vehicle = mysql_num_rows($result_vehicle);
?>

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
								<form action="../db/logistic/addlogis.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> รถ</label>
											<select class="form-control" id="car" name="car">
												<option value="0">เลือกรถ</option> 
												<?php for($i=1; $i<=$num; $i++) { 
													  $row = mysql_fetch_array($result);
													
												?>
												<option value="<?php echo $row['v_id'];?>"><?php echo $row['v_name'].' ('.$row['v_tabian'].')';?></option> 
												<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รายละเอียดเดินทาง</label>
											<input type="text" class="form-control require" id="j_name" name="j_name">
										</div>
										
										
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลขกิโล เริ่ม</label>
											<input type="text" class="form-control" id="kilo1" name="kilo1" value="">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่เดินทาง</label>
											<input type="text" class="form-control" id="date1" name="date1" value="<?php echo $today;?>">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลขกิโล สุดท้าย</label>
											<input type="text" class="form-control" id="kilo2" name="kilo2" value="">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่กลับ</label>
											<input type="text" class="form-control" id="date2" name="date2" value="<?php echo $today;?>">
										</div>
										
										
										<div class="form-group has-success">
											<button id="btn-save" type="button" class="btn btn-lg btn-success btn-block">บันทึกการเดินทาง</button>
										</div>
									</div>
									<input type="hidden" class="form-control require" id="emp" name="emp" value="<?php echo $e_id?>">
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
                 emp =  <?php echo $e_id;?><br>&nbsp;<br>
                </div>
            </div>
			
			<div class="vehicle">
				<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ตารางเดินรถ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 3%;'>ลำดับ</th>
                                        <th style='width: 30%;'>รายการ</th>
										<th style='width: 8%;'>รถ </th>
										<th style='width: 8%;'>กิโลเริ่ม</th>
										<th style='width: 8%;'>กิโลสุดท้าย</th>
										<th style='width: 15%;'>วันที่เริ่ม</th>
										<th style='width: 15%;'>วันที่สุดท้าย</th>

                                    </tr>
                                </thead>
                                <tbody>
									<?php for($i=1; $i<=$num_vehicle; $i++) { 
										$row_vehicle = mysql_fetch_array($result_vehicle);
									?>
                                     <tr>
										<td><?php echo $row_vehicle['j_id']?></td>
                                        <td><a href="logis_update.php?j_id=<?php echo $row_vehicle['j_id'] ?>"><?php echo $row_vehicle['j_name']?></a></td>
										<td><?php echo $row_vehicle['v_name']?></td>
										<td><?php echo number_format($row_vehicle['j_kilo1'], 0, '.', ','); ?></td>
										<td><?php echo number_format($row_vehicle['j_kilo2'], 0, '.', ','); ?></td>
										<td><?php echo $row_vehicle['j_time1']?></td>
										<td><?php echo $row_vehicle['j_time2']?></td>
                                    </tr>
									<?php } ?>
									
                                    
                                </tbody>
                            </table>
							<a href="../report/print/journey.php?e_id=<?php echo $e_id?>"><button  type="button" class="btn btn-lg btn-success btn-block">รายกงานการเดินทาง</button></a>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			</div><!-- end ajax machine-->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
