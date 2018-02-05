<?php session_start();
	  require_once('../include/connect.php');
	  $today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php';</script>");}
	
	?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);	
			$('#vatdate').datepicker({dateFormat: 'yy-mm-dd'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});		
		});
		
		
		function validation(){		
			
			$('#form1').submit();
			
		}
		



	</script> 
</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
		
		    
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ใบเสร็จ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ใบเสร็จ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/receive_paper.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รายการ </label>
											<input type="text" class="form-control" id="vatlist" name="vatlist">
										</div>
										
									</div>
																		
									<div class="col-lg-4">
											
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">VAT </label>
											<select class="form-control" id="vattype" name="vattype">
												<option value="0">เลือก VAT</option>
												<option value="1">VAT 7%</option>
												<option value="2">ไม่ VAT</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="vatdate" name="vatdate" value="<?php echo $today;?>">
										</div>
										
									</div>
									
									
									<div class="col-lg-4">
										

										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หัวบิล </label>
											<select class="form-control" id="vatcompany" name="vatcompany">
												<option value="0">เลือกหัวบริษัท</option>
												<option value="1">Top Cooling</option>
												<option value="2">PT WALL</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">พิมพ์</button>
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

		<!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
