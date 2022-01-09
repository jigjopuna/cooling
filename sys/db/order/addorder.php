<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	date_default_timezone_set("Asia/Bangkok");	
	define('LINE_API',"https://notify-api.line.me/api/notify");	 
	define('LINE_TOKEN','DVkXOmyzLiMaXMhF8Ppoim48pl1A7foQgMTCsz1olfr');  
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
	
	//หาเลข VAT ออเดอร์ก่อนหน้า แล้ว +1
	$sql_maxTax = mysql_fetch_array(mysql_query("SELECT MAX(vat_ord) maxvat FROM tb_tax"));
	$maxvat = $sql_maxTax['maxvat']+1;

	
	//1. receive data  ord_length ord_high 
	$search_custname = trim($_POST['search_custname']);
	$o_date = trim($_POST['date_pay']);  
	$ord_size = trim($_POST['ord_size']);
	$ord_width = trim($_POST['ord_width']); 
	$ord_high = trim($_POST['ord_high']); 
	
	$ord_prov = trim($_POST['ord_prov']);
	
	
	$ord_temp = trim($_POST['ord_temp']);
	$voltage = trim($_POST['voltage']);
	$ord_price = trim($_POST['ord_price']);
	$date_delivery = trim($_POST['date_delivery']);
	
	$ord_door = trim($_POST['ord_door']);
	$ord_color = trim($_POST['ord_color']);
	$ord_vat = trim($_POST['ord_vat']);
	
	$ord_control = trim($_POST['ord_control']);
	$ord_coilh = trim($_POST['ord_coilh']);
	
	$o_newold = trim($_POST['ord_new']);
	$o_type = trim($_POST['ord_type']);
	
	$cusprod = trim($_POST['cusprod']);
	$cusproduct = trim($_POST['cusproduct']);
	
	if($ord_vat=='on') $o_vat = 1;
	
	/*echo "search_custname = ", $search_custname, "<br>";
	echo "o_date = ", $o_date, "<br>";	
	exit();*/
	
	$target_dir = "../../quotation/files/";
	$filename = time().'.pdf';//.$_FILES["ord_quotation"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	//exit();
	
	if(file_exists($_FILES['ord_quotation']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["ord_quotation"]["tmp_name"]);
				
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		
		// Check if file already exists
		if (file_exists($target_file)) { 
			echo "Sorry, file already exists."; exit();
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["ord_quotation"]["size"] > 5000000) { 
			echo "Sorry, your file is too large."; exit();
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "pdf" && $imageFileType != "xlsx" && $imageFileType != "docx") {
			echo "Sorry, only pdf, xlsx,  & docx files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) { 
			echo "Sorry, your file was not uploaded."; exit();
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["ord_quotation"]["tmp_name"], $target_file)) {
				//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
				echo "The file ". basename( $_FILES["ord_quotation"]["name"]). " has been uploaded."; 
			} else {
				echo "Sorry, there was an error uploading your file."; exit();
			}
		}
	}//end check is has file
	
	//2. insert into database	
	$sql = "INSERT INTO tb_orders SET 
			o_cust =  '$search_custname', 
			o_status =  1, 
			o_emp = 2, 
			o_date =  '$o_date', 
			o_size = '$ord_size', 
			o_width	= '$ord_width', 
			o_high = '$ord_high', 
			o_price = '$ord_price', 
			o_delivery_date = '$date_delivery', 
			o_quotation = '$filename', 
			o_voltage = '$voltage', 
			o_door = '$ord_door', 
			o_vat = '$o_vat', 
			o_color = '$ord_color', 
			o_control = '$ord_control', 
			o_coil = '$ord_coilh', 
			o_newold = '$o_newold', 
			o_cuprovin = '$ord_prov',  
			o_cuprodtyp = '$cusprod', 
			o_cuprod = '$cusproduct',
			o_type = '$o_type', 
			o_temp = '$ord_temp'";
	$result1 = mysql_query($sql); 
	
	$rowcust = mysql_fetch_array(mysql_query("SELECT cust_name FROM tb_customer WHERE cust_id = '$search_custname'"));
	$custnames = $rowcust['cust_name'];
	
	$ordtype = mysql_fetch_array(mysql_query("SELECT ort_name FROM tb_ord_type WHERE ort_type = '$o_type'"));
	$ordname = $ordtype['ort_name'];
	
	$prov = mysql_fetch_array(mysql_query("SELECT pro_name FROM province WHERE id = '$ord_prov'"));
	$custprov = $prov['pro_name'];
	
	if($result1) {
		$a = mysql_insert_id($conn);
		if($o_newold==1){
			$work_list = "INSERT INTO tb_tax SET vat_ord = '$maxvat', vat_ord_no = '$a', vat_ord_type = 1 ";
			$result6 = mysql_query($work_list);
		}
		
		if($result1){
			$msg = "เพิ่มออเดอร์ห้องเย็น ขนาด ".$ord_size.' x '.$ord_width.' x '.$ord_high."\n\n".' ลูกค้า '.$custnames."\n\n".$ordname."\n\n".' จังหวัด '.$custprov;	
			$res = notify_message($msg);			
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




