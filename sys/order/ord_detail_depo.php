<?php session_start();
	  require_once('../include/connect.php');
	 
	
	$dep_id = trim($_GET['depo_id']);
	$cust_id = trim($_GET['cust_id']);
	
	//list all product this order
	
	$row_dep =  mysql_fetch_array(mysql_query("SELECT * FROM tb_deposit WHERE d_id = '$dep_id'"));
				 
	$row_cust = mysql_fetch_array(mysql_query("SELECT * FROM tb_customer WHERE cust_id = '$cust_id'"));
	$custname = $row_cust['cust_name'];
	
	/* ฝากของแต่ยังไม่ได้เบิกออก query มาเฉพาะที่อยู่ในตาราง tb_deposit แต่ไม่เอาในตาราง tb_withdraw*/
	$sql_dep = "SELECT * 
				FROM (SELECT *  FROM tb_deposit WHERE d_cust = '$cust_id') AS a LEFT JOIN tb_withdraw w  
					  ON a.d_id = w.w_did 
				WHERE w.w_did is NULL ORDER BY w.w_did DESC";
	$result_dep = mysql_query($sql_dep);
	$num_dep = mysql_num_rows($result_dep);
	
	/* ฝากของและเบิกของแล้ว (right join แล้ว ยังมีบางส่วนของ A มาด้วย) */
	$sql_draw = "SELECT * 
				 FROM (SELECT *  FROM tb_deposit WHERE d_cust = '$cust_id') AS a RIGHT JOIN tb_withdraw w  
				 ON a.d_id = w.w_did ORDER BY a.d_id";
	$result_draw = mysql_query($sql_draw);
	$num_draw = mysql_num_rows($result_draw);
	
	
	
	//find images attach infomation in deposit 
	$quot = mysql_fetch_array(mysql_query("SELECT d_attach FROM tb_deposit WHERE d_id='$dep_id'"));
	
	//image
	$imgs = $quot['d_attach'];
    list($img1, $img2,$img3, $img4, $img5) = explode(':',$imgs);
	/*echo 'img1 : '.$img1.'<br>';
	echo 'img2 : '.$img2;
	echo 'img3 : '.$img3;
	echo 'img4 : '.$img4;
	echo 'img5 : '.$img5;
	exit();*/
	
	$comm = mysql_fetch_array(mysql_query("SELECT o_note FROM tb_orders WHERE dep_id='$dep_id'"));
	$comments = $comm['o_note'];

	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<title>ฝากสินค้า</title>
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
			//window.location = '../quotation/files/'+quots;
			window.open('../quotation/files/'+quots, '_blank');
		});
		$('#process').click(function(){
			//window.location = '../../admin/job.php'+'?e_id='+ord_id;
			window.open('../../admin/job.php'+'?e_id='+ord_id, '_blank');
		});	
	});	
