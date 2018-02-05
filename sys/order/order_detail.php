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
	

	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<title>ออเดอร์ลูกค้า</title>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
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
<script>
	$(document).ready(function(){ 
		var quots = $('#quot').html();
		$('#quotationfile').click(function(){
			window.location = '../quotation/files/'+quots;
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
							รายละเอียดสินค้า   <?php echo number_format($row_count_prod['countprod']+$pocount, 0, '.', ',').' รายการ'; ?><br>
							กำหนดส่ง :  <?php echo $quot['o_delivery_date'];?> <br>
							ราคาขาย :  <?php echo number_format($quot['o_price'], 0, '.', ',');?> บาท<br>
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
										</tr>
									<?php } ?>
									
									<tr>
										<td colspan='6'>&nbsp;</td> 
										
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
			
			<div id="quot" style="display:none;"><?php echo $quot['o_quotation'];?></div>
			<button id="quotationfile" type="button" class="btn btn-lg btn-success btn-block" style="width: 30%;">ใบเสนอราคา</button>
			

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
