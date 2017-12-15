<?php session_start();
	  require_once('../include/connect.php');
	  
	  $today = date("Y-m-d");
	  
	  $tool_id = trim($_GET['t_id']);
	
	$row_name = mysql_fetch_array(mysql_query("SELECT t_name FROM tb_tools WHERE t_id = '$tool_id'"));
	
	$sql_sel = "SELECT t.t_name, c.cu_name, se.sel_id, se.sel_qty, se.sel_price, se.sel_comment, se.sel_date, e.e_name FROM ((tb_sell se JOIN tb_tools t ON t.t_id = se.sel_detail) JOIN tb_cust c ON c.cu_id = se.sel_cust) JOIN tb_emp e ON e.e_id = se.sel_approve WHERE t.t_id = '$tool_id' LIMIT 0,100";
	$result_sel = mysql_query($sql_sel);
	$num_sel = mysql_num_rows($result_sel);
	
	$sql_burk = "SELECT orpd.orpd_id, t.t_name, c.cust_name, orpd.orpd_qty, orpd.ot_emp, orpd.orpd_e_aprv, orpd.orpd_date, e.e_name FROM (((tb_ord_prod orpd JOIN tb_tools t ON t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp) JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_customer c ON c.cust_id = o.o_cust WHERE t.t_id = '$tool_id' LIMIT 0,100";
	$result_burk = mysql_query($sql_burk);
	$num_burk = mysql_num_rows($result_burk);
	
	$sql_tr = "SELECT t.t_name, orpd.orpd_id, e.e_name, orpd.orpd_wh, orpd.orpd_qty, orpd.orpd_date FROM (tb_ord_prod orpd JOIN tb_emp e ON e.e_id = orpd.orpd_e_aprv) JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE t.t_id = '$tool_id' AND o_id = 0 LIMIT 0,100";
	$result_tr = mysql_query($sql_tr);
	$num_tr = mysql_num_rows($result_tr);
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ'); window.location = '../pages/login/login.php';</script>");}
	
	?>

<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		$('#pudate').datepicker({dateFormat: 'yy-mm-dd'}); 
		$("#search_tool").autocomplete({
				source: "../../ajax/search_tool.php",
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
                    <h3 class="page-header">ประวัติเบิกจ่าย <?php echo $row_name['t_name'];?> </h3>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการขาย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>รายการ</th>
                                        <th>ลูกค้า</th>
										<th>จำนวน</th>
										<th>คอมเม้น</th>
										<th>คนขาย</th>
										<th>วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_sel; $i++){
										  $row_sel = mysql_fetch_array($result_sel);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_sel['sel_id']; ?></td>
											<td><?php echo $row_sel['t_name']; ?></td>
											<td><?php echo $row_sel['cu_name']; ?></td>
											<td><?php echo $row_sel['sel_qty']; ?></td>
											<td><?php echo $row_sel['sel_comment']; ?></td>
											<td><?php echo $row_sel['e_name']; ?></td>
											<td><?php echo $row_sel['sel_date']; ?></td>
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
                    <h3 class="page-header">เบิก </h3>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการเบิกไปใช้กับห้องเย็น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>รายการ</th>
                                        <th>ลูกค้า</th>
										<th>จำนวน</th>									
										<th>คนเบิก</th>
										<th>คนจ่าย</th>
										<th>วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_burk; $i++){
										  $row_burk = mysql_fetch_array($result_burk);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_burk['orpd_id']; ?></td>
											<td><?php echo $row_burk['t_name']; ?></td>
											<td><?php echo $row_burk['cust_name']; ?></td>
											<td><?php echo $row_burk['orpd_qty']; ?></td>
											<td><?php echo $row_burk['e_name']; ?></td>
											<td><?php echo $row_burk['orpd_e_aprv']; ?></td>
											<td><?php echo $row_burk['orpd_date']; ?></td>
											
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
                    <h3 class="page-header">โยกย้าย </h3>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการโยกย้าย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>รายการ</th>
										<th>จำนวน</th>																	
										<th>คนจ่าย</th>
										<th>วันที่</th>
										<th>จาก</th>
										<th>ไป</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_tr; $i++){
										  $row_tr = mysql_fetch_array($result_tr);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_tr['orpd_id']; ?></td>
											<td><?php echo $row_tr['t_name']; ?></td>
											<td><?php echo $row_tr['orpd_qty']; ?></td>										
											<td><?php echo $row_tr['e_name']; ?></td>
											<td><?php echo $row_tr['orpd_date']; ?></td>
											<td><?php 
													if($row_tr['orpd_wh']==2){
														echo 'นครปฐม';
													}else{
														echo 'กระทุ่มแบน';			
													}
												?>
											</td>
											
											<td><?php 
													if($row_tr['orpd_wh']==2){
														echo 'กระทุ่มแบน';
													}else{
														echo 'นครปฐม';			
													}
												?>
											</td>				
											
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
   
</body>

</html>
