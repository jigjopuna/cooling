<?php session_start();
	  require_once('../include/connect.php');
	
	$sql = "SELECT * FROM tb_part_sec ps JOIN province p ON p.id = ps.pars_province ORDER BY pars_id DESC";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>แหล่งซื้อของมือสอง</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>

	</script> 
</head>

<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                      <h1 class="page-header">เพิ่มรายการมือสอง</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
								<strong>เพิ่มคนขายมือสอง</strong> <br> 
						
						</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/finance/addpo.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="poqty" name="poqty" value="1">
										</div>
										
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ร้านค้า </label>
											<input type="text" class="form-control" id="poshop" name="poshop">
										</div>
										
									</div>
									
									
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกรายการสั่งซื้อ</button>
										</div>
									</div>
									
								</form>
							 </div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			
        </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รายละเอียด</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								คนขายของมือสอง
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>  
										<th>ราคา</th>	
                                        <th>ติดต่อ</th>
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
											<td><?php echo number_format($row['pars_id'], 0, '.', ''); ?></td>
											<td><a href="part_sec_detail.php?pars_id=<?php echo $row['pars_id'] ?>"><?php echo $row['pars_name']; ?></td>
											<td><?php echo number_format($row['pars_price'], 0, '.', ','); ?></td>
											<td><?php echo $row['pars_tel']; ?></td>
											<td><?php echo $row['pro_name']; ?></td>
											<td><?php echo $row['pars_date']; ?></td>
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

</html>
