<?php require_once('../include/connect.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	//1. receive data
	$r_width  = trim($_POST['r_width']);
	$r_length  = trim($_POST['r_length']);
	$r_height  = trim($_POST['r_height']);
	$temparature  = $_POST['temparature'];
	$temp_before  = $_POST['temp_before'];
	$qty  = $_POST['qty'];
	
	$area_room = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)))*1.1;
	$cute = $r_width*$r_length*$r_height;
	
	if($temparature==1){
		$pps = 100;
		$var13 = 35;
		$temp_num = 0;
	} else{
		$pps = 200;
		$var13 = 55;
		$temp_num = -20;
	}
	
	$result_cool = ($r_width-($pps/1000)*2)*($r_length-($pps/1000)*2)*($r_height-($pps/1000)*2);
	
	$var11 = (($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)*2);	
	$var12 = 0.033/($pps/1000);
	
	//1. ค่ารวม ภาระที่ผ่านฉนวนห้องเย็น
	$rusult = ($var11*$var12*$var13*24)/(18*1000);

	
	//2.ภาระอากาศจากภายนอก
	 $var21 = 1.29698 * pow($result_cool,0.4491); 
	 $var22 = (0.000001 * pow($temp_num,3)) - (0.00005 * pow($temp_num,2)) - (0.0017 * $temp_num) + 0.091; 
	 $result2 =  ($var21 * $var22 * 2 * 24) / (18*1000);
	 
	 //3.ภาระจากสินค้า
	  
	 $result30 = ($qty * 3.89 * ($temp_before - $temp_num)) / (8*3600);
	 $result31 = ($qty * 0) / (8*3600);
	 $result3 = $result30+$result31;
	 
	 
	 //4.ภาระอื่นๆ 
	 
	 $var41 = ((-0.000000000000002 * pow($temp_num,2)) - (6*$temp_num) + 270)*2;
	 
	 $result4 =  ($var41*8) / (8*3600);
	 
	 $all_result = $rusult + $result2 + $result3 + $result4;
	 $safety = $all_result * 0.2;
	 
	 $total_result = $all_result + $safety;
	 
	
	
	
	
	/*echo $result_cool; echo " ปริมาตรภายในห้องเย็น "; echo "<br>";
	echo "พื่้นที่คำนวนเครื่อง  "; echo $area_matchine; echo " ตารางเมตร "; echo "<br><br>";
	
	echo "1. ภาระที่ผ่านฉนวนห้องเย็น  "; echo $rusult; echo " KW "; echo "<br>";
	echo "2. ภาระอากาศจากภายนอก  "; echo $result2; echo " KW "; echo "<br>";
	echo "3. ภาระจากสินค้า เหนือจุดเยือแข็ง "; echo $result3; echo " KW "; echo "<br>";
	echo "4. ภาระอื่นๆ   "; echo $result4; echo " KW "; echo "<br><br>";
	
	echo "all_result  "; echo $all_result; echo " KW "; echo "<br>";
	echo "safety  "; echo $safety; echo " KW "; echo "<br><br>";*/
	echo "ตารางที่ 1  = "; echo $total_result; echo " KW "; echo "<br><br>";
	

	
    echo "=======================================================================";  echo "<br><br>";
	
	
	

	
	$var_t12 = 0.018/($pps/1000);
	
	//1. ค่ารวม ภาระที่ผ่านฉนวนห้องเย็น
	$rusult_t1 = ($var11*$var_t12*$var13*24)/(18*1000);
	
	//2.ภาระอากาศจากภายนอก
	 $var_t21 = 0.9684 * pow($result_cool,0.4565); 
	 $var_t22 = (0.000006 * pow($temp_num,2)) - (0.0015 * $temp_num) + 0.0922;
	 $resul_t2 =  ($var_t21 * $var_t22 * 2 * 24) / (18*1000);
	
	
	
	//3.ภาระจากสินค้า
	  
	 $result_t30 = ($qty * 3.53 * ($temp_before + 1.7)) / (8*3600);
	 $result_t31 = ($qty * 2.11 * ( -1.7 - $temp_num)) / (8*3600);
	 $result_t32 = ($qty * 239) / (8*3600);
	 $result_t3 = $result_t30 + $result_t31 + $result_t32;
	 
	 $all_result_t = $rusult_t1 + $resul_t2 + $result_t3 + $result4;
	 $safety_t = $all_result_t * 0.2;
	 
	 $total_result_t = $all_result_t + $safety_t;
	 
	 
	 /*echo "all_result_t  "; echo $all_result_t; echo " KW "; echo "<br>";
	 echo "safety_t  "; echo $safety_t; echo " KW "; echo "<br><br>";*/
	 echo "ตารางที่ 2  = "; echo $total_result_t; echo " KW "; echo "<br><br>";
	
	
	
	
	
	
	exit();
	
	
	
	

	/*echo "p_cate = "; echo $p_cate;
	echo "p_name = "; echo $p_name; echo "<br/>";
	echo "p_model = "; echo $p_model; echo "<br/>";*/

	
	//2. insert into database	
	/*$sql = "INSERT INTO tb_product SET  
			p_cate='$p_cate', 
			p_name='$p_name', 
			p_model='$p_model', 
			p_hp='$p_hp', 
			p_kw1='$p_kw1', 
			p_kw2='$p_kw2', 
			p_volt ='$p_volt', 
			p_amp='$p_amp', 
			p_kg='$p_kg', 
			p_cw5='$p_cw5', 
			p_cw20='$p_cw20',   
			p_size='$p_size', 
			p_hz='$p_hz', 
            p_type='$p_type', 			
			p_thin ='$p_thin', 
			p_inlet ='$p_inlet',  
			p_numya ='$p_numya', 
			p_outlet ='$p_outlet', 
			p_price ='$p_price', 
			p_price_sell ='$p_price_sell'";
	$result1 = mysql_query($sql);*/
	exit("
		<script>
			alert('บันทึกข้อมูฃเรียบร้อยจร้า รวยๆ');
			window.location='../data.php';
		</script>
	");
	
?>
</body>
</html>     