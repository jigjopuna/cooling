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
		
		$rowstk = mysql_fetch_array(mysql_query("SELECT SUM(pu.pu_qty*t.t_cost_center) coststk, COUNT(pu.pu_id) countpu FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date LIKE '$select_month'";
		$cntstk = $rowstk['countpu'];
		$costst = number_format($rowstk['coststk'], 0, '.', ',');
			 
			  
		$sqldetail = "SELECT pu.pu_id, pu.pu_qty, pu.pu_date, pu.pu_wh, t.t_name, t.t_cost_center, t.t_stock, t.t_stock1 
					  FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid 
					  WHERE pu_date LIKE '$select_month' "; 
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
                    <h1 class="page-header">รายการใส่สต็อค <?php echo $timeperiod;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการใส่สต็อค <?php echo $cntstk. ' รายการ  ราคาทุน '. number_format($costst, 0, '.', ',').' บาท';?>
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
										<th>สโตร์</th>
										<th>วันที่</th>
										pu.pu_id, pu.pu_qty, pu.pu_date, t.t_name, t.t_cost_center, t.t_stock, t.t_stock1
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										for($i=1; $i<=$num_detail; $i++){
										  $row_detail = mysql_fetch_array($result_detail);
										  $puqty = $row_detail['pu_qty'];
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_detail['pu_id']; ?></td>
											<td><?php echo $row_detail['t_name']; ?></td>
											<td><?php echo $puqty; ?></td>
											<td><?php echo number_format($row_detail['t_cost_center']*$puqty, 0, '.', ','); ?></td>
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
