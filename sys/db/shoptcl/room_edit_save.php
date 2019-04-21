<?php session_start();
	  require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	require_once('../../include/inc_role.php');  
	if($role['ro_shop']!=1){ exit("<script>alert('ไม่มีสิทธิ์ในการ UPDATE SHOP นะคะ'); window.location = 'https://google.co.th';</script>");}
	
	//1. receive data  ord_length ord_high 
	$pr_id = trim($_POST['pr_id']);
	$pr_name = trim($_POST['pr_name']);
	$pr_seo = trim($_POST['pr_seo']);
	$pr_descr1 = trim($_POST['pr_descr1']);
	$pr_descr2 = trim($_POST['pr_descr2']);
	$pr_descr3 = trim($_POST['pr_descr3']);
	$pr_cate = trim($_POST['pr_cate']);
	$pr_subcate = trim($_POST['pr_subcate']);
	$pr_type = trim($_POST['pr_type']);
	$pr_size = trim($_POST['pr_size']);
	$pr_width = trim($_POST['pr_width']);
	$pr_weight = trim($_POST['pr_weight']);
	$pr_length = trim($_POST['pr_length']);
	$pr_density = trim($_POST['pr_density']);
	$pr_temp = trim($_POST['pr_temp']);
	$pr_price = trim($_POST['pr_price']);
	$pr_sell_price = trim($_POST['pr_sell_price']);
	$pr_stock = trim($_POST['pr_stock']);
	$pr_img = trim($_POST['pr_img']);
	$pr_vdo = trim($_POST['pr_vdo']);
	$pr_publish = trim($_POST['pr_publish']);
	
	if($pr_id== '' || $pr_name == '' || $pr_price == '' || $pr_sell_price < 1){
		exit("<script>alert('กรอกข้อมูลไม่ถูกต้องนะคะ'); window.location = '../../shoptcl/product.php';</script>");
	}
	
	echo 'pr_id : '.$pr_id.'<br>';
	echo 'pr_name : '.$pr_name.'<br>';
	echo 'pr_seo : '.$pr_seo.'<br>';
	echo 'pr_descr1 : '.$pr_descr1.'<br>';
	echo 'pr_descr2 : '.$pr_descr2.'<br>';
	echo 'pr_descr3 : '.$pr_descr3.'<br>';
	echo 'pr_cate : '.$pr_cate.'<br>';
	echo 'pr_subcate : '.$pr_subcate.'<br>';
	echo 'pr_type : '.$pr_type.'<br>';
	echo 'pr_size : '.$pr_size.'<br>';
	echo 'pr_width : '.$pr_width.'<br>';
	echo 'pr_weight : '.$pr_weight.'<br>';
	echo 'pr_length : '.$pr_length.'<br>';
	echo 'pr_density : '.$pr_density.'<br>';
	echo 'pr_temp : '.$pr_temp.'<br>';
	echo 'pr_price : '.$pr_price.'<br>';
	echo 'pr_sell_price : '.$pr_sell_price.'<br>';
	echo 'pr_stock : '.$pr_stock.'<br>';
	echo 'pr_img : '.$pr_img.'<br>';
	echo 'pr_vdo : '.$pr_vdo.'<br>';
	echo 'pr_publish : '.$pr_publish.'<br>';
	
	if($pr_publish=='on'){
		$publish = 1;
	}else{
		$publish = 0;
	}

	
	$sql = "UPDATE tb_productroom SET 
				pr_name = '$pr_name', 
				pr_seo = '$pr_seo', 
				pr_descr1 = '$pr_descr1',  
				pr_descr2 = '$pr_descr2', 
				pr_descr3 = '$pr_descr3',  
				pr_cate = '$pr_cate', 
				pr_subcate = '$pr_subcate',  
				pr_type = '$pr_type', 
				pr_size = '$pr_size',  
				pr_width = '$pr_width', 
				pr_weight = '$pr_weight',  
				pr_length = '$pr_length', 
				pr_density = '$pr_density' ,
				pr_temp = '$pr_temp', 
				pr_price = '$pr_price', 
				pr_sell_price = '$pr_sell_price', 
				pr_stock = '$pr_stock', 
				pr_img = '$pr_img', 
				pr_vdo = '$pr_vdo', 
				pr_publish = '$publish' 
				WHERE pr_id = '$pr_id'";
	$result1 = mysql_query($sql);
	if($result1) {
		 exit("<script>alert('แก้ไขรายการสำเร็จ '); window.location='../../shoptcl/product.php';</script>");
		
	} else {
		 exit("<script>alert('บันทึกไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../shoptcl/product.php';</script>");
	}
	
?>
</body>
</html>     




