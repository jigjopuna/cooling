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
<title>รายการสั่งซื้อ</title>
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
		$rowburk = mysql_fetch_array(mysql_query("SELECT COUNT(orpd.orpd_id) countburk, SUM(orpd.orpd_cost) costburk FROM tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd_date LIKE '$select_month'"));
		$cntburk = number_format($rowburk['countburk'], 0, '.', ',');
		$costburk = number_format($rowburk['costburk'], 0, '.', ',');
			 
			  
		$sqldetail = "SELECT t.t_name, t.t_cost_center, orpd.orpd_id, orpd.orpd_qty, orpd.orpd_date, e.e_name, c.cust_name 
					  FROM (((tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id) 
							JOIN tb_emp e ON e.e_id = orpd.ot_emp) JOIN tb_orders o ON o.o_id = orpd.o_id) 
							JOIN tb_customer c ON c.cust_id = o.o_cust 
					  WHERE orpd_date LIKE '$select_month'";
		$result_detail = mysql_query($sqldetail);
		$num_detail = mysql_num_rows($result_detail);

		$timeperiod = 'เดือน '.$rep_month.' ปี '.$year;
			  
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
                    <h1 class="page-header">รายการเบิก <?php echo $timeperiod;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการเบิก <?php echo $cntburk. ' รายการ  ราคาทุน '. number_format($costburk, 0, '.', ',').' บาท';?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>                                                                           
                                        <th>รายการ</th>
										<th>จำนวน</th>
                                        <th>ราคากลาง</th>
										<th>คนเบิก</th>
										<th>งานลูกค้า</th>
										<th>วันที่</th>
										
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										for($i=1; $i<=$num_detail; $i++){
										  $row_detail = mysql_fetch_array($result_detail);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_detail['orpd_id']; ?></td>
											<td><?php echo $row_detail['t_name']; ?></td>
											<td><?php echo $row_detail['orpd_qty']; ?></td>
											<td><?php echo number_format($row_detail['t_cost_center'], 0, '.', ','); ?></td>
											<td><?php echo $row_detail['e_name']; ?></td>
											<td><?php echo $row_detail['cust_name']; ?></td>
											<td><?php echo $row_detail['orpd_date']; ?></td>

																			
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
