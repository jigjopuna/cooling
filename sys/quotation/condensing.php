<?php session_start();
	  include('../include/connect.php');
	  
	  $sql_com = "SELECT * FROM tb_com_brand";
	  $result_com = mysql_query($sql_com);
	  $num_com = mysql_num_rows($result_com);
	  
	  
	  $sql_cool = "SELECT * FROM  tb_cooling_brand";
	  $result_cool = mysql_query($sql_cool);
	  $num_cool = mysql_num_rows($result_cool);
	  
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> ราคาเครื่องทำความเย็น </title>
<?php 
	include ('../include/header.php');
	include('../include/metatagsys.php');
	$dates = date('Y-m-d');
?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('#btn').click(validation);
		$('#install').change(chkinstall);
		$('#hascoilyen').change(chkcoilyen);
		$('#hasroom').change(chkroom);
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust_q.php",
				minLength: 1
		});
		
		
	});
	
	function chkinstall(){
		//$('#install').prop("checked", true);
		if($("#install").prop('checked') == true){
			$('#hide').css("display","block"); 
		}else{
			$('#hide').css("display","none");
		}
		 
	}
	
	function chkcoilyen(){
		
		if($("#hascoilyen").prop('checked') == true){
			$('#coilhide').css("display","block"); 
		}else{
			$('#coilhide').css("display","none");
		}
	}
	
	function chkroom(){
		
		if($("#hasroom").prop('checked') == true){
			$('#foam').css("display","block");
			$('#foaminch').css("display","block");		 	
			$('#doortype').css("display","block");
			$('#d_width').css("display","block");
			$('#d_high').css("display","block");
			
		}else{
			$('#foam').css("display","none");
			$('#foaminch').css("display","none");
			$('#doortype').css("display","none");
			$('#d_width').css("display","none");
			$('#d_high').css("display","none");
		}
		
		 
	}

	function validation(){
			var search_custname = $('#search_custname').val();
			var hp = $('#hp').val();
			
			if(search_custname==''){
				alert("ใส่ชื่อลูกค้าด้วยนะคะ"); 
				return false;
			}else if((hp=='') ||isNaN(hp)){
				alert("ใส่ขนาดแรงม้าเป็นตัวเลขด้วยนะค่ะ"); 
				return false;				
			}else{
				$('#form1').submit();				
			}
		}		
</script>
</head>

