<?php session_start();
	  require_once('../include/connect.php');

	
	$sqlpu = "SELECT t_name, t_size, t_cost, t_temp,  t_subtype
			  FROM tb_tools 
			  WHERE t_type = 5 AND t_subtype LIKE '1%'
			  ORDER BY t_size ASC";
	$resultpu = mysql_query($sqlpu);
	$numpu = mysql_num_rows($resultpu);
	
	
			  
	$sqlps = "SELECT t_name, t_size, t_cost, t_temp, t_attrib1, t_subtype
			  FROM tb_tools 
			  WHERE t_type = 5 AND t_subtype = 21
			  ORDER BY t_size ASC";
	$resultps = mysql_query($sqlps);
	$numps = mysql_num_rows($resultps);
	
	
	
	$today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>ราคาต้นทุนโฟม</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
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
                    <h1 class="page-header">ต้นทุน โฟม PU</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								โฟม PU
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>                          
                                        <th>โฟม</th>
										<th>ราคา (บาท/ตร.ม.)</th>
										<th>อุณหภูมิ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										$sizepu = 0;
										
										for($i=1; $i<=$numpu; $i++){
										  $rowpu = mysql_fetch_array($resultpu);
										  
										  if($rowpu['t_subtype'] == 11){
											  $foamname = ' PU ';
										  }else if($rowpu['t_subtype'] == 12){
											   $foamname = ' PU สแตนเลส';
										  }else if($rowpu['t_subtype'] == 13){
											  $foamname = ' PU เปล่า';
										  }
										  
									  ?>
										<tr class="gradeA">
											<td><?php echo $foamname.' '.$rowpu['t_size'].' นิ้ว'; ?></td>
											<td><?php echo number_format($rowpu['t_cost'], 0, '.', ','); ?></td>
											<td><?php echo $rowpu['t_temp']; ?></td>
										</tr>
										
									<?php  } ?>

                                    
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
                    <h1 class="page-header">ต้นทุน โฟม PS</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								โฟม PS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>                          
                                        <th>โฟม</th>
										<th>ความหนาแน่น (ปอนด์)</th>
										<th>ราคา (บาท/ตร.ม.)</th>
										<th>อุณหภูมิ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										$sizepu = 0;
										
										for($i=1; $i<=$numps; $i++){
										  $rowps = mysql_fetch_array($resultps);
										  
										  
										  
									  ?>
										<tr class="gradeA">
											<td><?php echo ' PS '.$rowps['t_size'].' นิ้ว'; ?></td>
											<td><?php echo $rowps['t_attrib1']; ?></td>
											<td><?php echo number_format($rowps['t_cost'], 0, '.', ','); ?></td>
											<td><?php echo $rowps['t_temp']; ?></td>
										</tr>
										
									<?php  } ?>

                                    
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
			
			
			
			
		
		

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   
	<div id="role" style="display:none"><?php echo $rolepo;?></div>
</body>

</html>
