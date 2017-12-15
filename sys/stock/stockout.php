<?php session_start();
	  require_once('../include/connect.php');
	

	$sql = "SELECT ordp.orpd_id,t.t_id, t.t_name, e.e_name, c.cust_name, ordp.orpd_date, ordp.orpd_qty, ordp.orpd_e_aprv
			FROM (((tb_ord_prod ordp JOIN tb_orders o ON o.o_id = ordp.o_id) 
				JOIN tb_customer c ON c.cust_id = o.o_cust) 
				JOIN tb_emp e ON e.e_id = ordp.ot_emp)
				JOIN tb_tools t ON ordp.ot_id = t.t_id";
				
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
		
		
	$sql_tr = "SELECT e.e_name, orpd.orpd_id, orpd.orpd_date, orpd.orpd_qty, t.t_name, t.t_id, orpd.orpd_wh FROM (tb_ord_prod orpd JOIN tb_emp e ON e.e_id = orpd.orpd_e_aprv) JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd.o_id = 0 LIMIT 0,100";
	$result_tr= mysql_query($sql_tr);
	$num_tr = mysql_num_rows($result_tr);
	
	
	
	//รายชื่อคนจ่ายของ (ให้เบิก)
	/*$sql_apove = "SELECT ro.ro_emp_id, e.e_name FROM tb_role ro JOIN tb_emp e on ro.ro_emp_id = e.e_id WHERE ro_stock > 0";
	$result_apove = mysql_query($sql_apove);
	$num_apove = mysql_num_rows($result_apove);*/
	
	
	$today = date("Y-m-d");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ'); window.location = '../pages/login/login.php';</script>");}
		
		$role_ = mysql_fetch_array(mysql_query("SELECT ro_stock FROM tb_role WHERE ro_emp_id = '$e_id'"));
		$rolestock = $role_['ro_stock'];
	
	?>

