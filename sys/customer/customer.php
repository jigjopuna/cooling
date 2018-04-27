<?php session_start();
	  require_once('../include/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once('../include/header.php');?>
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once('../include/inc_role.php'); ?>
	<?php 
		
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){ exit("<script>alert('กรุณา Login ก่อนนะคะ'); window.location = '../pages/login/login.php';</script>");}
		
		$role_ = mysql_fetch_array(mysql_query("SELECT * FROM tb_role WHERE ro_emp_id = '$e_id'"));
		$role = $role_['ro_cust'];	
		if($role!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูข้อมูลลูกค้านะคะ'); window.location = '../index.php';</script>");}
		
		
		$sql_all = "SELECT * FROM tb_customer c JOIN province p ON c.cust_province = p.id";
		$result_all = mysql_query($sql_all);
		$num_all = mysql_num_rows($result_all);
	
	?>
</head>
<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ข้อมูลลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ข้อมูลลูกค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>บริษัท</th>
										<th>เบอร์ติดต่อ</th>
										<th>จังหวัด</th>
										<th>วันที่ลงระบบ</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_all; $i++){
										  $row_all = mysql_fetch_array($result_all);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_all['cust_id']; ?></td>
											<td><a href="cust_edit.php?cust_id=<?php echo $row_all['cust_id'] ?>"><?php echo $row_all['cust_name']; ?></a></td>
											<td><?php echo $row_all['cust_corp']; ?></td>
											<td><?php echo $row_all['cust_tel']; ?></td>
											<td><?php echo $row_all['pro_name'] ;?></td>
											<td><?php echo $row_all['cust_date'] ;?></td>
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

   

</body>

</html>
