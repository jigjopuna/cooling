<?php session_start();
	  require_once('../include/connect.php');
	  $sql_com = "SELECT * FROM tb_com_brand"; $result_com = mysql_query($sql_com); $num_com = mysql_num_rows($result_com);
	  $sql_coil = "SELECT * FROM tb_cooling_brand"; $result_coil = mysql_query($sql_coil); $num_coil = mysql_num_rows($result_coil);
	  
	  
	  $sql_sale = "SELECT e.e_id, e.e_name, e.e_tel FROM tb_emp e JOIN tb_role r  ON e.e_id = r.ro_emp_id WHERE r.ro_quotation != 0 AND e_publish = 1"; 
	  $result_sale = mysql_query($sql_sale); 
	  $num_sale = mysql_num_rows($result_sale);
	 
	  $sql_condensing = "SELECT t_id, t_name, t_model, t_cost, t_hp, t_cw5, t_cw20, t_attrib1, t_attrib2, t_attrib3 FROM tb_tools WHERE t_type = 11 AND t_subtype = 1";
	  $result_condensing = mysql_query($sql_condensing);
	  $num_condensing = mysql_num_rows($result_condensing);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	require_once ('../include/header.php');
	require_once('../include/metatagsys.php');
	$dates = date('Y-m-d');
?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('#btn').click(validation);
		$('#date_pay').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust_q.php",
				minLength: 1
		});
		
		$('input:radio[name=roomstype]').change(function () {
            if ($("input[name='roomstype']:checked").val() == 1) {
                $('#form1').attr("action", "../../admin/speedlock_newiso.php");

            }

            if ($("input[name='roomstype']:checked").val() == 2) {
                $('#form1').attr("action", "../../admin/speedlock_embed.php");
            }

			if ($("input[name='roomstype']:checked").val() == 3) {
                $('#form1').attr("action", "../../admin/speedlock_advance.php");
            }

        });
		
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var ord_temp = $('#ord_temp').val();
			var ship_cost = $('#ship_cost').val();
			var voltage = $('#voltage').val();
			var sizes = $('#sizes').val(); 
			var prods = $('#prods').val();
			
			var hp = $('#hp').val();
			
			var ord_price = $('#ord_price').val();
			
			if(search_custname==''){
				alert("ใส่ชื่อลูกค้าด้วยนะคะ"); 
				return false;
			}else if((ord_temp=='') ||isNaN(ord_temp)){
				alert("ใส่อุณหภูมิเป็นตัวเลขด้วยนะค่ะ"); 
				return false;				
			}else if(prods==''){
				alert("ใส่สินค้าด้วยนะคะ"); 
				return false;
			}else if(hp==''){
				alert("ใส่แรงม้าคอมเพรสเซอร์ด้วยนะคะ"); 
				return false;
			}else{
				$('#form1').submit();				
			}
		}		
	});

</script>
</head>

