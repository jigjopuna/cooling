<?php session_start();
	require_once('../../sys/include/connect.php');
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	
	
	if(isset($_SESSION['ss_basket_id'])){ 
		 $basket_id = $_SESSION['ss_basket_id'];
		 
	 }
	
	/*ต้องเช็คก่อนว่า ณ ปัจจุบัน ลูกค้ามีตะกร้าค้างอยู่หรือเปล่าก่อนที่จะ login ถ้ามีตะกร้าให้ไป update tb_basket ด้วยว่าตะกร้าเป็นของใคร*/
	
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?
	if($username == "" || $password=="") {
		alertphp('บางช่องมีค่าว่าง','https://www.google.co.th');
	}
	
	
	/*echo "user: ".$user. '<br>';
	echo "pass: ".$pass. '<br>';
	echo "numya: ".$numya. '<br>';*/
	
	 $sql = "SELECT u_id, u_user, u_pass, u_type FROM  tb_users";
			  $result = mysql_query($sql);   
			  $num = mysql_num_rows($result); 
			  for($i=1; $i<=$num; $i++) { //start for 
				$row = mysql_fetch_array($result);
					/*if($username == "" || $password=="") {
						mysql_close($conn);
						echo 1;
						exit;
					}*/
					
					if($username == strtolower($row['u_user'])&& $password == $row['u_pass']){
							 $_SESSION['ss_user_id'] = $row['u_id'];  
							 $_SESSION['ss_user_type'] = $row['u_type'];
							 
							 /* ถ้าเลือกสินค้าใส่ตะกร้าก่อน login เราจะยังไม่รู้ว่าตะกร้านี้เป็นของใคร เมื่อเลือกเสร็จแล้วค่อย login  ตอนนี้เราจะรู้แล้วว่าเป็นของใคร โดยการไป update user id ใน tb_basket*/
							 if($basket_id){
								$u_id = $row['u_id'];
								mysql_query("UPDATE tb_basket SET u_id = '$u_id' WHERE b_id = '$basket_id'");
							 }
							 
							 
							 alertphp('ไปหน้า google นะจ๊ะ','../basket/basket.php');
					}
			  }//end for
	
	
?>

</body>
</html>     