<?php session_start();
	  require_once('../include/connect.php');
	  
	$sql = "SELECT * FROM tb_mcenter";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$today = date("Y-m-d");	  
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>เงินส่วนกลาง</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
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
	
<script>
	$(document).ready(function(){ 
		
	});
</script> 
</head>
<body>
	<div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เงินส่วนกลาง</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มรายการโอนเข้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/finance/addpayin.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> หมายเลข ออเดอร์ </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname" placeholder="ใส่ชื่อลูกค้า">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวนเงิน</label>
											<input type="text" class="form-control" id="payamount" name="payamount">
										</div>
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">บิล/เอกสาร</label>
											<input type="file" class="form-control require" id="payinbill" name="payinbill">
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คนรับเงิน</label>
											<input type="text" class="form-control" id="search_emp" name="search_emp">
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
		
		 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ยอดโอนเข้า</h1>
                </div>
                <!-- /.col-lg-12 -->
         </div>
		
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ยอดโอนเข้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายได้จาก</th>                                     
                                        <th>ยอด</th>
                                        <th>วันที่</th>
										<th>เงินออก</th>
										<th>คงเหลือ</th>
										<th>ดูบิล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['m_id']; ?></td>
											<td><?php echo number_format($row['m_in'], 0, '.', ','); ?></td>
											<td><?php echo number_format($row['m_remain'], 0, '.', ','); ?></td>
											<td><a href="../images/mcenter/<?php echo $row['m_bill'];?>" target="_blank">ดูบิล</a></td>											
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
</html>