<body>

    <div id="wrapper">
		<?php 
			require_once('../include/inc_role.php'); 
			require_once ('../include/navproduct.php');
			if($ro_order!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการดูออเดอร์นะคะ'); window.location = '../index.php';</script>");}
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ขอใบเสนอราคา Speed Lock</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ขอใบเสนอราคา Speed Lock
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/speedlock_advance.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname" value="6">
										</div>
										
									
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กว้าง</label>
											<input type="text" class="form-control" id="r_width" name="r_width" value="2.40">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว</label>
											<input type="text" class="form-control" id="r_lenght" name="r_lenght" value="3.00">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง</label>
											<input type="text" class="form-control" id="r_high" name="r_high" value="2.40">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สินค้า (เช่น หมู ปลา ทุเรียน)</label> 
											<input type="text" class="form-control" id="prods" name="prods" value="อาหาร" placeholder="หมู"> 
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ปริมาณสินค้าเข้าต่อวัน (kg)</label>
											<input type="text" class="form-control" id="qtyperday" name="qtyperday" value="500">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ <strong><u>ก่อนเข้า</u></strong> ห้องเย็น (องศา)</label>
											<input type="text" class="form-control" id="tempbefore" name="tempbefore" value="5">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทห้อง</label><br>
											<input type="radio" value="1" name="instype" > สำเร็จรูป
											<input type="radio" value="2" name="instype" style="margin-left:50px;" checked>  ติดตั้งหน้างาน
										</div>
										
									</div>
									
									
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โฟม</label>
											<select class="form-control" id="foam" name="foam">
												<option value="1" >PU</option>
												<option value="2" selected >PS</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โฟมกี่นิ้ว</label>
											<select class="form-control" id="foaminch" name="foaminch">
												<option value="4" selected>4</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">คอม 220/380</label>
											<select class="form-control" id="voltage" name="voltage">
												<option value="380">380</option>
												<option value="220">220</option>
											</select>
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลือกขนาดแรงม้า HP</label>
											<input type="text" class="form-control" id="hp" name="hp" value="3" placeholder="3">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จำนวนเครื่อง คอยล์เย็น แผงไฟ (ชุด)</label>
											<input type="text" class="form-control" id="qtyhp" name="qtyhp" value="1">
										</div>


										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอมเพรสเซอร์</label>
											<select class="form-control" id="comp_name" name="comp_name">
											<?php for($i=1; $i<=$num_com; $i++) { 
												$row_com = mysql_fetch_array($result_com);
											?>
												<option value="<?php echo $row_com['comp_id']?>"><?php echo $row_com['com_brand']?></option>
											
											<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอยล์เย็น</label>
											<select class="form-control" id="coil_name" name="coil_name">
											<?php for($i=1; $i<=$num_coil; $i++) { 
												$row_coil = mysql_fetch_array($result_coil);
											?>
												<option value="<?php echo $row_coil['cool_id']?>"><?php echo $row_coil['cool_brand']?></option>
											
											<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หัวบิลบริษัท</label><br>
											<input type="radio" value="1" name="corp" checked > CPN
											<input type="radio" value="2" name="corp" style="margin-left:50px;" >  TCL
										</div>

									</div>
									
																		
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ </label>
											<input type="text" class="form-control" id="ord_temp" name="ord_temp" value="-18">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าขนส่ง </label>
											<input type="text" class="form-control" id="ship_cost" name="ship_cost" value="8000">
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">วันที่</label>
											<input type="text" class="form-control" id="date_pay" name="date_pay" value="<?php echo $dates;?>">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตู</label>
											<select class="form-control" id="doortype" name="doortype">
												<option value="1">บานสวิง</option>
												<option value="2">บานเลื่อน</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กำไร % </label>
											<input type="text" class="form-control" id="percent" name="percent" value="40">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ปริมาณเต็มความจุ (ตัน)</label>
											<input type="text" class="form-control" id="maxqty" name="maxqty" >
										</div>
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ระยะเวลาลดอุณหภูมิ (ชม.)</label>
											<input type="text" class="form-control" id="hours" name="hours" value="18">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">พนักงานขาย</label>
											<select class="form-control" id="sale_id" name="sale_id">
												<?php for($i=1; $i<=$num_sale; $i++) { 
													$row_sale = mysql_fetch_array($result_sale);
												?>
													<option value="<?php echo $row_sale['e_id']?>" <?php if($e_id==$row_sale['e_id']){ ?> selected <?php } ?> >
														<?php echo $row_sale['e_name']?>
													</option>
											
												<?php } ?>
											</select>
										</div>
										
									</div>
									
									
									
									<div class="col-lg-3">
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูกว้าง เมตร</label>
											<input type="text" class="form-control" id="d_width" name="d_width" value="1.0">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประตูสูง เมตร</label>
											<input type="text" class="form-control" id="d_high" name="d_high" value="2.0">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">พื้น</label>
											<select class="form-control" id="floor1" name="floor1">
												<option value="1">อลูมิเนียมลายกันลื่น</option>
												<option value="2">ปูน</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เบ็ดเตล็ด</label>
											<input type="text" class="form-control" id="bedtaled" name="bedtaled" value="43000">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าแรง</label>
											<input type="text" class="form-control" id="labors" name="labors" value="40000">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ส่วนลด</label>
											<input type="text" class="form-control" id="discount" name="discount" value="10000">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">โชว์  VAT (จริงๆ รวมไปแล้ว)</label>
											<input type="checkbox" class="form-control" id="intvat" name="intvat" checked>
										</div>
										
										
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ขอใบเสนอราคา</button>
										</div>
										
										<div class="form-group has-success">
											<input type="radio" value="1" name="roomstype"> แผ่นใหม่ เครื่องมือสอง
											<input type="radio" value="2" name="roomstype"> มือสองหมด
										</div>
										
										<div class="form-group has-success">
											<input type="radio" value="3" name="roomstype" checked="checked"> ใหม่หมด
											
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
		
		
			
			<div class="ajax_machine">
				<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ราคาเครื่อง
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th style='width: 5%;'>ลำดับ</th>
                                        <th style='width: 15%;'>Brand</th>
										 <th style='width: 10%;'>Model</th>
										<th style='width: 10%;'>Cost</th>
                                        <th style='width: 10%;'>HP</th>
										<th style='width: 5%;'>CW5</th>
										<th style='width: 5%;'>CW20</th>
										<th style='width: 15%;'>Attri1</th>
										<th style='width: 10%;'>Attri2</th>
										<th style='width: 10%;'>Attri3</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php for($i=1; $i<=$num_condensing; $i++) { 
										$row_condensing = mysql_fetch_array($result_condensing);
									?>
                                     <tr>
										<td style='widtd: 5%;'><?php echo $row_condensing['t_id']?></td>
                                        <td style='widtd: 15%;'><?php echo $row_condensing['t_name']?></td>
										<td style='widtd: 10%;'><?php echo $row_condensing['t_model']?></td>
										<td style='widtd: 10%;'><?php echo number_format($row_condensing['t_cost'], 0, '.', ','); ?></td>
                                        <td style='widtd: 10%;'><?php echo $row_condensing['t_hp'].'HP'?></td>
										<td style='widtd: 5%;'><?php echo $row_condensing['t_cw5']?></td>
										<td style='widtd: 5%;'><?php echo $row_condensing['t_cw20']?></td>
										<td style='widtd: 15%;'><?php echo $row_condensing['t_attrib1']?></td>
										<td style='widtd: 10%;'><?php echo $row_condensing['t_attrib2']?></td>
										<td style='widtd: 10%;'><?php echo $row_condensing['t_attrib3']?></td>
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
			
			</div><!-- end ajax machine-->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
