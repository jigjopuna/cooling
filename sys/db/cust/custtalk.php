<?php session_start();
	require_once('../../include/connect.php');
	
	$cust_name = trim($_POST['cust_name']);
	$province = trim($_POST['province']);
	$roomtype = trim($_POST['roomtype']);
	$phoneno = trim($_POST['phoneno']);
	$work_status = trim($_POST['work_status']);
	$notes = trim($_POST['notes']);
	$line = trim($_POST['line']);
	$facebook = trim($_POST['facebook']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <title>บันทึกข้อมูลลูกค้า</title>

</head>
<body>

<?php 
	$e_id = $_SESSION["ss_emp_id"];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php'; </script>");}
		
	echo "cust_name : ".$cust_name. "<br>";
	echo "province : ".$province. "<br>";
	echo "roomtype : ".$roomtype. "<br>";
	echo "phoneno : ".$phoneno. "<br>";
	echo "work_status : ".$work_status. "<br>";
	echo "notes : ".$notes. "<br>";
	echo "line : ".$line. "<br>";
	echo "facebook : ".$facebook. "<br>";
	
	//exit();
	$target_dir = "../../images/cust_image/";
	$filename = time().$_FILES["photos"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	if(file_exists($_FILES['photos']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["photos"]["tmp_name"]);
				
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
		if ($_FILES["photos"]["size"] > 3000000) { 
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
			if (move_uploaded_file($_FILES["photos"]["tmp_name"], $target_file)) {
				//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
				echo "The file ". basename( $_FILES["photos"]["name"]). " has been uploaded."; 
			} else {
				echo "Sorry, there was an error uploading your file."; exit();
			}
		}
	}//end check is has file
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	//exit();
	
	
	$sql = "INSERT INTO tb_quo_cust SET 
				qcust_name = '$cust_name', 
				qcust_prov = '$province', 
				qcust_note = '$notes', 	
				qcust_roomtype = '$roomtype', 
				qcust_tel = '$phoneno', 
				qcust_flow = '$work_status', 
				qcust_img = '$filename',  
				qcust_line = '$line', 
				qcust_fb = '$facebook',
				qcust_day = now()";
	$result = mysql_query($sql);	
	
	if($result){
		exit("<script> alert('บันทึกคุยกับลูกค้าเรียบร้อย'); window.location='../../quotation/cust_q.php';</script>");
	}else{
		exit("<script> alert('บันทึกไม่สำเร็จ ติดต่อผู้ดูแลระบบ'); window.location='../../customer/cust_qoutation.php';</script>");
	}

?>
    

</body>

</html>
