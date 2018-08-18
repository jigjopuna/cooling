<?php require_once('../include/connect.php'); 
	$sqlajax = "SELECT * FROM tb_categoryroom";
	$resultajax = mysql_query($sqlajax);
	$numajax = mysql_num_rows($resultajax);

?>
<form action='../db/prodcut_room_add.php' method='post' name='form1' id='form1' enctype='multipart/form-data'>
									<div class='col-lg-2'>
											
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>ชื่อสินค้า</label>
											<input type='text' class='form-control' id='pr_name' name='pr_name'>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>หมวดสินค้า</label>
											<select class='form-control' id='pr_cate' name='pr_cate'>
												<option value='0'>เลือกประเภทสินค้า</option> 
												<?php 
													for($i=1; $i<=$resultajax; $i++){
														$rowajax = mysql_fetch_array($resultajax); 
												?>						
												<option value='<?php echo $rowajax['catr_id']?>'><?php echo $rowajax['catr_name']?></option>
												
												<?php } ?>
											</select>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>หมวดสินค้าย่อย</label>
											<input type='text' class='form-control' id='pr_subcate' name='pr_subcate'>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>ประเภทสินค้า</label>
											<input type='text' class='form-control' id='pr_type' name='pr_type'>
										</div>
									</div>
									
									<div class='col-lg-2'>
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>ราคาเต็ม</label>
											<input type='text' class='form-control' id='pr_price' name='pr_price'>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>ราคาขาย</label>
											<input type='text' class='form-control' id='pr_sell_price' name='pr_sell_price'>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>อุณหภูมิที่สินค้ารองรับ</label>
											<input type='text' class='form-control' id='pr_temp' name='pr_temp'>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>ความหนาแน่นแผ่นโฟม</label>
											<input type='text' class='form-control' id='pr_density' name='pr_density'>
										</div>
									</div>
																		
									
									
									<div class='col-lg-2'>
										<div class='form-group'>
										  <label for='comment'>SEO</label>
										  <textarea class='form-control' rows='5' id='pr_seo' name='pr_seo'></textarea>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>กว้าง</label>
											<input type='text' class='form-control' id='pr_width' name='pr_width'>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>รูปภาพ</label>
											<input type='text' class='form-control' id='pr_img' name='pr_img'>
										</div>
									</div>
									
									<div class='col-lg-2'>
										<div class='form-group'>
										  <label for='comment'>คำอธิบาย 1</label>
										  <textarea class='form-control' rows='5' id='pr_descr1' name='pr_descr1'></textarea>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>ยาว</label>
											<input type='text' class='form-control' id='pr_length' name='pr_length'>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>วิดีโอ</label>
											<input type='text' class='form-control' id='pr_vdo' name='pr_vdo'>
										</div>
									</div>
									
									
									<div class='col-lg-2'>
										<div class='form-group'>
										  <label for='comment'>คำอธิบาย 2</label>
										  <textarea class='form-control' rows='5' id='pr_descr2' name='pr_descr2'></textarea>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>สูง</label>
											<input type='text' class='form-control' id='' name='' >
										</div>
										
										<div class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>แสดง</label>
											<input type='checkbox' class='form-control' id='pr_publish' name='pr_publish'>
										</div>
									</div>
									
									<div class='col-lg-2'>
										<div class='form-group'>
										  <label for='comment'>คำอธิบาย 3</label>
										  <textarea class='form-control' rows='5' id='pr_descr3' name='pr_descr3'></textarea>
										</div>
										
										<div id='proname' class='form-group has-success'>
											<label class='control-label' for='inputSuccess'>น้ำหนัก</label>
											<input type='text' class='form-control' id='' name=''>
										</div>
										
										<div class='form-group has-success'>
											<button id='btn' type='button' class='btn btn-lg btn-success btn-block'>บันทึกข้อมูล</button>
										</div>
									</div>
								</form>