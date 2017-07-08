<?php require_once('../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data
	$p_name = trim($_POST['p_name']);
	$p_id = trim($_POST['p_id']);
	$p_cate  = trim($_POST['p_cate']);
	$p_price  = trim($_POST['p_price']);
	
	$p_hp = trim($_POST['p_hp']);
	$p_kw1  = trim($_POST['p_kw1']);
	$p_kw2  = trim($_POST['p_kw2']);
	$p_model  = trim($_POST['p_model']);
	
	$p_volt = trim($_POST['p_volt']);
	$p_amp  = trim($_POST['p_amp']);
	$p_hz  = trim($_POST['p_hz']);
	$p_cw5  = trim($_POST['p_cw5']);
	
	$p_cw20 = trim($_POST['p_cw20']);
	$p_temp  = trim($_POST['p_temp']);
	$p_kg  = trim($_POST['p_kg']);
	$p_size  = trim($_POST['p_size']);
	
	$p_type = trim($_POST['p_type']);
	$p_thin  = trim($_POST['p_thin']);
	$p_inlet  = trim($_POST['p_inlet']);
	$p_numya  = trim($_POST['p_numya']);
	$p_outlet  = trim($_POST['p_outlet']);



	echo "p_name = ", $p_name, "<br>";
	echo "p_cate = ", $p_cate, "<br>";
	echo "p_price = ", $p_price, "<br>";


	echo "p_hp = ", $p_hp, "<br>";
	echo "p_kw1 = ", $p_kw1, "<br>";
	echo "p_kw2 = ", $p_kw2, "<br>";
	echo "p_model = ", $p_model, "<br>"; 

	echo "p_volt = ", $p_volt, "<br>";
	echo "p_amp = ", $p_amp, "<br>";
	echo "p_hz = ", $p_hz, "<br>";
	echo "p_cw5 = ", $p_cw5, "<br>"; 

	echo "p_cw20 = ", $p_cw20, "<br>";
	echo "p_temp = ", $p_temp, "<br>";
	echo "p_kg = ", $p_kg, "<br>";
	echo "p_size = ", $p_size, "<br>"; 

	echo "p_type = ", $p_type, "<br>";
	echo "p_thin = ", $p_thin, "<br>";
	echo "p_inlet = ", $p_inlet, "<br>";
	echo "p_numya = ", $p_numya, "<br>";
	echo "p_outlet = ", $p_outlet, "<br>"; 	

	
	//2. insert into database	
	$sql = "UPDATE tb_product SET 
			p_name     = '$p_name', 
			p_cate     = '$p_cate', 
			p_price    = '$p_price', 
			p_hp   = '$p_hp', 
			p_kw1    = '$p_kw1', 
			p_kw2   = '$p_kw2', 
			p_model    = '$p_model', 
			p_volt   = '$p_volt', 
			p_amp    = '$p_amp', 
			p_hz   = '$p_hz', 
			p_cw5    = '$p_cw5', 
			p_cw20   = '$p_cw20', 
			p_temp    = '$p_temp', 
			p_kg   = '$p_kg', 
			p_size    = '$p_size', 
			p_type   = '$t_stock', 
			p_thin   = '$p_thin',
			p_inlet    = '$p_inlet', 
			p_numya   = '$p_numya', 
			p_outlet    = '$p_outlet'
			WHERE p_id = '$p_id'";
	
	$result1 = mysql_query($sql);
	
	exit("
		<script>
			alert('แก้ไขข้อมูลเรียบร้อยแล้วจร้า ^^ ');
			window.location='../product/$p_cate.php?cate_id=$p_cate';
		</script>
	");
	
?>
</body>
</html>     