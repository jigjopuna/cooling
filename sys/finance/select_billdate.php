<?php session_start();
	  require_once('../include/connect.php');
	  
	  $year = date("Y");
	  $month = date('m');
	  if($month < 10){
		  $months = '0'.$month;
	  }else {
		  $months = $month;
	  }
	  
	  $select_month =  $year.'-'.$months.'%';
	  //$select_month = '2019%';
	  $sql = "SELECT MONTHNAME(o_date) month, COUNT(o_id) ordqty, SUM(o_price) price
			  FROM tb_orders
			  WHERE o_date LIKE '$year%' AND o_type LIKE '1%'
			  GROUP BY YEAR(o_date), MONTH(o_date)";
	  $result = mysql_query($sql);
	  $num = mysql_num_rows($result);
	  
	  

	 
	 

	  	  
	   
	  

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			//$("#rep_datecover, #rep_monthcover, #rep_weekcover, #rep_yearcover").hide();
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
				$("#rep_yearcover").hide();
				$("#rep_weekcover").hide();
			}else if(timesal==2){
				$("#rep_datecover").hide();
				$("#rep_monthcover").hide();
				$("#rep_yearcover").hide();
				$("#rep_weekcover").show();
			}else if(timesal==3){
				$("#rep_datecover").hide();
				$("#rep_monthcover").show();
				$("#rep_yearcover").hide();
				$("#rep_weekcover").hide();
			}else{
				$("#rep_monthcover").hide();
				$("#rep_yearcover").show();
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
				$('#form1').attr('action','totalord.php');
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
                    <h1 class="page-header">เลือกวันที่</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เลือกเดือนที่ออกบิล
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/receive_paper_all.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success" id="rep_yearcover">
											<label class="control-label" for="inputSuccess">เลือกปี</label>
											<select class="form-control" id="rep_year" name="rep_year">
												<option value="2023">2023</option>
												<option value="2017">2017</option>
												<option value="2018">2018</option>
												<option value="2019">2019</option>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
												<option value="2022">2022</option>
												<option value="2023">2023</option>
												<option value="2024">2024</option>
												<option value="2025">2025</option>
												
											</select>
										</div>
									</div>
																		
									<div class="col-lg-4">
										
										
										<div class="form-group has-success" id="rep_monthcover">
											<label class="control-label" for="inputSuccess">เดือน</label>
											<select class="form-control" id="rep_month" name="rep_month">
												<option value="0">เลือกเดือน</option>
												<option value="01">มกราคม</option>
												<option value="02">กุมภาพันธ์</option>
												<option value="03">มีนาคม</option>
												<option value="04">เมษายน</option>
												<option value="05">พฤษภาคม</option>
												<option value="06">มิถุนายน</option>
												<option value="07">กรกฏาคม</option>
												<option value="08">สิงหาคม</option>
												<option value="09">กันยายน</option>
												<option value="10">ตุลาคม</option>
												<option value="11">พฤศจิกายน</option>
												<option value="12">ธันวาคม</option>												
											</select>
										</div>
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ดูบิล</button>
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
