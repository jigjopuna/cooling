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

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายงานออเดอร์</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php 
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php';</script>");}
	
	/*$role_ = mysql_fetch_array(mysql_query("SELECT ro_stock FROM tb_role WHERE ro_emp_id = '$e_id'"));
	$role = $role_['ro_stock'];*/
		
	if($rep_time==1){
			  
	}else if($rep_time==2){
			  
	}else if($rep_time==3){
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(o_price) sumprice FROM tb_orders WHERE o_date LIKE '$select_month'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(o_id) countord FROM tb_orders WHERE o_date LIKE '$select_month'"));
			  
		$rowsum = $rowsum_['sumprice'];
		$rowcount = $rowcount_['countord'];

					  
		$sqldetail = "SELECT c.cust_name, ost.ost_status, pro.pro_name, o.o_size, o.o_temp, o.o_price, o.o_date, o.o_id, o.o_status
					  FROM ((tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust) 
							JOIN province pro ON pro.id = c.cust_province) 
							JOIN tb_ord_status ost ON ost.ost_id = o.o_status
				  	  WHERE o.o_date LIKE '$select_month' 
					  ORDER BY o.o_date DESC";	

		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);		  
			  
	}else if($rep_time==4){
			  
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
								ยอดรวม <?php echo number_format($rowsum, 0, '.', ',').' บาท'. ' ทั้งหมด :'.$rowcount. ' รายการ';?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ลูกค้า</th>                                     
                                        <th>จังหวัด</th>
                                        <th>ราคา</th>
                                        <th>ขนาดห้อง</th>
										<th>อุณหภูมิ</th>
										<th>วันที่</th>
										<th>สถานะ</th>
										
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										for($i=1; $i<=$num_detail; $i++){
										  $row_detail = mysql_fetch_array($result_detail);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo number_format($row_detail['o_id'], 0, '.', ''); ?></td>
											<td><?php echo $row_detail['cust_name']; ?></td>
											<td><?php echo $row_detail['pro_name']; ?></td>
											<td><?php echo number_format($row_detail['o_price'], 0, '.', ','); ?></td>
											<td><?php echo $row_detail['o_size']; ?></td>
											<td><?php echo $row_detail['o_temp']; ?></td>
											<td><?php echo $row_detail['o_date']; ?></td>	
											<?php if($row_detail['o_status']==5) { ?>
												<td style="background-color: #cce29a"><a href="edit_ord_status.php?o_id=<?php echo $row_detail['o_id']?>"><?php echo $row_detail['ost_status']; ?></a></td>
											<?php } else if($row_detail['o_status']==1) { ?>
												<td style="background-color: #f7f3ba"><a href="edit_ord_status.php?o_id=<?php echo $row_detail['o_id']?>"><?php echo $row_detail['ost_status']; ?></a></td>
											<?php } else if($row_detail['o_status']==7){ ?>
												<td style="background-color: #feacc3"><a href="edit_ord_status.php?o_id=<?php echo $row_detail['o_id']?>"><?php echo $row_detail['ost_status']; ?></a></td>
											<? } else if($row_detail['o_status']==6) { ?>
												<td style="background-color: #baf7ee"><a href="edit_ord_status.php?o_id=<?php echo $row_detail['o_id']?>"><?php echo $row_detail['ost_status']; ?></a></td>
											<?php } else {?>
												<td><a href="edit_ord_status.php?o_id=<?php echo $row_detail['o_id']?>"><?php echo $row_detail['ost_status']; ?></a></td>
											<?php } ?>
																			
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
