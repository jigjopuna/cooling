<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	$o_note = trim($_POST['o_note']);
	$orders_id = trim($_POST['orders_id']);
	
	echo 'o_note : '.$o_note.'<br>';
	echo 'orders_id : '.$orders_id;
	
	$result = mysql_query("UPDATE tb_orders SET o_note = '$o_note' WHERE o_id = '$orders_id'");
	
	if($result){
		exit("<script>alert('บันทึกคอมเม้นเรียบร้อยแล้วจร้า ^^ ');window.location='../../order/order.php';</script>");
	}
	
?>
</body>
</html>     

