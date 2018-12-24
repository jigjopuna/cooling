 <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	

	$rowcash = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2, cash_emp, cash_temp FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	
	$fromtransfer = trim($_POST['fromtransfer']);
	$totransfer  = trim($_POST['totransfer']);
	$tr_amount  = trim($_POST['tr_amount']); 
	$tr_date  = trim($_POST['tr_date']);

		
	$search_custname = trim($_POST['search_custname']);
	
	$curr_cash = $rowcash['cash_now'];
	$cash1 = $rowcash['cash1'];
	$cash2 = $rowcash['cash2'];
	$cash_emp = $rowcash['cash_emp'];	
	$cash_temp = $rowcash['cash_temp'];
	$today = date("Ymd");
	
	/*
		cash_now = กองเงินรับเข้าาจากลูกค้า
		cash1 = กองเงินซื้อของ
		cash2 = กองเงินกำไร
		cash_emp = กองเงินไว้จ่ายพนักงาน
		cash_temp = กองไว้เผื่อทำอะไร
	*/
	if($curr_cash < $tr_amount){ exit("<script>alert('เงินไม่พอโยกย้าย'); window.location='../../finance/outpay.php';</script>"); }
	
	$current_cash = $curr_cash - $tr_amount;
	if($totransfer == 1){
		//เอาเงินลูกค้าโอนมาเข้ากองซื้อของ   SET cash_now = '$money_buy', cash1 = '$tr_amount'
		$type = 'กองเงินซื้อของ';
		$add = $cash1 + $tr_amount;
		$sql = "INSERT INTO tb_cash_center SET cash_now = '$current_cash', cash_temp = '$cash_temp', cash1 = '$add', cash2 = '$cash2', cash_emp = '$cash_emp', cash_date = '$tr_date', cash_times = now()";
	}else if($totransfer == 2){
		//เอาเงินลูกค้าโอนมาเข้ากองเงินจ่ายพนักงาน   SET cash_now = '$cashtemp1', cash_emp = '$tr_amount'
		$type = 'กองเงินไว้จ่ายพนักงาน';
		$add = $cash_emp + $tr_amount;
		$sql = "INSERT INTO tb_cash_center SET cash_now = '$current_cash', cash_temp = '$cash_temp', cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$add', cash_date = '$tr_date', cash_times = now()";
	}else if($totransfer == 3){
		//เอาเงินลูกค้าโอนมาเข้ากองเงินสำรอง   SET cash_now = '$cashtemp1', cash_emp = '$tr_amount'
		$type = 'กองไว้เผื่อทำอะไร';
		$add = $cash_temp + $tr_amount;
		$sql = "INSERT INTO tb_cash_center SET cash_now = '$current_cash', cash_temp = '$add', cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_date = '$tr_date', cash_times = now()";
	}
	else if($totransfer == 4){
		//เงินกำไร
		$type = 'เงินกำไร';
		$add = $cash2 + $tr_amount;
		$sql = "INSERT INTO tb_cash_center SET cash_now = '$current_cash', cash_temp = '$cash_temp', cash1 = '$cash1', cash2 = '$add', cash_emp = '$cash_emp', cash_date = '$tr_date', cash_times = now()";
	}
	echo "today = ", $today, "<br>"; 
	echo "fromtransfer = ", $fromtransfer, "<br>";
	echo "totransfer = ", $totransfer, "<br>";
	echo "tr_amount = ", $tr_amount, "<br>";
	echo "tr_date = ", $tr_date, "<br>";
	
	echo "curr_cash = ", $curr_cash, "<br>";
	echo "cash1 = ", $cash1, "<br>";
	echo "cash2 = ", $cash2, "<br><br>";
	echo "cash_emp = ", $cash_emp, "<br>";
	echo "cash_temp = ", $cash_temp, "<br>";
	echo "current_cash = ", $current_cash, "<br>";
	echo "type = ", $type, "<br><br><br>";
	

	
	
	$result = mysql_query($sql);
	if($result) {
		exit("<script>alert('โอนเงินเรียบร้อย '); window.location='../../finance/outpay.php';</script>");
	} else {
		exit("<script>alert('โอนเงินไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ'); window.location='../../finance/outpay.php';</script>");
	}
	
?>
</body>
</html>     