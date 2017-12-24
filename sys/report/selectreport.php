<?php session_start();
	  require_once('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php';</script>");}
	
	?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			$("#rep_datecover, #rep_monthcover, #rep_weekcover").hide();
			$('#rep_date').datepicker({dateFormat: 'yy-mm-dd'});
			$("#rep_time").change(showtime);
			$("#sel_rep").change(reports);
			
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});		
		});
		
		function showtime(){
			var timesal = $(this).val();
			if(timesal==1){
				$("#rep_datecover").show();
				$("#rep_monthcover").hide();
				$("#rep_weekcover").hide();
			}else if(timesal==2){
				$("#rep_datecover").hide();
				$("#rep_monthcover").hide();
				$("#rep_weekcover").show();
			}else if(timesal==3){
				$("#rep_datecover").hide();
				$("#rep_monthcover").show();
				$("#rep_weekcover").hide();
			}else{
				
			}
		}
		
		function validation(){		
			
			$('#form1').submit();
			
		}
		
		function reports(){
			var rep_type = ($(this).val());
			if(rep_type==1){
				$('#form1').attr('action','salreport.php');
			}else if(rep_type==2){
				$('#form1').attr('action','sellreport.php');
			}else if(rep_type==3){
				$('#form1').attr('action','tranreport.php');
			}else if(rep_type==4){
				$('#form1').attr('action','poreport.php');
			}else if(rep_type==5){
				$('#form1').attr('action','stockreport.php');
			}else if(rep_type==6){
				$('#form1').attr('action','burkreport.php');
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
                    <h1 class="page-header">เลือกรายงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เลือกรายงาน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<label class="control-label" for="inputSuccess">เลือกรายงาน </label>
											<select class="form-control" id="sel_rep" name="sel_rep">
												<option value="0">เลือกรายงาน</option>
												<option value="1" disabled >เงินเดือน</option>
												<option value="2">ยอดขาย</option>
												<option value="3">ยอดโอน</option>
												<option value="4">ซื้อของ</option>
												<option value="5">การใส่สต็อค</option>
												<option value="6">การเบิกสต็อค</option>
											
											</select>
									</div>
																		
									<div class="col-lg-4">
										<label class="control-label" for="inputSuccess">ช่วงเวลา </label>
											<select class="form-control" id="rep_time" name="rep_time">
												<option value="0">เลือกช่วงเวลา</option>
												<option value="1" disabled>รายวัน</option>
												<option value="2" disabled>รายสัปดาห์</option>
												<option value="3">รายเดือน</option>
												<option value="4" disabled>รายปี</option>		
											</select>
									</div>
									
									
									<div class="col-lg-4">
										
										
										<div class="form-group has-success" id="rep_datecover">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="rep_date" name="rep_date">
										</div>
										

										
										<div class="form-group has-success" id="rep_monthcover">
											<label class="control-label" for="inputSuccess">เดือน</label>
											<select class="form-control" id="rep_month" name="rep_month">
												<option value="0">เลือกเดือน</option>
												<option value="1">มกราคม</option>
												<option value="2">กุมภาพันธ์</option>
												<option value="3">มีนาคม</option>
												<option value="4">เมษายน</option>
												<option value="5">พฤษภาคม</option>
												<option value="6">มิถุนายน</option>
												<option value="7">กรกฏาคม</option>
												<option value="8">สิงหาคม</option>
												<option value="9">กันยายน</option>
												<option value="10">ตุลาคม</option>
												<option value="11">พฤศจิกายน</option>
												<option value="12">ธันวาคม</option>												
											</select>
										</div>
										
										<div class="form-group has-success" id="rep_weekcover">
											<label class="control-label" for="inputSuccess">สัปดาห์</label>
											<select class="form-control" id="rep_week" name="rep_week">
												<option value="0">เลือกสัปดาห์</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
																				
											</select>
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ดูรายงาน</button>
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

		<!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
