 <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	

	$rowcash = mysql_fetch_array(mysql_query("SELECT * FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	
	$cash_now = $rowcash['cash_now'];
	$cash_now1 = $rowcash['cash_now1']; 
		
	$cash_salary = $rowcash['cash_salary'];
	$cash_bank = $rowcash['cash_bank'];
		
	$cash1 = $rowcash['cash1'];
	$cash2 = $rowcash['cash2'];
		
	$cash_emp = $rowcash['cash_emp'];
	$cash_emp1 = $rowcash['cash_emp1'];
	
	$cash_temp = $rowcash['cash_temp'];
	$cash_temp1 = $rowcash['cash_temp1'];
		
	
	$po_id = trim($_POST[poid]);
	$poname = trim($_POST['poname']);
	$poqty  = trim($_POST['poqty']);
	$poprice  = trim($_POST['poprice']);
	$pocreditcomp  = trim($_POST['pocreditcomp']);
	$posumrong  = trim($_POST['posumrong']);
	$remain  = trim($_POST['remain']);
	
	$due_date  = trim($_POST['po_due_date']);
	
	$poshop = trim($_POST['poshop']);
	$pobuyer  = trim($_POST['pobuyer']);
	
	$poment  = trim($_POST['poment']);
	
	$podate = trim($_POST['podate']);
	$pocredit = trim($_POST['pocredit']);
	
	$search_custname = trim($_POST['search_custname']);
	$credit_pay = trim($_POST['credit_pay']);
	$getfristdate = substr($credit_pay, 0, 1);
	
	$today = date("Y-m-d");
	
	$ord_bank = trim($_POST['ord_bank']);
	
	
	
	
	
	if($posumrong=='on') { $sumrong = 1;} else { $sumrong = 0; }
	if($pocredit=='on') { $po_credit = 1;} else {$po_credit = 0; }
	if($pocreditcomp=='on') {
		$pocreditcomps = 1;
		/* 
			เช็คว่าติ๊กจ่ายเครดิตไหม ถ้าติ๊กจ่ายเครดิตให้ อัปเดทวันที ณ วันปัจจุบัน
			ถ้า credit_pay ไม่เป็น 0000-00-00 ให้ใส่เป็นค่าปัจจุบัน
			ถ้า credit_pay ขึ้นต้นด้วย 20xxx ให้ update เป็นค่าเดิม เพราะยังต้อง update อยู่แล้ว
		*/
		if($getfristdate > 1){
			$wan_jay = $credit_pay;
		}else{
			$wan_jay = $today;
		}
	
	} else {
		$pocreditcomps = 0;
	}
	
	
	/*echo "posumrong = ", $posumrong, "<br>";
	echo "pocredit = ", $pocredit, "<br>";
	echo "pocreditcomp = ", $pocreditcomp, "<br><br>";
	echo "sumrong = ", $sumrong, "<br>";
	echo "po_credit = ", $po_credit, "<br>";
	echo "pocreditcomps = ", $pocreditcomps, "<br>";
	exit();*/
	
	
	//ถ้าเป็นเครดิต และ ยังไม่ได้ชำระเครดิต  
	/*if($po_credit == 1 && $pocreditcomps == 1 && $sumrong == 0){
		if($cash1 < $remain){ exit("<script>alert('เงินซื้อของไม่พอจ่ายเครดิต นะจ๊ะ');window.location='../../finance/outpay.php';</script>"); }
	}else if ($po_credit == 1 && $pocreditcomps == 1 && $sumrong == 1){
		if($cash_temp < $remain){ exit("<script>alert('เงินสำรองไม่พอจ่ายเครดิต นะจ๊ะ');window.location='../../finance/outpay.php';</script>"); }
	}*/
	
	if($sumrong == 1){ 
		$temp_cash1 = $cash1; //เงินซื้อของ
		$temp_cash2 = $cash_temp - $remain; //เงินสำรอง
	}else{
		$temp_cash1 = $cash1 - $remain; //เงินซื้อของ
		$temp_cash2 = $cash_temp; //เงินสำรอง
	}
	

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
	//exit();
	
	$sql = "UPDATE tb_po SET 
			po_name     = '$poname', 
			po_qty      = '$poqty', 
			po_price    = '$poprice', 
			po_buyer    = '$pobuyer', 
			po_shop     = '$poshop', 
			po_pay_bank = '$ord_bank', 
			po_comment  = '$poment',  
			po_date     = '$podate', 
			po_bill_img = '$filename', 
			po_orders   = '$search_custname', 
			po_credit_due_date	= '$due_date', 
			po_credit_pay	= '$wan_jay', 
			po_credit   = '$po_credit', 
			po_credit_complete = '$pocreditcomps' 
			WHERE po_id = '$po_id'
			";
	$result1 = mysql_query($sql);

	if($result1){ 
		if($po_credit == 1 && $pocreditcomps == 1){ // ต้องติ๊กชำระ เครดิตเท่านั้น ถึงจะมี Transaction ในตาราง tb_cash_center และตัดเงินที่เหลือหลังมัดจำ
			

		 if($ord_bank == 1){ //กสิกร ออม 
			$update_cash = $cash_now - $remain; 	
			if(($cash_now < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ กสิกร ออมทรัพย์ '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$update_cash', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		   

		 }else if ($ord_bank == 2){ //กสิกร กระแส
		    $update_cash = $cash_now1 - $remain; 	
			if(($cash_now1 < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ กสิกร กระแส '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$update_cash', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		  
		 }else if ($ord_bank == 4){ // tbm ออม
			$update_cash = $cash1 - $remain; 	
			if(($cash1 < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ TMB ออมทรัพย์ '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$update_cash', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		 
		 }else if ($ord_bank == 5){ //tmb กระแส
		    $update_cash = $cash2 - $remain; 	
			if(($cash2 < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ TMB กระแส '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$update_cash', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
			
		 }else if ($ord_bank == 6){ //กรุงเทพ ออม
			$update_cash = $cash_salary - $remain; 	
			if(($cash_salary < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ BBL ออมทรัพย์ '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$update_cash', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		    
		 }else if ($ord_bank == 7){ //ไทยพานิชย์ ออม 
			$update_cash = $cash_emp - $remain; 	
			if(($cash_emp < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ SCB ออมทรัพย์ '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$update_cash', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		  
		 }else if ($ord_bank == 8){ //ไทยพานิชย์ กระแส cash_emp1
			$update_cash = $cash_emp1 - $remain; 	
			if(($cash_emp1 < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ SCB กระแส '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$update_cash', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
			
		 }else if ($ord_bank == 9){ //กรุงศรี ออม cash_temp
			$update_cash = $cash_temp - $remain; 	
			if(($cash_temp < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ SCB กระแส '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$update_cash', cash_temp1 = '$cash_temp1'";
			
		  
		 }else if ($ord_bank == 10){ //กรุงศรี กระแส  cash_temp1
			$update_cash = $cash_temp1 - $remain; 	
			if(($cash_temp1 < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ กรุงเศรี ออมทรัพย์ '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$update_cash'";
		   
		  
		 }else if ($ord_bank == 11){ //กรุงเทพ กระแส
			$update_cash = $cash_bank - $remain; 	
			if(($cash_bank < $remain)) { 
				exit("<script>alert('เงินซื้อของไม่พอ BBL กระแส '); window.location='../../finance/outpay.php';</script>"); 
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$po_id', cash_out = '$remain', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$update_cash', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		 
		 }
			$result6 = mysql_query($cal_cash);
			
			
		}
		exit("<script>alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');window.location='../../finance/outpay.php';</script>");
	}else{
		exit("<script>alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ');window.location='../../finance/outpay.php';</script>");
	}

?>
</body>
</html>     