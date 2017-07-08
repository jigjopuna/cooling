<?php  session_start(); ?>
<?php 

	require_once('../../include/connect.php'); 
	$today = date("Y-m-d");
	$sql = /*"select p.p_name, sum(od.ord_qty ) qty, sum(od.ord_amount) amount
			from tb_order_detail od INNER JOIN tb_product p ON p.p_id = od.ord_product 
			WHERE od.ord_dates = '$today'
			group by p.p_name";*/
			"SELECT *
FROM tb_product pr, tb_product_type pdt, 
	(select p.p_id, sum(od.ord_qty ) qty, sum(od.ord_amount) amount
	from tb_order_detail od INNER JOIN tb_product p ON p.p_id = od.ord_product 
	WHERE od.ord_dates = '$today'
	group by p.p_id) AS sumorder
WHERE pr.p_id = sumorder.p_id AND pr.p_type = pdt.pt_id 
GROUP BY pr.p_type
ORDER BY pr.p_type";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sqlCountAllToday = "SELECT SUM(ord_qty) qty, SUM(ord_amount) amount FROM tb_order_detail WHERE ord_dates = '$today'";
	$result_sqlCountAllToday  = mysql_query($sqlCountAllToday);
	$row_sqlCountAllToday = mysql_fetch_array($result_sqlCountAllToday);
	
	$sqlAmountToday = "SELECT SUM(ord_amount) amount FROM tb_order_detail WHERE ord_dates = '$today'";
	$result_AmountToday = mysql_query($sqlAmountToday);
	$row_AmountToday = mysql_fetch_array($result_AmountToday);
	
	// รวมจำนวนและราคาของแต่เค้กแต่ละประเภท
	$sqlsumptype = "SELECT pt.pt_id, SUM(ord_qty) ord_qty, SUM(ord_amount) ord_amount
					FROM (tb_order_detail od JOIN tb_product p ON p.p_id = od.ord_product) JOIN tb_product_type pt ON pt.pt_id = p.p_type
					WHERE od.ord_dates = '$today' 
					GROUP BY pt.pt_id
					ORDER BY pt.pt_id";
	$result_sumptype  = mysql_query($sqlsumptype);
	$num_sumptype = mysql_num_rows($result_sumptype);


// เก็บ array เพื่อใส่รวมจำนวนและราคาของและประเภท จะทำต่อจาก 	$sqlsumptype	
for($i = 0 ; $i < $num_sumptype ; $i++){
    $row_sumptype = mysql_fetch_array($result_sumptype);
    $items[] = array(
        "pt_id"     		=> $row_sumptype[pt_id], 
        "ord_qty"    	  		=> $row_sumptype[ord_qty],
        "ord_amount"       => $row_sumptype[ord_amount]
    );
	
}
//ไว้ใส่ แถวสุดท้ายหาจำนวนทั้งหมดแล้วลบด้วย 1 จะได้ข้อมูลสุดท้ายของ array
$countarr = count($items); 
//exit();
/*foreach($items as $item){
        $values[] = "({$item['pt_id']}', '{$item['ord_qty']}', '{$item['ord_amount']}')";
    }*/
	//$values = implode(", ", $values);
	

//print_r($items);



	


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>รายการออเดอร์วันนี้ทั้งหมด</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once ('../../include/navadmin.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รวมออเดอร์ลูกค้าทั้งหมดวันนี้</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                               จำนวน  <?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',') ?> ชิ้น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>ชนิดเค้ก</th>
                                        <th>จำนวนชิ้น</th>
                                        <th>ราคา (บาท)</th>
										<th>เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										for($i=1;$i<=$num; $i++){
											$row = mysql_fetch_array($result);
																			
									?>
									
									<?php if($i==1) { //ถ้าเป็นครั้งแรกให้แสดงชื่อประเภทเค้กได้เลย ถ้าไม่เท่ากับ 1 ให้เช็คก่อนจนกว่าจะเปลี่ยนประเภท เพราะ 1 ประเภทมีหลายสินค้า?>
										<tr><td colspan="2"><?php echo $row[pt_name];?></td><td colspan="3"><?php echo $num_sumtype;?></td></tr>
										<?php $chktype = $row[p_type];?>
									<?php } ?>
									
									
									<?php if($chktype!= $row[p_type]) { ?>
									    
										<!--<tr><td colspan='2'>รวม 1 </td><td><?php //echo $row[p_type]  /*number_format($items[$row[p_type]-$a]['ord_qty'], 0, '.', ',')*/; ?></td><td><?php //echo number_format($items[$row[p_type]-$a]['ord_amount'], 0, '.', ',') ;  ?></td><td></td><tr>   -->
										<tr><td colspan="2"><?php echo $row[pt_name];?></td><td colspan="3"></td></tr>
										<?php $chktype = $row[p_type]; ?>
									<?php } ?>
									
											<tr class="odd gradeX">
												<td><?php echo $i/*.' | '. $chktype. ' |  '.$row[p_type]*/ ;?></td>
												<td><?php echo $row[p_name]?></td>
												<td><?php echo number_format($row[qty], 0, '.', ',') ?></td>
												<td><?php echo number_format($row[amount], 0, '.', ',')?></td>
												<td><?php echo date("Y-m-d");?></td>
											</tr>

										
									<?php } //end for ?>
									
										<!--<tr><td colspan='2'>รวม</td><td><?php //echo number_format($items[$countarr-1]['ord_qty'], 0, '.', ',') ; ?></td><td><?php //echo number_format($items[$countarr-1]['ord_amount'], 0, '.', ',') ;  ?></td><td></td><tr>   -->
										
									
										<tr class="odd gradeX" align="center">
											<td colspan="3"><?php echo number_format($row_sqlCountAllToday[qty], 0, '.', ',')?> ชิ้น</td>
											<td colspan="3"><?php echo number_format($row_AmountToday[amount], 2, '.', ',')?> บาท</td>
										</tr>
									
                                    
                                </tbody>
							</form>
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

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>

    </script>
<!--

คิวรีนี้เป็น subqQuery เพื่อรวมจำนวนสินค้า ราคา ก่อนที่จะนำไปจอย กับ ตารางสินค้าเพื่อไปดึงชื่อสินค้ามาแสดง
จะมอง subQuery นี้เป็น 1 ตางรางคือ ตาราง sumorder
(SELECT ord_product, SUM(ord_qty) qty, SUM(ord_price_whole) amount
FROM tb_order_detail
WHERE ord_dates = '2016-12-30'
GROUP BY ord_product) AS sumorder

// query นี้เป็นการแสดงรายการจำนวน ราคาทั้งหมด ตามชนิดเค้ก คือ ลูกค้ามากกว่า 1 คน ซื้อ เครปกล้วย  คิวรี่นี้รวม เครปกล้วย ว่ามีทั้งหมดกี่ชิ้นที่มีคนซื้อ
SELECT 
FROM tb_product p, (SELECT ord_product, SUM(ord_qty) qty, SUM(ord_price_whole) amount
					FROM tb_order_detail
					WHERE ord_dates = '2016-12-30'
					GROUP BY ord_product) AS sumorder
WHERE p.p_id = sumorder.ord_product

php array http://stackoverflow.com/questions/4383914/how-to-get-single-value-from-php-array
 -->
</body>

</html>
