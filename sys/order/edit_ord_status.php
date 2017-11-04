<?php session_start();
	  require_once('../include/connect.php');
	  
	$o_id = $_GET['o_id'];

	$sql = "SELECT * FROM tb_ord_status";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$row_ord = mysql_fetch_array(mysql_query("SELECT * FROM tb_orders WHERE o_id = '$o_id'"));
	$ord_status = $row_ord['o_status'];
	//echo $ord_status; exit();
	

?>
<!DOCTYPE html>
<html lang="en">

<head>

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
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		$('#date_pay').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
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
                    <h1 class="page-header">อัปเดทสถานะงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							แก้ไขสถานะงาน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

							<div class="row">
								<form action="../db/order/save_edit_ord.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สถานะงาน </label>
											<select class="form-control" id="ord_status" name="ord_status">
												<option value="">เลือกสถานะงาน</option> 
												<?php 
													for($i=1; $i<=$num; $i++){
														$row = mysql_fetch_array($result);												
												?>						
												<option value="<?php echo $row['ost_id']?>" <?php if($row['ost_id']==$ord_status) echo "selected" ?>><?php echo $row['ost_status']?></option>
												
													
												<?php } ?>
											</select>
										</div>
									
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">อัปเดทสถานะงาน</button>
										</div>
									</div>
																
																
									<div class="col-lg-4"></div>
									
									
									<div class="col-lg-4"></div>
									<input type="hidden" name="order_id" value="<?php echo $o_id;?>" >
								</form>
							 </div> <!-- row -->
							
							
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>		
        </div>

            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
