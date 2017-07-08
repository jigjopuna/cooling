<?php session_start();
	require_once('../include/connect.php');
	$cate_id = trim($_GET['cate_id']);

	//for left nav menu path include/navproduct.php
	$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//Product Expandtion
	$sql_all = "SELECT * FROM tb_product WHERE p_cate = '$cate_id' ORDER BY p_id DESC";
	$result_all = mysql_query($sql_all);
	$num_all = mysql_num_rows($result_all);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Expandtion</title>
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once ('../include/header.php');?>
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
		});
		
		function validation(){
			var p_name = $('#p_name').val();
			var p_numya = $('#p_numya').val();
			var p_model = $('#p_model').val();
			var p_price = $('#p_price').val();
			var p_inlet = $('#p_inlet').val(); 
			var p_outlet = $('#p_outlet').val();
			if((p_name=='') || (p_numya=='') || (p_model=='') || (p_price='') || (p_inlet=='') || (p_outlet=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
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
                    <h1 class="page-header">เพิ่มรายการ Expandtion </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เอ็กแพนชั่น วาว
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <div class="row">
								<!--<form action="../db/addprod.php" method="post" name="form1" id="form1" enctype="multipart/form-data">-->
								<form action="../db/addprod.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยีห้อ expand</label>
											<input type="text" class="form-control require" id="p_name" name="p_name">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">น้ำยา</label>
											<input type="text" class="form-control require" id="p_numya" name="p_numya">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รูป</label>
											<input type="file" class="form-control require" id="file" name="fileToUpload">
										</div>
										
										<div class="form-group has-success">
											<button type="button" class="btn btn-lg btn-success btn-block">บันทึก</button>
										</div>
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">รุ่น / model</label>
											<input type="text" class="form-control require" id="p_model" name="p_model">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาเต็ม</label>
											<input type="text" class="form-control require" id="p_price" name="p_price">
										</div>
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อเข้า (นิ้ว)</label>
											<input type="text" class="form-control require" id="p_inlet" name="p_inlet">
										</div>
										
										
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อออก (นิ้ว)</label>
											<input type="text" class="form-control require" id="p_outlet" name="p_outlet">
										</div>
										
										
										
									 </div> <!-- row -->
								
									<input type="hidden" value="<?php echo $cate_id?>" name="p_cate">	
								</form>
							
                           
                        </div>
                        <!-- /.panel-body -->
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
							Expandtion ทั้งหมด  รายการ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
										<th>ชื่อ/ยี่ห้อ expand</th>
                                        <th>Model</th>
										<th>ท่อเข้า</th>
										<th>ท่อออก</th>
										<th>น้ำยา</th>
										<th>ราคา</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>			
									<?php 
										for($i=1; $i<=$num_all; $i++){
											$row_all = mysql_fetch_array($result_all);
									?>
										<tr class="odd gradeX">
											<td><?php echo $row_all['p_id'];?></td>
											<td><a href="../productupdate/<?php echo $row_all['p_cate']?>.php?p_id=<?php echo $row_all['p_id']?>&p_cate=<?php echo $row_all['p_cate']?>" target="_blank"><?php echo $row_all['p_name'];?></a></td>
											<td><?php echo $row_all['p_model'];?></td>
											<td><?php echo $row_all['p_inlet'];?></td>
											<td><?php echo $row_all['p_outlet'];?></td>
											<td><?php echo $row_all['p_numya'];?></td>
											<td align='right'><?php echo number_format($row_all['p_price'], 0, '.', ',');?></td>
										</tr>
										<?php } ?>
                                </tbody>
								</table>
						 
							 </div> <!-- row -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
		
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
	
    

    </script>

</body>

</html>
