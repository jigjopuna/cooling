<?php session_start();
	  require_once('../include/connect.php');
	  $today = date("Y-m-d");
	
	//ประเภทสินค้า
	$sql_tooltype = "SELECT * FROM tb_tools_type";
	$result_tooltype = mysql_query($sql_tooltype);
	$num_tooltype = mysql_num_rows($result_tooltype);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>เพิ่มสินค้าอุปกรณ์ห้องเย็น</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);	
			$('#vatdate').datepicker({dateFormat: 'yy-mm-dd'});
			$('#poprodtype').change(selectprod);	
		});
		
		function validation(){		
			$('#form1').submit();
		}
		
		function selectprod(){
			$( "#loadform" ).empty();
			$('#proname').removeClass('hide');
				var poprodtype = $('#poprodtype').val();
				if(poprodtype==1){ //เครื่อง
					$('#form1').attr('action','machinet.php');
					$('#loadform').load("../../ajax/return_machine.php");
				}else if(poprodtype==2){//ห้อง
					$('#form1').attr('action','roomt.php');
					$('#loadform').load("../../ajax/load_form_room.php").slideDown();
				}
		}
		



	</script> 
</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
		
		    
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เพิ่มสินค้า PRODUCT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เลือกหมวดหมู่สินค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/receive_paper.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
										<select class="form-control" id="poprodtype" name="poprodtype">
												<option value="0">เลือกประเภทสินค้า</option> 
												<?php 
													for($i=1; $i<=$num_tooltype; $i++){
														$row_tooltype = mysql_fetch_array($result_tooltype);
													
												?>						
													<option value="<?php echo $row_tooltype['to_typeid'];?>"><?php echo $row_tooltype['to_typename']?></option>
												<?php } ?>
											</select>
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
							ฟอร์ม
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row" id="loadform">
								
							</div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>