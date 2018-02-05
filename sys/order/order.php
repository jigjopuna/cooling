<?php session_start();
	  require_once('../include/connect.php');
	  
	 $dates = date('Y-m-d');
	  
	  //for left nav menu path include/navproduct.php
	/*$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);*/
	
	//Product Expandtion
	$sql_all = "SELECT o.o_id, c.cust_name, c.cust_corp, c.cust_tel, p.pro_name, o.o_status, o.o_temp, o.o_voltage, o.o_size, ost.ost_status, e.e_name 
				FROM (((tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id) 
					 JOIN province p ON c.cust_province = p.id) 
					 JOIN tb_ord_status ost ON ost.ost_id = o.o_status)
					 JOIN tb_emp e ON e.e_id = o.o_emp";
	$result_all = mysql_query($sql_all);
	$num_all = mysql_num_rows($result_all);
	

	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
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
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		$('#date_pay, #date_delivery').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
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
                <div class="col-lg-12">
                    <h1 class="page-header">เพิ่มออเดอร์</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มออเดอร์
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/order/addorder.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ </label>
											<input type="text" class="form-control" id="ord_temp" name="ord_temp">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กำหนดส่ง</label>
											<input type="text" class="form-control" id="date_delivery" name="date_delivery">
										</div>

										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอม 220/380</label>
											<select class="form-control" id="voltage" name="voltage">
												<option value="0">เลือกแรงดัน</option> 
												<option value="220">220</option>
												<option value="380">380</option>
												
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ใบเสนอราคา</label>
											<input type="file" class="form-control require" id="ord_quotation" name="ord_quotation">
										</div>
										
										
										
									</div>
									
									
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ขนาดห้อง </label>
											<input type="text" class="form-control" id="ord_size" name="ord_size">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาขาย</label>
											<input type="text" class="form-control" id="ord_price" name="ord_price">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกออเดอร์ใหม่</button>
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
                    <h1 class="page-header">ออเดอร์ลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ออเดอร์ลูกค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ลำดับ</th>
                                        <th style='width: 15%;'>ลูกค้า</th>
										<th style='width: 10%;'>จังหวัด</th>
                                        <th style='width: 10%;'>สถานะ</th>      
                                        <th style='width: 10%;'>ขนาดห้อง</th>
										<th style='width: 5%;'>อุณหภูมิ</th>
										<th style='width: 5%;'>คอม 220/380</th>
										<th style='width: 15%;'>เบอร์ติดต่อ</th>
										<th style='width: 15%;'>ผู้รับผิดชอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_all; $i++){
										  $row_all = mysql_fetch_array($result_all);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_all['o_id']; ?></td>  
											<td><a href="order_detail.php?o_id=<?php echo $row_all['o_id'];?>&cust_name=<?php echo $row_all['cust_name'];?>"><?php echo $row_all['cust_name']; ?></td>	
											<td><?php echo $row_all['pro_name']; ?></td>   
											
											<?php if($row_all['o_status']==5) { ?>
												<td style="background-color: #315ab2; color:red; font-weight:bold;"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } else if($row_all['o_status']==1) { ?>
												<td style="background-color: #f7f3ba"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } else if($row_all['o_status']==7){ ?>
												<td style="background-color: #feacc3"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<? } else if($row_all['o_status']==6) { ?>
												<td style="background-color: #baf7ee"><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } else {?>
												<td><a href="edit_ord_status.php?o_id=<?php echo $row_all['o_id']?>"><?php echo $row_all['ost_status']; ?></a></td>
											<?php } ?>
											
											
											<td><?php echo $row_all['o_size']; ?></td>
											<td><?php echo $row_all['o_temp']; ?></td>
											<td><?php echo $row_all['o_voltage']; ?></td>
											<td><?php echo $row_all['cust_tel']; ?></td>
											<td><?php echo $row_all['e_name']; ?></td>
											          
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
