<?php require_once('../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	//1. receive data
	$sku  = trim($_POST['sku']);
	$asin  = trim($_POST['asin']);
	$upc  = trim($_POST['upc']);
	$title  = $_POST['title'];
	$cate  = trim($_POST['cate']);
	$cost  = trim($_POST['cost']);
	$price  = trim($_POST['price']);
	
	$supplier  = trim($_POST['supplier']);
	$stock  = trim($_POST['stock']);
	$link1  = $_POST['link1'];
	$link2  = $_POST['link2'];
	$keyword  = $_POST['keyword'];
	$sell  = $_POST['sell'];
	$status = $_POST['status'];
    

	//2. insert into database	
	$sql = "INSERT INTO product SET  
			p_sku='$sku', 
			p_asin='$asin', 
			p_name='$title', 
			p_cate='$cate', 
			p_cost='$cost', 
			p_sup='$supplier', 
			p_price='$price', 
			p_upc='$upc', 
			p_stock='$stock', 
			p_status='$status', 
			p_link1='$link1', 
            p_link2='$link2', 			
			p_keyword ='$keyword', 
			p_sell ='$sell', p_date=now()";
	$result1 = mysql_query($sql);
	exit("
		<script>
			alert('บันทึกข้อมูลแล้วจ๊ะอีหมู');
			window.location='../record.php';
		</script>
	");
	
?>
</body>
</html>     