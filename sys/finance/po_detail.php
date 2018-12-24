<?php session_start();
	  require_once('../include/connect.php');
	
	//PO LIST
	$po_id = $_GET['po_id'];
	$sql = "SELECT * FROM tb_po WHERE po_id = '$po_id'"; 
	$result= mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	
	
	
	$sql_buyer = "SELECT e_id, e_name FROM tb_emp WHERE e_id = 10";
	$result_buyer = mysql_query($sql_buyer);
	$num_buyer = mysql_num_rows($result_buyer);
	
	//ประเภทสินค้า การสั่งซื้อ
	$sql_tooltype = "SELECT * FROM tb_tools_type";
	$result_tooltype = mysql_query($sql_tooltype);
	$num_tooltype = mysql_num_rows($result_tooltype);

	$today = date("Y-m-d");
	
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
			$('.btn-success').click(validation);
			$('#podate').datepicker({dateFormat: 'yy-mm-dd'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
			
			//chk_hide_credit();
			
			
			$('#pocredit').change(credit);
			//$('#pobuyer').change(chk_cash); 
			$('#poprice').blur(chkfieldcash);
			$('#pocreditcomp').change(chk_cash); 
			
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
			/*if($(this).prop('checked') == true){
				alert('checked');
				$('#pobuyer option').last().prop('disabled',true);
				$('#pobuyer option:first-child').prop('selected',true);
			}else{
				alert('un checked'); 
				$('#pobuyer option').last().prop('disabled', false);
			}*/
		}//end credit
		
		function chk_cash(){
			//if cash center
			
				var url = "../../ajax/cash_center.php";
				var param = "poprice="+$("#remain").val();
				   
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
							return false;
						}else{ 
							$('#btn').prop('disabled',false);
						}
					}
				});//end ajax
		}
		
		function chk_hide_credit(){
			var buyers = $('#pobuyer option:selected').val();
			if(buyers==10){
				$('#pocredit').parent().hide(); 
				$('#pocreditcomp').parent().hide();
			}
		}
		
		function validation(){
			var poname = $('#poname').val();
			var poqty = $('#poqty').val();
			var poprice = $('#poprice').val();
			var pobuyer = $('select[name=pobuyer]').val();
			var podate = $('#podate').val(); 
			if((poname=='') || (poqty=='') || (poprice=='') || (pobuyer=='') || (pobuyer<0) || (podate=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
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
                    <h1 class="page-header">แก้ไขรายการสั่งซื้อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							แก้ไขรายการสั่งซื้อ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/finance/editpo.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> สินค้า/รายการ </label>
											<input type="text" class="form-control" id="poname" name="poname" value="<?php echo $row['po_name']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="poqty" name="poqty" value="<?php echo $row['po_qty']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคา </label>
											<input type="text"  class="form-control" id="poprice" name="poprice" value="<?php echo $row['po_price']?>">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทสินค้า </label>
											<select class="form-control" id="poprodtype" name="poprodtype">
												<option value="0">เลือกประเภทสินค้า</option> 
												<?php 
													for($i=1; $i<=$num_tooltype; $i++){
														$row_tooltype = mysql_fetch_array($result_tooltype);
													
												?>						
												<option value="<?php echo $row_tooltype['to_typeid']?>" <?php if( $row_tooltype['to_typeid']==$row['po_cate']) echo "selected" ?>><?php echo $row_tooltype['to_typename']?></option>
												
												<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เครดิต</label>
											<input type="checkbox"  class="form-control" id="pocredit" name="pocredit" <?php if( $row['po_credit']==1) echo "checked" ?>>
										</div>
										
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ร้านค้า </label>
											<input type="text" class="form-control" id="poshop" name="poshop" value="<?php echo $row['po_shop']?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คนจ่าย </label>
											<select class="form-control" id="pobuyer" name="pobuyer">
												<!--<option value="">เลือกคนจ่าย</option> -->
												<?php 
													for($i=1; $i<=$num_buyer; $i++){
														$row_buyer = mysql_fetch_array($result_buyer);
													
												?>						
												<option value="<?php echo $row_buyer[e_id]?>" <?php if( $row_buyer['e_id']==$row['po_buyer']) echo "selected" ?>><?php echo $row_buyer['e_name']?></option>
												
												<?php } ?>
											</select>
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอมเม้นท์</label>
											<input type="text" class="form-control" id="poment" name="poment" value="<?php echo $row['po_comment']?>">
										</div>
										
										
										<?php if($row['po_credit']==1) { ?>
										<div class="form-group has-success ">
											<label class="control-label" for="inputSuccess">มัดจำไป </label>
											<input type="text" class="form-control" id="mudjum" name="mudjum" value="<?php echo $row['po_mudjum'];?>">
										</div>
										<?php } ?>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จ่ายเครดิต</label>
											<input type="checkbox" class="form-control" id="pocreditcomp" name="pocreditcomp" <?php if( $row['po_credit_complete']==1) echo "checked" ?>>
										</div>
										
										<!--<div class="form-group has-success">
												<label class="control-label" for="inputSuccess">ใช้เงินสำรองจ่าย</label>
												<input type="checkbox" class="form-control" id="posumrong" name="posumrong">
										</div>-->
										
										
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">บิล/เอกสาร</label>
											<input type="file" class="form-control require" id="pobill" name="pobill">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="podate" name="podate" value="<?php echo $today;?>" value="<?php echo $row['po_date']?>">
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า</label>
											<input type="text" class="form-control" id="search_custname" name="search_custname" value="<?php echo $row['po_orders']?>">
										</div>
										
										<?php if($row['po_credit']==1) { ?>
										<div class="form-group has-success ">
											<label class="control-label" for="inputSuccess">คงเหลือ </label>
											<input type="text" class="form-control"  id="remain" name="remain" value="<?php echo $row['po_price']-$row['po_mudjum'];?>">
										</div>
										<?php } ?>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกรายการสั่งซื้อ</button>
										</div>
									</div>
									<input type="hidden" name="poid" value="<?php echo $po_id;?>">
									
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
