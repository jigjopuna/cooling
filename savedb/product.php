<?php require_once('../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	//1. receive data
	$p_cate  = trim($_POST['category']);
	$p_name  = trim($_POST['brand']);
	$p_model  = trim($_POST['model']);
	$p_hp  = $_POST['hp'];
	
	$p_kw1  = trim($_POST['kw1']);
	$p_kw2  = trim($_POST['kw2']);
	
	$p_volt  = trim($_POST['volt']);
	$p_amp  = trim($_POST['amp']);
	$p_hz  = $_POST['hz'];
	$p_cw5  = $_POST['temp1'];
	$p_cw20  = $_POST['temp2'];
	$p_temp  = $_POST['tempExpand'];
	
	$p_size  = $_POST['size'];
	$p_type  = $_POST['types'];
	$p_kg  = $_POST['kg'];
	$p_thin  = $_POST['thin'];
	$p_inlet  = $_POST['inlet'];
	$p_outlet  = $_POST['outlet'];
	$p_numya  = $_POST['numya'];
	$p_price  = $_POST['price'];
	$p_price_sell  = $_POST['sell_price'];
	
	
	
	
	
	/*echo "p_cate = "; echo $p_cate;
	echo "p_name = "; echo $p_name; echo "<br/>";
	echo "p_model = "; echo $p_model; echo "<br/>";
	echo "p_hp = "; echo $p_hp; echo "<br/>";
	echo "p_kw1 = "; echo $p_kw1; echo "<br/>";
	echo "p_kw2 = "; echo $p_kw2; echo "<br/>";
	echo "p_volt = "; echo $p_volt; echo "<br/>";
	echo "p_amp = "; echo $p_amp; echo "<br/>";
	
	echo "p_hz = "; echo $p_hz; echo "<br/>";
	echo "p_cw5 = "; echo $p_cw5; echo "<br/>";
	echo "p_cw20 = "; echo $p_cw20; echo "<br/>";
	echo "p_size = "; echo $p_size; echo "<br/>";
	echo "p_type = "; echo $p_type; echo "<br/>";
	echo "p_kg = "; echo $p_kg; echo "<br/>";
	echo "p_thin = "; echo $p_thin; echo "<br/>";
	echo "p_inlet = "; echo $p_inlet; echo "<br/>";
	
	echo "p_outlet = "; echo $p_outlet; echo "<br/>";
	echo "p_price = "; echo $p_price; echo "<br/>";
	
	exit();*/

	
	//2. insert into database	
	$sql = "INSERT INTO tb_product SET  
			p_cate='$p_cate', 
			p_name='$p_name', 
			p_model='$p_model', 
			p_hp='$p_hp', 
			p_kw1='$p_kw1', 
			p_kw2='$p_kw2', 
			p_volt ='$p_volt', 
			p_amp='$p_amp', 
			p_kg='$p_kg', 
			p_cw5='$p_cw5', 
			p_cw20='$p_cw20',   
			p_size='$p_size', 
			p_hz='$p_hz', 
            p_type='$p_type', 			
			p_thin ='$p_thin', 
			p_temp = '$p_temp', 
			p_inlet ='$p_inlet',  
			p_numya ='$p_numya', 
			p_outlet ='$p_outlet', 
			p_price ='$p_price', 
			p_price_sell ='$p_price_sell'";
	$result1 = mysql_query($sql);
	exit("
		<script>
			alert('บันทึกข้อมูฃเรียบร้อยจร้า รวยๆ');
			window.location='../data.php';
		</script>
	");
	
?>
</body>
</html>     