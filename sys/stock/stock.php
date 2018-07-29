<?php session_start();
	  require_once('../include/connect.php');
	
	//stock
	$sql = "SELECT *
			FROM tb_tools t JOIN tb_tools_type tot ON t.t_type = tot.to_typeid";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sql_push = "SELECT t.t_name, t.t_id, ps.pu_id, ps.pu_wh, ps.pu_qty, ps.pu_date FROM tb_pushstock ps JOIN tb_tools t ON t.t_id = ps.pu_tid";
	$result_push= mysql_query($sql_push);
	$num_push = mysql_num_rows($result_push);
	
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
		
		$role_ = mysql_fetch_array(mysql_query("SELECT ro_stock FROM tb_role WHERE ro_emp_id = '$e_id'"));
		$rolestock = $role_['ro_stock'];
	
	?>

<script>
	$(document).ready(function(){
		$('#btn').click(validation); 
		$('#btncost').click(validcost);
		$('#pudate').datepicker({dateFormat: 'yy-mm-dd'}); 
		$(".search_tool").autocomplete({
				source: "../../ajax/search_tool.php",
				minLength: 1
		});
		var ro_stock = $('#rolestock').html();
		if(ro_stock==1){
			$('#puwh option:eq(2)').prop("selected", true);
			$('#puwh option:eq(0)').prop("disabled", true);
			$('#puwh option:eq(1)').prop("disabled", true);
		}else if(ro_stock==2){
			$('#puwh option:eq(1)').prop("selected", true);
			$('#puwh option:eq(0)').prop("disabled", true);
			$('#puwh option:eq(2)').prop("disabled", true);
			
		}else{}
	});
	function validcost(){ 
		var tools = $('#tool').val();
		var costs = $('#cost').val();
		if(isNaN(tools)){
			alert('กรุณาเลือกรายการให้ถูกต้องนะคะ');
			return false;
		}
		if(isNaN(costs)){
			alert('กรุณาใส่ราคาเป็นตัวเลขนะคะ');
			return false;
		}
			
		if(tools=='' || costs==''){
			alert("ใส่ข้อมูลต้นทุนให้ครบนะค่ะ");
			return false;
		}else{
			$('#form2').submit();
			
		}
		
	}
	
	
	function validation(){
			var search_tool = $('#search_tool').val();
			var puqty = $('#puqty').val();
			var pudate = $('#paydate').val();
			if(isNaN(search_tool)){
				alert('กรุณาเลือกรายการสต็อกให้ถูกต้องนะคะ');
				return false;
			}
			if((search_tool=='') || (puqty=='') || (pudate=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ");
				return false;				
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
                    <h1 class="page-header">ใส่ของเพิ่ม (เพิ่มสต็อก)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							ใส่ของเพิ่ม (เพิ่มสต็อก)
							
						</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/stock/pushstock.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> สินค้า/รายการ (รวม นครปฐม กระทุ่มแบน )</label>
											<input type="text" class="form-control search_tool" id="search_tool" name="search_tool">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวน</label>
											<input type="text" class="form-control" id="puqty" name="puqty">
										</div>
										
										
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โกดัง </label>
											<select class="form-control" id="puwh" name="puwh">
												<!--value จะผูกกับรหัส emp ชายกับพี่ไพรฑูรย์ -->
												<option value="0">เลือกโกดัง</option> 					
												<option value="3">กระทุ่มแบน</option>
												<option value="2">นครปฐม</option>
												
											</select>
										</div>
										
									</div>
									
									
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="pudate" name="pudate" value="<?php echo $today;?>">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">เพิ่มสต็อก</button>
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
                    <h1 class="page-header">สต็อกอะไหล่</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								สต็อกอะไหล่
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>อะไหล่</th>
                                        <th>สต็อก</th>
										<!--<th>กระทุ่มแบน</th>-->
										<th>ต้นทุน (บาท)<!-- นครปฐม--></th>
										<!--<th>ต้นทุน (บาท) กระทุ่มแบน</th>-->
										<th>ราคากลาง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  
										  $stock = $row['t_stock'];
										  $stock1 = $row['t_stock1'];
										  $allstock = $stock + $stock1;
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['t_id']; ?></td>
											<td><a href="stocklog.php?t_id=<?php echo $row['t_id']?>"><?php echo $row['t_name'].' ('.$allstock.')'; ?></td>
											<td><?php echo $stock; ?></td>
											
											<td><?php echo $row['t_cost']; ?></td>
											
											<td><?php echo $row['t_cost_center']; ?></td>
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
			
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ประวัติใส่สต็อก</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ประวัติใส่สต็อก
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>                                     
                                        <th>อะไหล่</th>
										<th>จำนวน</th>
                                        <th>สโตร์</th>
										<th>วันที่</th>
									
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_push; $i++){
										  $row_push = mysql_fetch_array($result_push);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row_push['pu_id']; ?></td>
											<td><a href="stocklog.php?t_id=<?php echo $row_push['t_id']?>"><?php echo $row_push['t_name']; ?></td>
											<td><?php echo $row_push['pu_qty']; ?></td>
					
											<?php if($row_push['pu_wh']==2) { ?>
												<td><?php echo 'นครปฐม'; ?></td>
											<? } else if ($row_push['pu_wh']==3){ ?>
												<td><?php echo 'กระทุ่มแบน'; ?></td>
											<? } ?>
											<td><?php echo $row_push['pu_date']; ?></td>
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
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ใส่ต้นทุนอะไหล่</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							ใส่ต้นทุนอะไหล่
							
						</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/stock/addcost.php" method="post" name="form2" id="form2" enctype="multipart/form-data">
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> สินค้า/รายการ (รวม นครปฐม กระทุ่มแบน )</label>
											<input type="text" class="form-control search_tool" id="tool" name="tool">
										</div>
										
										<div class="form-group has-success">
											<button id="btncost" type="button" class="btn btn-lg btn-success btn-block">ใส่ต้นทุน</button>
										</div>
									</div>
																		
									<div class="col-lg-4">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ต้นทุน (ราคา)</label>
											<input type="text" class="form-control" id="cost" name="cost">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-4">
									
									</div>
									
								</form>
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
   
	<div style="display:none" id="rolestock"><?php echo $rolestock;?></div>
</body>

</html>
