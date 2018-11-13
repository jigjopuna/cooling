<?php session_start();
	  require_once('../include/connect.php');
	  $today = date("Y-m-d");
	  
	  $p_id = trim($_GET['p_id']);
	  $rowprod = mysql_fetch_array(mysql_query("SELECT * FROM tb_product WHERE p_id ='$p_id'"));
	
	
	  //ประเภทสินค้า
	  $sql_catm = "SELECT * FROM  tb_category"; 
	  $result_catm = mysql_query($sql_catm);
	  $num_catm = mysql_num_rows($result_catm);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>อุปกรณ์เครื่อง</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);	
			$('#vatdate').datepicker({dateFormat: 'yy-mm-dd'});
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
                    <h1 class="page-header">แก้ไขข้อมูล อุปกรณ์ทำความเย็น</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							แก้ไข
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/shoptcl/machine_edit_save.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-2">
											
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
											<input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo $rowprod['p_name'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">หมวดสินค้า</label>
											<select class="form-control" id="p_cate" name="p_cate">
												<option value="0">เลือกประเภทสินค้า</option> 
												<?php 
													for($i=1; $i<=$num_catm; $i++){
														$row_catm = mysql_fetch_array($result_catm); 
												?>						
												<option value="<?php echo $row_catm['cat_id']?>" <?php if( $row_catm['cat_id']==$rowprod['p_cate']) echo "selected" ?>><?php echo $row_catm['cat_name']?></option>
												
												<?php } ?>
											</select>
										</div>
										
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">HP แรงม้า</label>
											<input type="text" class="form-control" id="p_hp" name="p_hp" value="<?php echo $rowprod['p_hp']; ?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_kw1</label>
											<input type="text" class="form-control" id="p_kw1" name="p_kw1" value="<?php echo $rowprod['p_kw1']; ?>">
										</div>
		
									</div>
									
									<!--END Column 1-->
									
									
									
									<div class="col-lg-2">
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาเต็ม</label>
											<input type="text" class="form-control" id="p_price" name="p_price" value="<?php echo $rowprod['p_price'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาขาย</label>
											<input type="text" class="form-control" id="p_price_sell" name="p_price_sell" value="<?php echo $rowprod['p_price_sell'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิที่สินค้ารองรับ</label>
											<input type="text" class="form-control" id="p_temp" name="p_temp" value="<?php echo $rowprod['p_temp'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_kg</label>
											<input type="text" class="form-control" id="p_kg" name="p_kg" value="<?php echo $rowprod['p_kg'];?>">
										</div>
										
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_kw2</label>
											<input type="text" class="form-control" id="p_kw2" name="p_kw2" value="<?php echo $rowprod['p_kw2']; ?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_model</label>
											<input type="text" class="form-control" id="p_model" name="p_model" value="<?php echo $rowprod['p_model']; ?>">
										</div>
										
										
										
									</div>
									<!--END Column 2-->									
									
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">SEO</label>
										  <textarea class="form-control" rows="5" id="pr_seo" name="p_seo"><?php echo $rowprod['p_seo'];?></textarea>
										</div>
										
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">รูปภาพ</label>
											<input type="text" class="form-control" id="p_image" name="p_image" value="<?php echo $rowprod['p_image'];?>">
										</div>
										
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">แรงดัน (V)</label>
											<input type="text" class="form-control" id="p_volt" name="p_volt" value="<?php echo $rowprod['p_volt']; ?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">แอมป์</label>
											<input type="text" class="form-control" id="p_amp" name="p_amp" value="<?php echo $rowprod['p_amp']; ?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ความถี่ Hz</label>
											<input type="text" class="form-control" id="p_hz" name="p_hz" value="<?php echo $rowprod['p_hz']; ?>">
										</div>
										
									</div>
									<!--END Column 3-->
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">คำอธิบาย 1</label>
										  <textarea class="form-control" rows="5" id="p_descr1" name="p_descr1"><?php echo $rowprod['p_descr1'];?></textarea>
										</div>
										
										
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">วิดีโอ</label>
											<input type="text" class="form-control" id="p_vdo" name="p_vdo" value="<?php echo $rowprod['p_vdo'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_cw5</label>
											<input type="text" class="form-control" id="p_cw5" name="p_cw5" value="<?php echo $rowprod['p_cw5']; ?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_cw20</label>
											<input type="text" class="form-control" id="p_cw20" name="p_cw20" value="<?php echo $rowprod['p_cw20']; ?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_kw</label>
											<input type="text" class="form-control" id="p_kw" name="p_kw" value="<?php echo $rowprod['p_kw']; ?>">
										</div>
										
										
									</div>
									
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">คำอธิบาย 2</label>
										  <textarea class="form-control" rows="5" id="p_descr2" name="p_descr2"><?php echo $rowprod['p_descr2'];?></textarea>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ขนาด Dimention</label>
											<input type="text" class="form-control" id="p_size" name="p_size" value="<?php echo $rowprod['p_size'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_type</label>
											<input type="text" class="form-control" id="p_type" name="p_type" value="<?php echo $rowprod['p_type'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">p_thin</label>
											<input type="text" class="form-control" id="p_thin" name="p_thin" value="<?php echo $rowprod['p_thin'];?>">
										</div>
										
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">แสดง</label>
											<input type="checkbox" class="form-control" id="p_publish" name="p_publish" <?php if( $rowprod['p_publish']==1) echo "checked" ?>>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">คำอธิบาย 3</label>
										  <textarea class="form-control" rows="5" id="p_descr3" name="p_descr3"><?php echo $rowprod['p_descr3'];?></textarea>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">น้ำหนัก</label>
											<input type="text" class="form-control" id="p_kg" name="p_kg" value="<?php echo $rowprod['p_kg'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อเข้า</label>
											<input type="text" class="form-control" id="p_inlet" name="p_inlet" value="<?php echo $rowprod['p_inlet'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">น้ำยา</label>
											<input type="text" class="form-control" id="p_numya" name="p_numya" value="<?php echo $rowprod['p_numya'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อออก</label>
											<input type="text" class="form-control" id="p_outlet" name="p_outlet" value="<?php echo $rowprod['p_outlet'];?>">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูล</button>
										</div>
									</div>
									<input type="hidden" value="<?php echo $p_id;?>" name="p_id">
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
