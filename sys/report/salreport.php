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
			  
	}else if($rep_time==2){
			  
	}else if($rep_time==3){
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(sal_amount) sal_amount FROM tb_salary WHERE sal_date LIKE '$select_month'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(sal_id) countsal FROM tb_salary WHERE sal_date LIKE '$select_month'"));
			  
		$rowsum = $rowsum_['sal_amount'];
		$rowcount = $rowcount_['countsal'];
			  
			  
		$sqldetail = "SELECT s.sal_id, s.sal_date, s.sal_amount, e.e_name
					  FROM tb_salary s JOIN tb_emp e ON s.sal_emp = e.e_id 
					  WHERE s.sal_date LIKE '$select_month'";
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
                                        <th>พนักงาน</th>                                     
                                        <th>จำนวนเงิน</th>
                                        <th>วันที่</th>
										
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										for($i=1; $i<=$num_detail; $i++){
										  $row_detail = mysql_fetch_array($result_detail);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_detail['sal_id']; ?></td>
											<td><?php echo $row_detail['e_name']; ?></td>
											<td><?php echo number_format($row_detail['sal_amount'], 0, '.', ','); ?></td>
											<td><?php echo $row_detail['sal_date']; ?></td>
																	
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
