<?php session_start();
	  require_once('../include/connect.php');
	
	//stock
	$sql = "SELECT t.t_name, c.cu_name, se.sel_id, se.sel_qty, se.sel_price, se.sel_comment, se.sel_date, e.e_name FROM ((tb_sell se JOIN tb_tools t ON t.t_id = se.sel_detail) JOIN tb_cust c ON c.cu_id = se.sel_cust) JOIN tb_emp e ON e.e_id = se.sel_approve LIMIT 0,100";
	/*$sql = "SELECT * 
			FROM (tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_cust on cu_id = orpd.orpd_sell_cust
			WHERE orpd.o_id = 2 ";*/
			//o_id = 2 หมายถึงเป็นเบิกสต็อกออกเพื่อเป็นการขายให้คนอื่น ไม่ใช่เบิกของไปใช้สร้างห้องเย็น
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$today = date("Y-m-d");
	

	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ'); window.location = '../pages/login/login.php';</script>");}
	
	?>

<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		$('#pudate').datepicker({dateFormat: 'yy-mm-dd'}); 
		$("#search_tool").autocomplete({
				source: "../../ajax/search_tool.php",
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
                    <h1 class="page-header">รายการขาย</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการขาย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>รายการ</th>
                                        <th>ลูกค้า</th>
										<th>จำนวน</th>
										<th>ราคา</th>
										<th>คนขาย</th>
										<th>คอมเม้น</th>
										<th>วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['sel_id']; ?></td>
											<td><?php echo $row['t_name']; ?></td>
											<td><?php echo $row['cu_name']; ?></td>
											<td><?php echo $row['sel_qty']; ?></td>
											<td><?php echo $row['sel_price']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><?php echo $row['sel_comment']; ?></td>
											<td><?php echo $row['sel_date']; ?></td>
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
   
</body>

</html>
