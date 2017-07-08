<?php  session_start(); 
	require_once('../../include/connect.php');
	$admin_id = $_SESSION[ss_adminid];
	$today = date("Y-m-d");
	$sql = " SELECT * FROM tb_user u JOIN tb_user_type ut ON u.u_type = ut.ut_id";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>ข้อมูลลูกค้า</title>
	<meta name="description" content="">
	<?php require_once ('../../include/header.php');?>

</head>

<body>

    <div id="wrapper">
        <?php require_once ('../../include/navadmin-sub.php');?>

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
							ลูกค้าทั้งหมด <?php echo number_format($num, 0, '.', ',') ?> คน  
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ชื่อลูกค้า</th>
                                        <th>Username</th>
                                        <th>Password</th>
										<th>ประเภท</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										for($i=1;$i<=$num; $i++){
											$row = mysql_fetch_array($result);
																			
									?>
										<tr class="odd gradeX">
											<td><?php echo $row[u_name]?></td>
											<td><?php echo $row[u_user]?></td>
											<td><?php echo $row[u_pass]?></td>
											<td><?php echo $row[ut_type]?></td>
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php require_once ('../../include/footer.php');?>
</body>

</html>
