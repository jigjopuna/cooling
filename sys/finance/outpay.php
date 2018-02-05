<?php session_start();
	  require_once('../include/connect.php');
	
	//PO LIST
	$sql = "SELECT p.po_emp, p.po_id, p.po_name, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_subyer, p.po_bill_img, p.po_date, p.po_shop, p.po_credit, p.po_credit_complete, e.e_id, e.e_name   
			FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id
			ORDER BY po_id DESC LIMIT 0,100";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sql_buyer = "SELECT e_id, e_name FROM tb_emp WHERE e_type = 1";
	$result_buyer = mysql_query($sql_buyer);
	$num_buyer = mysql_num_rows($result_buyer);
	
	//ดูว่าเงินส่วนกลางของชายหรือพี่ไพรฑูรย์ถูกใช่ไป
	$result_emp = mysql_query("SELECT e_id, e_name FROM tb_emp WHERE e_cash = 1");
	$num_emp = mysql_num_rows($result_emp);
	
	
	$monery = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cur_cash = $monery['cash_now'];
	$cash1 = $monery['cash1'];
	$cash2 = $monery['cash2'];
	$today = date("Y-m-d");
	
	
	//find employee finance position หาคนรับเงิน
	$result_from = mysql_query("SELECT e_id, e_name FROM tb_emp WHERE e_cash = 1");
	$num_from = mysql_num_rows($result_from);
	
	$result_empto = mysql_query("SELECT e_id, e_name FROM tb_emp WHERE e_cash = 1");
	$num_empto = mysql_num_rows($result_empto);
	
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
		$role = mysql_fetch_array(mysql_query("SELECT ro_po FROM tb_role WHERE ro_emp_id = '$e_id'"));
		$rolepo = $role['ro_po'];
		
	
	?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			$('#btn_tr').click(validation_tr);
			$('#podate, #tr_date').datepicker({dateFormat: 'yy-mm-dd'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
			$('#pocredit').change(credit);
			$('#pobuyer').change(chk_cash); 
			$('#poprice').blur(chkfieldcash);
			$('#owner_money').hide();
			$('#fromtransfer').change(cash_transfer);
			$('#totransfer option').prop("disabled", true);		
		});
		/*
		ตอนซื้อของเราอยากรู้ว่าเอาเงินส่วนไหนไปซื้อ เงินกองกลาง หรือ เงินส่วนตัว ถ้าเงินส่วนตัวซื้อแบบเครดิตหรือเปล่า
		ถ้าซื้อเครดิตจะใช้เงินส่วนกลางไม่ได้
		ถ้าจะซื้อด้วยเงินส่วนกลาง จะต้องเช็คก่อนว่าเงินกองกลางพอไหม
		*/
		
		/*เช็คตอนที่กรอกราคาเสร็จให้เช็คว่าใส่ราคามาเป็นตัวเลขหรือเปล่า และ เช็คว่า จะซื้อด้วยเงินกองกลางหรือเปล่า ถ้าเป็นเงินกองกลางก็ให้เช็คเงินกองกลางก่อนว่าพอไหม*/
		function chkfieldcash(){
			if((isNaN($(this).val()))){
				alert('กรุณาใส่ราคาด้วยตัวเลขค่ะ');
				return false;
			}
			if($('#pobuyer').val()==10){
				chk_cash();
				
			}		
		}
		
		function credit(){
			if($(this).prop('checked') == true){
				//alert('checked');
				$('#pobuyer option').last().prop('disabled',true);
				$('#pobuyer option:first-child').prop('selected',true);
			}else{
				//alert('un checked'); 
				$('#pobuyer option').last().prop('disabled', false);
			}
		}//end credit
		
		function chk_cash(){
			//if cash center
			if($('#pobuyer').val()==10){ 
				var url = "../../ajax/cash_center.php";
				var param = "poprice="+$("#poprice").val();
				   
				$.ajax({
					url      : url,
					data     : param,
					dataType : "html",
					type     : "POST",
					success: function(result){
						//$("body").html(result);	
						var cash_now = result;
						if(cash_now == 1){
							alert('เงินส่วนกลางไม่พอ'); 
							$('#btn').prop('disabled',true);
						}else{
							$('#btn').prop('disabled',false);
						}
					}
				});//end ajax 
				$('#owner_money').show();  //ถ้าเลือกส่วนกลางให้แสดงชื่อว่าใช้ส่วนกลางบัญชีชายหรือพี่ไพรฑูรย์
			}else{
				$('#btn').prop('disabled',false);
				$('#owner_money').hide();
			}
			//disablemp();
		}
		
		function validation(){
			var poname = $('#poname').val();
			var poqty = $('#poqty').val();
			var poprice = $('#poprice').val();
			var pobuyer = $('select[name=pobuyer]').val();
			var podate = $('#podate').val(); 
			var cashcenter = $('#pobuyer option:selected').val();
			var ownercash = $('#ownercash option:selected').val();
			if(isNaN(poprice)|| isNaN(poqty)){
				alert('กรุณาใส่จำนวนเงินเป็นตัวเลขค่ะ');
				return false;
			}			
			
			if((poname=='') || (poqty=='') || (poprice=='') || (pobuyer=='') || (pobuyer<=0) || (podate=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else if(cashcenter==10 && ownercash==0) {
				alert("เลือกบัญชีส่วนกลางด้วยค่ะ");				
			}else {
				$('#form1').submit();
			}
		}
		
		
		function validation_tr(){
			var fromtransfer = $('#fromtransfer').val();
			var totransfer = $('#totransfer').val();
			var tr_amount = $('#tr_amount').val();
			if(isNaN(tr_amount)){
				alert('กรุณาใส่จำนวนเงินเป็นตัวเลขค่ะ');
				return false;
			}
			
			if((fromtransfer==0) || (totransfer==0) || (tr_amount=='')){
				alert("เลือกผู้โอนกับรับโอน หรือกรอกเงินด้วยค่ะ"); 
			}else {
				$('#form2').submit();
			}
		}
		
		function cash_transfer(){
			var cashtr = $('#fromtransfer option:selected').val();	
			$('#totransfer option:eq(0)').prop("selected", true);
			if(cashtr==2 ){				
				$('#totransfer option:eq(2)').prop("disabled", false);	
				$('#totransfer option:eq(1)').prop("disabled", true);
			}else if (cashtr==3 ){
				$('#totransfer option:eq(1)').prop("disabled", false);
				$('#totransfer option:eq(2)').prop("disabled", true);				
			}else{ }
		}
		
		function disablemp(){
			var roles = $('#role').html();
			if(roles==1){ //นครปฐม
				$('#ownercash option:eq(1)').prop("selected", true);
				$('#ownercash option:eq(2)').prop("disabled", true);
				$('#ownercash option:eq(1)').prop("disabled", false);
				$('#ownercash option:eq(0)').prop("disabled", true);				
			}else if(roles==2){ //กระทุ่มแบน
				$('#ownercash option:eq(2)').prop("selected", true);
				$('#ownercash option:eq(1)').prop("disabled", true);
				$('#ownercash option:eq(2)').prop("disabled", false);
				$('#ownercash option:eq(0)').prop("disabled", true);
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
                    <h1 class="page-header">เพิ่มรายการสั่งซื้อ </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เงินกองกลางมีอยู่ <?php echo number_format($cur_cash, 0, '.', ',') ;?> บาท <?php echo "<br><strong>ชูเกียรติ :</strong> ".number_format($cash1, 0, '.', ',').' บาท <br> <strong>ไพรฑูรย์ :</strong> '.number_format($cash2, 0, '.', ',')." บาท"?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/finance/addpo.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> สินค้า/รายการ </label>
											<input type="text" class="form-control" id="poname" name="poname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="poqty" name="poqty">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคา </label>
											<input type="text" class="form-control" id="poprice" name="poprice">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เครดิต</label>
											<input type="checkbox" class="form-control" id="pocredit" name="pocredit">
										</div>
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ร้านค้า </label>
											<input type="text" class="form-control" id="poshop" name="poshop">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คนจ่าย </label>
											<select class="form-control" id="pobuyer" name="pobuyer">
												<option value="0">เลือกคนจ่าย</option> 
												<?php 
													for($i=1; $i<=$num_buyer; $i++){
														$row_buyer = mysql_fetch_array($result_buyer);
													
												?>						
												<option value="<?php echo $row_buyer['e_id']?>">
													<?php if($row_buyer['e_id']==10) { ?>
														<?php echo $row_buyer['e_name'];?>
													<?php } else { ?>
														<?php echo $row_buyer['e_name'].' (ส่วนตัว)';?>
													<?php } ?>
													
												</option>
												
												<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success" id="owner_money">
											<label class="control-label" for="inputSuccess">ส่วนกลางบัญชี</label>
											<select class="form-control" name="owner_money" id="ownercash">
												<option value="0">เลือกเจ้าของบัญชี</option> 
												<?php 
													for($i=1; $i<=$num_emp; $i++){
														$row_emp = mysql_fetch_array($result_emp);													
												?>		
												
												<option value="<?php echo $row_emp['e_id']?>"><?php echo $row_emp['e_name'];?></option>
												
												<?php } ?>
											</select>
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอมเม้นท์</label>
											<input type="text" class="form-control" id="poment" name="poment">
										</div>
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">บิล/เอกสาร</label>
											<input type="file" class="form-control require" id="pobill" name="pobill">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="podate" name="podate" value="<?php echo $today;?>">
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า</label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกรายการสั่งซื้อ</button>
										</div>
									</div>
									<input type="hidden" name="curr_cash" id="curr_cash" value="<?php echo $cur_cash?>">   
									<input type="hidden" name="e_id" id="e_id" value="<?php echo $e_id?>"> 
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
                    <h1 class="page-header">รายการสั่งซื้อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการสั่งซื้อ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>                                     
                                        <th>จำนวน</th>
                                        <th>ราคา</th>
                                        <th>ร้านค้า</th>
										<th>คนจ่าย</th>
										<th>คอมเม้นท์</th>
										<th>วันที่</th>
										<th>เอกสาร</th>
										<th>คนลงรายการ</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  $subyer = $row['po_subyer'];
										  if($subyer==2){ $names = "ชูเกียรติ"; }else if ($subyer==3){$names = "ไพรฑูรย์"; }
									  ?>
										<tr class="gradeA"> 
											<td><?php echo number_format($row['po_id'], 0, '.', ''); ?></td>
											<td><a href="po_detail.php?po_id=<?php echo $row['po_id'] ?>"><?php echo $row['po_name']; ?></td>
											<td><?php echo number_format($row['po_qty'], 0, '.', ''); ?></td>
											<td><?php echo number_format($row['po_price'], 0, '.', ','); ?></td>
											<td><?php echo $row['po_shop']; ?></td>
											
											<?php if($row['po_credit']==1) { ?>
												<?php if($row['po_credit_complete']==1) { ?>
													<td style="color:green; text-decoration:underline; font-weight:bold;"><?php echo $row['e_name']; ?></td>
												<? }else{ ?>
													<td style="color:orange; text-decoration:underline; font-weight:bold;"><?php echo $row['e_name']; ?></td>
												<?php } ?>
											<? }else{ ?>
												
												<?php if($subyer==0) { ?>
													<td><?php echo $row['e_name']; ?></td>
												<? }else{ ?>
													<td><?php echo $row['e_name'].' ('.$names.')'; ?></td>
												<? } ?>
												
											<?php } ?>
											
											<td><?php echo $row['po_comment']; ?></td>
											<td><?php echo $row['po_date']; ?></td>
											<td><a href="../images/bill/<?php echo $row['po_bill_img'];?>" target="_blank">ดูบิล</a></td>											
										    <td><?php echo $row['po_emp']; ?></td>
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
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							โยกย้ายเงินกองกลาง
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
							<div class="row"> 
								<form action="../db/finance/transfer.php" method="post" name="form2" id="form2" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โยกย้ายเงินจาก </label>
											<select class="form-control" id="fromtransfer" name="fromtransfer" class="select_tran">
												<option value="0">เลือกต้นทาง</option> 
												<?php 
													for($i=1; $i<=$num_from; $i++){
														$row_from = mysql_fetch_array($result_from);													
												?>						
												<option value="<?php echo $row_from['e_id']?>"><?php echo $row_from['e_name']?></option>
												
												<?php } ?>											
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="tr_date" name="tr_date" value="<?php echo $today;?>">
										</div>

									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ไป</label>
											<select class="form-control" id="totransfer" name="totransfer" class="select_tran">
												<option value="0">เลือกปลายทาง</option> 
												<?php 
													for($i=1; $i<=$num_empto; $i++){
														$row_empto = mysql_fetch_array($result_empto);
													
												?>						
												<option value="<?php echo $row_empto['e_id']?>"><?php echo $row_empto['e_name']?></option>
												
												<?php } ?>											
											</select>
										</div>
										
										<div class="form-group has-success">
											<button id="btn_tr" type="button" class="btn btn-lg btn-success btn-block">บันทึกโอนเงิน</button>
										</div>
										
									</div>
									
									
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวนเงิน (บาท)</label>
											<input type="text" class="form-control" id="tr_amount" name="tr_amount">
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

   
	<div id="role" style="display:none"><?php echo $rolepo;?></div>
</body>

</html>
