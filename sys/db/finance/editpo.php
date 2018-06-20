 <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	

	$rowcash = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2, cash_emp, cash_temp FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cash_now = $rowcash['cash_now'];
	$cash1 = $rowcash['cash1'];
	$cash2 = $rowcash['cash2'];
	$cash_emp = $rowcash['cash_emp'];
	$cash_temp = $rowcash['cash_temp'];

	$po_id = trim($_POST[poid]);
	$poname = trim($_POST['poname']);
	$poqty  = trim($_POST['poqty']);
	$poprice  = trim($_POST['poprice']);
	$pocreditcomp  = trim($_POST['pocreditcomp']);
	$posumrong  = trim($_POST['posumrong']);
	
	
	
	$poshop = trim($_POST['poshop']);
	$pobuyer  = trim($_POST['pobuyer']);
	
	$poment  = trim($_POST['poment']);
	
	$podate = trim($_POST['podate']);
	$pocredit = trim($_POST['pocredit']);
	
	$search_custname = trim($_POST['search_custname']);
	$today = date("Ymd");
	
	
	
	if($posumrong=='on') { $sumrong = 1;} else { $sumrong = 0; }
	if($pocredit=='on') { $po_credit = 1;} else {$po_credit = 0; }
	if($pocreditcomp) {$pocreditcomps = 1;} else {$pocreditcomps = 0;}
	
	/*echo "posumrong = ", $posumrong, "<br>";
	echo "pocredit = ", $pocredit, "<br>";
	echo "pocreditcomp = ", $pocreditcomp, "<br><br>";
	echo "sumrong = ", $sumrong, "<br>";
	echo "po_credit = ", $po_credit, "<br>";
	echo "pocreditcomps = ", $pocreditcomps, "<br>";
	exit();*/
	
	if($po_credit == 1 && $pocreditcomps == 1 && $sumrong == 0){
		if($cash1 < $poprice){ exit("<script>alert('เงินซื้อของไม่พอจ่ายเครดิต นะจ๊ะ');window.location='../../finance/outpay.php';</script>"); }
	}else if ($po_credit == 1 && $pocreditcomps == 1 && $sumrong == 1){
		if($cash_temp < $poprice){ exit("<script>alert('เงินสำรองไม่พอจ่ายเครดิต นะจ๊ะ');window.location='../../finance/outpay.php';</script>"); }
	}
	
	if($sumrong = 1){ 
		$temp_cash1 = $cash1; //เงินซื้อของ
		$temp_cash2 = $cash_temp - $poprice; //เงินสำรอง
	}else{
		$temp_cash1 = $cash1 - $poprice; //เงินซื้อของ
		$temp_cash2 = $cash_temp; //เงินสำรอง
	}
	
	
	
	
	
	echo "today = ", $today, "<br>"; 
	echo "poname = ", $poname, "<br>";
	echo "poqty = ", $poqty, "<br>";
	echo "poprice = ", $poprice, "<br>";

	echo "poshop = ", $poshop, "<br>";
	echo "pobuyer = ", $pobuyer, "<br>";
	echo "owner_money = ", $owner_money, "<br>";
	
	echo "poment = ", $poment, "<br>";
	echo "podate = ", $podate, "<br>";
	echo "pocredit = ", $pocredit, "<br>";
	
	echo "cash2 = ", $cash2, "<br>";
	echo "cash1 = ", $cash1, "<br>";
	echo "temp_cash1 = ", $temp_cash1, "<br>";
	echo "temp_cash2 = ", $temp_cash2, "<br>";
	
	
	
	
	$target_dir = "../../images/bill/";
	$filename = time().$_FILES["pobill"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	
	
	if(file_exists($_FILES['pobill']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["pobill"]["tmp_name"]);
				
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
		if ($_FILES["pobill"]["size"] > 3000000) { 
			echo "Sorry, your file is too large."; exit();
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) { 
			echo "Sorry, your file was not uploaded."; exit();
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["pobill"]["tmp_name"], $target_file)) {
				//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
				echo "The file ". basename( $_FILES["pobill"]["name"]). " has been uploaded."; 
			} else {
				echo "Sorry, there was an error uploading your file."; exit();
			}
		}
	}//end check is has file
	

	$sql = "UPDATE tb_po SET 
			po_name     = '$poname', 
			po_qty      = '$poqty', 
			po_price    = '$poprice', 
			po_buyer    = '$pobuyer', 
			po_shop     = '$poshop', 
			po_comment  = '$poment',  
			po_date     = '$podate', 
			po_bill_img = '$filename', 
			po_orders   = '$search_custname', 
			po_credit   = '$po_credit', 
			po_credit_complete = '$pocreditcomps' 
			WHERE po_id = '$po_id'
			";
	$result1 = mysql_query($sql);

	if($result1){ 
		if($po_credit == 1 && $pocreditcomps == 1){ // ต้องติ๊กชำระ เครดิตเท่านั้น ถึงจะมี Transaction ในตาราง tb_cash_center
			//$temp_cash1 = $cash1 - $poprice;
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_times = now(), cash1 = '$temp_cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_temp = '$temp_cash2'";		
			$result6 = mysql_query($cal_cash);
		}
		exit("<script>alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');window.location='../../finance/outpay.php';</script>");
	}else{
		exit("<script>alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ');window.location='../../finance/outpay.php';</script>");
	}

?>
</body>
</html>     