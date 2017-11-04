<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	
	$po_id = trim($_POST[poid]); 
	$poname = trim($_POST['poname']);
	$poqty  = trim($_POST['poqty']);
	$poprice  = trim($_POST['poprice']);
	
	$poshop = trim($_POST['poshop']);
	$pobuyer  = trim($_POST['pobuyer']);
	$poment  = trim($_POST['poment']);
	
	$podate = trim($_POST['podate']);
	$pocredit = trim($_POST['pocredit']);
	$pocreditcomp = trim($_POST['pocreditcomp']);
	
	$search_custname = trim($_POST['search_custname']);
	$curr_cash = trim($_POST['curr_cash']);
	$today = date("Ymd");
	
	if($pocredit=='on') $po_credit = 1; else $po_credit = 0;	
	
	if($pocreditcomp=='on') $po_creditcomp = 1; else $po_creditcomp = 0;	
	
	
	echo "today = ", $today, "<br>"; 
	
	
	
	echo "po_id = ", $po_id, "<br>";
	echo "poname = ", $poname, "<br>";
	echo "poqty = ", $poqty, "<br>";
	echo "poprice = ", $poprice, "<br>";

	echo "poshop = ", $poshop, "<br>";
	echo "pobuyer = ", $pobuyer, "<br>";
	
	echo "poment = ", $poment, "<br>";
	echo "podate = ", $podate, "<br>";
	echo "po_credit = ", $po_credit, "<br>";
	echo "po_creditcomp = ", $po_creditcomp, "<br>";

	
	
	
	$target_dir = "../../images/bill/";
	$chk_filename = $_FILES["pobill"]["name"];
	$filename = time().$chk_filename;
	$target_file = $target_dir . basename($filename);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
	echo "target_dir = ", $target_dir, "<br>";
	echo "chk_filename = ", $chk_filename, "<br>";
	echo "filename = ", $filename, "<br>";
	echo "target_file = ", $target_file, "<br>";
	echo "imageFileType = ", $imageFileType, "<br>";
	//exit();
	
	/*if(file_exists($_FILES['pobill']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
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
	
	*/
	

	$sql = "UPDATE tb_po SET 
			po_name     = '$poname', 
			po_qty      = '$poqty', 
			po_price    = '$poprice', 
			po_buyer    = '$pobuyer', 
			po_shop     = '$poshop', 
			po_comment  = '$poment',  
			po_date     = '$podate', 
			po_orders   = '$search_custname', 
			po_credit   = '$po_credit', 
			po_credit_complete = '$po_creditcomp' 
			WHERE po_id = '$po_id'
			";
	
	//$sql = "UPDATE tb_po SET po_name ='aaaaa' WHERE po_id = 1";
	$result1 = mysql_query($sql);
	
	
	if($result1) {
		//echo 'Successful inserts: ';
		exit("
			<script>
			alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ');
			window.location='../../finance/outpay.php';
			</script>");
	}else{
		exit("
			<script>
			alert('บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ');
			window.location='../../finance/outpay.php';
			</script>");
	}			

	
	
	
?>
</body>
</html>     