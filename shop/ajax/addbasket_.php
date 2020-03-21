<?php session_start(); 
	  require_once('../includes/connect.php');

    $prod_id = $_POST['prod_id']; 
	$prod_type = $_POST['prod_type'];
	$qty = $_POST['qty'];
	$basket_id = $_SESSION['session_basket'];
	
	//เช็คก่อนว่ามีค่าว่างไหม ถ้ามีให้หยุดแค่นี้
	if($prod_id == ''  || $prod_type == ''  || $qty == '' || $basket_id == '') { echo 0; mysql_close($conn); exit();}
	
	/*
	   ก่อนที่จะ Update ตะกร้าต้องเช็คก่อนว่าเคยมีสินค้ารหัสเดียวกันอยู่ในตะกร้าก่อนหน้านี้แล้วหรือไม่ 
	   ถ้ามีอยู่ให้บวกจำนวนสินค้าที่รหัสเดียวกันก่อนแล้ว INSERT แถวใหม่ จากนั้น SET inbas_active ให้เป็น 0 
	*/

	$inbas = "INSERT INTO tb_inbasket SET bas_id = '$basket_id', bas_prod = '$prod_id', bas_qty = '$qty', bas_prodtype = '$prod_type'";		
	$result = mysql_query($inbas);
		
	if($result){
		echo 1;
	}else{
		echo 0;
	}
	
	
	mysql_close($conn);
	
	
?>
	
   