<body>

    <div id="wrapper">
		<?php 
			include('../include/inc_role.php'); 
			include ('../include/navproduct.php');
			if($role['ro_quotation']!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการทำใบเสนอราคานะคะ'); window.location = '../index.php';</script>");}
		?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ราคาเครื่องทำความเย็น</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			 
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ราคาเครื่องอย่างเดียว
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../../admin/condensings.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ลูกค้า </label>
											<input type="text" class="form-control" id="search_custname" name="search_custname" value="6">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ขนาดแรงม้า</label>
											<input type="text" class="form-control" id="hp" name="hp" value="4">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอมเพรสเซอร์</label>
											<select class="form-control" id="combrand" name="combrand">
												<?php for($i=1; $i<=$num_com; $i++) { 
													  $row_com = mysql_fetch_array($result_com);
												?>
												<option value="<?php echo $row_com['comp_id'];?>" <?php if($row_com['comp_id']==4) echo "selected";?>><?php echo $row_com['com_brand'];?></option>
												<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กว้าง </label>
											<input type="text" class="form-control" id="r_width" name="r_width" value="2.40">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยาว </label>
											<input type="text" class="form-control" id="r_lenght" name="r_lenght" value="6.00">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">สูง </label>
											<input type="text" class="form-control" id="r_high" name="r_high" value="2.40">
										</div>
										
									</div>
									
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">อุณหภูมิ </label>
											<input type="text" class="form-control" id="ord_temp" name="ord_temp" value="-18">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอนเด็นเซอร์</label>
											<select class="form-control" id="condensing" name="condensing">
												<option value="Q-Coil">Q-Coil</option>
												<option value="Tecumseh">Tecumseh </option>
												<option value="XMK">XMK </option>
												<option value="Cool Scape" selected>Cool Scape</option>
												<option value="Bes Cool">Bes Cool</option>
												<option value="Guntner">Guntner</option>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กี่ชุด (จำนวนเครื่อง)</label>
											<input type="text" class="form-control" id="qtyhp" name="qtyhp" value="1">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">มีคอยเย็นไหม</label>
											<input type="checkbox" class="form-control" id="hascoilyen" name="hascoilyen">
										</div>
										
										<div class="form-group has-success" id="coilhide" style="display:none;">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอยล์เย็น</label>
											<select class="form-control" id="coilyen" name="coilyen">
											<?php for($i=1; $i<=$num_cool; $i++) { 
												$row_cool = mysql_fetch_array($result_cool);
											?>
												<option value="<?php echo $row_cool['cool_id'];?>" <?php if($row_cool['cool_id']==6) echo "selected";?>><?php echo $row_cool['cool_brand'];?></option>
											<?php } ?>
											</select>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เอาแผ่นไหม</label>
											<input type="checkbox" class="form-control" id="hasroom" name="hasroom">
										</div>
										
										
										
									</div>
									
																		
									<div class="col-lg-3">
										
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">มีตู้คอนโทรลไหม</label>
											<input type="checkbox" class="form-control" id="controlbox" name="controlbox">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">จ้างติดตั้งไหม</label>
											<input type="checkbox" class="form-control" id="install" name="install">
										</div>
										
										<div class="form-group has-success" id="hide" style="display:none;">
											<label class="control-label" for="inputSuccess">ราคาติดตั้ง</label>
											<input type="text" class="form-control" id="install_price" name="install_price" value="25000">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">หัวบิลบริษัท</label><br>
											<input type="radio" value="1" name="corp" checked > CPN
											<input type="radio" value="2" name="corp" style="margin-left:50px;" > CHK
										</div>
										
										<div class="form-group has-success" id="foam" style="display:none;">
											<label class="control-label" for="inputSuccess">โฟม</label>
											<select class="form-control"  name="foam">
												<option value="1">PU</option>
												<option value="2">PS</option>
											</select>
										</div>
										
										<div class="form-group has-success" id="foaminch" style="display:none;">
											<label class="control-label" for="inputSuccess">โฟมกี่นิ้ว</label>
											<select class="form-control"  name="foaminch">
												<option value="4">4</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
										</div>
										
										
										<div class="form-group has-success" id="doortype" style="display:none;">
											<label class="control-label" for="inputSuccess">ประตู</label>
											<select class="form-control" name="doortype">
												<option value="1">บานสวิง</option>
												<option value="2">บานเลื่อน</option>
											</select>
										</div>
										
									</div>
									
									
									
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ส่วนลด</label>
											<input type="text" class="form-control" id="discount" name="discount" value="10000">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">กำไร % </label>
											<input type="text" class="form-control" id="percent" name="percent" value="40">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ค่าขนส่ง</label>
											<input type="text" class="form-control" id="shipcost" name="shipcost" value="5000">
										</div>
										
										<div class="form-group has-success" id="d_width" style="display:none;">
											<label class="control-label" for="inputSuccess">ประตูกว้าง เมตร</label>
											<input type="text" class="form-control"  name="d_width" value="1.0">
										</div>
										
										<div class="form-group has-success" id="d_high" style="display:none;">
											<label class="control-label" for="inputSuccess">ประตูสูง เมตร</label>
											<input type="text" class="form-control"  name="d_high" value="2.0">
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ขอใบเสนอราคา</button>
										</div>
										
									</div>
									<input type="hidden" id="sale_id" name="sale_id" value="<?php echo $e_id;?>">
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
    <!-- /#wrapper -->

   

</body>

</html>
