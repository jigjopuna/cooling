<?php session_start();
	  require_once('../../include/connect.php'); 	  
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	require_once('../../include/inc_role.php');
	
	$orpd_id = trim($_POST['orpd_id']);
	$qty = trim($_POST['qty']);
	$cost_center = trim($_POST['cost_center']);
	$ot_id = trim($_POST['ot_id']);
	$bef_edi = trim($_POST['bef_edi']);
	$o_ids = trim($_POST['o_ids']);
	
	echo 'orpd_id : '.$orpd_id.'<br>';
	echo 'qty : '.$qty.'<br>';
	echo 'cost_center : '.$cost_center.'<br>';
	echo 'ot_id : '.$ot_id.'<br>';
	echo 'bef_edi : '.$bef_edi.'<br>';
	echo 'o_ids : '.$o_ids.'<br>';
	
	
	$cal = $qty*$cost_center;
	$diff = $qty-$bef_edi; // ใหม่ - เก่า ถ้าเป็นบวก 10 - 8 สต็อกลด (+2) ไป 2  || แต่ถ้า เป็นลบ  3-6 (-3) แปลว่า สต็อกเพิ่ม ไป 3
	echo 'diff : '.$diff.'<br>';
	if($diff==0) exit("<script>alert('ไม่มีการแก้ไข กรุณาแก้ไขตัวเลข');window.location = '../../order/order.php';</script>");
	
	
	
	
	$sql = "UPDATE tb_ord_prod SET orpd_qty = '$qty', orpd_cost = '$cal' WHERE orpd_id = '$orpd_id'";
	$result = mysql_query($sql);
	
	$rowt = mysql_fetch_array(mysql_query("SELECT * FROM tb_tools WHERE t_id = '$ot_id'"));
	echo 't_name : '.$rowt['t_name'].'<br>';
	echo 't_stock : '.$rowt['t_stock'].'<br>';
	
	if($diff>0){
		echo 'สต็อกต้องลด'.'<br>';
		$newqty = $rowt['t_stock']-$diff;
		$sqltool = "UPDATE tb_tools SET t_stock = '$newqty' WHERE t_id = '$ot_id'";
		echo 'newqty : '.$newqty.'<br>';
	}else{
		echo 'สต็อกต้องเพิ่ม'.'<br>';
		$newqty = $rowt['t_stock']+($diff*(-1));
		$sqltool = "UPDATE tb_tools SET t_stock = '$newqty' WHERE t_id = '$ot_id'";
		echo 'newqty : '.$newqty.'<br>';
	}
	
	$result1 = mysql_query($sqltool);
	if($result1) {
		exit("<script>alert('แก้ไขจำนวนอะไหล่ ออเรียบร้อย');window.location = '../../order/order_detail.php?o_id=$o_ids';</script>");
	}
?>
</body>
</html>     




