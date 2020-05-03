<?php session_start();
	  require_once('../include/connect.php');
	
	//โอนเข้ามา
	$sql = "SELECT * 
			FROM tb_intra_acc ia JOIN tb_cash_center cc ON cc.cash_intra = ia.inc_id
			ORDER BY ia.inc_id DESC";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
		
	$sql_bank = "SELECT * FROM tb_bank";
	$result_bank = mysql_query($sql_bank);
	$num_bank = mysql_num_rows($result_bank);
	
	$sql_bank1 = "SELECT * FROM tb_bank";
	$result_bank1 = mysql_query($sql_bank1);
	$num_bank1 = mysql_num_rows($result_bank1);
	
	$sql_bank2 = "SELECT * FROM tb_bank";
	$result_bank2 = mysql_query($sql_bank2);
	$num_bank2 = mysql_num_rows($result_bank2);
	
	for($i=0; $i<=$num_bank2; $i++){
		$row_bank2 = mysql_fetch_array($result_bank2);
		$bankarr[$i] = $row_bank2['bk_name'];	
	}
	
	$today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>โยกย้ายเงินภายใน</title>
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
		
		$("#search_ord").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
		});
		
		function validation(){
			var search_ord = $('#search_ord').val(); 
			var bfrom = $('#bfrom').val();
			var bto = $('#bto').val();
			var yokprice = $('#yokprice').val();
			var yokname = $('#yokname').val();
			
			if(search_ord==''){
				alert('กรุณาเลือกหมายเลขออเดอร์ด้วยนะค่ะ');
				return false;
			   }
				if((isNaN(search_ord))){
				alert('กรุณาใส่เลขออเดอร์ลูกค้านะค่ะ');
				return false;
			}
			
			if((search_ord=='') || (bto==0) || (bfrom==0) || (yokprice==0) || (yokname=='')){ 
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
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							โยกย้าย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/finance/yokyays.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รายการ</label>
											<input type="text" class="form-control" id="yokname" name="yokname" placeholder="รายการโยกย้ายเงิน">
										</div>
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> หมายเลข ออเดอร์ </label>
											<input type="text" class="form-control" id="search_ord" name="search_ord" placeholder="ค้นหาหมายเลขออเดอร์">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวนเงิน</label>
											<input type="text" class="form-control" id="yokprice" name="yokprice">
										</div>
										
									</div>
																		
									<div class="col-lg-4">
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จาก ธนาคาร</label>
											<select class="form-control" id="bfrom" name="bfrom">
												<option value="0">เลือกบัญชี</option> 
												<?php for($i=1; $i<=$num_bank; $i++) { 
													  $row_bank = mysql_fetch_array($result_bank);
													  
													  if($row['bk_type']==1){$types = 'ออมทรัพย์'; }else{ $types = 'กระแส'; }
												?>
												<option value="<?php echo $row_bank['bk_id'];?>"><?php echo $row_bank['bk_name']. ' ('.$types. ')';?></option> 
												<?php } ?>
											</select>
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ไป ธนาคาร</label>
											<select class="form-control" id="bto" name="bto">
												<option value="0">เลือกบัญชี</option> 
												<?php for($i=1; $i<=$num_bank1; $i++) { 
													  $row_bank1 = mysql_fetch_array($result_bank1);
													  
												?>
												<option value="<?php echo $row_bank1['bk_id'];?>"><?php echo $row_bank1['bk_name'];?></option> 
												<?php } ?>
											</select>
										</div>
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="paydate" name="paydate" value="<?php echo $today;?>">
										</div>
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกโยกย้าย</button>
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
                    <h1 class="page-header">โยกย้าย</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			
			
          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								โยกย้ายภายใน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>  
										<th>ของห้อง</th>  
                                        <th>จำนวนเงิน</th>
                                        <th>จากบัญชี</th>
										<th>เข้าบัญชี</th>
										<th>วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										$bankname = array();
										$bankname1 = array();
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td style='width: 2%;'><?php echo $row['inc_id'];?></td>
											<td><?php echo $row['inc_name']; ?></td>
											<td><?php echo $row['cash_order']; ?></td>
											<td><?php echo number_format($row['inc_price'], 0, '.', ','); ?></td>
											<td><?php //https://youtu.be/qfm9zZLkyWA
											
												foreach($bankarr as $key => $value){
													$bankname[$key] =  $key;
													//echo "key = " . $bankname[$key] . " : value = ". $value . "<br>";
													$keys = $key+1;
													if($row['inc_from'] == $bankname[$keys]){ echo $value;  }
												}
											 ?>
											
											</td>
											<td>
											<?php 
											
												foreach($bankarr as $key2 => $values){
													$bankname1[$key2] =  $key2;
													$key1 = $key2+2;
													if($row['inc_to'] == $bankname1[$key1]){ echo $values;  }
												}
											 ?>
											
											</td>
											<td><?php echo $row['inc_date']; ?></td>
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
                  &nbsp;<br>&nbsp;<br>
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
