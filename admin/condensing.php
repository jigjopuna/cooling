<?php session_start();
	  require_once('../include/connect.php');
	  
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
	require_once ('../include/header.php');
	require_once('../include/metatagsys.php');
	$dates = date('Y-m-d');
?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<script>
	$(document).ready(function(){
		$('#btn').click(validation);
		$('#install').change(chkinstall);
		$('#hascoilyen').change(chkcoilyen);
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
			$('#hide').css("display","none")
		}
		 
	}
	
	function chkcoilyen(){
		
		if($("#hascoilyen").prop('checked') == true){
			$('#coilhide').css("display","block"); 
		}else{
			$('#coilhide').css("display","none")
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
			require_once('../include/inc_role.php'); 
			require_once ('../include/navproduct.php');
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
											<input type="text" class="form-control" id="search_custname" name="search_custname">
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ขนาดแรงม้า</label>
											<input type="text" class="form-control" id="hp" name="hp" >
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอมเพรสเซอร์</label>
											<select class="form-control" id="combrand" name="combrand">
												<?php for($i=1; $i<=$num_com; $i++) { 
													  $row_com = mysql_fetch_array($result_com);
												?>
												<option value="<?php echo $row_com['comp_id'];?>"><?php echo $row_com['com_brand'];?></option>
												<?php } ?>
											</select>
										</div>
										
									</div>
									
									
									
									<div class="col-lg-3">
									
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ยี่ห้อคอนเด็นซิ่ง</label>
											<select class="form-control" id="condensing" name="condensing">
												<option value="Q-Coil เป่าข้าง">Q-Coil เป่าข้าง</option>
												<option value="เป่าบน">Proserv เป่าบน</option>
												<option value="XMK เป่าข้าง">XMK เป่าข้าง</option>
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
												<option value="<?php echo $row_cool['cool_id'];?>"><?php echo $row_cool['cool_brand'];?></option>
											<?php } ?>
											</select>
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
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">ขอใบเสนอราคา</button>
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
