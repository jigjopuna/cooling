<?php session_start();
	  require_once('../include/connect.php');
	  $today = date("Y-m-d");
	
	//ยังไม่ได้จ่ายเครดิต
	$sql = "SELECT s.sl_name, p.po_emp, p.po_id, p.po_name, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_mudjum, p.po_subyer, p.po_bill_img, p.po_date, p.po_shop, p.po_credit, p.po_credit_complete, e.e_id, e.e_name   
			FROM (tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id) JOIN tb_sellers s ON s.sl_id = p.po_shop
			WHERE p.po_credit = 1 AND p.po_credit_complete != 1 
			ORDER BY po_id DESC LIMIT 0,200";
	/*
	    JOIN ชื่อร้านค้า ชื่อคนลงระบบ
		SELECT * 
		FROM ((tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id) JOIN tb_sellers s ON s.sl_id = p.po_shop) JOIN tb_emp em ON em.e_id = p.po_emp
		WHERE p.po_credit = 1 AND p.po_credit_complete != 1 
		ORDER BY po_id DESC LIMIT 0,200	
	*/
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	
	//จ่ายเครดิตแล้ว ประวัติ
	$sql_jai = "SELECT p.po_emp, p.po_id, p.po_name, p.po_qty, p.po_price, p.po_buyer, p.po_comment, p.po_subyer, p.po_bill_img, p.po_date, p.po_shop, p.po_credit, p.po_credit_complete, e.e_id, e.e_name   
			FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id
			WHERE p.po_credit = 1 AND p.po_credit_complete = 1 
			ORDER BY po_id DESC LIMIT 0,200";
	$result_jai= mysql_query($sql_jai);
	$num_jai = mysql_num_rows($result_jai);
	
	
	$sql_creditall = "SELECT s.sl_name, p.po_shop, SUM(p.po_price)prices, SUM(p.po_mudjum) mudjums, SUM(p.po_price)-SUM(p.po_mudjum) remain
					FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id 
					WHERE p.po_credit = 1 AND p.po_credit_complete != 1 
					GROUP BY po_shop ORDER BY prices DESC";
	$result_creditall = mysql_query($sql_creditall);
	$num_creditall = mysql_num_rows($result_creditall);
	$rowsum = mysql_fetch_array(mysql_query("SELECT SUM(po_price) sumprices FROM tb_po WHERE po_credit = 1 AND po_credit_complete != 1"));
	
	
	
	$rowdate = mysql_fetch_array(mysql_query("SELECT DATEDIFF('$today', '2017-06-15') AS difdate"));
	//echo $rowdate['difdate']; exit(); Where a.DateValue > DateAdd(day,-3,getdate())
	/*
	https://www.ninenik.com/%E0%B8%A3%E0%B8%B9%E0%B9%89%E0%B8%88%E0%B8%B1%E0%B8%81_%E0%B9%81%E0%B8%A5%E0%B8%B0%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B8%87%E0%B8%B2%E0%B8%99_DATEDIFF()_%E0%B9%83%E0%B8%99_mysql_%E0%B8%9F%E0%B8%B1%E0%B8%87%E0%B8%81%E0%B9%8C%E0%B8%8A%E0%B8%B1%E0%B8%99_%E0%B9%80%E0%B8%97%E0%B8%B5%E0%B8%A2%E0%B8%9A%E0%B8%8A%E0%B9%88%E0%B8%A7%E0%B8%87%E0%B9%80%E0%B8%A7%E0%B8%A5%E0%B8%B2%E0%B8%97%E0%B8%B5%E0%B9%88%E0%B9%80%E0%B8%AB%E0%B8%A5%E0%B8%B7%E0%B8%AD-428.html
	*/
	$sqldates  = "SELECT * FROM tb_po WHERE DATEDIFF(po_date,NOW())>= -60 AND po_credit = 1 AND po_credit_complete != 1 ORDER BY po_date ASC";
	$result_date = mysql_query($sqldates);
	$num_date = mysql_num_rows($result_date);
	
	
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>เครดิต</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
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
                    <h1 class="page-header">เครดิต </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								เครดิต <?php echo number_format($rowsum['sumprices'], 2, '.', ','); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>รหัสร้าน</th>
                                        <th>ชื่อร้าน</th> 
										<th>ยอดเต็ม</th> 
										<th>ม้ดจำ</th> 
										<th>คงเหลือ</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_creditall; $i++){
										  $row_creditall = mysql_fetch_array($result_creditall);
										  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_creditall['po_shop']; ?></td>
											<td><?php echo $row_creditall['sl_name']; ?></td>
											<td><?php echo number_format($row_creditall['prices'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row_creditall['mudjums'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row_creditall['remain'], 2, '.', ','); ?></td>
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
								เครดิตย้อนหลัง 60 วัน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>รายการ</th> 
										<th>ยอดเต็ม</th> 
										<th>ม้ดจำ</th> 
										<th>คงเหลือ</th>
										<th>วันที่</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_date; $i++){
										  $row_date = mysql_fetch_array($result_date);
										  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_date['po_name']; ?></td>
											<td><?php echo number_format($row_date['po_price'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row_date['po_mudjum'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row_date['po_price']-$row_date['po_mudjum'], 2, '.', ','); ?></td>
											<td style="color:red; font-weight:bold;"><?php echo $row_date['po_date']; ?></td>
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
								ยังไม่จ่าย 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>  
										<th>ราคา</th>
										<th>มัดจำ</th>										
                                        <th>ร้านค้า</th>
										<th>คอมเม้นท์</th>
										<th>วันที่</th>
										<th>เอกสาร</th>
										<th>คนลงรายการ</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo number_format($row['po_id'], 0, '.', ''); ?></td>
											<td><a href="po_detail.php?po_id=<?php echo $row['po_id'] ?>"><?php echo $row['po_name']; ?></td>
											<td><?php echo number_format($row['po_price'], 0, '.', ','); ?></td>
											<td><?php echo number_format($row['po_mudjum'], 0, '.', ','); ?></td>
											<td><?php echo $row['sl_name']; ?></td>
											<td><?php echo $row['po_comment']; ?></td>
											<td><?php echo $row['po_date']; ?></td>
											<td><a href="../images/bill/<?php echo $row['po_bill_img'];?>" target="_blank">ดูบิล</a></td>											
										    <td><?php echo $row['po_emp']; ?></td>
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
								จ่ายแล้ว 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>  
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
										for($i=1; $i<=$num_jai; $i++){
										  $row_jai = mysql_fetch_array($result_jai);
										  $subyer = $row_jai['po_subyer'];
										  if($subyer==2){ $names = "ชูเกียรติ"; }else if ($subyer==3){$names = "ไพรฑูรย์"; }
									  ?>
										<tr class="gradeA"> 
											<td><?php echo number_format($row_jai['po_id'], 0, '.', ''); ?></td>
											<td><a href="po_detail.php?po_id=<?php echo $row_jai['po_id'] ?>"><?php echo $row_jai['po_name']; ?></td>
											<td><?php echo number_format($row_jai['po_price'], 0, '.', ','); ?></td>
											<td><?php echo $row_jai['sl_name']; ?></td>
											
											<?php if($row_jai['po_credit']==1) { ?>
												<?php if($row_jai['po_credit_complete']==1) { ?>
													<td style="color:green; text-decoration:underline; font-weight:bold;"><?php echo $row_jai['e_name']; ?></td>
												<? }else{ ?>
													<td style="color:orange; text-decoration:underline; font-weight:bold;"><?php echo $row_jai['e_name']; ?></td>
												<?php } ?>
											<? }else{ ?>
												
												<?php if($subyer==0) { ?>
													<td><?php echo $row_jai['e_name']; ?></td>
												<? }else{ ?>
													<td><?php echo $row_jai['e_name'].' ('.$names.')'; ?></td>
												<? } ?>
												
											<?php } ?>
											
											<td><?php echo $row_jai['po_comment']; ?></td>
											<td><?php echo $row_jai['po_date']; ?></td>
											<td><a href="../images/bill/<?php echo $row_jai['po_bill_img'];?>" target="_blank">ดูบิล</a></td>											
										    <td><?php echo $row_jai['po_emp']; ?></td>
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

   
	<div id="role" style="display:none"><?php echo $rolepo;?></div>
</body>

</html>
