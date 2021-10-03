<?php session_start();
	  require_once('../include/connect.php');

	
	$sql = "SELECT * 
		    FROM tb_cash_center c
			ORDER BY c.cash_id DESC 
			LIMIT 0,200";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
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
                    <h1 class="page-header">ความเคลื่อนไหวเงิน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการเคลื่อนไหว
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ซื้อของ</th>                                     
                                        <th>เลขเงินเข้า</th>
                                        <th>เงินเข้า (บาท)</th>
                                        <th>เงินออก</th>
										<th>กสิกร ออม</th>
										<th>กสิกร กระแส</th>
										
										<th>กสิกร เดชาธร</th>
										<th>กรุงเทพ เดชาธ</th>
										
										<th>BBL ออม</th>
										
										<th>SCB ออม</th>
										<th>SCB กระแส</th>
									
										<th>KRS ออม</th>
										<th>KRS กระแส</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row['cash_id']; ?></td>
											<td><?php echo $row['cash_po']; ?></td>
											<td><?php echo $row['cash_ord']; ?></td>
											
											<?php if($row['cash_in'] != 0) { ?>
												<td style="background-color:pink"><?php echo number_format($row['cash_in'], 1, '.', ','); ?></td>
											<?php }else{ ?>
												<td><?php echo number_format($row['cash_in'], 1, '.', ','); ?></td>
											<?php }?>
											
											<?php if($row['cash_out'] != 0) { ?>
												<td style="background-color:#e1fb45"><?php echo number_format($row['cash_out'], 1, '.', ','); ?></td>
											<?php }else{ ?>
												<td><?php echo number_format($row['cash_out'], 1, '.', ','); ?></td>
											<?php }?>
											
											
											<td><?php echo number_format($row['cash_now'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash_now1'], 1, '.', ','); ?></td>
											
											
											<td><?php echo number_format($row['cash1'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash2'], 1, '.', ','); ?></td>
											
											<td><?php echo number_format($row['cash_salary'], 1, '.', ','); ?></td>
											
											<td><?php echo number_format($row['cash_emp'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash_emp1'], 1, '.', ','); ?></td>
											
											<td><?php echo number_format($row['cash_kcpns'], 1, '.', ','); ?></td>
											<td><?php echo number_format($row['cash_kcpnc'], 1, '.', ','); ?></td>
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
