<?php session_start();
	  require_once('../include/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once('../include/header.php');?>
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once('../include/inc_role.php');
		$sql = "SELECT * 
				FROM tb_cust_depo c JOIN province p ON c.cuplt_province = p.id";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
	
	?>
</head>
<body>

    <div id="wrapper">
        <?php require_once ('../include/navplt.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ข้อมูลลูกค้า พระลักษณ์ไทย</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ข้อมูลลูกค้า ฝากสินค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ </th>
                                        <th>ชื่อลูกค้า</th>
										<th>เบอร์ติดต่อ</th>
										<th>จังหวัด</th>
										<th>วันที่ลงระบบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td> <?php echo $row['cuplt_id']; ?> </td>
											<td><a href="cust_edit_plt.php?cust_id=<?php echo $row['cuplt_id'] ?>"><?php echo $row['cuplt_name']; ?></a></td>
											<td> <?php echo $row['cuplt_tel']; ?> </td>
											<td> <?php echo $row['pro_name']; ?> </td>
											<td> <?php echo $row['cuplt_day']; ?> </td>
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
