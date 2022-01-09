<?php require_once('../../include/connect.php'); 
	
	/*ถ้ายังไม่มี session ตะกร้า ให้สร้างตะกร้าใหม่
	if($_SESSION['session_admin_basket'] == '')
		$sqlcrebas = "INSERT INTO tb_basket SET b_cust = '0', b_type='M', b_status = '0'";
		$createba = mysql_query($sqlcrebas);
					
		if($createba){ 
			$a = mysql_insert_id($conn);
			$_SESSION['session_admin_basket'] = $a;
		}
	}*/
	
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
	//define('LINE_TOKEN','rnkNl937MsFP8QGVRf4nKZQ0OIspR6MaVXe6GZdrE9G');
    define('LINE_TOKEN','jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt');	
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
	$ord_price = trim($_POST['ord_price']);
	
	$logger = trim($_POST['logger']);
	$prod = trim($_POST['prod']);
	$prod_type = trim($_POST['prod_type']);
	$ord_qty = trim($_POST['ord_qty']); 
	$ord_temp = trim($_POST['ord_temp']);
	
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
	$sql = "INSERT INTO tb_deposit SET 
			d_cust =  '$search_custname', 
			d_qty = '$ord_qty', 
			d_temp = '$ord_temp', 
			d_logger = '$logger', 
			d_status =  1, 
			d_emp = 2, 
			d_date =  '$o_date', 
			d_price = '$ord_price', 
			d_prod = '$prod', 
			d_prod_type = '$prod_type', 
			d_quotation = '$filename'
			" ;
	$result1 = mysql_query($sql); 
	
	$rowcust = mysql_fetch_array(mysql_query("SELECT cust_name FROM tb_customer WHERE cust_id = '$search_custname'"));
	$custnames = $rowcust['cust_name'];

	
	if($result1) {
		$a = mysql_insert_id($conn);
		if($o_newold==1){
			$work_list = "INSERT INTO tb_tax SET vat_ord = '$maxvat', vat_ord_no = '$a', vat_ord_type = 1 ";
			$result6 = mysql_query($work_list);
		}
		
		if($result1){
			$msg = "เทสระบบรับฝากอาหาร ".$ord_size.' x '.$ord_width.' x '.$ord_high."\n\n".' ลูกค้า '.$custnames."\n\n".' จังหวัด '.$custprov;	
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




