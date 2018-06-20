<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
	
	
	$imgs = trim($_POST['imgattach']);
	$o_id = trim($_POST['o_ids']);
	$today = date("Ymd");
	
	$rowimg = mysql_fetch_array(mysql_query("SELECT o_attach FROM tb_orders WHERE o_id ='$o_id'"));
	$imgname = $rowimg['o_attach'];

	$target_dir = "../../images/orderdetail/";
	$filename = time().$_FILES["imgattach"]["name"];
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	if($imgname!=''){
		$newname = $imgname.':'.time().$_FILES["imgattach"]["name"];
	}else{
		$newname = time().$_FILES["imgattach"]["name"];
	}
    
	echo "o_id = ", $o_id, "<br>";
	echo "target_dir = ", $target_dir, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	//exit();
	
	if(file_exists($_FILES['imgattach']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["imgattach"]["tmp_name"]);
				
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
		if ($_FILES["imgattach"]["size"] > 3000000) { 
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
			if (move_uploaded_file($_FILES["imgattach"]["tmp_name"], $target_file)) {
				//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
				echo "The file ". basename( $_FILES["imgattach"]["name"]). " has been uploaded."; 
			} else {
				echo "Sorry, there was an error uploading your file."; exit();
			}
		}
	}//end check is has file
	//echo "filename = ", $filename, "<br>";
	//exit();
	$sql = "UPDATE tb_orders SET o_attach = '$newname' WHERE o_id='$o_id'"; //SELECT o_attach FROM tb_orders WHERE o_id ='$o_id'
	$result1 = mysql_query($sql);
	

			
		if($result1) {
			exit("<script>alert('บันทึกรูปแล้วจร้า ');window.location='../../order/order.php';</script>");
		} else {
		    exit("<script>alert('บันทึกรูปม่สำเร็จ ติดต่อผู้ดูแลระบบ');window.location='../../order/order.php';</script>");
		}			
				

	
	
	
?>
</body>
</html>     