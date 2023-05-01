<?php session_start();
	  require_once('../include/connect.php');
	  $today = date("d-m-Y");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);	
			$('#vatdate').datepicker({dateFormat: 'dd-mm-yy'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
			
			$('input:radio[name=ord_type]').change(function () {
				
				if ($("input[name='ord_type']:checked").val() == 1) {
					$('#form1').attr("action", "../../admin/receive_paper.php");
				}else{	
					$('#form1').attr("action", "../../admin/receive_paper_part.php");
				}
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
							ใบเสร็จห้องเย็น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/receive_paper.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทออเดอร์</label><br>
											<input type="radio" value="1" name="ord_type" checked> ห้องเย็น
											<input style="margin-left: 10px;" type="radio" value="2" name="ord_type"> อะไหล่ใหม่
										</div>
										
										<div class="form-group has-success">
											<input type="radio" value="3" name="ord_type"> เซอร์วิส
										</div>
										
										
									</div>
																		
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="vatdate" name="vatdate" value="<?php echo $today;?>">
										</div>
										
									</div>
									
									<div class="col-lg-3">
										<label class="control-label" for="inputSuccess">หัวบิล</label>
										<div class="form-group has-success">
											<input type="radio" value="1" name="copetype" checked> CPN
											<input style="margin-left: 10px;" type="radio" value="2" name="copetype"> CHK
											<!--<input style="margin-left: 10px;" type="radio" value="3" name="copetype"> TCL888-->
										</div>
										
										<!--<label class="control-label" for="inputSuccess"></label>
										<div class="form-group has-success">
											<input style="" type="radio" value="4" name="copetype"> พระลักษณ์ไทย
										</div>-->
										
									</div>
									
									<div class="col-lg-3">
										<input type="hidden" name="corp_addr" value="1">
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
		
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							บิลอะไหล่  / service
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<a href="../../admin/receive_paper_part.php" id="bilpart"><button id="" type="button" class="btn btn-lg btn-success btn-block">บิลอะไหล่ใหม่ CPN</button>
										</div>
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<a href="../../admin/receive_paper_parsec.php"><button id="" type="button" class="btn btn-lg btn-success btn-block">บิลอะไหล่มือสอง </button>
										</div>
									</div>
									
									<div class="col-lg-4">
										
										
									</div>
									
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