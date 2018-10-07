<?php session_start();
	  require_once('include/connect.php');
	  
	$sql = "SELECT o.ost_status, e.e_name, r.rm_type, q.qcust_name, q.qcust_prov, q.qcust_tel, q.qcust_line, q.qcust_fb, q.qcust_flow, q.qcust_emp, q.qcust_day
			FROM (tb_quo_cust q JOIN tb_ord_status o ON q.qcust_flow = o.ost_id) JOIN tb_room_type r ON r.rm_id = q.qcust_roomtype
			JOIN tb_emp e ON e.e_id = q.qcust_emp
			WHERE q.qcust_status = 0";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รา</title>
<?php require_once ('include/header1.php');?>
<?php require_once('include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			$('#btn_tr').click(validation_tr);
			$('#podate, #tr_date').datepicker({dateFormat: 'yy-mm-dd'});
		});

	</script> 
</head>

<body>

    <div id="wrapper">
        <?php require_once ('include/navcust.php');?>
        <div id="page-wrapper">
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ตารางงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							ตารางงาน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลูกค้า</th>
                                        <th>สถานะ</th>  
										<th>ผู้รับผิดชอบ</th>										
                                        <th>ประเภทห้อง</th>
                                        <th>ช่องทางติดต่อ</th>
										<th>เบอร์ติดต่อ</th>
										<th>จังหวัด</th>
										<th>วันที่</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){ 
										$row = mysql_fetch_array($result);
									?>
										<tr class="gradeA"> 
											<td><?php echo $row['qcust_name']?></td>
											<td><?php echo $row['ost_status']?></td>
											<td><?php echo $row['e_name']?></td>
											<td><?php echo $row['rm_type']?></td>
											<td>1</td>
											<td><?php echo $row['qcust_tel']?></td>
											<td><?php echo $row['qcust_prov']?></td>
											<td><?php echo $row['qcust_day']?></td>
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
<?php 
/*
https://startbootstrap.com/template-categories/all/
https://startbootstrap.com/template-overviews/sb-admin-2/
 http://stackoverflow.com/questions/4383914/how-to-get-single-value-from-php-array
*/
?>
</html>
