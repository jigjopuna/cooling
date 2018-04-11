<?php session_start();
	  require_once('../include/connect.php');
	
	
	$sql = "SELECT cust_id, cust_name, cust_url FROM tb_customer";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$rowiot = mysql_fetch_array(mysql_query("SELECT COUNT(*) cntiot FROM tb_customer WHERE cust_url != ''"));
	
	$today = date("Y-m-d");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>

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
                    <h1 class="page-header">ลูกค้า Iot</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ลูกค้า Iot  <?php echo $rowiot['cntiot'];?> รายการ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>ลูกค้า</th>
                                        <th>ดูกราฟ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['cust_id']; ?></td>
											<td><?php echo $row['cust_name']; ?></td>
											<?php if($row['cust_url']!= '') { ?>
												<td><a href="http://topcooling.net/sys/iot/<?php echo $row['cust_url'];?>"><button id="" type="button" class="btn btn-lg btn-success btn-block">ดูกราฟ</button></a></td>
											<?php } else { ?>
												<td><button id="" type="button" class="btn btn-lg btn-block">No IoT</button></td>
											<?php } ?>
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
   
	<div style="display:none" id="rolestock"><?php echo $rolestock;?></div>
</body>

</html>
