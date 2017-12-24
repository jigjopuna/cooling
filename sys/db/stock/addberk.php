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
	
	if( ($role!=1) && ($role!=2)){ exit("<script>alert('ไม่มีสิทธิ์ในการเบิกสต็อคนะคะ'); window.location = '../../stock/stock.php';</script>");}
	if($role==1){ $warehouse = 2; }else if($role==2){ $warehouse = 3; } else{ }
	//1. receive data
	$toolid = trim($_POST['search_tool']);
	$berkqty  = trim($_POST['berkqty']);
	$ordid  = trim($_POST['search_ord']);

	$empid = trim($_POST['search_emp']);
	$stodate  = trim($_POST['stodate']);
	
	
	/*ตอนเบิกให้ตัดสต็อก*/
	
	if($role==1) {
		$rowchkst = mysql_fetch_array(mysql_query("SELECT t_stock, t_cost_center FROM tb_tools WHERE t_id = '$toolid'"));
		$chkst = $rowchkst['t_stock'];
		$cost_center = $rowchkst['t_cost_center']*$berkqty;
		if($chkst < $berkqty) { exit("<script>alert('สต็อคที่นครปฐมไม่พอเบิกนะคะ'); window.location = '../../stock/stockout.php';</script>"); }
	}else if($role==2){
		$rowchkst = mysql_fetch_array(mysql_query("SELECT t_stock1, t_cost_center FROM tb_tools WHERE t_id = '$toolid'"));
		$chkst = $rowchkst['t_stock1']*$berkqty;
		$cost_center = $rowchkst['t_cost_center'];
			if($chkst < $berkqty) { exit("<script>alert('สต็อคที่กระทุ่มแบนไม่พอเบิกนะคะ'); window.location = '../../stock/stockout.php';</script>"); }
	}else{}
	
	
	echo "stodate = ", $stodate, "<br>"; 
	echo "toolid = ", $toolid, "<br>";
	echo "berkqty = ", $berkqty, "<br>";
	
	echo "ordid = ", $ordid, "<br>";
	echo "empid = ", $empid, "<br>";
	echo "chkst = ", $chkst, "<br>";
	echo "cost_center = ", $cost_center, "<br>";
	
	$substk = $chkst - $berkqty;
	/*echo 'substk : '.$substk;
	exit();*/
	

	

	//2. insert into database	
	$sql = "INSERT INTO tb_ord_prod SET 
			o_id       = '$ordid', 
			orpd_qty   = '$berkqty', 
			ot_id      = '$toolid', 
			orpd_date  = '$stodate', 
			ot_emp     = '$empid', 
			orpd_wh    = '$warehouse', 
			orpd_e_aprv= '$e_id', 
			orpd_cost  = '$cost_center', 
			orpd_time  =  now()";
	
	$result1 = mysql_query($sql);
	
	if($result1){	
		if($role==1) {
			$sql_update = "UPDATE tb_tools SET t_stock = '$substk' WHERE t_id = '$toolid'";
			$result_update = mysql_query($sql_update);
		}else if($role==2){
			$sql_update = "UPDATE tb_tools SET t_stock1 = '$substk' WHERE t_id = '$toolid'";
			$result_update = mysql_query($sql_update);
		}else{}
		
		if($result_update){
			exit("<script>alert('บันทึกเบิกเรียบร้อยแล้วจร้า ^^ ');window.location='../../stock/stockout.php';</script>");
		}else{
			exit("<script>alert('บันทึกเบิกไม่ได้ ติดต่อผู้ดูแลระบบ ');window.location='../../stock/stockout.php';</script>");
		}
				
	}else{
		exit("<script>alert('บันทึกเบิกไม่ได้ ติดต่อผู้ดูแลระบบ ');window.location='../../stock/stockout.php';</script>");
	}
	
?>
</body>
</html>     