</script>
</head>
<body>
    <div id="wrapper">
        <?php require_once ('../include/navplt.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ฝากสินค้า <?php echo $custname;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			 <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							การชำระเงิน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover">
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
			

            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							สินค้าที่ฝาก
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ล็อตที่</th>
										<th style='width: 15%;'>สินค้า</th>
										<th style='width: 10%;'>ฝาก (kg)</th>
										<th style='width: 10%;'>ราคา</th>
										<th style='width: 10%;'>ล็อกที่วาง</th>
										<th style='width: 10%;'>วันที่ฝาก</th>
									 </tr>
                                </thead>
                                <tbody>
										<tr class="gradeA">
											<td><?php echo $row_dep['d_id']; ?></td>
											<td><?php echo $row_dep['d_prod']; ?></td>
											<td><?php echo number_format($row_dep['d_qty'], 0, '.', ',') ?></td>
											<td><?php echo number_format($row_dep['d_price'], 0, '.', ',') ?></td>
											<td><?php echo $row_dep['d_logger']; ?></td>
											<td><?php echo $row_dep['d_date']; ?></td>      
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
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							ประวัติการฝากสินค้าทั้งหมด
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ล็อตที่</th>
										<th style='width: 15%;'>สินค้า</th>
										<th style='width: 10%;'>ฝาก (kg)</th>
										<th style='width: 10%;'>เบิกออก (kg)</th>
										<th style='width: 10%;'>ราคา</th>
										<th style='width: 10%;'>ล็อกที่วาง</th>
										<th style='width: 10%;'>คงเหลือ</th>
										<th style='width: 10%;'>วันที่ฝาก</th>
										<th style='width: 9%;'>วันที่เบิก</th>
										<th style='width: 7%;'>ออกบิล</th>
									 </tr>
                                </thead>
                                <tbody>
									 <?php 
										for($i=1; $i<=$num_dep; $i++){
										  $row_dep = mysql_fetch_array($result_dep);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_dep['d_id']; ?></td>
											<td><a target="_blank" href="ord_depo_edit.php?depo_id=<?php echo $row_dep['d_id'];?>"><?php echo $row_dep['d_prod']; ?></a></td>
											<td><?php echo number_format($row_dep['d_qty'], 0, '.', ',') ?></td>
											<td>0</td> 
											<td><?php echo number_format($row_dep['d_price'], 0, '.', ',') ?></td>
											<td><?php echo $row_dep['d_logger']; ?></td> 
											 
											<td> </td> 
											<td><?php echo $row_dep['d_date']; ?></td>
											<td></td>
											<td><a href="../../admin/receive_paper_plt.php?depo_id=<?php echo $row_dep['d_id']; ?>" target="_blank">ออกบิล</a></td>
										</tr>
										<?php } ?>
										
										<?php 
										for($i=1; $i<=$num_draw; $i++){
										  $row_draw = mysql_fetch_array($result_draw);
									  ?>
										<?php if($row_draw['d_id']!=''){ ?>
											<tr class="gradeA" style="color:blue; font-weight:bold;">
												<td><?php echo $row_draw['d_id']; ?></td>
												<td><a target="_blank" href="ord_depo_edit.php?depo_id=<?php echo $row_draw['d_id'];?>&draw_id=<?php echo $row_draw['w_did']?>">  <?php echo $row_draw['d_prod']; ?></a></td>
												<td><?php echo number_format($row_draw['d_qty'], 0, '.', ',') ?></td>
												<td><?php echo number_format($row_draw['w_qty'], 0, '.', ',') ?></td> 
												<td><?php echo number_format($row_draw['d_price'], 0, '.', ',') ?></td>
												<td><?php echo $row_draw['d_logger']; ?></td> 
												 
												<td> </td> 
												<td><?php echo $row_draw['d_date']; ?></td>
												<td><?php echo $row_draw['w_date']; ?></td>		
												<td><a href="../../admin/receive_paper_plt.php?depo_id=<?php echo $row_draw['d_id']; ?>" target="_blank">ออกบิล</a></td>
											</tr>
										<?php } //end if?>
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
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <button id="quotationfile" type="button" class="btn btn-lg btn-success btn-block" style="width: 30%; float:left;">ใบเสนอราคา</button>
							<button id="process" type="button" class="btn btn-lg btn-success btn-block" style="width: 30%; float:right;">ใบดำเนินการ</button>
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
		
				<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							คอมเม้นท์ Comment
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover">
                              <form action="../db/order/order_note.php" id="form1" name="form" method="post">
                                <tbody>
                                   <tr>
										<td> 
											<div class="form-group">
											  <input type="text" class="form-control" id="o_note" name="o_note" value="<?php echo $comments;?>">
											  <input type="hidden" name="orders_id" value="<?php echo $dep_id;?>">
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
							  <table width="100%" class="">
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
								   <input type="hidden" name="o_ids" id="o_ids" value="<?php echo $dep_id?>"> 
								</form>
							  </table>                           
                        </div>
                    <!-- /.panel -->
					</div>
                <!-- /.col-lg-12 -->
				</div>
			</div>
			
			<div id="quot" style="display:none;"><?php echo $quot['o_quotation'];?></div>
			
			

        </div>
        <!-- /#page-wrapper -->
		<div id="ord_id" style="display:none"><?php echo $dep_id;?></div>
    </div>
    <!-- /#wrapper -->

   

</body>

</html>
