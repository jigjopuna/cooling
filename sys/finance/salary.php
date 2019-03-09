<?php session_start();
	  require_once('../include/connect.php');
	
	//โอนเข้ามา
	$sql = "SELECT s.sal_id, e.e_name, s.sal_amount, s.sal_bill, s.sal_date, s.sal_comment FROM tb_emp e JOIN tb_salary s ON e.e_id = s.sal_emp";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$today = date("Y-m-d");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>ค่าตอบแทนพนักงาน</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php');
	  if($role['ro_salary'] !=1 ){ exit("<script>alert('ไม่มีสิทธิ์ในการเข้าถึงนะคะ');window.location = '../index.php';</script>"); }
?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>

<script>
	$(document).ready(function(){ 
		$('.btn-success').click(validation);
		$('#paydate').datepicker({dateFormat: 'yy-mm-dd'});
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
			var search_custname = $('#search_custname').val();
			var payinqty = $('#payinqty').val();
			var paydate = $('#paydate').val();
			if((search_custname=='') || (payinqty=='') || (paydate=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
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
                <div class="col-lg-4">
					<a href="working1.php"><button type="button" class="btn btn-lg btn-success btn-block">บันทึกการทำงาน</button></a>
				</div>
				
				<div class="col-lg-4">
					<a href="../salary/report.php"><button type="button" class="btn btn-lg btn-success btn-block">ข้อมูลการทำงาน</button></a>
				</div>
                <!-- /.col-lg-12 -->
            </div>
			
            <div class="row">
                <div class="col-lg-12">
					
                    <h1 class="page-header">ค่าตอบแทนพนักงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ค่าตอบแทนพนักงาน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ชื่อ</th>                                     
                                        <th>จำนวนเงิน</th>
                                        <th>วันที่</th>
										<th>คอมเม้น</th>
										<th>ดูบิล</th>
                                    </tr>
                                </thead>
                                <tbody> 
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td style='width: 10%;'><?php echo $row['sal_id'];?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><?php echo number_format($row['sal_amount'], 0, '.', ','); ?></td>
											<td><?php echo $row['sal_date']; ?></td>
											<td><?php echo $row['sal_comment']; ?></td>				
											<td><a href="../images/salary/<?php echo $row['sal_bill'];?>" target="_blank">ดูสลิป</a></td>		
													
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
			
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">กรอกเดือนพนักงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							กรอกเดือนพนักงาน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/finance/salary.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อพนักงาน </label>
											<input type="text" class="form-control" id="search_emp" name="search_emp">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวนเงิน</label>
											<input type="text" class="form-control" id="payamount" name="payamount">
										</div>
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">sal_commentบิล/เอกสาร</label>
											<input type="file" class="form-control require" id="sal_bill" name="sal_bill">
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอมเม้นท์</label>
											<input type="text" class="form-control" id="sal_comment" name="sal_comment">
										</div>
										
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="paydate" name="paydate" value="<?php echo $today;?>">
										</div>
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกรายการสั่งซื้อ</button>
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>