<script>
	$(document).ready(function(){
		$('#btn').click(validation);
		$('#btntransfer').click(transvalidate);
		$('#stodate').datepicker({dateFormat: 'yy-mm-dd'}); 
		$("#search_tool, #tools").autocomplete({
				source: "../../ajax/search_tool.php",
				minLength: 1
		});
		$("#search_ord").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
		});
		
		$("#search_emp").autocomplete({
				source: "../../ajax/search_emp.php",
				minLength: 1
		});
		
		var ro_stock = $('#rolestock').html();
		if(ro_stock==1){
			$('#stktrwh option:eq(1)').prop("selected", true);
			$('#stktrwh option:eq(0)').prop("disabled", true);
			$('#stktrwh option:eq(2)').prop("disabled", true);
		}else if(ro_stock==2){
			$('#stktrwh option:eq(2)').prop("selected", true);
			$('#stktrwh option:eq(0)').prop("disabled", true);
			$('#stktrwh option:eq(1)').prop("disabled", true);
			
		}else{}		
	});
	
	function validation(){
		var search_tool = $('#search_tool').val();
		var berkqty = $('#berkqty').val();
		var search_emp = $('#search_emp').val();
		var search_ord = $('#search_ord').val();
		var stodate = $('#stodate').val();
		if(isNaN(berkqty)){
			alert('กรุณาจำนวนเบิกเป็นตัวเลข');
			return false;
		}
		if(isNaN(search_emp)){
			alert('เลือกคนเบิกให้ถูกต้อง');
			return false;
		}
		if(isNaN(search_ord)){
			alert('เลือกลูกค้า  ให้ถูกต้อง');
			return false;
		}
		if((search_tool=='') || (berkqty=='') || (search_emp=='') || (search_ord=='') || (stodate=='')){
			alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
		}else{
			$('#form1').submit();				
		}
	}
	
	function transvalidate(){
		var transferqty = $('#transferqty').val(); 
		var tools = $('#tools').val();
		if(isNaN(transferqty)){
			alert('กรุณาจำนวนโยกย้ายเป็นตัวเลข');
			return false;
		}
		if((transferqty=='') || (tools=='')){
			alert("ใส่ข้อมูลโยกย้ายให้ครบนะค่ะ"); 
		}else{
			$('#form2').submit();				
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
                    <h1 class="page-header">เบิกของ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เบิกของ
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/stock/addberk.php" method="post" name="form1" id="form1">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ของ (รวม นครปฐม กระทุ่มแบน)</label>
											<input type="text" class="form-control" id="search_tool" name="search_tool">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="berkqty" name="berkqty">
										</div>
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">งานของลูกค้า</label>
											<input type="text" class="form-control" id="search_ord" name="search_ord">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คนเบิก</label>
											<input type="text" class="form-control" id="search_emp" name="search_emp">
										</div>										
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่เบิก</label>
											<input type="text" class="form-control" id="stodate" name="stodate" value="<?php echo $today;?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอมเม้นท์</label>
											<input type="text" class="form-control" id="comment" name="comment">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกการเบิก</button>
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
                    <h1 class="page-header">รายการที่เบิก</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการที่เบิก
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>รายการ</th>
										<th>ออเดอร์ลูกค้า</th>
										<th>คนเบิก</th>
										<th>จำนวน</th>
                                        <th>วันที่เบิก</th>
										<th>คนจ่าย</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['orpd_id']; ?></td>
											<td><a href="stocklog.php?t_id=<?php echo $row['t_id']?>"><?php echo $row['t_name']; ?></a></td>
											<td><?php echo $row['cust_name']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><?php echo $row['orpd_qty']; ?></td>
											<td><?php echo $row['orpd_date']; ?></td>	
											<td><?php echo $row['orpd_e_aprv']; ?></td>											
										</tr>
									<?php } //end main for?>

                                    
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
                    <h1 class="page-header">รายการโยกย้าย</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการทโยกย้าย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>รายการ</th>
										<th>จำนวน</th>
										<th>คนจ่าย</th>
										<th>วันที่</th>
										<th>จาก</th>
										<th>ไป</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_tr; $i++){
										  $row_tr = mysql_fetch_array($result_tr);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_tr['orpd_id']; ?></td>
											<td><a href="stocklog.php?t_id=<?php echo $row_tr['t_id']?>"><?php echo $row_tr['t_name']; ?></a></td>
											<td><?php echo $row_tr['orpd_qty']; ?></td>
											<td><?php echo $row_tr['e_name']; ?></td>	
											<td><?php echo $row_tr['orpd_date']; ?></td>
											<td><?php 
													if($row_tr['orpd_wh']==2){
														echo 'นครปฐม';
													}else{
														echo 'กระทุ่มแบน';			
													}
												?>
											</td>
											
											<td><?php 
													if($row_tr['orpd_wh']==2){
														echo 'กระทุ่มแบน';
													}else{
														echo 'นครปฐม';			
													}
												?>
											</td>											
										</tr>
									<?php } //end main for?>

                                    
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
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							โยกย้าย
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/stock/transferstk.php" method="post" name="form1" id="form2">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ของ (รวม นครปฐม กระทุ่มแบน)</label>
											<input type="text" class="form-control" id="tools" name="tools">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="tran_date" name="tran_date" value="<?php echo $today;?>">
										</div>
										
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="transferqty" name="transferqty">
										</div>									
									</div>
									
									
									<div class="col-lg-4">
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ไป</label>
											<select class="form-control" id="stktrwh" name="stktrwh">
												<!--value จะผูกกับรหัส emp ชายกับพี่ไพรฑูรย์ -->
												<option value="0">เลือกโกดัง</option> 					
												<option value="3">กระทุ่มแบน</option>
												<option value="2">นครปฐม</option>
												
											</select>
										</div>	
										
										<div class="form-group has-success">
											<button id="btntransfer" type="button" class="btn btn-lg btn-success btn-block">บันทึกโยกย้าย</button>
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

<div style="display:none" id="rolestock"><?php echo $rolestock;?></div>   

</body>

</html>
