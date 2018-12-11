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
<title>SHOP PRODUCT</title>
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
			$( "#tabledetail" ).empty();
			$('#proname').removeClass('hide');
				var poprodtype = $('#poprodtype').val();
				if(poprodtype==11){
					$('#form1').attr('action','machinet.php');
					$('#tabledetail').load("../../ajax/return_machine.php");
					$("#prodname").autocomplete({			
						source: "../../ajax/search_product.php",
						minLength: 1
					});
				}else if(poprodtype==1){
					$('#form1').attr('action','.php');
					$('#tabledetail').load("../../ajax/return_mass.php");
					$("#prodname").autocomplete({			
						source: "../../ajax/search_productroom.php",
						minLength: 1
					});
				}else if(poprodtype==2){
					$('#form1').attr('action','roomt.php');
					$('#tabledetail').load("../../ajax/return_room.php");
					$("#prodname").autocomplete({			
						source: "../../ajax/search_productroom.php",
						minLength: 1
					});
				}else if(poprodtype==3){
					$('#form1').attr('action','elec.php');
					$('#tabledetail').load("../../ajax/return_elec.php");
					$("#prodname").autocomplete({			
						source: "../../ajax/search_elec.php",
						minLength: 1
					});
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
                    <h1 class="page-header">สินค้า PRODUCT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เลือกสินค้า
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
									
									<div class="col-lg-4">
										<div id="proname" class="form-group has-success hide">
											<label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
											<input type="text" class="form-control" id="prodname" name="prodname">
										</div>
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ค้นหา</button>
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
								รายการสินค้า
                        </div>
                        <div class="panel-body" id="tabledetail">
                            
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
