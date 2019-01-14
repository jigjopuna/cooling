<?php session_start();
	  require_once('../include/connect.php');
	  
	  $reptype = trim($_POST['sel_rep']);
	  $rep_time = trim($_POST['rep_time']); 
	  $rep_date = trim($_POST['rep_date']);
	  $rep_month = trim($_POST['rep_month']);
	  $rep_week = trim($_POST['rep_week']);
	  $rep_year = trim($_POST['rep_year']);
	  
	  $curdate = date('Y-m-d');
	  $year = date('Y');
	  $month = date('m');
	  
	  $select_month =  $year.'-'.$rep_month.'%';
	  
	 
	  
	  
	/*  echo "reptype : ".$reptype."<br>";
	  echo "rep_time : ".$rep_time."<br>";
	  echo "rep_date : ".$rep_date."<br>";
	  echo "rep_month : ".$rep_month."<br>";
	  echo "rep_week : ".$rep_week."<br>";
	  echo "rep_year : ".$rep_year."<br>";
	  
	  echo "curdate : ".$curdate."<br>";
	  echo "year : ".$year."<br>";
	  echo "month : ".$month."<br>";
	  echo "select_month : ".$select_month."<br>";
	  
	  
	  exit();*/
	  
	  
	  
	 
	/*if($rep_time==1){
		$result_po = mysql_query("SELECT e.e_name, p.po_bill_img, p.po_shop, p.po_buyer, p.po_subyer, p.po_name, p.po_price, p.po_qty, p.po_credit, p.po_credit_complete FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer WHERE p.po_date = '$rep_date'");
		$num_po = mysql_num_rows($result_po);
		
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice FROM tb_po WHERE po_date LIKE '$rep_date'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$rep_date'"));
		$rowsum = $rowsum_['poprice'];
		$rowcount = $rowcount_['countpo'];
		
	}else if($rep_time==2){
		//$po_print = $select_month;  
	}else if($rep_time==3){
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice FROM tb_po WHERE po_date LIKE '$select_month'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$select_month'"));
			  
		$rowsum = $rowsum_['poprice'];
		$rowcount = $rowcount_['countpo'];
			  
			  
		$sqldetail = "SELECT * FROM tb_po WHERE po_date LIKE '$select_month'";
		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);

		$po_print = $select_month;
			  
	}else if($rep_time==4){
		//$po_print = $select_month;	  
	}else { } */
	

	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการจ่าย</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php 
	include('../include/inc_role.php');
	include('../include/inc_ro_report.php');

	if($rep_time==1){
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) po_amount FROM tb_po WHERE po_date = '$rep_date'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date = '$rep_date'"));
			  
		$rowsum = $rowsum_['po_amount'];
		$rowcount = $rowcount_['countpo'];
			  
			  
		$sqldetail = "SELECT p.po_emp, p.po_id, p.po_name, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_subyer, p.po_bill_img, p.po_date, p.po_shop, p.po_credit, p.po_credit_complete, e.e_id, e.e_name   
					 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id
					 WHERE p.po_date = '$rep_date' 
					 ORDER BY po_id DESC LIMIT 0,100";
					 
		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);	
		$po_print = $rep_date;		
			  
	}else if($rep_time==2){
			  
	}else if($rep_time==3){ 
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) po_amount FROM tb_po WHERE po_date LIKE '$select_month'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$select_month'"));
			  
		$rowsum = $rowsum_['po_amount'];
		$rowcount = $rowcount_['countpo'];
			  
			  
		$sqldetail = "SELECT p.po_emp, p.po_id, p.po_name, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_subyer, p.po_bill_img, p.po_date, p.po_shop, p.po_credit, p.po_credit_complete, e.e_id, e.e_name   
					 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id
					 WHERE p.po_date LIKE '$select_month' 
					 ORDER BY po_id DESC LIMIT 0,100";
					 
		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);	
		
		
		$sql_group = "SELECT t.to_typename, SUM(p.po_price) price
						FROM tb_po p JOIN tb_tools_type t ON t.to_typeid = p.po_cate 
						WHERE p.po_date LIKE '$select_month' 
						GROUP BY p.po_cate ORDER BY price DESC";
		$result_group =  mysql_query($sql_group);
		$num_group = mysql_num_rows($result_group);

		$po_print = $select_month;
		$times = 'เดือน'.$select_month;
			  
	}else if($rep_time==4){ //rep_year
		$years = $rep_year.'%';
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) po_amount FROM tb_po WHERE po_date LIKE '$years'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$years'"));
			  
		$rowsum = $rowsum_['po_amount'];
		$rowcount = $rowcount_['countpo'];
			  
			  
		$sqldetail = "SELECT p.po_emp, p.po_id, p.po_name, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_subyer, p.po_bill_img, p.po_date, p.po_shop, p.po_credit, p.po_credit_complete, e.e_id, e.e_name   
					 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id
					 WHERE p.po_date LIKE '$years' 
					 ORDER BY po_id DESC LIMIT 0,100";
					 
		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);	
		
		
		$sql_group = "SELECT t.to_typename, SUM(p.po_price) price
						FROM tb_po p JOIN tb_tools_type t ON t.to_typeid = p.po_cate 
						WHERE p.po_date LIKE '$years' 
						GROUP BY p.po_cate ORDER BY price DESC";
		$result_group =  mysql_query($sql_group);
		$num_group = mysql_num_rows($result_group);
		$times = 'ปี '.$rep_year;

	}else { } 
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
								สรุปรายการจ่ายซื้อของ  <?php echo $times;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>                                     
                                        <th>ยอดซื้อ</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_group; $i++){
										  $row_group = mysql_fetch_array($result_group);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $i; ?></td>
											<td><?php echo $row_group['to_typename']; ?></td>
											<td><?php echo number_format($row_group['price'], 2, '.', ','); ?></td>
										</tr>
									<?php } ?>
                                    
                                </tbody>
                            </table>
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
								ยอดจ่ายรวม <?php echo number_format($rowsum, 0, '.', ',').' บาท'. ' ทั้งหมด :'.number_format($rowcount, 0, '.', ','). ' รายการ';?>
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
										for($i=1; $i<=$num_detail; $i++){
										  $row = mysql_fetch_array($result_detail);
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
							
							<a href="print/poreport.php?dates=<?php echo $po_print;?>" target=""><button class="btn btn-lg btn-success btn-block">ปริ้นรายการซื้อ</button></a>
										
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
