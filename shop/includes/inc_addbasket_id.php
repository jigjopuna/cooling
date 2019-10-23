<?php
	  /* 
	  
	    1. เช็คก่อนเลยว่ามีตะกร้าหรือยัง ไม่ว่าจะเป็นลูกค้า TYPE ไหน
		
		
	    
	   2. เช็คก่อนว่าลูกค้า Login มาแล้วหรือยัง ถ้าลูกค้า LOGIN เข้ามาแล้วจะมี session 
		ถ้ายังไม่ได้ login ไม่เป็นไร แต่ลูกค้าต้องมีตะกร้า จะมีตะกร้าก็ต่อเมื่อ add สินค้าชิ้นแรก 
		
		
	
		เช็คก่อนว่าเป็นลูกค้า login มาแล้วหรือยัง
		ลูกค่ามี 2 แบบ register checkout กับ guest checkout 
		
		ถ้า Guest Checkout ให้สร้าง ตะกร้าใหม่ และ add ลง inbasket เลย (Basket type = G)
		
		ถ้า Login มาแล้ว ถ้ามี ตะกร้าอยู่แล้วใช้ตะกร้าเดิม  ถ้ายังไม่มีตะกร้าก็ให้ทำเหมือน Guest checkout (Basket type = R)
		
		ถ้าเกิดว่า Guest Checkout อยาก Login ทีหลัง แบบว่าใส่ของในตระกร้าแล้ว ที่นี่ type จะเป็น G ก็คือมี basket id และ inbasket ก็ให้ UPDATE TYPE G เป็น R ถ้า LOGIN  
	
		
	  */
	 
	  $cust_id = $_SESSION['cust_id'];
	  if($_SESSION['session_basket'] != ''){
		    $basidso = $_SESSION['session_basket'];
			$sql_takraroom = "SELECT p.pr_name, p.pr_sell_price, i.bas_qty, i.bas_id 
							  FROM tb_inbasket i JOIN tb_productroom p ON i.bas_prod = p.pr_id  
							  WHERE i.bas_id = '$basidso' AND i.bas_prodtype = 'r'";
			$result_takraroom = mysql_query($sql_takraroom);
			$num_takraroom = mysql_num_rows($result_takraroom);
	  }

	  
	  if($cust_id != ''){
		// login แล้ว

		
	  }else{
		// ยังไมได้ login
		//ก่อนสร้างตะกร้าดูว่ามี session_basket หรือยัง
		//สร้างตะกร้าใหม่
		
		if($_SESSION['session_basket'] == ''){
			//ยังไม่มีตะกร้า
			$intsebas = "INSERT INTO tb_basket SET b_cust = '0', b_type='G', b_status = '0'";
			$reintsebas = mysql_query($intsebas);
			
			if($reintsebas){ 
				$a = mysql_insert_id($conn);
				$_SESSION['session_basket'] = $a;
			}
		}
	
	  }
	 /* echo $_SESSION['session_basket'];
	  echo $_SESSION['cust_id'];*/
?>