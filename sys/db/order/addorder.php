<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data
	$search_custname = trim($_POST['search_custname']);
	$o_date = trim($_POST['date_pay']);
	
	/*echo "search_custname = ", $search_custname, "<br>";
	echo "o_date = ", $o_date, "<br>";	
	exit();*/

	
	//2. insert into database	
	$sql = "INSERT INTO tb_orders SET 
			o_cust =  '$search_custname', 
			o_status =  1,			
			o_date =  '$o_date'";
	
	$result1 = mysql_query($sql);
	
	exit("
		<script>
			alert('บันทึกออเดอร์ใหม่เรียบร้อยแล้วจร้า ^^ ');
			window.location='../../order/order.php';
		</script>
	");
	
?>
</body>
</html>     




