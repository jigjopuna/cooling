<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	</head>
	<body>
		<?php
			$emp = trim($_POST['emp']);
			$car = trim($_POST['car']);
			$j_name = trim($_POST['j_name']);
			
			$kilo1 = trim($_POST['kilo1']);
			$kilo2 = trim($_POST['kilo2']);
			
			$date1 = trim($_POST['date1']);
			$date2 = trim($_POST['date2']);
			
			$today = date("Ymd");
			
			
			echo "emp = ". $emp. "<br>";
			echo "car = ". $car. "<br>";
			echo "j_name = ". $j_name. "<br><br><br>"; 
			
			echo "kilo1 = ". $kilo1. "<br>";
			echo "kilo2 = ". $kilo2. "<br>";
			echo "date1 = ". $date1. "<br>";
			echo "date2 = ". $date2. "<br>";
			//exit();

			$sql = "INSERT INTO tb_journey SET 
					j_name = '$j_name',
					j_car = '$car', 
					j_kilo1 = '$kilo1', 
					j_kilo2 = '$kilo2', 
					j_emp   = '$emp', 
					j_time1 = '$date1', 
					j_time2 = '$date2'";
			
			$result1 = mysql_query($sql);
			
			if($result1) {
				exit("<script>alert('บันทึกข้อมูลเรียบร้อยแล้วจร้า ! ');window.location='../../logistic/logis.php';</script>");
			} else {
				 exit("<script>alert('บันทึกข้อมูลไม่สำเร็จ ติดต่อผู้ดูแลระบบ !'); window.location='../../logistic/logis.php';</script>");
			}
			
			
		?>

	</body>
</html>     