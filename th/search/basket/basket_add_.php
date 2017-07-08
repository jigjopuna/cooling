<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    
</head>

<body>
<?php 
	  require_once('../../sys/include/connect.php');
	  
	  $chk_user = '';
	  
	 /*
		หน้านี้จะมาจาก ตอนกดสั่งซื้อที่หน้าสินค้า จะมีอยู่ 2 กรณี
		
		
		basket id จะถูกสร้าง seesion ขึ้นที่หน้า basket_add.php กรณีที่ยังไม่เคยมี basket_id มาก่อน
		เราก็ต้องเช็คว่าลูกค้าเป็น G และ ยังไม่เคยมี basket id นะ จึงจะสร้าง basket ให้ใหม่
		
		และสร้าง basket id ในหน้า basket.php ด้วย
		
		แต่ถ้ามี basket id อยู่ให้ใช้ตระกร้า อันเดิม
		
		ยังไงถ้าลูกค้าผ่านเข้าหน้า basket_add.php ทุกคนต้องมี basket ไม่ว่าจะ login มาหรือไม่ จะต้องมี basket id
		
		==========================================
		|| basket ||  login(u_id) ||
		------------------------------------------
		||   Yes  ||     No       || ไม่สร้างตะกร้า
		||   Yes  ||     Yes      || ไม่สร้างตะกร้า
		||   No   ||     Yes      || ต้องเช็คก่อนว่าลูกค้าคนนี้เคยมีตะกร้าหรือเปล่า ถ้ายังไม่เคยมีก็สร้าง
		||   No   ||     No       || สร้างตะกร้า
		||        ||              ||
		==========================================
		
	 */
	 
	  
	  if(isset($_SESSION['ss_user_id']) && !isset($_SESSION['ss_basket_id'])){ 
		/* 
			login แล้ว และ ไม่มีตะกร้า 
			ต้องเช็คก่อนว่าลูกค้าคนนี้เคยมีตะกร้าหรือเปล่า ถ้ายังไม่เคยมีก็สร้าง
		*/
			 $user_id = $_SESSION['ss_user_id']; 
			 $chk_user = $_SESSION['ss_user_type'];
			 
			 $basket = mysql_fetch_array(mysql_query("SELECT b_id FROM tb_basket WHERE b_id = (SELECT MAX(b_id) FROM tb_basket WHERE u_id = '$user_id')"));				 
			 if($basket['b_id']==''){
				 $chk_user = 'G'; //case 4
			 }else{
				 $basket_id = $basket['b_id']; //case 2
				 $chk_user = 'R';
			 }
			 			
	 }
	 
	 /*
		ถ้าไม่ได้ login และไม่มีตะกร้า ทำยังไง
		ก็ให้สร้างตะกร้าไง ก็ให้ user type = G 
		
		ถ้า user มีตะกร้าล่ะ 
		
		ถ้า user ไม่มีตระกร้า แต่ login 
	 */
	 
	 if(isset($_SESSION['ss_basket_id'])){ 
		 $basket_id = $_SESSION['ss_basket_id'];
		 
	 }else{
		 $basket_id = ''; // ถ้าไม่มีตะกร้า จะให้ตะกร้าเท่ากับ ค่าว่าง
	 }
	 
	 if(!isset($_SESSION['ss_basket_id']) && !isset($_SESSION['ss_basket_id'])){ 
		 $chk_user = 'G';
	 }
		
	 
	 
	/* echo 'user id : '.$user_id.'<br>';
	 echo 'chk_user : '.$chk_user.'<br>'; 
	 echo 'basket_id : '.$basket_id.'<br>'; 
	 
	 
	 exit();*/

	  
	  
	  
	  
	if($chk_user=='G' && $basket_id == ''){ //guest case 4
		//echo 'case 4'; exit();
		$sql = "INSERT INTO tb_basket SET b_type = 'G'";
		$result1 = mysql_query($sql);
		if($result1){ // ตรงนี้ทำเพื่อจะเอาค่า id(PK) ไปเก็บไว้ใน table tb_inbasket ใน column ib_id เพื่อใช้อ้างอิงกับงานหลายสินค้า table tb_basket
			$basket_id = mysql_insert_id($conn);
			 //echo 'basket_id : '.$basket_id.'<br>'; exit();
			$inbasket = "INSERT INTO tb_inbasket SET b_id='$basket_id', p_id='$p_id'";
			$result2 = mysql_query($inbasket);
		}
		$_SESSION['ss_basket_id'] = $basket_id; 
		
		
		
	}else if($chk_user !='G' && $basket_id != ''){ // register | มีตะกร้าอยู่แล้ว ถ้า login เข้ามา  case 2
	    //echo 'case 2'; exit();
	    $inbasket = mysql_query("INSERT INTO tb_inbasket SET p_id = '$p_id', b_id = '$basket_id'");
		
		
		
	}else if($chk_user !='G' && $basket_id != ''){ //case 3
		//echo 'case 3'; exit();
	
	
		
		
	}else{
		//echo 'case 1'; exit();
		$_SESSION['ss_basket_id'] = $basket_id;
	}
	
	 exit("<script>
			window.location='basket.php';
		 </script>");
	
	

/*
กดสั่งซื้อมาแล้วทำไรต่อ
1. เช็ค user type ก่อนว่าเป็นแบบไหน guest หรือ Register, Privilege, Platinum 
 - guest ให้ไปสร้างตะกร้า  ในตาราง tb_basket แล้ว Add สินค้าใน tb_inbasket
 - register ให้เอาตะกร้าเดิมอันล่าสุดมาใช้  เพราะลูกค้า 1 คน สั่งซื้อได้หลายครั้ง ซื้อแต่ละครั้งที่ซื้อใช้ได้ 1 ตะกร้าเท่านั้น และ 1 ตะกร้ามีได้หลายสินค้า
 
กดสั่่งซื้อสินค้าที่ 2 หรือมากกว่า 1 ชิ้น
2. Add สินค้าใน tb_inbasket ด้วย id ตระกร้าเดิมอันล่าสุด ของคนนั้น


ต่อถ้ากดดูใบเสนอราคาละ ทำไงต่อ  5555 มึน
*/

?>



</body>

</html>
