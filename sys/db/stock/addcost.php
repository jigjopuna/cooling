<?php session_start();
	  require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){
		exit("<script>alert('กรุณา Login ก่อนนะคะ'); window.location = '../pages/login/login.php';</script>");
	}
	$role_ = mysql_fetch_array(mysql_query("SELECT ro_stock FROM tb_role WHERE ro_emp_id = '$e_id'"));
	$role = $role_['ro_stock'];
	
	//1 เท่ากับนครปฐม
	if(($role!=1) && ($role!=2)){ exit("<script>alert('ไม่มีสิทธิ์ในการใส่ต้นทุนนะคะ'); window.location = '../../stock/stock.php';</script>");}
	if($role==1){ $warehouse = 2; }else if($role==2){ $warehouse = 3; } else{ }
	
	//1. receive data
	$tool = trim($_POST['tool']);
	$cost = trim($_POST['cost']);
	
	$rowcost = mysql_fetch_array(mysql_query("SELECT t_cost, t_cost1 FROM tb_tools WHERE t_id = '$tool'"));
	$lastcost = $rowcost['t_cost'];
	$lastcost1 = $rowcost['t_cost1'];
	
 
	if($role==1){//นครปฐม
		if($lastcost1 > 0)
			$center = ($cost+$lastcost1)/2;
		else 
			$center = $cost;
		$sql = "UPDATE tb_tools SET t_cost = '$cost', t_cost_center = '$center' WHERE t_id = '$tool'";
	}else if($role==2){	
		if($lastcost > 0)
			$center = ($cost+$lastcost)/2;
		else
			$center = $cost;
		$sql = "UPDATE tb_tools SET t_cost1 = '$cost', t_cost_center = '$center' WHERE t_id = '$tool'";
	}
	
	$result1 = mysql_query($sql);
	
	if($result1){ 
		exit("<script>alert('อัปเดทต้นทุนเรียบร้อยแล้ว^^ ');window.location='../../stock/stock.php';</script>");	
	}else{
		exit("<script>alert('อัปเดทต้นทุนเไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ ');window.location='../../stock/stock.php';</script>");
	}


?>
</body>
</html>     

