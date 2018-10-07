<?php session_start();
	  require_once('../include/connect.php');
	  
	  //for left nav menu path include/navproduct.php
	/*$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);*/
	
	$o_id = trim($_GET['o_id']);
	$cust_name = $_GET['cust_name'];
	
	//list all product this order
	
	$sql_prd = "SELECT orpd.orpd_id, t.t_name, orpd.orpd_qty, orpd.orpd_date, orpd.orpd_e_aprv, orpd.ot_emp, e_name, t.t_cost, t.t_cost1, t.t_cost_center 
	FROM ((tb_ord_prod orpd JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp
	WHERE orpd.o_id = '$o_id'";
	$result_prd = mysql_query($sql_prd);
	$num_prd = mysql_num_rows($result_prd);
	
	$row_sumcost = mysql_fetch_array(mysql_query("SELECT SUM(orpd_cost) sumcost FROM tb_ord_prod WHERE o_id = '$o_id'"));
	
	$row_count_prod = mysql_fetch_array(mysql_query(("SELECT COUNT(o_id) countprod FROM tb_ord_prod WHERE o_id = '$o_id'")));
	$sumprod = $row_sumcost['sumcost'];
	//order pay
	$sql_pay = "SELECT * FROM tb_ord_pay opy JOIN tb_orders ord on opy.o_id = ord.o_id WHERE opy.o_id = '$o_id' ORDER BY opy.pay_date";
	$result_pay = mysql_query($sql_pay);
	$num_pay= mysql_num_rows($result_pay);
	
	
	//หายอดโอนรวมทุกงวด
	$row_find_pay = mysql_fetch_array(mysql_query(("SELECT SUM(pay_amount) sumallpay FROM tb_ord_pay WHERE o_id = '$o_id'")));
	$sumalltranfer = $row_find_pay['sumallpay'];
	
	/*
		sum cost from tb_po
		ค่าใช้แต่ละออเดอร์จะมาจาก 2 ตารางคือ tb_ord_prod กับ tb_po  
		tb_ord_prod จะเป็นทุนที่มาจากสต็อค
		tb_po จะเป็นทุนที่ไม่ได้มาจากสต็อค เช่น ค่ารถเฮียบ ค่าช่างติดหน้างาน เป็นต้น
	*/
	
	
	$rowpocost = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice, COUNT(po_id) cntpoid FROM tb_po WHERE po_orders = '$o_id'"));
	$pocost = $rowpocost['poprice'];
	$pocount = $rowpocost['cntpoid'];
	
	/*echo 'pocost : '.$pocost.'<br>';
	echo 'pocount : '.$pocount;
	echo 'sumprod : '.$sumprod;
	exit();*/
	
	$sql_po = "SELECT * FROM tb_po WHERE po_orders = '$o_id'";
	$result_po = mysql_query($sql_po);
	$num_po = mysql_num_rows($result_po);
	
	
	
	//find quotation docs get price and delivery date
	$quot = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders WHERE o_id='$o_id'"));
	
	//image
	$imgs = $quot['o_attach'];
    list($img1, $img2,$img3, $img4, $img5) = explode(':',$imgs);
	/*echo 'img1 : '.$img1.'<br>';
	echo 'img2 : '.$img2;
	echo 'img3 : '.$img3;
	echo 'img4 : '.$img4;
	echo 'img5 : '.$img5;
	exit();*/
	
	$comm = mysql_fetch_array(mysql_query("SELECT o_note FROM tb_orders WHERE o_id='$o_id'"));
	$comments = $comm['o_note'];

	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<title>ออเดอร์ลูกค้า</title>
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
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<strong>รายละเอียดสินค้า</strong>   <?php echo number_format($row_count_prod['countprod']+$pocount, 0, '.', ',').' รายการ'; ?><br>
							<strong>กำหนดส่ง : &nbsp;&nbsp;&nbsp;</strong> <?php echo $quot['o_delivery_date'];?> <br>
							<strong>ราคาขาย : &nbsp;&nbsp;&nbsp;</strong> <?php echo number_format($quot['o_price'], 0, '.', ',');?> บาท<br>
							<strong>ประตู : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <?php 
							if($quot['o_door']==1){ 
								echo ' ด้านหน้า'; 
							}else if($quot['o_door']==2){ 
								echo ' ด้านข้างซ้าย'; 
							}else if($quot['o_door']==3){ 
								echo ' ด้านข้างขวา';
							}?><br>
							
							<strong>แผงไฟ : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <?php 
							if($quot['o_control']==1){ 
								echo ' ด้านหน้า'; 
							}else if($quot['o_control']==2){ 
								echo ' ด้านข้างซ้าย'; 
							}else if($quot['o_control']==3){ 
								echo ' ด้านข้างขวา';
							}
							
							?> <br>
							
							<strong>คอล์ยร้อน : &nbsp;&nbsp;&nbsp; </strong> <?php 
							if($quot['o_coil']==1){ 
								echo ' ด้านหน้า'; 
							}else if($quot['o_coil']==2){ 
								echo ' ด้านข้างซ้าย'; 
							}else if($quot['o_coil']==3){ 
								echo ' ด้านข้างขวา';
							}else if($quot['o_coil']==4){ 
								echo ' ด้านหลัง';
							}else if($quot['o_coil']==5){ 
								echo ' ด้านบน';
							}
							
							?> <br>
							
							<strong>สี :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>  <?php echo $quot['o_color'];?> <br>
							
							<strong>อุปกรณ์ : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong> <?php 
							if($quot['o_newold']==1){ 
								echo ' ของใหม่ทั้งหมด'; 
							}else if($quot['o_newold']==2){ 
								echo ' มือสองทั้งหมด'; 
							}else if($quot['o_newold']==3){ 
								echo ' ผนังมือสอง เครื่องใหม่';
							}else if($quot['o_newold']==4){ 
								echo ' ผนังใหม่ เครื่องมือสอง';
							}
					
							?> <br>
							
							<strong>ประเภทห้อง :  </strong> <?php 
							if($quot['o_type']==1){ 
								echo ' ห้องสำเร็จรูป'; 
							}else if($quot['o_type']==2){ 
								echo ' ห้องฝั่ง'; 
							}else if($quot['o_type']==3){ 
								echo ' ห้องบลาสฟรีซ';
							}
					
							?> <br>
							<?php if($quot['o_vat']==1) echo 'ออก VAT'; else echo 'ไม่ออก VAT'; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 2%;'>ลำดับ</th>
                                        <th>รายการ</th>
                                        <th>จำนวน</th>
                                        <th>คนเบิก</th>
										<th>คนจ่าย</th>
										<th>ทุนต่อชิ้น</th>
										<th>ทุนรวม</th>
										<th>วันที่</th>
										<?php if($role['ro_ed_ord_dt']==1) { ?>
											<th>.</th>
										<? } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_prd; $i++){
										  $row_prd = mysql_fetch_array($result_prd);
										  $qty_cost = $row_prd['orpd_qty'];
										  $cost = $row_prd['t_cost'];
										  $cost1 = $row_prd['t_cost1'];
										  $cost_center = $row_prd['t_cost_center'];
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_prd['orpd_id']; ?></td>
											<td><?php echo $row_prd['t_name']; ?></td>
											<td><?php echo $qty_cost; ?></td> 
											<td><?php echo $row_prd['e_name']; ?></td>
											<td><?php echo $row_prd['orpd_e_aprv']; ?></td>
											<td><?php echo number_format($cost_center, 0, '.', ','); ?></td>  
											<td><?php echo number_format($cost_center*$qty_cost, 0, '.', ','); ?></td> 
											<td><?php echo $row_prd['orpd_date']; ?></td>
											
											<?php if($role['ro_ed_ord_dt']==1) { ?>
												<td><a href="ord_deta_ed.php?t_id=<?php echo $row_prd['orpd_id'];?>&o_id=<?php echo $o_id;?>">แก้ไข</a></td>	
											<? } ?>
										</tr>
									<?php } ?>
									
									<?php 
										for($i=1; $i<=$num_po; $i++){
										  $row_po = mysql_fetch_array($result_po);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_po['po_id']; ?></td>
											<td><?php echo $row_po['po_name']; ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td><?php echo number_format($row_po['po_price'], 0, '.', ','); ?></td>
											<td><?php echo $row_po['po_date']; ?></td>
											<?php if($role['ro_ed_ord_dt']==1) { ?>
												<td><a href="ord_deta_edpo.php?po_id=<?php echo $row_po['po_id'];?>">แก้ไข</a></td>
											<?php } ?>
										</tr>
									<?php } ?>
									
									<tr>
										<?php if($role['ro_ed_ord_dt']==1) { ?>
											<td colspan='7'><a href="ord_report.php?o_id=<?php echo $o_id;?>&custname=<?php echo $cust_name;?>" target="_blank">ปริ้น</a></td> 
										<?php }else { ?>
											<td colspan='6'>&nbsp;</td> 
										<?php } ?>
										
										<td colspan='2'>
											<?php 
												echo number_format($pocost+$sumprod, 0, '.', ','); 
												// pocost คือต้นทุนที่ไม่ใช่อะไหล่เช่น ค่าเดินทาง ค่าที่พักเป็นต้น sumprod คือต้นทุนอะไหล่
											?>
										</td>
                                    </tr>
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
			
			 <!-- /.row -->
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
										<th>Comment</th>
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
											<th><a href="../images/receive/<?php echo $row_pay['pay_bill']; ?>">ดูบิล</a></th> 
											<td>.</td> 
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
							กำไร : <?php echo number_format($sumalltranfer-($pocost+$sumprod), 2, '.', ',');?> บาท
                        </div>
                    </div>
                </div>
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							คอมเม้นท์ Comment
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                              <form action="../db/order/order_note.php" id="form1" name="form" method="post">
                                <tbody>
                                   <tr>
										<td> 
											<div class="form-group">
											  <input type="text" class="form-control" id="o_note" name="o_note" value="<?php echo $comments;?>">
											  <input type="hidden" name="orders_id" value="<?php echo $o_id;?>">
											</div> 
										</td>
										<td> <button type="button" id="notes" class="btn btn-lg btn-primary btn-block" style="float:left;">บันทึก</button>  </td>
								   </tr>
                                   
                                </tbody>
							   </form>
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
			<button id="quotationfile" type="button" class="btn btn-lg btn-success btn-block" style="width: 30%; float:left;">ใบเสนอราคา</button>
			<button id="process" type="button" class="btn btn-lg btn-success btn-block" style="width: 30%; float:right;">ใบดำเนินการ</button>
			

        </div>
        <!-- /#page-wrapper -->
		<div id="ord_id" style="display:none"><?php echo $o_id;?></div>
    </div>
    <!-- /#wrapper -->

   

</body>

</html>
