<?php session_start();
	  require_once('../include/connect.php');
	  
	  $reptype = trim($_POST['sel_rep']);
	  $rep_time = trim($_POST['rep_time']); 
	  $rep_date = trim($_POST['rep_date']);
	  $rep_month = trim($_POST['rep_month']);
	  $rep_week = trim($_POST['rep_week']);
	  
	  $curdate = date('Y-m-d');
	  $year = date('Y');
	  $month = date('m');
	  
	  $select_month =  $year.'-'.$rep_month.'%';
	  
	 
	  
	  
	 /* echo "reptype : ".$reptype."<br>";
	  echo "rep_time : ".$rep_time."<br>";
	  echo "rep_date : ".$rep_date."<br>";
	  echo "rep_month : ".$rep_month."<br>";
	  echo "rep_week : ".$rep_week."<br>";
	  
	  echo "curdate : ".$curdate."<br>";
	  echo "year : ".$year."<br>";
	  echo "month : ".$month."<br>";
	  echo "select_month : ".$select_month."<br>";*/
	  
	  
	  //exit();
	  
	  
	  
	 
	if($rep_time==1){
		$result_po = mysql_query("SELECT e.e_name, p.po_bill_img, p.po_shop, p.po_buyer, p.po_subyer, p.po_name, p.po_price, p.po_qty, p.po_credit, p.po_credit_complete FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer WHERE p.po_date = '$rep_date'");
		$num_po = mysql_num_rows($result_po);
		
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice FROM tb_po WHERE po_date LIKE '$rep_date'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$rep_date'"));
		$rowsum = $rowsum_['poprice'];
		$rowcount = $rowcount_['countpo'];
		
	}else if($rep_time==2){
			  
	}else if($rep_time==3){
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice FROM tb_po WHERE po_date LIKE '$select_month'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$select_month'"));
			  
		$rowsum = $rowsum_['poprice'];
		$rowcount = $rowcount_['countpo'];
			  
			  
		$sqldetail = "SELECT * FROM tb_po WHERE po_date LIKE '$select_month'";
		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);		  
			  
	}else if($rep_time==4){
			  
	}else { } 
	

	
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
		$e_id = $_SESSION['ss_emp_id'];
		if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php';</script>");}
	
	?>
	
	<script>
		$(document).ready(function(){
		
		});
		


	</script> 
</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
		
		    
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รายงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ยอดรวม <?php echo number_format($rowsum, 0, '.', ',').' บาท'. ' ทั้งหมด :'.$rowcount. ' รายการ';?>
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
                                        <!--<th>คนซื้อ</th>
										<th>บัญชี</th>-->
										<th>วันที่</th>
										<th>บิล</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_po; $i++){
										  $row_po = mysql_fetch_array($result_po);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $i; ?></td>
											<td><a href="po_detail.php?po_id=<?php echo $row_po['po_id'] ?>"><?php echo $row_po['po_name']; ?></td>
											<td><?php echo number_format($row_po['po_qty'], 0, '.', ''); ?></td>
											<td><?php echo number_format($row_po['po_price'], 0, '.', ','); ?></td>
											<td><?php echo $row_po['po_shop']; ?></td>
											
											<!--< if($row_po['po_credit']==1) { ?>
												<if($row_po['po_credit_complete']==1) { ?>
													<td style="color:green; text-decoration:underline; font-weight:bold;">< echo $row['e_name']; ?></td>
												< }else{ ?>
													<td style="color:orange; text-decoration:underline; font-weight:bold;">< echo $row['e_name']; ?></td>
												<} ?>
											< }else{ ?>
												<td>< echo $row_po['e_name']; ?></td>
											< } ?>-->
											
											<td><?php echo $curdate; ?></td>
											<td><a href="../images/bill/<?php echo $row_po['po_bill_img'];?>" target="_blank">ดูบิล</a></td>											
										</tr>
									<?php } ?>

                                    
                                </tbody>
                            </table>
							
							<a href="print/poreport.php?dates=<?php echo $rep_date;?>" target=""><button class="btn btn-lg btn-success btn-block">ปริ้นรายการซื้อ</button></a>
										
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
