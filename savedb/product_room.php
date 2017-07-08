<?php require_once('../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	//1. receive data
	$pr_cate  = trim($_POST['pr_category']);  
	$pr_name  = trim($_POST['brand']);

	$pr_size  = $_POST['size'];
	
	$pr_width  = $_POST['size'];
	$pr_length  = $_POST['width'];
	
	
	$pr_type  = $_POST['types'];
	$pr_density  = $_POST['density'];
	$pr_temp  = $_POST['temp'];
	
	$p_price  = $_POST['price'];
	$pr_sell_price  = $_POST['sell_price'];
	
	
	
	
	
	echo "pr_cate = "; echo $pr_cate; echo "<br/>";
	echo "pr_name = "; echo $pr_name; echo "<br/>";
	echo "pr_size = "; echo $pr_size; echo "<br/>";
	echo "pr_width = "; echo $pr_width; echo "<br/>"; 
	echo "pr_length = "; echo $pr_length; echo "<br/>"; 
	echo "pr_type = "; echo $pr_type; echo "<br/>";
    echo "pr_density = "; echo $pr_density; echo "<br/>";
	echo "p_price = "; echo $p_price; echo "<br/>";
	
	//exit();

	
	//2. insert into database	
	$sql = "INSERT INTO tb_productroom SET  
			pr_cate='$pr_cate', 
			pr_name='$pr_name',    
			pr_size='$pr_size', 
			pr_width='$pr_width', 
			pr_length='$pr_length', 
            pr_type='$pr_type',  
			pr_density='$pr_density', 
			pr_temp='$pr_temp', 
			pr_price ='$p_price', 
			pr_sell_price ='$pr_sell_price'";
			
	$result1 = mysql_query($sql);
	exit("
		<script>
			alert('บันทึกข้อมูฃเรียบร้อยจร้า รวยๆ');
			window.location='../room.php';
		</script>
	");
	
?>
</body>
</html>     