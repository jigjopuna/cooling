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
	if($role==1){ $warehouse = 2; $empid = 11; /*ตอยขอเบิกจากนครปฐม*/ }else if($role==2){ $warehouse = 3; $empid = 5;/*ปลาขอเบิกจากกระทุ่มแบน*/} else{ }
	
	//1. receive data
	$toolid = trim($_POST['tools']);
	$transferqty  = trim($_POST['transferqty']);
	$stktrwh  = trim($_POST['stktrwh']);

	$tran_date = trim($_POST['tran_date']);
	
	/*เช็คก่อนว่ามีของให้โอนไหม*/
	
	$row_nakornpathom = mysql_fetch_array(mysql_query("SELECT t_stock FROM tb_tools WHERE t_id = '$toolid'"));
	$skt_nakornpathom = $row_nakornpathom['t_stock'];
	
	$row_kratumban = mysql_fetch_array(mysql_query("SELECT t_stock1 FROM tb_tools WHERE t_id = '$toolid'"));
	$skt_kratumban = $row_kratumban['t_stock1'];
	
	if($role==1) {
		if($skt_nakornpathom < $transferqty) { exit("<script>alert('สต็อคที่นครปฐมไม่พอเบิกนะคะ'); window.location = '../../stock/stockout.php';</script>"); }
	}else if($role==2){
		if($skt_kratumban < $transferqty) { exit("<script>alert('สต็อคที่กระทุ่มแบนไม่พอเบิกนะคะ'); window.location = '../../stock/stockout.php';</script>"); }
	}else{}
	
	
	echo "tran_date = ", $tran_date, "<br>"; 
	echo "toolid = ", $toolid, "<br>";
	echo "transferqty = ", $transferqty, "<br>";
	echo "stktrwh = ", $stktrwh, "<br>";
	
	echo "skt_nakornpathom = ", $skt_nakornpathom, "<br>";
	echo "skt_kratumban = ", $skt_kratumban, "<br>";
	
	echo "warehouse = ", $warehouse, "<br>";
	echo "empid = ", $empid, "<br>";
	//exit();


	//2. insert into database	
	$sql = "INSERT INTO tb_ord_prod SET  
			orpd_qty   = '$transferqty', 
			ot_id      = '$toolid', 
			orpd_date  = '$tran_date', 
			ot_emp     = '$empid', 
			orpd_wh    = '$warehouse', 
			orpd_e_aprv= '$e_id', 
			orpd_time  =  now()";
	
	$result1 = mysql_query($sql);
	
	/*ถ้าตาราง tb_ord_prod คอมลัม ot_emp เป็น 5 หรือ 11 แสดงว่าเป็นการโยกย้ายสต็อกนะ 5 กับ 11 เป็นหมายเลขพนักงานที่ดูแลสต็อก*/
	if($result1){	
		if($role==1) { //โยกจากนครปฐมไปกระทุ่มแบน
			//ลบนครปฐม 
			$updatestknkpt = $skt_nakornpathom - $transferqty;
			
			//เพิ่มกระทุ่มแบน
			$upddatesktktb = $skt_kratumban + $transferqty;		
					
		}else if($role==2){		
			//ลบกระทุ่มแบน
			$upddatesktktb = $skt_kratumban - $transferqty;	
			
			//เพิ่มนครปฐม 
			$updatestknkpt = $skt_nakornpathom + $transferqty;
				
		}else{}
		
		$sql_update = "UPDATE tb_tools SET t_stock = '$updatestknkpt', t_stock1 = '$upddatesktktb' WHERE t_id = '$toolid'";
		$result_update = mysql_query($sql_update);
		
		if($result_update){
			exit("<script>alert('บันทึกโยกย้ายเรียบร้อยแล้วจร้า ^^ ');window.location='../../stock/stockout.php';</script>");
		}else{
			exit("<script>alert('บันทึกโยกย้ายไม่ได้ ติดต่อผู้ดูแลระบบ ');window.location='../../stock/stockout.php';</script>");
		}
				
	}else{
		exit("<script>alert('บันทึกโยกย้ายไม่ได้ ติดต่อผู้ดูแลระบบ ');window.location='../../stock/stockout.php';</script>");
	}
	
?>
</body>
</html>     

