<?php session_start();
	  require_once('../../include/connect.php'); 	
?>
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
	echo '$e_id = '.$e_id.'<br>';
	
	$role_ = mysql_fetch_array(mysql_query("SELECT ro_stock FROM tb_role WHERE ro_emp_id = '$e_id'"));
	$role = $role_['ro_stock'];
	
	echo 'role = '.$role.'<br>';
	//exit();
	if( ($role!=1) && ($role!=2)){ exit("<script>alert('ไม่มีสิทธิ์ในการเพิ่มสต็อคนะคะ'); window.location = '../../stock/stock.php';</script>");}
	
	//1. receive data
	$toolid = trim($_POST['search_tool']);
	$puqty  = trim($_POST['puqty']);
	$puwh  = trim($_POST['puwh']);
	$pudate = trim($_POST['pudate']);
	
	
	
	//ดูก่อนว่าก่อนว่าก่อนเพิ่ม Stock ตอนนี้มี Stock อยู่เท่าไร
	/*
		role = 1 นครปฐม role = 2 กระทุ่มแบน
		stock = นครปฐม   stock1 = กระทุ่มแบน
		
	*/
	
	if($role==1) {
		$rowchkst = mysql_fetch_array(mysql_query("SELECT t_stock FROM tb_tools WHERE t_id = '$toolid'"));
		$chkst = $rowchkst['t_stock'];
	}else if($role==2){ 
		$rowchkst = mysql_fetch_array(mysql_query("SELECT t_stock1 FROM tb_tools WHERE t_id = '$toolid'"));
		$chkst = $rowchkst['t_stock1'];
	} else {}

		
	echo "puqty = ", $puqty, "<br>"; 
	echo "toolid = ", $toolid, "<br>";
	echo "puwh = ", $puwh, "<br>";
	echo "chkst = ", $chkst, "<br>";
	echo "pudate = ", $pudate, "<br>";
	//exit();
	
	//2. insert into database	
	$sql = "INSERT INTO tb_pushstock SET 
			pu_tid     = '$toolid', 
			pu_qty 	   = '$puqty', 
			pu_date    = '$pudate', 
			pu_wh      = '$puwh', 
			pu_time    =  now()";
	
	$result1 = mysql_query($sql);
	
	if($result1){
		$addstk = $chkst + $puqty;
		echo 'addstk = '.$addstk; 
		if($role==1){
			$sql_update = "UPDATE tb_tools SET t_stock = '$addstk' WHERE t_id = '$toolid'";
		}else if($role==2){
			$sql_update = "UPDATE tb_tools SET t_stock1 = '$addstk' WHERE t_id = '$toolid'";
		}else{  }
			
		$result_update = mysql_query($sql_update);
		
		if($result_update){
			exit("<script>alert('บันทึกเบิกเรียบร้อยแล้วจร้า ^^ ');window.location='../../stock/stock.php';</script>");
		}else{
			exit("<script>alert('บันทึกสต็อกไม่ได้ ติดต่อผู้ดูแลระบบ1 ');window.location='../../stock/stock.php';</script>");
		}
				
	}else{
		exit("<script>alert('บันทึกสต็อกไม่ได้ ติดต่อผู้ดูแลระบบ2 ');window.location='../../stock/stock.php';</script>");
	}
	
	
	
?>
</body>
</html>     



