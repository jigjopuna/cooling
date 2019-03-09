<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data  ord_length ord_high 
	$ahlai = trim($_POST['ahlai']);
	$ahlaicost = trim($_POST['ahlaicost']);  
	

    
	echo "ahlai = ", $ahlai, "<br>";
	echo "ahlaicost = ", $ahlaicost, "<br>";

	//2. insert into database	
	$sql = "INSERT INTO tb_service_detail SET 
			o_date =  '$o_date', 
			o_size = '$ord_size', 
			o_width	= '$ord_width'";
	$result1 = mysql_query($sql);
	
	if($result1) {
		$a = mysql_insert_id($conn);
		if($o_newold==1){
			$work_list = "INSERT INTO tb_tax SET vat_ord = '$a'";
			$result6 = mysql_query($work_list);
		}
		if($result1){
			exit("<script>alert('บันทึกออเดอร์ใหม่เรียบร้อยแล้วจร้า ^^ '); window.location='../../order/order.php';</script>");
		}else{
			 exit("<script>alert('บันทึกออเดอร์ไม่สำเร็จ ติดต่อผู้ดูแลระบบ1'); window.location='../../order/order.php';</script>");
		}
	} else {
		 exit("<script>alert('บันทึกออเดอร์ไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../order/order.php';</script>");
	}
?>
</body>
</html>     




