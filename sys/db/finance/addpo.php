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

	$poname = trim($_POST['poname']);
	$poprodtype = trim($_POST['poprodtype']);
	$poqty  = trim($_POST['poqty']);
	$poprice  = trim($_POST['poprice']);
	$mudjum  = trim($_POST['mudjum']);
	
	
	$poshop = trim($_POST['poshop']);
	$pobuyer  = trim($_POST['pobuyer']);
	$owner_money  = trim($_POST['owner_money']);
	
	$poment  = trim($_POST['poment']);
	$po_subcate  = trim($_POST['po_subcate']);
	
	
	$podate = trim($_POST['podate']);
	$pocredit = trim($_POST['pocredit']);
	$posumrong = trim($_POST['posumrong']);
	
	$search_custname = trim($_POST['search_custname']);
	$e_id = trim($_POST['e_id']);
	$today = date("Ymd");
	
	$ord_bank = trim($_POST['ord_bank']);
	
	if($pocredit=='on'){ 
		$po_credit = 1;
		$mudjum_1 = $mudjum;
	}else{
		$po_credit = 0;
		$mudjum_1 = 0;
	}
	

	
	/*
		cash_now = กองเงินรับเข้าาจากลูกค้า
		cash1 = กองเงินซื้อของ
		cash2 = กองเงินกำไร
		cash_emp = กองเงินไว้จ่ายพนักงาน
		cash_temp = กองไว้เผื่อทำอะไร กองเงินสำรอง
		
		
	   มัดจำซื้อของ จะเอาเงินจากส่วนกลางมัดจำ 
	   หักเงินจากส่วนกลาง
	   จะมี 2 กรณี 
	   1. จ่ายสด   (หักเงินส่วนกลาง)
	   2. เครดิตเครดิตสั่งของ  (ไม่หัก) โปรเซิร์ฟ
	   3. มัดจำซื้อของ % ใส่ยอดเงินมัดจำ และจ่ายเต็มเมื่อรับของ (หักเงินส่วนกลาง)
	   4. มัดจำซื้อของ % ใส่ยอดเงินมัดจำ จ่ายเงินเต็มเมื่อครบกำหนดเวลาดิว เช่น 30 วัน (หักเงินส่วนกลาง)  คุณบี ต้น
	   
	   ไม่หักส่วนก็ต่อเมื่อ ติ๊ก Credit และ มัดจำเป็น 0 
	*/
	
	
	if($ord_bank == 1){
		
	}else if($ord_bank == 1){
		
	}
	

	
	echo "ซื้อของ = ", $poprice, "<br>"; 
	echo "มัดจำ = ", $mudjum_1, "<br>";
	echo "เงินคงเหลือก่อนซื้อ = ", $cash1, "<br>";
	echo "เงินซื้องคงเหลือ = ", $temp_cash1, "<br>";
	echo "เงินสำรอง = ", $temp_cash2, "<br>";
	//exit();
	
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
			po_subcate  = '$po_subcate', 
			po_buyer    = '$pobuyer', 
			po_subyer    = '$owner_money',			
			po_shop     = '$poshop', 
			po_comment  = '$poment', 
			po_mudjum   = '$mudjum_1', 
			po_bill_img = '$filename', 
			po_date     = '$podate', 
			po_orders   = '$search_custname', 
			po_cate		= '$poprodtype', 	
			po_credit   = '$po_credit', 
			po_emp      = '$e_id', 
			po_time =  now()";
	
	$result1 = mysql_query($sql);
	
	//อัปเดทเงินกองกลาง ในกรณีที่ใช้เงินส่วนกลางซื้อของ 
	if($pobuyer == 10 /*&& $po_credit == 0*/){				
		if($result1){ // เอาค่า PK ที่เพิ่งบันทึกลงในตารางสั่งซื้อมา ผูกไว้ในตารางเงินกองกลาง tb_cash_center
			$a = mysql_insert_id($conn);
		if($ord_bank == 1){ //กสิกร ออม 
  
		   if($pocredit=='on'){ 
				$mudjum_1 = $mudjum;
				if($mudjum!=0) { $update_cash = $cash_now - $mudjum; } else { $update_cash = $cash_now; }
			}else{
				$mudjum_1 = 0;
				$update_cash = $cash_now - $poprice; //เงินซื้อของ
				if(($cash_now < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ กสิกร ออมทรัพย์ '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$update_cash', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";

		 }else if ($ord_bank == 2){ //กสิกร กระแส
		  
		  if($pocredit=='on'){ 
				if($mudjum!=0) { /*มัดจำ*/ $update_cash = $cash_now1 - $mudjum; } else { /*ไม่ มัดจำ*/ $update_cash = $cash_now1; }
			}else{
				$update_cash = $cash_now1 - $poprice; //เงินซื้อของ
				if(($cash_now1 < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ กสิกร กระแส '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$update_cash', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";

		 }else if ($ord_bank == 4){ // tbm ออม
		  
		  if($pocredit=='on'){ 
				if($mudjum!=0) { $update_cash = $cash1 - $mudjum; } else { $update_cash = $cash1; }
			}else{
				$update_cash = $cash1 - $poprice; //เงินซื้อของ
				if(($cash1 < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ tbm ออม '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$update_cash', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
			
		 }else if ($ord_bank == 5){ //tmb กระแส
		    if($pocredit=='on'){ 
				if($mudjum!=0) { $update_cash = $cash2 - $mudjum; } else { $update_cash = $cash2; }
			}else{
				$update_cash = $cash2 - $poprice; //เงินซื้อของ
				if(($cash2 < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ tmb กระแส '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$update_cash', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
			
		 }else if ($ord_bank == 6){ //กรุงเทพ ออม
		    if($pocredit=='on'){ 
				if($mudjum!=0) { $update_cash = $cash_salary - $mudjum; } else { $update_cash = $cash_salary; }
			}else{
				$update_cash = $cash_salary - $poprice; //เงินซื้อของ
				if(($cash_salary < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ กรุงเทพ ออม '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$update_cash', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
			
		 }else if ($ord_bank == 7){ //ไทยพานิชย์ ออม 
			if($pocredit=='on'){ 
				if($mudjum!=0) { $update_cash = $cash_emp - $mudjum; } else { $update_cash = $cash_emp; }
			}else{
				$update_cash = $cash_emp - $poprice; //เงินซื้อของ
				if(($cash_emp < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ ไทยพานิชย์ ออมทรัพย์ '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$update_cash', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		  
		 }else if ($ord_bank == 8){ //ไทยพานิชย์ กระแส cash_emp1
		 
			if($pocredit=='on'){ 
				if($mudjum!=0) { $update_cash = $cash_emp1 - $mudjum; } else { $update_cash = $cash_emp1; }
			}else{
				$update_cash = $cash_emp1 - $poprice; //เงินซื้อของ
				if(($cash_emp1 < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ ไทยพานิชย์ กระแส '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$update_cash', cash_temp = '$cash_temp', cash_temp1 = '$cash_temp1'";
		  
		 }else if ($ord_bank == 9){ //กรุงศรี ออม cash_temp
		  
			if($pocredit=='on'){ 
				if($mudjum!=0) { $update_cash = $cash_temp - $mudjum; } else { $update_cash = $cash_temp; }
			}else{
				$update_cash = $cash_temp - $poprice; //เงินซื้อของ
				if(($cash_temp < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ กรุงศรี ออม'); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$update_cash', cash_temp1 = '$cash_temp1'";
		  
		 }else if ($ord_bank == 10){ //กรุงศรี กระแส  cash_temp1
		 
		    if($pocredit=='on'){ 
				if($mudjum!=0) { $update_cash = $cash_temp1 - $mudjum; } else { $update_cash = $cash_temp1; }
			}else{
				$update_cash = $cash_temp1 - $poprice; //เงินซื้อของ
				if(($cash_temp1 < $poprice)) { exit("<script>alert('เงินซื้อของไม่พอ กรุงศรี กระแส '); window.location='../../finance/outpay.php';</script>"); }
			}
			
			$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_times = now(), cash1 = '$cash1', cash2 = '$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp = '$cash_temp', cash_temp1 = '$update_cash'";
		  
		 }else if ($ord_bank == 11){ //กรุงเทพ กระแส
		  //$update_cash = $cash_temp + $payamount;
		 }
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