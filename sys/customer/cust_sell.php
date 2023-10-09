<?php session_start();
	  require_once('../include/connect.php');
	  $e_id = $_SESSION['ss_emp_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	
	<?php 
		$dates = date('Y-m-d');
		require_once('../include/header.php');
		require_once('../include/metatagsys.php');
		require_once('../include/inc_role.php');
		
		$sql = "SELECT *  
			  FROM ((tb_sell_contact s JOIN tb_emp e ON s.sc_emp = e.e_id)
						JOIN province p ON p.id =  s.sc_province)
						JOIN tb_ord_status o ON o.ost_id = s.sc_action

			  WHERE o.ost_type = 0
			  ORDER BY s.sc_id DESC";
		$result = mysqli_query($con, $sql);
		$num = mysqli_num_rows($result);
		
		$sql_status = "SELECT * FROM tb_ord_status WHERE ost_type = 0";
		$result_status = mysqli_query($con, $sql_status);
		$num_status = mysqli_num_rows($result_status);
		
		$sql_type = "SELECT * FROM tb_ord_type ORDER BY ort_id";
		$result_type = mysqli_query($con, $sql_type);
		$num_type = mysqli_num_rows($result_type);
	?>
	
	<script>
		$(document).ready(function() {
			$('.btn-success').click(validation);
			$('#datepick').datepicker({dateFormat: 'yy-mm-dd'});
			$("#province").load("../../ajax/province_server.php");
		});
		
		function validation(){
			var cust_name = $('#cust_name').val();
			var detail = $('#detail').val();
			var province = $('#province').val();
			
			
			
			if(cust_name==''){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
				return false;
			}else if(province < 1){
				alert("เลือกจังหวัดด้วยนะคะ"); 
				return false;
			}else if(detail ==''){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
				return false;
			}else{
				$('#form1').submit();				
			}
		}	
    </script>
<title>เซลล์ รีพอร์ต</title>


</head>
<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">SELL REPROT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เซลล์คุยกับลูกค้า  <span> <a href="../report/print/sell_talks.php">ปริ้นรายการ</a> </span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/cust/custtalk.php" id="form1" name="form" method="post" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ชื่อ ลูกค้า </label>
											<input type="text" class="form-control" id="cust_name" name="cust_name">
										</div>	
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> เบอร์ลูกค้า </label>
											<input type="text" class="form-control" id="cust_tel" name="cust_tel">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทสินค้า</label>
											<select class="form-control" id="ord_type" name="ord_type">
												<?php 
													for($i=1; $i<=$num_type; $i++) { 
														$row_type = mysqli_fetch_array($result_type);
												?>
													<option value="<?php echo $row_type['ort_type']; ?>"><?php echo $row_type['ort_name'];?></option>
												
												<?php } ?>
												
											</select>
										</div>

										
									</div>
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> จังหวัด </label>
											<select class="form-control" id="province" name="province">
											</select>
										</div>
										
										<div class="form-group">
										  <label for="comment">รายละเอียด</label>
										  <textarea class="form-control" rows="5" id="detail" name="detail"></textarea>
										</div>
									</div>

									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สิ่งที่ทำไป</label>
											<select class="form-control" id="action" name="action">
												<option value="23">กำลังคุยกับลูกค้า</option> 
												<?php 
													for($i=1; $i<=$num_status; $i++) { 
														$row_status = mysqli_fetch_array($result_status);
												?>
													<option value="<?php echo $row_status['ost_id']; ?>"><?php echo $row_status['ost_status'];?></option>
												
												<?php } ?>
												
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess"> ความเป็นไปได้ </label>
											<input type="text" class="form-control" id="occu" name="occu">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ระดับความสำคัญ</label>
											<select class="form-control" id="serverity" name="serverity">
												<option value="10">100% เอาแน่อน </option> 
												<option value="9">90% สนใจมาก พร้อมจ่าย</option> 
												<option value="8">80% พร้อมซื้อ แต่รอไฟฟ้า</option> 
												<option value="7">70% พร้อมซื้อ รอถามที่บ้าน</option>
												<option value="6">60% สนใจ มาเยี่ยมชมเราแล้ว</option>
												<option value="5">50% หาข้อมูล </option>
												<option value="4">40% หาข้อมูล</option> 
												<option value="3">30% หาข้อมูล</option> 
												<option value="2">20% หาข้อมูล </option>
												<option value="1">10% หาข้อมูล</option>
																											
											</select>
										</div>
										
									</div>
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="datepick" name="datepick" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูล</button>
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
                    <h1 class="page-header">ข้อมูลว่าที่ลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ปิดลูกค้าให้ได้ สู็ๆ เขาลูก
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style="width:3%; font-size:12px;">ลำดับ</th>
                                        <th style="width:10%">ชื่อลูกค้า</th> 
                                        <th style="width:8%">เบอร์</th>
                                        <th style="width:8%">จังหวัด</th>
										
                                        <th style="width:35%">รายละเอียด</th>
										
										<th style="width:3%; font-size:12px;">Serv</th>
										<th style="width:10%">สิ่งที่ทำไป</th>
										<th style="width:10%">โอกาส</th>
										<th style="width:5%">เซลล์</th>
										<th style="width:7%">วันที่</th>
										
                                    </tr>
                                </thead>  
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysqli_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['sc_id']; ?></td>
											<td><?php echo $row['sc_name']; ?></td>
											<td><?php echo $row['sc_tel']; ?></td>
											<td><?php echo $row['pro_name']; ?></td>
											<td><?php echo $row['sc_detail']; ?></td>
											
											<td><?php echo $row['sc_severity']; ?></td>
											<td><?php echo $row['ost_status']; ?></td>
											
											<td><?php echo $row['sc_occu']; ?></td>
											<td><?php echo $row['e_name']; ?></td>
											<td><?php echo $row['sc_date']; ?></td>
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
