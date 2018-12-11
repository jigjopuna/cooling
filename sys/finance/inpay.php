<?php session_start();
	  require_once('../include/connect.php');
	
	//โอนเข้ามา
	$sql = "SELECT op.pay_id, c.cust_name, op.pay_amount, op.pay_date, o.o_id, e.e_name, op.pay_bill
			FROM ((tb_orders o JOIN tb_ord_pay op ON o.o_id = op.o_id) 
				 JOIN tb_customer c ON c.cust_id = o.o_cust) JOIN tb_emp e ON e.e_id = op.o_emp_receive
			ORDER BY op.pay_date DESC LIMIT 0,50";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//find employee finance position หาคนรับเงิน
	$result_emp = mysql_query("SELECT e_id, e_name FROM tb_emp WHERE e_cash = 1");
	$num_emp = mysql_num_rows($result_emp);
	
	$today = date("Y-m-d");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รับเงิน</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>

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
			var search_ord = $('#search_ord').val(); 
			var payinqty = $('#payinqty').val();
			var paydate = $('#paydate').val();
			var emp_receive = $('#emp_receive').val();
			
			if(search_ord==''){
				alert('กรุณาเลือกลูกค้าด้วยนะค่ะ');
				return false;
			   }
				if((isNaN(search_ord))){
				alert('กรุณาใส่เลขออเดอร์ลูกค้านะค่ะ');
				return false;
			}
			
			if((search_ord=='') || (payinqty=='') || (paydate=='') || (emp_receive==0)){ 
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
                <div class="col-lg-12">
                    <h1 class="page-header">เพิ่มรายการโอนเข้า</h1>
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
											<input type="text" class="form-control" id="search_ord" name="search_ord" placeholder="ใส่ชื่อลูกค้า">
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
											<label class="control-label" for="inputSuccess">คนรับเงิน </label>
											<select class="form-control" id="emp_receive" name="emp_receive">
												<?php 
													for($i=1; $i<=$num_emp; $i++){
														$row_emp = mysql_fetch_array($result_emp);
													
												?>						
												<option value="<?php echo $row_emp['e_id']?>"><?php echo $row_emp['e_name']?></option>
												
												<?php } ?>											
											</select>
										</div>
										
										<!--<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คนรับเงิน</label>
											<input type="text" class="form-control" id="search_emp" name="search_emp">
										</div>-->
										
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
            <!-- /.row -->
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
                                        <th>ลูกค้า</th>                                     
                                        <th>จำนวนเงิน</th>
                                        <th>วันที่</th>
										<th>ผู้รับเงิน</th>
										<th>ดูบิล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td style='width: 2%;'><?php echo $row['pay_id'];?></td>
											<td><a href="../order/order_detail.php?o_id=<?php echo $row['o_id'] ?>"><?php echo $row['cust_name']; ?></td>
											<td><?php echo number_format($row['pay_amount'], 0, '.', ','); ?></td>
											<td><?php echo $row['pay_date']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><a href="../images/receive/<?php echo $row['pay_bill'];?>" target="_blank">ดูบิล</a></td>											
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
                <div class="col-lg-3">
                   <a href="insoon.php"><button type="button" class="btn btn-lg btn-primary btn-block">ยอดกำลังจะโอนเข้า</button></a>
                </div>
                
                 <div class="col-lg-3">
                  
                </div>
                
                 <div class="col-lg-3">
                   <a href="period.php"><button type="button" class="btn btn-lg btn-primary btn-block">เช็คงวด</button></a>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-3">
                  &nbsp;<br>&nbsp;<br>
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
