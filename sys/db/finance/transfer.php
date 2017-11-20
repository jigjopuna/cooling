 <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	

	$rowcash = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	
	$fromtransfer = trim($_POST['fromtransfer']);
	$totransfer  = trim($_POST['totransfer']);
	$tr_amount  = trim($_POST['tr_amount']); 
	$tr_date  = trim($_POST['tr_date']);

		
	$search_custname = trim($_POST['search_custname']);
	
	$curr_cash = $rowcash['cash_now'];
	$cash1 = $rowcash['cash1'];
	$cash2 = $rowcash['cash2'];
	$today = date("Ymd");
	
	
	
	
	if($totransfer == 2){
		$cashtemp1 = $cash1 + $tr_amount;
		$cashtemp2 = $cash2 - $tr_amount;
		
	}else if($totransfer == 3){
		$cashtemp2 = $cash2 + $tr_amount;
		$cashtemp1 = $cash1 - $tr_amount;
	}else{
		
	}
	echo "today = ", $today, "<br>"; 
	echo "fromtransfer = ", $fromtransfer, "<br>";
	echo "totransfer = ", $totransfer, "<br>";
	echo "tr_amount = ", $tr_amount, "<br>";
	echo "tr_date = ", $tr_date, "<br>";
	
	echo "curr_cash = ", $curr_cash, "<br>";
	echo "cash1 = ", $cash1, "<br>";
	echo "cash2 = ", $cash2, "<br>";
	echo "cashtemp1 = ", $cashtemp1, "<br>";
	echo "cashtemp2 = ", $cashtemp2, "<br>";
	
	//exit();
	
	$sql = "INSERT INTO tb_cash_center SET cash1 = '$cashtemp1', cash2 = '$cashtemp2', cash_now = '$curr_cash', cash_date = '$tr_date', cash_times = now()";
	$result = mysql_query($sql);
	if($result) {
		exit("<script>alert('โอนเงินเรียบร้อย '); window.location='../../finance/outpay.php';</script>");
	} else {
		exit("<script>alert('โอนเงินไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ'); window.location='../../finance/outpay.php';</script>");
	}
	
?>
</body>
</html>     