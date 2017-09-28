<?php session_start();
	  require_once('../include/connect.php');
	
	//PO LIST
	$sql = "SELECT p.po_id, p.po_name, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_bill_img, p.po_date, p.po_shop, e.e_id, e.e_name   
			FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id
			ORDER BY po_id DESC";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sql_buyer = "SELECT e_id, e_name FROM tb_emp WHERE e_type = 1";
	$result_buyer = mysql_query($sql_buyer);
	$num_buyer = mysql_num_rows($result_buyer);
	
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
			$('.btn-success').click(validation);
			$('#podate').datepicker({dateFormat: 'yy-mm-dd'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
		});
		
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
                    <h1 class="page-header">เพิ่มรายการสั่งซื้อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เพิ่มรายการสั่งซื้อ
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
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ร้านค้า </label>
											<input type="text" class="form-control" id="poshop" name="poshop">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คนจ่าย </label>
											<select class="form-control" id="pobuyer" name="pobuyer">
												<option value="">เลือกคนจ่าย</option> 
												<?php 
													for($i=1; $i<=$num_buyer; $i++){
														$row_buyer = mysql_fetch_array($result_buyer);
													
												?>						
												<option value="<?php echo $row_buyer[e_id]?>"><?php echo $row_buyer[e_name]?></option>
												
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
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo number_format($row['po_id'], 0, '.', ''); ?></td>
											<td><a href="order_detail.php?o_id=<?php echo $row['po_id'] ?>"><?php echo $row['po_name']; ?></td>
											<td><?php echo number_format($row['po_qty'], 0, '.', ''); ?></td>
											<td><?php echo number_format($row['po_price'], 0, '.', ','); ?></td>
											<td><?php echo $row['po_shop']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><?php echo $row['po_comment']; ?></td>
											<td><?php echo $row['po_date']; ?></td>
											<td><a href="../images/bill/<?php echo $row['po_bill_img'];?>" target="_blank">ดูบิล</a></td>											
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
