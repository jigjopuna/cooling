<?php session_start();
	  require_once('../include/connect.php');
	
	$sql = "SELECT * 
			FROM (tb_contractor c JOIN province p ON p.id = c.prm_province)
				JOIN tb_region_th rg ON rg.reg_id = p.pro_region
			";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>ผู้รับเหมา</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#podate, #tr_date').datepicker({dateFormat: 'yy-mm-dd'});
			$("#search_custname").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
			});
				
		});
		
	</script> 
</head>

<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ผู้รับเหมา</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ผู้รับเหมา
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ชื่อ</th>                                     
                                        <th>เบอร์</th>
                                        <th>ทักษะ</th>
										<th>พื้นฐานมาจาก</th>
										<th>ภาค</th>
										<th>จังหวัด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  if($row['prm_skill']==1){
											 $skill  = 'ห้อง';
										  }else if($row['prm_skill']==2){
											 $skill  = 'เครื่อง';
										  }else if($row['prm_skill']==3){
											 $skill  = 'เครื่องและห้อง';
										  }else if($row['prm_skill']==4){
											 $skill  = 'SERVICE'; 
										  }
										  
										  if($row['prm_type']==0){
											 $basic  = 'ช่างแอร์';
										  }else if($row['prm_type']==1){
											 $basic  = 'ห้องเย็น';
										  }else if($row['prm_type']==2){
											 $basic  = 'งานไฟฟ้า';
										  }else if($row['prm_type']==3){
											 $basic  = 'งานปูน'; 
										  }else if($row['prm_type']==4){
											 $basic  = 'ก่อสร้าง'; 
										  }else if($row['prm_type']==5){
											 $basic  = 'เหล็ก'; 
										  }
										  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $i; ?></td>
											<td><?php echo $row['prm_name']; ?></td>
											<td><?php echo $row['prm_tel']; ?></td>
											<td><?php echo $skill; ?></td>
											<td><?php echo $basic; ?></td>
											<td><?php echo $row['reg_name']; ?></td>
											<td><?php echo $row['pro_name']; ?></td>
											
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

    <input type="hidden" value="<?php echo number_format($money, 0, '.', ','); ?>" id="yodsue">
	<div id="role" style="display:none"><?php echo $rolepo;?></div>
</body>

</html>
