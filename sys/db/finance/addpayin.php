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
	$cash1 = $rowcash['cash1'];
	$cash2 = $rowcash['cash2'];
	$cash_emp = $rowcash['cash_emp'];
	$cash_emp1 = $rowcash['cash_emp1'];
	$cash_temp = $rowcash['cash_temp'];
	$cash_temp1 = $rowcash['cash_temp1'];
	
	
	//1. receive data
	$cust_order = trim($_POST['search_ord']);
	$payamount  = trim($_POST['payamount']);
	
	$emp = 2; // ชายเป็นคนรับเงิน ตั้งค่าไว้เฉยๆ 
	$paydate  = trim($_POST['paydate']);
	$poment  = trim($_POST['poment']);
	
	$podate = trim($_POST['podate']);
	$ord_bank = trim($_POST['ord_bank']);
	$today = date("Ymd");
	
	
	
	
	/*if($emp == 2){
		$cash1 = $cash1 + $payamount;
	}else if ($emp == 3){
		$cash2 = $cash2 + $payamount;
	}else{
		exit("<script> alert('เลือกผู้รับเงินด้วยจร้า'); window.location='../../finance/inpay.php';</script>");
	}*/
	
	

	echo "cust_order = ". $cust_order. "<br>";
	echo "payamount = ". $payamount. "<br>";
	echo "payinbill = ". $payinbill. "<br>";
	echo "emp = ". $emp. "<br>";
	echo "paydate = ". $paydate. "<br>";
	echo "today = ". $today. "<br><br><br>"; 
	
	echo "cur_cash = ". $cur_cash. "<br>";
	echo "cash1 = ". $cash1. "<br>";
	echo "cash2 = ". $cash2. "<br>";
	echo "cash_emp = ". $cash_emp. "<br>";
	echo "cash_temp = ". $cash_temp. "<br>";
	//exit();
	
	

	$target_dir = "../../images/receive/";
	$filename = time().$_FILES["payinbill"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	//exit();
	
	if(file_exists($_FILES['payinbill']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["payinbill"]["tmp_name"]);
				
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
		if ($_FILES["payinbill"]["size"] > 3000000) { 
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
			if (move_uploaded_file($_FILES["payinbill"]["tmp_name"], $target_file)) {
				//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
				echo "The file ". basename( $_FILES["payinbill"]["name"]). " has been uploaded."; 
			} else {
				echo "Sorry, there was an error uploading your file."; exit();
			}
		}
	}//end check is has file
	


	//2. insert into database	
	$sql = "INSERT INTO tb_ord_pay SET 
			o_id        = '$cust_order', 
			pay_amount  = '$payamount', 
			pay_bill    = '$filename', 
			o_emp_receive    = '$emp',  
			pay_date    = '$paydate', 
			pay_bank    = '$ord_bank',
			pay_time    =  now()";
			
	$result1 = mysql_query($sql);
	
	
	if($result1){ 
		$a = mysql_insert_id($conn);
		
		
		if($ord_bank == 1){ //กสิกร ออม 
  
		  $update_cash = $cash_now + $payamount;
		  
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$update_cash', cash_now1 = 'cash_now1', cash1 = '$cash1', cash2='$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp='$cash_temp', cash_temp1 ='$cash_temp1', cash_times=now()";

		 }else if ($ord_bank == 2){ //กสิกร กระแส
		  
		  $update_cash = $cash_now1 + $payamount;
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = '$update_cash', cash1 = '$cash1', cash2='$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp='$cash_temp', cash_temp1 ='$cash_temp1', cash_times=now()";
		  
		 }else if ($ord_bank == 4){ // tbm ออม
		  
		  $update_cash = $cash1 + $payamount;
		  
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = 'cash_now1', cash1 = '$update_cash', cash2='$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp='$cash_temp', cash_temp1 ='$cash_temp1', cash_times=now()";
		  
		  
		 }else if ($ord_bank == 5){ //tmb กระแส
		  
		  $update_cash = $cash2 + $payamount;
		  
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = 'cash_now1', cash1 = '$cash1', cash2='$update_cash', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp='$cash_temp', cash_temp1 ='$cash_temp1', cash_times=now()";
		  
		  
		 }else if ($ord_bank == 6){ //กรุงเทพ ออม
		 
		  $update_cash = $salary + $payamount;
		  
		  
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$update_cash', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = 'cash_now1', cash1 = '$cash1', cash2='$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp='$cash_temp', cash_temp1 ='$cash_temp1', cash_times=now()";
		  
		  
		 }else if ($ord_bank == 7){ //ไทยพานิชย์ ออม
		 
		  $update_cash = $cash_emp + $payamount;
		 
		 $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = 'cash_now1', cash1 = '$cash1', cash2='$cash2', cash_emp = '$update_cash', cash_emp1 = '$cash_emp1', cash_temp='$cash_temp', cash_temp1 ='$cash_temp1', cash_times=now()";
		  
		 }else if ($ord_bank == 8){ //ไทยพานิชย์ กระแส
		 
		  $update_cash = $cash_emp1 + $payamount;
		  
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = 'cash_now1', cash1 = '$cash1', cash2='$cash2', cash_emp = '$cash_emp', cash_emp1 = '$update_cash', cash_temp='$cash_temp', cash_temp1 ='$cash_temp1', cash_times=now()";
		  
		 }else if ($ord_bank == 9){ //กรุงศรี ออม
		  
		  $update_cash = $cash_temp + $payamount;
		 
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = '$cash_now1', cash1 = '$cash1', cash2='$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp='$update_cash', cash_temp1 ='$cash_temp1', cash_times=now()";
		  
		  
		 }else if ($ord_bank == 10){ //กรุงศรี กระแส
		 
		  $update_cash = $cash_temp1 + $payamount;
		  
		  $work_list = "INSERT INTO tb_cash_center SET cash_ord = '$a', cash_in = '$payamount', cash_date = '$paydate', cash_salary = '$cash_salary', cash_bank = '$cash_bank', cash_now = '$cash_now', cash_now1 = 'cash_now1', cash1 = '$cash1', cash2='$cash2', cash_emp = '$cash_emp', cash_emp1 = '$cash_emp1', cash_temp='$cash_temp', cash_temp1 ='$update_cash', cash_times=now()";
		  
		 }else if ($ord_bank == 11){ //กรุงเทพ กระแส
		  //$update_cash = $cash_temp + $payamount;
		 }
		
		$result6 = mysql_query($work_list);
		
		if($result6){
			exit("<script>alert('บันทึกเงินเข้าเรียบร้อยแล้วจร้า ^^ ');window.location='../../finance/inpay.php';</script>");
		}else{
			exit("<script>alert('บันทึกเงินไม่เข้า TT ');window.location='../../finance/inpay.php';</script>");
		}
	}//end cash
		
?>
</body>
</html>     