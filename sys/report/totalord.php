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
	  $select_year =  $rep_year.'%';
	  
	  
	  
	 /* echo "reptype : ".$reptype."<br>";
	  echo "rep_time : ".$rep_time."<br>";
	  echo "rep_date : ".$rep_date."<br>";
	  echo "rep_month : ".$rep_month."<br>";
	  echo "rep_week : ".$rep_week."<br>";
	  echo "rep_year : ".$rep_year."<br>";
	  
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
<?php require_once('../include/inc_role.php'); ?>
<?php 
		
	if($rep_time==1){
			  
	}else if($rep_time==2){
			  
	}else if($rep_time==3){ // รายเดือน
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(o_price) sumprice FROM tb_orders WHERE o_date LIKE '$select_month'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(o_id) countyod FROM tb_orders WHERE o_date LIKE '$select_month'"));
			  
		$rowsum = $rowsum_['sumprice'];
		$rowcount = $rowcount_['countyod'];

					  
		$sqldetail = "SELECT c.cust_name, ost.ost_status, pro.pro_name, o.o_size, o.o_temp, o.o_price, o.o_date, o.o_id, o.o_status
					  FROM ((tb_orders o JOIN tb_customer c ON c.cust_id = o.o_cust) 
							JOIN province pro ON pro.id = c.cust_province) 
							JOIN tb_ord_status ost ON ost.ost_id = o.o_status
				  	  WHERE o.o_date LIKE '$select_month' 
					  ORDER BY o.o_date DESC";	

		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);		  
			  
	}else if($rep_time==4){ // รายปี	ต้องรู้ปี
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(o_price) sumprice FROM tb_orders WHERE o_date LIKE '$select_year'"));
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT COUNT(o_id) countyod FROM tb_orders WHERE o_date LIKE '$select_year'"));		 	
		$rowsum = $rowsum_['sumprice'];
		$rowcount = $rowcount_['countyod'];
		
		$sqldetail =   "SELECT ot.ort_name, ord.sumprices, ord.countord
						FROM tb_ord_type ot JOIN (
								SELECT o_type, COUNT(o_id) countord, SUM(o_price) sumprices
								FROM tb_orders  
								WHERE o_date like '$select_year'
								GROUP BY o_type
							) ord ON ord.o_type = ot.ort_type";
		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);
		
		$condition_date = 'ปี '.$select_year;
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
                    <h1 class="page-header">รายงานออเดอร์ทั้งหมด</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ยอดรวม <?php echo number_format($rowsum, 0, '.', ',').' บาท'. ' ทั้งหมด : '.$rowcount. ' ออเดอร์(ห้อง)';?><br>
								<?php echo $condition_date;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ประเภทห้อง</th>                                     
                                        <th>จำนวน</th>
                                        <th>ยอดขาย</th>
										
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										for($i=1; $i<=$num_detail; $i++){
										  $row_detail = mysql_fetch_array($result_detail);
									  ?>
										<tr class="gradeA">
											<td><?php echo $i; ?></td>
											
											<td><?php echo $row_detail['ort_name']; ?></td>
											<td><?php echo $row_detail['countord']; ?></td>
											<td><?php echo number_format($row_detail['sumprices'], 2, '.', ','); ?></td>
											
																			
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
