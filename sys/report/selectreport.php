<?php session_start();
	  require_once('../include/connect.php');
	  
	  $year = date("Y");
	  
	  $sql = "SELECT MONTHNAME(o_date) month, COUNT(o_id) ordqty, SUM(o_price) price
			  FROM tb_orders
			  WHERE o_date LIKE '$year%'
			  GROUP BY YEAR(o_date), MONTH(o_date)";
	  $result = mysql_query($sql);
	  $num = mysql_num_rows($result);
	  
	  
	  $sumyear = mysql_fetch_array(mysql_query("
					    SELECT SUM(A.price) sumyear
						FROM (
							SELECT MONTHNAME(o_date) month, COUNT(o_id) ordqty, SUM(o_price) price
							FROM tb_orders
							WHERE o_date LIKE '$year%'
							GROUP BY YEAR(o_date), MONTH(o_date)
							) AS A"));
	 $yearamount = $sumyear['sumyear'];
	  
	   
	  

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
			$("#rep_datecover, #rep_monthcover, #rep_weekcover, #rep_yearcover").hide();
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
												<option value="1">รายวัน</option>
												<option value="2" disabled>รายสัปดาห์</option>
												<option value="3">รายเดือน</option>
												<option value="4">รายปี</option>		
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
										
										<div class="form-group has-success" id="rep_yearcover">
											<label class="control-label" for="inputSuccess">เลือกปี</label>
											<select class="form-control" id="rep_year" name="rep_year">
												<option value="0">เลือกปี</option>
												<option value="2017">2017</option>
												<option value="2018">2018</option>
												<option value="2019">2019</option>
												<option value="2020">2020</option>								
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
		
		
		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รายงานประจำเดือน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								<span style="background-color: yellow;">ยอดขายปี <?php echo $year.' : '.number_format($yearamount, 0, '.', ',');?>  บาท </span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
										<th>เดือน</th>
                                        <th>จำนวนห้อง</th> 
										<th>ยอดขาย</th>
										
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $i; ?></td>
											<td><?php echo $row['month']; ?></td>
											<td><?php echo number_format($row['ordqty'], 0, '.', ','); ?></td>
											<td><?php echo number_format($row['price'], 0, '.', ','); ?></td>
											
										</tr>
									<?php } ?>

                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
