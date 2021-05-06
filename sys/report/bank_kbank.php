<?php session_start();
	  require_once('../include/connect.php');
	
	$sql = "SELECT b.bk_id, b.bk_name, SUM(op.pay_amount) rakas, COUNT(op.pay_id) numpay
			FROM tb_ord_pay op JOIN tb_bank b ON b.bk_id = op.pay_bank
			GROUP BY b.bk_id 
			ORDER by numpay DESC";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>ธนาคากสิกรไทย</title>
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
			require_once ('../include/navproduct.php');
			if($ro_finance!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูการเงินนะคะ'); window.location = '../index.php';</script>");}
		?>
		
        <div id="page-wrapper">
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">สรุปเงินเข้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								สรุปเงินเข้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>จำนวนรายการ</th>
                                        <th>ธนาคาร</th>                                     
                                        <th>รายรับรวม (บาท)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  
									  ?>
									<tr class="gradeA"> 
										
										<td><?php echo $row['numpay']; ?></td>
										<td><a href="bank.php?bankid=<?php echo $row['bk_id']?>"><?php echo $row['bk_name']; ?></a></td>
										<td><?php echo number_format($row['rakas'], 0, '.', ','); ?></td>
											
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