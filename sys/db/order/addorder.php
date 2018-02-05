<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data
	$search_custname = trim($_POST['search_custname']);
	$o_date = trim($_POST['date_pay']);  
	$ord_size = trim($_POST['ord_size']);
	$ord_temp = trim($_POST['ord_temp']);
	$voltage = trim($_POST['voltage']);
	$ord_price = trim($_POST['ord_price']);
	$date_delivery = trim($_POST['date_delivery']);
	
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
		if ($_FILES["ord_quotation"]["size"] > 3000000) { 
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
			o_price = '$ord_price', 
			o_delivery_date = '$date_delivery', 
			o_quotation = '$filename', 
			o_voltage = '$voltage', 
			o_temp = '$ord_temp'";
	
	$result1 = mysql_query($sql);
	
	if($result1) {
		exit("<script>alert('บันทึกออเดอร์ใหม่เรียบร้อยแล้วจร้า ^^ '); window.location='../../order/order.php';</script>");
	} else {
		 exit("<script>alert('บันทึกออเดอร์ไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../order/order.php';</script>");
	}
?>
</body>
</html>     




