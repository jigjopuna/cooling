<?php require_once('../../include/connect.php'); 
	  
	  $dates = date('Y-m-d');
	  
	/*ถ้ายังไม่มี session ตะกร้า ให้สร้างตะกร้าใหม่
	if($_SESSION['session_admin_basket'] == '')
		$sqlcrebas = "INSERT INTO tb_basket SET b_cust = '0', b_type='M', b_status = '0'";
		$createba = mysql_query($sqlcrebas);
					
		if($createba){ 
			$a = mysql_insert_id($conn);
			$_SESSION['session_admin_basket'] = $a;
		}
	}*/
	  
	$depid = trim($_POST['depid']);
	$draw_prod_qty = trim($_POST['draw_prod_qty']);
	$dates = trim($_POST['date_pay']);
	$custname = trim($_POST['custname']);
	
	// เช็คว่าเคยมีเบิกไปบ้างหรือยัง แล้วเบิกไปแล้วเท่าไร ดูว่าการเบิกครั้งล่าสุดนี้เกินของที่คงเหลือในห้องเย็นหรือไม่
	$row_chkberk = mysql_fetch_array(mysql_query("SELECT w_did, count(w_id), SUM(w_qty) wqty FROM tb_withdraw WHERE w_did = '$depid'"));
	$sum_berk = $row_chkberk['wqty'];
	
	$row_depo = mysql_fetch_array(mysql_query("SELECT d_qty, d_prod FROM tb_deposit WHERE d_id = '$depid'"));
	$row_d_qty = $row_depo['d_qty'];
	$product = $row_depo['d_prod'];
	
	$all_berk = draw_prod_qty + $sum_berk;
	$compare = $row_d_qty - $all_berk;
	// ยอดที่เบิกไปแล้ว + ที่เพิ่งเบิก เกินกว่าที่ฝากไหม
	if($compare < 0){ exit("<script>alert('เบิกเกินจำนวนที่ฝาก กรุณากรอกใหม่'); window.location='../../order/ord_deposit.php';</script>"); }
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");	
	define('LINE_TOKEN','unssmF5QMBemRuMk3YSAVP5dmVPRkbMd5sE9nAwFLzA');
    //define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt');	
	define('LINE_TOKEN1', $cust_token); 
	function notify_message($message){
		$queryData = array('message' => $message);
		$queryData = http_build_query($queryData,'','&');
		$headerOptions = array(
			'http'=>array(
				'method'=>'POST',
				'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
						  ."Authorization: Bearer ".LINE_TOKEN."\r\n"
						  ."Content-Length: ".strlen($queryData)."\r\n",
				'content' => $queryData
			)
		);
		$context = stream_context_create($headerOptions);
		$result = file_get_contents(LINE_API,FALSE,$context);
		$res = json_decode($result);
		return $res;
	}
	
	
	
	//2. insert into database	
	$sql = "INSERT INTO tb_withdraw SET 
			w_did = '$depid', 
			w_qty = '$draw_prod_qty', 
			w_date = '$dates'
			" ;
	$result1 = mysql_query($sql); 
	
	if($result1){
		$msg = ' ลูกค้า '.$custname." ". " เบิกอาหาร ".$product.' จำวน '.number_format($draw_prod_qty, 0, '.', ',').' kg ';	
		$res = notify_message($msg);			
		exit("<script>alert('เบิกสินค้าเรียบร้อยแล้วจร้า ^^ '); window.location='../../order/ord_deposit.php';</script>");
	}

?>
</body>
</html>     




