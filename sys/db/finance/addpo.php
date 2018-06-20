 <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	

	$rowcash = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2, cash_emp, cash_temp FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	
	$poname = trim($_POST['poname']);
	$poqty  = trim($_POST['poqty']);
	$poprice  = trim($_POST['poprice']);
	
	$poshop = trim($_POST['poshop']);
	$pobuyer  = trim($_POST['pobuyer']);
	$owner_money  = trim($_POST['owner_money']);
	
	$poment  = trim($_POST['poment']);
	
	$podate = trim($_POST['podate']);
	$pocredit = trim($_POST['pocredit']);
	$posumrong = trim($_POST['posumrong']);
	
	$search_custname = trim($_POST['search_custname']);
	$curr_cash = $rowcash['cash_now'];
	$cash1 = $rowcash['cash1'];
	$cash2 = $rowcash['cash2'];
	$cash_emp = $rowcash['cash_emp'];
	$cash_temp = $rowcash['cash_temp'];

	
	$e_id = trim($_POST['e_id']);
	
	$today = date("Ymd");
	
	if($posumrong=='on'){ 
		$sumrong = 1; //เอาเงินสำรองซื้อ
		if($cash_temp < $poprice) { exit("<script>alert('เงินกอง สำรองจ่าย ไม่พอ '); window.location='../../finance/outpay.php';</script>"); }
		$temp_cash1 = $cash1; //เงินซื้อของ
		$temp_cash2 = $cash_temp - $poprice; //เงินสำรอง
	}else{
		$sumrong = 0;	//เอาเงินซื้อของซื้อ
		$temp_cash1 = $cash1 - $poprice; //เงินซื้อของ
		$temp_cash2 = $cash_temp; //เงินสำรอง
	}

	if($pocredit=='on'){ 
		$po_credit = 1;
	}else{
		$po_credit = 0;	
		if(($cash1 < $poprice) && ($sumrong == 0)) { exit("<script>alert('เงินซื้อของไม่พอ '); window.location='../../finance/outpay.php';</script>"); }
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
	echo "pocredit = ", $pocredit, "<br>";
	
	$target_dir = "../../images/bill/";
	$filename = time().$_FILES["pobill"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	//exit();
	
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
	

	$sql = "INSERT INTO tb_po SET 
			po_name     = '$poname', 
			po_qty      = '$poqty', 
			po_price    = '$poprice', 
			po_buyer    = '$pobuyer', 
			po_subyer    = '$owner_money',			
			po_shop     = '$poshop', 
			po_comment  = '$poment', 
			po_bill_img = '$filename', 
			po_date     = '$podate', 
			po_orders   = '$search_custname', 
			po_credit   = '$po_credit', 
			po_emp      = '$e_id', 
			po_time =  now()";
	
	$result1 = mysql_query($sql);
	
	//อัปเดทเงินกองกลาง ในกรณีที่ใช้เงินส่วนกลางซื้อของ
	if($pobuyer == 10 && $po_credit == 0){				
		if($result1){ // เอาค่า PK ที่เพิ่งบันทึกลงในตารางสั่งซื้อมา ผูกไว้ในตารางเงินกองกลาง tb_cash_center
			$a = mysql_insert_id($conn);
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$curr_cash', cash_times = now(), cash1 = '$temp_cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_temp = '$temp_cash2'";		
			$result6 = mysql_query($cal_cash);
		}
			
		if($result6) {
			exit("<script>alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');window.location='../../finance/outpay.php';</script>");
		} else {
		    exit("<script>alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ');window.location='../../finance/outpay.php';</script>");
		}			
				
	}else{
	
		if($result1) {
			exit("<script>alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ! ');window.location='../../finance/outpay.php';</script>");
		} else {
			 exit("<script>alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ !'); window.location='../../finance/outpay.php';</script>");
		}
	}
	
	
	
?>
</body>
</html>     