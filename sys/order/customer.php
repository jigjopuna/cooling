<?php session_start();
	require_once('../include/connect.php');

	//for left nav menu path include/navproduct.php
	$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//Product Expandtion
	$sql_all = "SELECT * FROM tb_customer";
	$result_all = mysql_query($sql_all);
	$num_all = mysql_num_rows($result_all);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>ข้อมูลลูกค้า</title>
	
	<?php require_once ('../include/header.php');?>
	<?php require_once('../include/metatagsys.php');?>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = '../pages/login/login.php';
				</script>");
		}
	
	?>
	<script src="../js/jquery-1.11.1.min.js"></script>

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
							<div class="row">
								<table class="table table-bordered table-hover table-striped" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
										<th>ชื่อลูกค้า</th>
                                        <th>บริษัท</th>
										<th>เบอร์ติดต่อ</th>
										<th>อีเมล</th>
                                        <th>ที่อยู่</th>			
										<th>จังหวัด</th>	
                                    
                                    </tr>
                                </thead>
                                <tbody>			
									<?php 
										for($i=1; $i<=$num_all; $i++){
											$row_all = mysql_fetch_array($result_all);
									?>
										<tr class="odd gradeX">
											<td><?php echo $i;?></td>
											<td><a href="cust_edit.php?cust_id=<?php echo $row_all['cust_id'] ?>" target="_blank"><?php echo $row_all['cust_name']; ?></a></td>
											<td><?php echo $row_all['cust_corp']; ?></td>
											<td><?php echo $row_all['cust_tel']; ?></td>
											<td><?php echo $row_all['cust_email']; ?></td>
											<td><?php echo $row_all['cust_address'] ;?></td>
											<td><?php echo $row_all['cust_province'] ;?></td>											
										</tr>
										<?php } ?>
                                </tbody>
								</table>
						 
							 </div> <!-- row -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			


        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php include('../include/footer-script-product.php')?>
	
</body>

</html>
