<?php session_start();
	  require_once('../include/connect.php');
	
	//โอนเข้ามา
	$sql = "SELECT ordp.orpd_id, t.t_name, e.e_name, c.cust_name, ordp.orpd_date, ordp.orpd_qty
			FROM (((tb_ord_prod ordp JOIN tb_orders o ON o.o_id = ordp.o_id) 
				JOIN tb_customer c ON c.cust_id = o.o_cust) 
				JOIN tb_emp e ON e.e_id = ordp.ot_emp)
				JOIN tb_tools t ON ordp.ot_id = t.t_id";

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
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = '../pages/login/login.php';
				</script>");
		}
	
	?>

<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		$('#stodate').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_tool").autocomplete({
				source: "../../ajax/search_tool.php",
				minLength: 1
		});
		$("#search_ord").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
		});
		
		$("#search_emp").autocomplete({
				source: "../../ajax/search_emp.php",
				minLength: 1
		});
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var payinqty = $('#payinqty').val();
			var paydate = $('#paydate').val();
			if((search_custname=='') || (payinqty=='') || (paydate=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
			}
		}
		
	});
	
</script>

</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เบิกของ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เบิกของ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/stock/addberk.php" method="post" name="form1" id="form1"">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ของ </label>
											<input type="text" class="form-control" id="search_tool" name="search_tool">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="berkqty" name="berkqty">
										</div>
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">งานของลูกค้า</label>
											<input type="text" class="form-control" id="search_ord" name="search_ord">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คนเบิก</label>
											<input type="text" class="form-control" id="search_emp" name="search_emp">
										</div>
										
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่เบิก</label>
											<input type="text" class="form-control" id="stodate" name="stodate" value="<?php echo $today;?>">
										</div>
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกการเบิก</button>
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
                    <h1 class="page-header">รายการที่เบิก</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								รายการที่เบิก
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>รายการ</th>
										<th>ออเดอร์ลูกค้า</th>
										<th>คนเบิก</th>
										<th>จำนวน</th>
                                        <th>วันที่เบิก</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['orpd_id']; ?></td>
											<td><?php echo $row['t_name']; ?></td>
											<td><?php echo $row['cust_name']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><?php echo $row['orpd_qty']; ?></td>
											<td><?php echo $row['orpd_date']; ?></td>											
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
