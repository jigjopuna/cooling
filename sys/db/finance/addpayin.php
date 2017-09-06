  <?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	//1. receive data
	$cust_order = trim($_POST['search_custname']);
	$payamount  = trim($_POST['payamount']);
	
	$emp = trim($_POST['search_emp']);
	$paydate  = trim($_POST['paydate']);
	$poment  = trim($_POST['poment']);
	
	$podate = trim($_POST['podate']);
	$today = date("Ymd");
	
	

	echo "cust_order = ", $cust_order, "<br>";
	echo "payamount = ", $payamount, "<br>";
	echo "payinbill = ", $payinbill, "<br>";

	echo "emp = ", $emp, "<br>";
	echo "paydate = ", $paydate, "<br>";
	
	echo "today = ", $today, "<br>"; 
	
	
	
	
	
	$target_dir = "../../images/receive/";
	$filename = time().$_FILES["payinbill"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	exit();
	
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
			o_id     = '$cust_order', 
			pay_amount  = '$payamount', 
			pay_bill    = '$filename', 
			o_emp_receive    = '$emp',  
			pay_date     = '$paydate', 
			pay_time =  now()";
	
	$result1 = mysql_query($sql);
	
	exit("
		<script>
			alert('บันทึกเงินเข้าเรียบร้อยแล้วจร้า ^^ ');
			window.location='../../finance/inpay.php';
		</script>
	");
	
?>
</body>
</html>     