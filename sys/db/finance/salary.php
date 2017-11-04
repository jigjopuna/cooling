<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	

	$emp_id = trim($_POST['search_emp']);
	$payamount  = trim($_POST['payamount']);
	$sal_comment  = trim($_POST['sal_comment']);
	
	$paydate = trim($_POST['paydate']);

	$today = date("Ymd");
	
	/*if($pocredit=='on'){ 
		$po_credit = 1;
	}else{
		$po_credit = 0;
		
	}*/
	
	echo "today = ", $today, "<br>"; 

	echo "emp_id = ", $emp_id, "<br>";
	echo "payamount = ", $payamount, "<br>";
	echo "sal_comment = ", $sal_comment, "<br>";
	echo "paydate = ", $paydate, "<br>";
	
	
	$target_dir = "../../images/salary/";
	$filename = time().$_FILES["sal_bill"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	//exit();
	
	if(file_exists($_FILES['sal_bill']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["sal_bill"]["tmp_name"]);
				
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
		if ($_FILES["sal_bill"]["size"] > 3000000) { 
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
			if (move_uploaded_file($_FILES["sal_bill"]["tmp_name"], $target_file)) {
				//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
				echo "The file ". basename( $_FILES["sal_bill"]["name"]). " has been uploaded."; 
			} else {
				echo "Sorry, there was an error uploading your file."; exit();
			}
		}
	}//end check is has file
	

	$sql = "INSERT INTO tb_salary SET 
			sal_amount     = '$payamount', 
			sal_emp        = '$emp_id', 
			sal_bill       = '$filename', 
			sal_comment    = '$sal_comment', 
			sal_date       = '$paydate'";
	
	$result1 = mysql_query($sql);
	
	if($result1) {
		//echo 'Successful inserts: ';
		exit("
			<script>
				alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');
				window.location='../../finance/salary.php';
			</script>");
	} else {
		// echo 'query failed: ' ;
		exit("
			<script>
				alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ');
				window.location='../../finance/salary.php';
			</script>");
	}

?>
</body>
</html>     