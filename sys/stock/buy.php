<?php session_start();
	  require_once('../include/connect.php');
	  $year = date("Y");
	  $pee = $year.'%';
	
	$sql = "SELECT t.t_id, t.t_name, t_stock, t_cost_center, cs.cst_prod, cs.cst_five_meter, A.count nub,  cs.cst_five_meter*A.count AS yod
			FROM tb_count_stock cs JOIN tb_tools t ON t.t_id = cs.cst_prod 
				 JOIN (SELECT COUNT(*) count
					FROM tb_orders o 
					WHERE o.o_date LIKE '$pee' AND o.o_status != 5 AND o.o_type LIKE '1%'
					
				 ) AS A";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>
	
	<script>
		$(document).ready(function(){
			$('#buyall').text($('#yodsue').val());
			$('#btn').click(validation);
			$('#btn_tr').click(validation_tr);
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
                    <h1 class="page-header">ซื้อของ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ยอดซื้อของ <span id="buyall"></span> บาท
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>อะไหล่</th>                                     
                                        <th>สต็อค</th>
                                        <th>ราคา</th>
                                        <th>ใช้ต่อห้อง</th>
										<th>จำนวนห้อง</th>
										<th>จำนวนที่ต้องใช้</th>
										<th>ต้องซื้อเพิ่ม</th>
										<th>ราคา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
										  $yodd = $row['yod'];
										  $stock = $row['t_stock'];
										  $cost = $row['t_cost_center'];
										  $qty = $row['cst_five_meter'];
										  $nub = $row['nub'];
										  $havetouse = $qty*$nub; //จำนวนที่ต้องใช้
										  $buyadd = -1*($stock-$havetouse);
										  if($buyadd < 0){
											  $pricebuyadd = 0;
											  $buyadd = 0 ;
										  }else{
											  $pricebuyadd = $cost*$buyadd;
											  $money += $pricebuyadd;
										  }
										  
										  
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row['t_id']; ?></td>
											<td><?php echo $row['t_name']; ?></td>
											<td><?php echo number_format($stock, 0, '.', ','); //สต็อค ?></td> 
											<td><?php echo number_format($cost, 0, '.', ',');//ราคา ?></td>
											<td><?php echo $qty;//ใช้ต่อห้อง ?></td>
											<td><?php echo $nub;//จำนวนห้อง ?></td>
											<td><?php echo $havetouse;//จำนวนที่ต้องใช้ ?></td>
											<td><?php echo $buyadd; //ต้องซื้อเพิ่ม ?></td>
											<td><?php echo number_format($pricebuyadd, 0, '.', ','); //ราคาที่ต้องซื้อเพิ่ม ?></td>
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
		
		<div class="row">
            <div class="col-lg-3">
                <a href="buyseller.php"><button type="button" class="btn btn-lg btn-primary btn-block">ใบสั่งซื้อ</button></a>
            </div>
			
			<div class="col-lg-3">
                <a href="item_per_room.php"><button type="button" class="btn btn-lg btn-primary btn-block">ของต่อ 1 ห้อง</button></a>
            </div>
        </div>
		<div class="row">
             <div class="col-lg-3">
                  &nbsp;<br>&nbsp;<br>
              </div>
        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <input type="hidden" value="<?php echo number_format($money, 0, '.', ','); ?>" id="yodsue">
	<div id="role" style="display:none"><?php echo $rolepo;?></div>
</body>

</html>
