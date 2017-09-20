<?php session_start();
	  require_once('../include/connect.php');
	  
	  //for left nav menu path include/navproduct.php
	/*$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);*/
	
	$o_id = trim($_GET['o_id']);
	$cust_name = $_GET['cust_name'];
	
	
	//list all product this order
	//$sql_prd = "SELECT * FROM tb_ord_prod orpd JOIN tb_product p ON orpd.p_id = p.p_id WHERE orpd.o_id = '$o_id'";
	$sql_prd = "SELECT po.po_id, po.po_name, po.po_price, po.po_qty, po.po_bill_img, e.e_name FROM tb_po po JOIN tb_emp e ON po.po_buyer = e.e_id WHERE po.po_orders = '$o_id'";
	$result_prd = mysql_query($sql_prd);
	$num_prd = mysql_num_rows($result_prd);
	
	
	//order pay
	$sql_pay = "SELECT * FROM tb_ord_pay opy JOIN tb_orders ord on opy.o_id = ord.o_id WHERE opy.o_id = '$o_id' ORDER BY opy.pay_date";
	$result_pay = mysql_query($sql_pay);
	$num_pay= mysql_num_rows($result_pay);

	
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
		$('#quotationfile').click(function(){window.location = '../quotation/files/20170906-tamarind-petchaboon.pdf';});
	
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
							รายละเอียดสินค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 2%;'>ลำดับ</th>
                                        <th>สินค้า</th>
                                        <th>ราคา</th>
                                        <th>จำนวน</th>
										<th>เอาเงินจาก</th>
										<th>ดูบิล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_prd; $i++){
										  $row_prd = mysql_fetch_array($result_prd);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_prd['po_id']; //$row_prd['p_name']; ?></td>
											<td><?php echo $row_prd['po_name']; //$row_prd['p_model']; ?></td>
											<td><?php echo $row_prd['po_price']; //$row_prd['orpd_qty']; ?></td> 
											<td><?php echo $row_prd['po_qty']; ?></td>
											<td><?php echo $row_prd['e_name']; ?></td>											
											<td><a href="../images/bill/<?php echo $row_prd['po_bill_img'];?>" target="_blank">ดูบิล</a></td>																													
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
			<button id="quotationfile" type="button" class="btn btn-lg btn-success btn-block" style="width: 30%;">ใบเสนอราคา</button>
			

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
