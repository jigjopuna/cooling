<?php session_start();
	  require_once('../include/connect.php');
	
	$sql = "SELECT t.t_name, cs.cst_five_meter, cs.cst_min 
FROM tb_count_stock cs JOIN tb_tools t ON t.t_id = cs.cst_prod";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการของต่อ 1 ห้อง</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#buyall').text($('#yodsue').val());
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
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รายการของต่อ 1 ห้อง</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการ <span id="buyall"></span> บาท
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th>                                     
                                        <th>ใช้ต่อ 1 ห้อง</th>
                                        <th>ขั้นต่ำที่ต้องมี</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $i; ?></td> 
											<td><?php echo $row['t_name']; ?></td>
											<td><?php echo number_format($row['cst_five_meter'], 0, '.', ','); //สต็อค ?></td>
											<td><?php echo number_format($row['cst_min'], 0, '.', ','); //สต็อค ?></td> 											
											
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
           
        </div>
		
		<div class="row">
             <div class="col-lg-3">
                  &nbsp;<br>&nbsp;<br>
              </div>
        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <input type="hidden" value="<?php echo number_format($money, 0, '.', ','); ?>" id="yodsue">
	<div id="role" style="display:none"><?php echo $rolepo;?></div>
</body>

</html>
