<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data
	$ord_status = trim($_POST['ord_status']);	 
	$order_id = trim($_POST['order_id']);
	
	/*echo "ord_status = ", $ord_status, "<br>";
	echo "order_id = ", $order_id, "<br>";	
	exit();*/

	
	//2. update into database	
	$sql = "UPDATE tb_orders SET o_status = '$ord_status' WHERE o_id = '$order_id'";
	
	$result1 = mysql_query($sql);
	
	exit("
		<script>
			alert('อัปเดทสถานะออเดอร์เรียบร้อยแล้วจร้า ^^ ');
			window.location='../../order/order.php';
		</script>
	");
	
?>
</body>
</html>     




