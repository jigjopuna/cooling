<?php session_start();
	  require_once('../include/connect.php');
	
	$sql = "SELECT * FROM tb_bank WHERE bk_cop = 'PLT' ORDER BY bk_code";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>สมุดบัญชี พระลักษณ์ไทย</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			$('#btn_tr').click(validation_tr);
			$('#podate, #tr_date').datepicker({dateFormat: 'yy-mm-dd'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
				
		});
		
	</script> 
</head>

<body>

    <div id="wrapper">
        <?php 
			require_once ('../include/navplt.php');
			if($ro_finance!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูการเงินนะคะ'); window.location = '../index.php';</script>");}
			$rowtype = 0;
		?>
		
        <div id="page-wrapper">
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">บัญชีธนาคาร พระลักษณ์ไทย</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								บัญชีธนาคาร พระลักษณ์ไทย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>##</th>
                                        <th>ธนาคาร</th>                                     
                                        <th>บัญชี</th>
										<th>บริษัท</th>
										<th>ที่มาของรายได้</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  if($rowtype != $row['bk_code']){ echo '<tr style="height:5px;"><td colspan="5" align="center">.</td></tr>'; $rowtype = $row['bk_code'];}
										  
									  ?>
									<tr class="gradeA"> 
										
										<td><?php echo $row['bk_id']; ?></td>
										<td><?php echo $row['bk_name']; ?></td>
										<td><?php echo $row['bk_acc']; ?></td>
										<td><?php echo $row['bk_cop']; ?></td>
										<td><?php echo $row['bk_target']; ?></td>
											
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