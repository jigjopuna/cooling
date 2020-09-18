<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data  ord_length ord_high 
	$search_custname = trim($_POST['search_custname']);
	$serv_prov = trim($_POST['serv_prov']);  
	$broken = trim($_POST['broken']);
	
	/*echo 'search_custname: '.$search_custname.'<br>';
	echo 'serv_prov: '.$serv_prov.'<br>';
	echo 'broken: '.$broken.'<br>';
	*/
	

	//2. insert into database	
	$sql = "INSERT INTO tb_orders SET o_cust = '', o_note
			";
	$result1 = mysql_query($sql);
	
	if($result1) {
		exit("<script>alert('บันทึกงานเซอร์วิสใหม่เรียบร้อยแล้วจร้า ^^ '); window.location='../../order/service.php';</script>");
	} else {
		exit("<script>alert('บันทึกไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../order/service.php';</script>");
	}
?>
</body>
</html>     




