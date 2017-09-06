  <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data
	$toolid = trim($_POST['search_tool']);
	$berkqty  = trim($_POST['berkqty']);
	$ordid  = trim($_POST['search_ord']);
	
	$empid = trim($_POST['search_emp']);
	$stodate  = trim($_POST['stodate']);
	
	echo "stodate = ", $stodate, "<br>"; 
	echo "toolid = ", $toolid, "<br>";
	echo "berkqty = ", $berkqty, "<br>";
	echo "ordid = ", $ordid, "<br>";

	echo "empid = ", $empid, "<br>";
	
	//2. insert into database	
	$sql = "INSERT INTO tb_ord_prod SET 
			o_id     = '$ordid', 
			orpd_qty = '$berkqty', 
			ot_id    = '$toolid', 
			orpd_date = '$stodate', 
			ot_emp     = '$empid', 
			orpd_time =  now()";
	
	$result1 = mysql_query($sql);
	
	exit("
		<script>
			alert('บันทึกเบิกเรียบร้อยแล้วจร้า ^^ ');
			window.location='../../stock/stockout.php';
		</script>
	");
	
?>
</body>
</html>     




