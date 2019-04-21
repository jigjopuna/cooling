<?php session_start();
	  require_once('../include/connect.php');
	  
	  $sql_vat = "SELECT * FROM tb_tax t JOIN tb_ord_type o ON t.vat_ord_type = o.ort_id ORDER BY t.vat_id DESC LIMIT 0,30";
	  $result_vat = mysql_query($sql_vat);
	  $num_vat = mysql_num_rows($result_vat);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once('../include/header.php');?>
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once('../include/inc_role.php');?>
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
			$('#btn1').click(validation1);			
			$('#vatdate, #servdate').datepicker({dateFormat: 'dd-mm-yy'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
			$("#search_custs").autocomplete({
				source: "../../ajax/search_custservice.php",
				minLength: 1
			});
		});
		
		function validation(){
			$('#form1').submit();
		}
		function validation1(){
			$('#form2').submit();
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
							ใบเสร็จลูกค้าห้องเย็น
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
										
										
									</div>
																		
									<div class="col-lg-4">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="vatdate" name="vatdate" value="<?php echo $today;?>">
										</div>
										
									</div>
									
									<div class="col-lg-4">
										<!--<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หัวบิล </label>
											<select class="form-control" id="corp_addr" name="corp_addr">
												<option value="0">เลือกหัวบริษัท</option>
												<option value="1">Top Cooling</option>
												<option value="2">PT WALL</option>
											</select>
										</div>-->
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
							ใบเสร็จงานเซอร์วิส
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/receive_paper_serv.php" method="post" name="form2" id="form2" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custs" name="search_custs">
										</div>
									</div>
																		
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="servdate" name="servdate" value="<?php echo $today;?>">
										</div>
										
									</div>
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">VAT </label>
											<input type="checkbox" class="form-control" id="servat" name="servat">
										</div>
									</div>
									
									<div class="col-lg-3">
										<!--<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หัวบิล </label>
											<select class="form-control" id="corp_addr" name="corp_addr">
												<option value="0">เลือกหัวบริษัท</option>
												<option value="1">Top Cooling</option>
												<option value="2">PT WALL</option>
											</select>
										</div>-->
										<input type="hidden" name="corp_addr" value="1">
										<div class="form-group has-success">
											<button id="btn1" type="button" class="btn btn-lg btn-success btn-block">พิมพ์</button>
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
                    <h1 class="page-header">เลขภาษี</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ประวัติหมายเลขกำกับภาษี
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>หมายเลข  VAT</th>
										<th>ประเภทงาน</th>
                                        <th>หมายเลขออเดอร์</th>
										<th>วันที่</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_vat; $i++){
										  $row_vat = mysql_fetch_array($result_vat);
									  ?>
										<tr class="gradeA">
											
												<td>00<?php echo $row_vat['vat_ord']; ?></td>
												<td><?php echo $row_vat['ort_name']; ?></td>
												<td><?php echo $row_vat['vat_ord_no'] ;?></td>
												<td><?php echo $row_vat['vat_date'] ;?></td>
											
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
