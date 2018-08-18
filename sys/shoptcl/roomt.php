<?php session_start();
	  require_once('../include/connect.php');
	  $today = date("Y-m-d");
	  
	  $pr_id = trim($_POST['prodname']);

	
	$rowprod = mysql_fetch_array(mysql_query("SELECT * FROM tb_productroom WHERE pr_id ='$pr_id'"));
	
	
	//ประเภทสินค้า
	$sql_catr = "SELECT * FROM  tb_categoryroom"; 
	$result_catr = mysql_query($sql_catr);
	$num_catr = mysql_num_rows($result_catr);
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
                    <h1 class="page-header">สินค้า อุปกรณ์ห้องเย็น</h1>
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
									<div class="col-lg-2">
											
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
											<input type="text" class="form-control" id="pr_name" name="pr_name" value="<?php echo $rowprod['pr_name'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">หมวดสินค้า</label>
											<select class="form-control" id="pr_cate" name="pr_cate">
												<option value="0">เลือกประเภทสินค้า</option> 
												<?php 
													for($i=1; $i<=$num_catr; $i++){
														$row_catr = mysql_fetch_array($result_catr); 
												?>						
												<option value="<?php echo $row_catr['catr_id']?>" <?php if( $row_catr['catr_id']==$rowprod['pr_cate']) echo "selected" ?>><?php echo $row_catr['catr_name']?></option>
												
												<?php } ?>
											</select>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">หมวดสินค้าย่อย</label>
											<input type="text" class="form-control" id="pr_subcate" name="pr_subcate" value="<?php echo $rowprod['pr_subcate'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ประเภทสินค้า</label>
											<input type="text" class="form-control" id="pr_type" name="pr_type" value="<?php echo $rowprod['pr_type'];?>">
										</div>
									</div>
									
									<div class="col-lg-2">
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาเต็ม</label>
											<input type="text" class="form-control" id="pr_price" name="pr_price" value="<?php echo $rowprod['pr_price'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ราคาขาย</label>
											<input type="text" class="form-control" id="pr_sell_price" name="pr_sell_price" value="<?php echo $rowprod['pr_sell_price'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิที่สินค้ารองรับ</label>
											<input type="text" class="form-control" id="pr_temp" name="pr_temp" value="<?php echo $rowprod['pr_temp'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ความหนาแน่นแผ่นโฟม</label>
											<input type="text" class="form-control" id="pr_density" name="pr_density" value="<?php echo $rowprod['pr_density'];?>">
										</div>
									</div>
																		
									
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">SEO</label>
										  <textarea class="form-control" rows="5" id="pr_seo" name="pr_seo"><?php echo $rowprod['pr_seo'];?></textarea>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">กว้าง</label>
											<input type="text" class="form-control" id="pr_width" name="pr_width" value="<?php echo $rowprod['pr_width'];?>">
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">รูปภาพ</label>
											<input type="text" class="form-control" id="pr_img" name="pr_img" value="<?php echo $rowprod['pr_img'];?>">
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">คำอธิบาย 1</label>
										  <textarea class="form-control" rows="5" id="pr_descr1" name="pr_descr1"><?php echo $rowprod['pr_descr1'];?></textarea>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว</label>
											<input type="text" class="form-control" id="pr_length" name="pr_length" <?php echo $rowprod['pr_length'];?>>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">วิดีโอ</label>
											<input type="text" class="form-control" id="pr_vdo" name="pr_vdo" <?php echo $rowprod['pr_vdo'];?>>
										</div>
									</div>
									
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">คำอธิบาย 2</label>
										  <textarea class="form-control" rows="5" id="pr_descr2" name="pr_descr2"><?php echo $rowprod['pr_descr2'];?></textarea>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง</label>
											<input type="text" class="form-control" id="" name="" >
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">แสดง</label>
											<input type="checkbox" class="form-control" id="pr_publish" name="pr_publish" <?php if( $rowprod['pr_publish']==1) echo "checked" ?>>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
										  <label for="comment">คำอธิบาย 3</label>
										  <textarea class="form-control" rows="5" id="pr_descr3" name="pr_descr3"><?php echo $rowprod['pr_descr3'];?></textarea>
										</div>
										
										<div id="proname" class="form-group has-success">
											<label class="control-label" for="inputSuccess">น้ำหนัก</label>
											<input type="text" class="form-control" id="" name="" >
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

		<!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
