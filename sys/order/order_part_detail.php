<?php session_start();
	  require_once('../include/connect.php');
	  
	  $o_id = trim($_GET['o_id']);
	  $cust_name = $_GET['cust_name'];
	  
	  $sql_opart = "SELECT t.t_id, o.o_date,  t.t_name, b.b_id, ib.bas_price, ib.bas_qty, ib.bas_price*ib.bas_qty amount ,o.o_price 
				FROM ((tb_inbasket ib JOIN tb_basket b ON b.b_id = ib.bas_id)
						   JOIN tb_tools t ON t.t_id = ib.bas_prod)
						   JOIN tb_orders o ON o.o_id = b.b_oid
				WHERE o.o_type LIKE '4%' AND b.b_type = 'A' AND o.o_id = '$o_id'
				ORDER BY b.b_id DESC";
	$result_opart = mysql_query($sql_opart);
	$num_opart = mysql_num_rows($result_opart);
	
	//การชำระเงิน
	$sql_pay = "SELECT opy.o_id, opy.pay_amount, opy.pay_bill, opy.pay_date FROM tb_ord_pay opy JOIN tb_orders ord on opy.o_id = ord.o_id WHERE opy.o_id = '$o_id' ORDER BY opy.pay_date";
	$result_pay = mysql_query($sql_pay);
	$num_pay= mysql_num_rows($result_pay);
	
	//find quotation docs get price and delivery date
	$quot = mysql_fetch_array(mysql_query("SELECT o_attach FROM tb_orders WHERE o_id='$o_id'"));
	
	//image
	$imgs = $quot['o_attach'];
    list($img1, $img2,$img3, $img4, $img5) = explode(':',$imgs);

	
	$comm = mysql_fetch_array(mysql_query("SELECT o_note FROM tb_orders WHERE o_id = '$o_id'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<title>อะไหล่ออเดอร์ </title>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<style>
	.o_image { width: 65%; margin-top:20px;}
	@media screen and (max-width: 1024px){.o_image { width: 100%; }}
	@media print{ .page{ background-color:red;}}
</style>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php');?>
<script>
	$(document).ready(function(){ 
		var quots = $('#quot').html();
		var ord_id = $('#ord_id').html();
		
		$("#notes").click(function(){
			var note = $('#o_note').val();
			if(note==''){
				alert("ใส่คอมเม้นด้วยนะคะ");
				return false;
			}else{
				$('#form1').submit();
			}	
		});
		
		$("#picattach").click(function(){
			var imgs = $('#imgattach').val();
			if(imgs==''){
				alert('ใส่รูปด้วยนะคะ');
				return false;
			}else{
				$('#form2').submit();
			}
		});
		
		$('#quotationfile').click(function(){
			window.location = '../quotation/files/'+quots;
		});
		$('#process').click(function(){
			window.location = '../../admin/job.php'+'?e_id='+ord_id;
		});
		
	
	});
	
	
	
	
	
</script>
</head>
<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รายละเอียด ออเดอร์ <?php echo $cust_name;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							รายการสินค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th style='width: 5%;'>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>ตะกร้า</th>
										<th>ราคา</th>
										<th>จำนวน</th>
										<th>รวมราคา</th>
										<th>รวมทั้งหมด</th>
										<th>เวลาสั่งซื้อ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
										for($i=1; $i<=$num_opart; $i++){
										  $row_opart = mysql_fetch_array($result_opart);
									  ?>
									
										<tr class="gradeA">
											<td><?php echo $row_opart['t_id']; ?></td>
											<td><?php echo $row_opart['t_name']; ?></td>
											<td><?php echo $row_opart['b_id']; ?></td>
											<td><?php echo number_format($row_opart['bas_price'], 2, '.', ','); ?></td>
											<td><?php echo $row_opart['bas_qty']; ?></td>
											<td><?php echo number_format($row_opart['amount'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row_opart['o_price'], 2, '.', ','); ?></td>
											<td><?php echo $row_opart['o_date']; ?></td>
		
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
			
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							การชำระเงิน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th style='width: 5%;'>งวด</th>
                                        <th>จำนวน</th>
                                        <th>เวลา</th>
										<th>บิล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_pay; $i++){
										  $row_pay = mysql_fetch_array($result_pay);
									  ?>
										<tr class="gradeA">
											<td><?php echo $i; ?></td>
											<td><?php echo number_format($row_pay['pay_amount'], 2, '.', ','); ?></td>
											<td><?php echo $row_pay['pay_date']; ?></td> 
											<th><a href="../images/receive/<?php echo $row_pay['pay_bill']; ?>" target="_blank">ดูบิล</a></th> 
											
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
						 ใส่รูป
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							  <table width="100%" class="table table-striped table-bordered table-hover data_table">
								<form action="../db/order/orderattach.php" method="post" name="form2" id="form2" enctype="multipart/form-data">
								   <tbody>
										<tr>
										<td> 
											<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">แนบรูป</label>
											<input type="file" class="form-control require" id="imgattach" name="imgattach">
											</div>
										</td>
										<td> <button type="button" id="picattach" class="btn btn-lg btn-primary btn-block" style="float:left;">บันทึกรูป</button>  </td>
								      </tr>
                                   
                                   </tbody>
								   <input type="hidden" name="o_ids" id="o_ids" value="<?php echo $o_id?>"> 
								</form>
							  </table>                           
                        </div>
                    <!-- /.panel -->
					</div>
                <!-- /.col-lg-12 -->
				</div>
			</div>
			
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
						 รูป
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="col-lg-12"> 
								<?php if($img1 != '') { ?>
									<img class="o_image" src="../images/orderdetail/<?php echo $img1;?>">
								<?php } ?>
								
								<?php if($img2 != '') { ?>
									<img class="o_image" src="../images/orderdetail/<?php echo $img2;?>">
								<?php } ?>
								
								<?php if($img3 != '') { ?>
									<img class="o_image" src="../images/orderdetail/<?php echo $img3;?>">
								<?php } ?>
								
								<?php if($img4 != '') { ?>
									<img class="o_image" src="../images/orderdetail/<?php echo $img4;?>">
								<?php } ?>
								
								<?php if($img5 != '') { ?>
									<img class="o_image" src="../images/orderdetail/<?php echo $img5;?>">
								<?php } ?>
							</div>
							
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
			
			<div id="quot" style="display:none;"><?php echo $quot['o_quotation'];?></div>
			<bu
          </div>   

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
