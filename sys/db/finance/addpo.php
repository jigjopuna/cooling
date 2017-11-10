 <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	

	$rowcash = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	
	$poname = trim($_POST['poname']);
	$poqty  = trim($_POST['poqty']);
	$poprice  = trim($_POST['poprice']);
	
	$poshop = trim($_POST['poshop']);
	$pobuyer  = trim($_POST['pobuyer']);
	$owner_money  = trim($_POST['owner_money']);
	
	$poment  = trim($_POST['poment']);
	
	$podate = trim($_POST['podate']);
	$pocredit = trim($_POST['pocredit']);
	
	$search_custname = trim($_POST['search_custname']);
	$curr_cash = $rowcash['cash_now'];
	$cash1 = $rowcash['cash1'];
	$cash2 = $rowcash['cash2'];
	
	$today = date("Ymd");
	
	if($pocredit=='on'){ 
		$po_credit = 1;
	}else{
		$po_credit = 0;	
	}
	
	if($owner_money == 2){
		if($cash1 < $poprice) { exit("<script>alert('เงินกองกลางชายไม่พอ '); window.location='../../finance/outpay.php';</script>"); }
	}else if($owner_money == 3){
		if($cash2 < $poprice) { exit("<script>alert('เงินกองกลางพี่ไพรฑูรย์ไม่พอ '); window.location='../../finance/outpay.php';</script>"); }
	}else{}
	
	
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
			po_time =  now()";
	
	$result1 = mysql_query($sql);
	
	//อัปเดทเงินกองกลาง ในกรณีที่ใช้เงินส่วนกลางซื้อของ
	if($pobuyer == 10){
		if($poprice > $curr_cash){
			exit("<script>alert('เงินกองกลางไม่พอ '); window.location='../../finance/outpay.php';</script>");
		}else{		
			if($result1){ // เอาค่า PK ที่เพิ่งบันทึกลงในตารางสั่งซื้อมา ผูกไว้ในตารางเงินกองกลาง tb_cash_center
				$a = mysql_insert_id($conn);
				if($owner_money==2){
					/*เลขเป็นบัญชีของชายให้ 
					 ตอนซื้อของถ้าเลือกจ่ายเป็นส่วนกลางแล้วก็ต้องเช็คว่าเอาจากบัญชีไหนมา ถ้าบัญชีนั้นเงินไม่พอก็ต้องบอกไม่พอ 
					*/
					if($cash1 < $poprice){
						exit("<script>alert('เงินกองกลางชายไม่พอ'); window.location='../../finance/outpay.php';</script>");
					}else{
						$temp_cash1 = $cash1 - $poprice;
						$new_cash = $curr_cash - $poprice;
						$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$new_cash', cash_times = now(), cash1 = '$temp_cash1', cash2 = '$cash2'";
					}
				}else if ($owner_money==3){
					if($cash2 < $poprice){
						exit("<script>alert('เงินกองกลางพี่ไพรฑูรย์ไม่พอ'); window.location='../../finance/outpay.php';</script>");
					}else{
						$temp_cash2 = $cash2 - $poprice;
						$new_cash = $curr_cash - $poprice;
						$cal_cash = "INSERT INTO tb_cash_center SET cash_po = '$a', cash_out = '$poprice', cash_date = '$podate', cash_now = '$update_cash', cash_times = now(), cash1 = '$temp_cash1', cash2 = '$cash2'";
					}
									
				}else{
					
				}
				$result6 = mysql_query($cal_cash);
			}
			
			if($result6) {
				//echo 'Successful inserts: ';
				exit("
					<script>
						alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');
						window.location='../../finance/outpay.php';
					</script>");
			} else {
			   // echo 'query failed: ' ;
			   exit("
					<script>
						alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ');
						 window.location='../../finance/outpay.php';
					</script>");
			}			
		}
		
	}else{
		
		if($result1) {
				//echo 'Successful inserts: ';
				exit("
					<script>
						alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');
						window.location='../../finance/outpay.php';
					</script>");
			} else {
			   // echo 'query failed: ' ;
			   exit("
					<script>
						alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ');
						 window.location='../../finance/outpay.php';
					</script>");
			}
	}
	
	
	
?>
</body>
</html>     