<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />
	<?php require_once('../sys/include/metatagsys.php');?>
	<title>ใบเสนอราคาห้องเย็น Topcooling</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
	
</head>
<body>
<?php 
   require_once('../include/connect.php');
   require_once('../include/thaibaht.php');

    //1. receive data
	$r_width  = trim($_POST['r_width']);
	$r_width2  = trim($_POST['r_width2']);
	
	$r_length  = trim($_POST['r_length']);
	$r_length2  = trim($_POST['r_length2']);
	
	$r_height  = trim($_POST['r_height']);
	$temparature  = $_POST['temparature'];
	$temp_before  = $_POST['temp_before']; 
	$timeperiod  = $_POST['timeperiod'];
	$qty  = $_POST['qty'];
	$percentprice = 1;
	
	
		$stdardwall = 1.2;
	$aluminium_lenght = 6;
	
	$cost_chakbold = 330;
	$cost_chakl = 410;
	$cost_chakcurve = 390;
	$cost_chakf = 1035;
	$cost_minuimbua = 230;
	
	$cost_printcode = 2150;
	$cost_plastic = 4500;
	$cost_seland = 70;
	$cost_silicon = 88;
	$cost_revet = 407;
	$cost_pressure = 2000;
	
	if($r_length >= $r_length2){
		$max_length = $r_length;
	}else{
		$max_length = $r_length2;
	}
		
	if($r_width >= $r_width2){
		$max_width = $r_width;
	}else{
		$max_width = $r_width2;
	}
			
	echo 'max_width : '. $max_width . '<br>';
	echo 'max_length : '. $max_length . '<br>';
	
	
	if($temparature==1){
		$temps = 25;
	}else if ($temparature==2){
		$temps = 18;
	}else if ($temparature==3){
		$temps = 15;
	}else if ($temparature==4){
		$temps = -5;
	}else if ($temparature==5){
		$temps = -12;
	}else if ($temparature==6){
		$temps = -15;
	}else if ($temparature==7){
		$temps = -25;
	}else if ($temparature==8){
		$temps = -30;
	}else{
		$temps = -40;
	}
	
	
	
	
	$area_room = ((($max_width*$r_height)*2)+ (($max_length*$r_height)*2) + (($max_length*$max_width)))*1.1;
	$cute = $max_width*$max_length*$r_height;
	
	
	if($timeperiod==6){
		$condensingtime = 5;
	}else if ($timeperiod==12){
		$condensingtime = 10;
	}
	else if ($timeperiod==15){
		$condensingtime = 13.5;
	}
	else if ($timeperiod==18){
		$condensingtime = 15;
	}
	else if ($timeperiod==21){
		$condensingtime = 17.5;
	}
	else if ($timeperiod==24){
		$condensingtime = 20;
	}
	
	
	//Temparature 0
	if($temparature <= 4){
		$pps = 100;
		$var13 = 35;
		$temp_num = 0;
	//Temparature -20
	} else{
		$pps = 200;
		$var13 = 55;
		$temp_num = -20;
	}
	//echo "temparature before : ".$temparature. "<br>";
	$result_cool = ($max_width-($pps/1000)*2)*($max_length-($pps/1000)*2)*($r_height-($pps/1000)*2);
	
	$var11 = (($max_width*$r_height)*2)+ (($max_length*$r_height)*2) + (($max_length*$max_width)*2);
	$var_room = ((($max_width*$r_height)*2)+ (($max_length*$r_height)*2) + (($max_length*$max_width)))*1.1;
	$var_florom = $max_length*$max_width*1.1;
	$var12 = 0.033/($pps/1000);
	
	echo "var_room : ".$var_room."<br>";
	echo "var_florom : ".$var_florom."<br><br>";
	
	//1. ค่ารวม ภาระที่ผ่านฉนวนห้องเย็น
	$rusult = ($var11*$var12*$var13*24)/($condensingtime*1000);

	
	//2.ภาระอากาศจากภายนอก
	 $var21 = (pow($result_cool,0.4491))*1.2969; 
	 $var22 = (0.000001 * pow($temp_num,3)) - (0.00005 * pow($temp_num,2)) - (0.0017 * $temp_num) + 0.091; 
	 $result2 =  ($var21 * $var22 * 2 * 24) / $condensingtime;
	 
	 //3.ภาระจากสินค้า
	 $test = $temp_before - $temp_num; 
	 $result30 = ($qty * 3.89 * ($temp_before - $temp_num)) / ($timeperiod*3600); 
	 $result31 = ($qty * 0) / ($timeperiod*3600);  
	 $result3 = $result30+$result31;
	 
	 
	 //4.ภาระอื่นๆ 
	 
	 $var41 = ((-0.000000000000002 * pow($temp_num,2)) - (6*$temp_num) + 270)*2;
	 $result4 =  ($var41*8) / (18*1000);
	 
	 $all_result = $rusult + $result2 + $result3 + $result4;
	 $safety = $all_result*0;
	 
	 $total_result = $all_result + $safety;
	 
	/* echo "all_result = ".$all_result."<br>";
    echo "safety = ".$safety."<br>";		 
	
	
	echo $result_cool; echo " ปริมาตรภายในห้องเย็น "; echo "<br>";
	echo "พื่้นที่คำนวนเครื่อง  "; echo $area_matchine; echo " ตารางเมตร "; echo "<br><br>";
	
	echo "1. ภาระที่ผ่านฉนวนห้องเย็น  "; echo $rusult; echo " KW "; echo "<br>";
	echo "2. ภาระอากาศจากภายนอก  "; echo $result2; echo " KW "; echo "<br>";
	echo "3. ภาระจากสินค้า เหนือจุดเยือแข็ง "; echo $result3; echo " KW "; echo "<br>";
	echo "4. ภาระอื่นๆ   "; echo $result4; echo " KW "; echo "<br><br>";
	
	echo "all_result  "; echo $all_result; echo " KW "; echo "<br>";
	echo "safety  "; echo $safety; echo " KW "; echo "<br><br>";
	echo "ตารางที่ 1  = "; echo $total_result; echo " KW "; echo "<br><br>";
	

	
    echo "=======================================================================";  echo "<br><br>";*/
	
	
	

	
	$var_t12 = 0.018/($pps/1000);
	$var_t13 = $var13;
	
	//1. ค่ารวม ภาระที่ผ่านฉนวนห้องเย็น
	

	$rusult_t1 = ($var11*$var_t12*$var_t13*24)/($condensingtime*1000);
	
	//2.ภาระอากาศจากภายนอก
	
	 $var_t21 = 0.9684 * pow($result_cool,0.4565); 
	 $var_t22 = (0.000006 * pow($temp_num,2)) - (0.0015 * $temp_num) + 0.0922; 
	 $resul_t2 =  ($var_t21 * $var_t22 * 2 * 24) / $condensingtime;
	
	
	
	//3.ภาระจากสินค้า
	  
	 $result_t30 = ($qty * 3.53 * ($temp_before + 1.7)) / ($timeperiod*3600);
	 $result_t31 = ($qty * 2.11 * ( -1.7 - $temp_num)) / ($timeperiod*3600);
	 $result_t32 = ($qty * 239) / ($timeperiod*3600);
	 $result_t3 = $result_t30 + $result_t31 + $result_t32;
	/* 
	 echo 'result_t30 = '; echo $result_t30; echo "<br>";
	 echo 'result_t31 = '; echo $result_t31; echo "<br>";
	 echo 'result_t32 = '; echo $result_t32; echo "<br>";*/
	 
	 $all_result_t = $rusult_t1 + $resul_t2 + $result_t3 + $result4;
	//echo 'no saftry = '; echo $all_result_t; echo "<br>";
	 $safety_t = $all_result_t*0;
	 
	 $total_result_t = $all_result_t + $safety_t;
	 
	 
	 /*echo "all_result_t  "; echo $all_result_t; echo " KW "; echo "<br>";
	 echo "safety_t  "; echo $safety_t; echo " KW "; echo "<br><br>";
	 echo "ตารางที่ 2  = "; echo $total_result_t; echo " KW "; echo "<br><br>";*/
	 
	 
	
	/*echo "1. ภาระที่ผ่านฉนวนห้องเย็น  "; echo $rusult_t1; echo " KW "; echo "<br>";
	echo "2. ภาระอากาศจากภายนอก  "; echo $resul_t2; echo " KW "; echo "<br>";
	echo "3. ภาระจากสินค้า เหนือจุดเยือแข็ง "; echo $result_t3; echo " KW "; echo "<br>";
	echo "4. ภาระอื่นๆ   "; echo $result4; echo " KW "; echo "<br><br>";*/
	
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	
	$thatdate = $date."/".$nMonth."/".$year;
	
	
	
	
	
	
	
	
    //query select product
	  //temp 0 
	if($temp_num==0){
		$chkMaxKw = "SELECT p.p_id, p.p_cw5 as MAXKW FROM tb_product p WHERE p.p_cw5 = (SELECT MAX(p_cw5) FROM tb_product WHERE p_cate=1)";
		$result_chkMaxKw = mysql_query($chkMaxKw);	
				
	}else{ //temp -20
		$chkMaxKw = "SELECT p.p_id, p.p_cw20 as MAXKW FROM tb_product p WHERE p.p_cw20 = (SELECT MAX(p_cw20) FROM tb_product WHERE p_cate=1)";
		$result_chkMaxKw = mysql_query($chkMaxKw);
		
	}//end select 0 or -20
	
	    $row_chkMaxKw = mysql_fetch_array($result_chkMaxKw);
		$get_chkMaxKw = $row_chkMaxKw['MAXKW'];
		$get_MaxKw_id = $row_chkMaxKw['p_id'];

		/*echo "get_chkMaxKwfromCWConedensing = ".$get_chkMaxKw."<br>";
		echo "ค่าที่คำนวณได้ = ".$total_result_t."<br>";*/
		
		
		if($total_result_t > $get_chkMaxKw){ //compare condensing max  
			$getsed = $total_result_t % $get_chkMaxKw;
			/*echo "เศษที่ได้ = ",$getsed."<br>";
			echo "หารกัน = ",$total_result_t / $get_chkMaxKw."<br>";
			echo "ลบกัน = ",$total_result_t - $get_chkMaxKw."<br>";*/
			if($getsed==0){
				$condensingmaxqty = ceil($total_result_t / $get_chkMaxKw);
				//echo "<br>"."condensingmaxqty = ".$condensingmaxqty."<br>";
				$lastvalue = $get_MaxKw_id;
			}else{
				//หาค่า cw5 หรือ cw20 ที่มีค่ามากที่สุด 10 อันดับแรก เพื่อเลือก condensing ที่เหมาะสมที่สุด
				if($temp_num==0){
					$sql = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE  p.p_cate = 1 ORDER BY p.p_cw5 DESC Limit 0,10";
				}else{
					$sql = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE  p.p_cate = 1 ORDER BY p.p_cw20 DESC Limit 0,10";
				}
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);
				
				//หาจำนวนของ condensing ว่าเราจะใช้ทั้งหมดกี่ตัว โดยแต่ละตัวต้องมีค่า cw เท่าๆ กัน หรือใกล้เคียงกัน
				$first = number_format($total_result_t / $get_chkMaxKw, 2, '.', ''); 
				$condensingmaxqty = ceil($first);
				list($fdec, $fsed) = explode('.',$first);
				//echo "<br>"."condensingmaxqty = ".$condensingmaxqty."<br>";
				//ลูปเพื่อหาว่า ค่าไหนเหมาะสมที่สุด
				for($i=1; $i<=$num; $i++){
					$row = mysql_fetch_array($result);
					/*echo "<br>"."cw5 = ".$row['p_cw5']."<br>";
					echo "<br>"."fdec = ".$fdec."<br>";*/
					
					
					//แบ่งค่าออกมา ห้ามเกินตัวนั้น เช่น 150/40  = 3.75  ตัวแรกห้ามเกิน 3 หลังจุดหาให้เข้าใกล้ 9 มากที่สุดจะดี
					if($temp_num==0){
						$sub = number_format($total_result_t / $row['p_cw5'], 2, '.', '');
					}else{
						$sub = number_format($total_result_t / $row['p_cw20'], 2, '.', '');
					}
					list($dec, $sed) = explode('.',$sub);
					
					
					if($dec == $fdec){
						$goodvalue[$i] = $row['p_id']."<br>";
						//echo $row['p_id'];
						//print_r(array_values($goodvalue));
					}else{
						break;
					}
						
				}//end for 
				//print_r(array_values($goodvalue));
				$lastvalue = end($goodvalue);
                //echo "condensing_id = ".$lastvalue;			
							
				//$sub = number_format($total_result_t / $get_chkMaxKw, 2, '.', '');
				list($dec, $sed) = explode('.',$sub);			
				/*echo "<br>"."total_result_t = ".$total_result_t."<br>";
				echo "<br>"."get_chkMaxKw = ".$get_chkMaxKw."<br>";
				echo "<br>"."getsed = ".$getsed."<br>";
				echo "<br>"."sub = ".$sub."<br>";
				echo "<br>"."dec = ".$dec."<br>";
				echo "<br>"."sed = ".$sed."<br>";*/
			} //end getsed
			$sql_condensing = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_id='$lastvalue'";		
		}else{ 
			if($temparature <= 4){
				//echo "no more cw5";
				$sql_condensing = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_cw5 > '$total_result_t' AND p.p_cate = 1 ORDER BY p.p_cw5 Limit 0,1";		
			}else{
				//echo "no more cw20";
				$sql_condensing = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_cw20 > '$total_result_t' AND p.p_cate = 1 ORDER BY p.p_cw20 Limit 0,1";				
			}
			$condensingmaxqty = 1;
		}//end compare condensing max

	$result_condensing = mysql_query($sql_condensing);
	$row_condensing = mysql_fetch_array($result_condensing);
	
	
	
	//echo 'condensingmaxqty = '. $condensingmaxqty.'<br>';
	//echo $row['p_id'];echo "<br>"; echo $row['p_name'] ;echo "<br>"; echo $row['p_model'] ;

    // Cooler 
	    //echo "<br><br>"."Cooler=================================================="."<br><br>";
	   // temp 0 
	   if($temp_num==0){
			$chkMaxKwcw = "SELECT MAX(p_cw5) as MAXKWCW FROM tb_product WHERE p_cate=2";
			$result_chkMaxKwcw = mysql_query($chkMaxKwcw);
			
			//อ้างอิงค่าจาก condensing เพื่อเลือกค่า คอยล์เย็นหรือ cooler
			$getfromcondensing = $row_condensing['p_cw5'];
			//echo "<br>"."coolercw05", '<br>';		
				
		}else{ //temp -20
			$chkMaxKwcw = "SELECT MAX(p_cw20) as MAXKWCW FROM tb_product WHERE p_cate=2";
			$result_chkMaxKwcw = mysql_query($chkMaxKwcw);
			
			//อ้างอิงค่าจาก condensing เพื่อเลือกค่า คอยล์เย็นหรือ cooler
			$getfromcondensing = $row_condensing['p_cw20'];
			//echo "<br>","coolercw20", '<br>';
			
		}//end select 0 or -20
		
		//exit();
	
	    $row_chkMaxKwcw = mysql_fetch_array($result_chkMaxKwcw);
		$get_chkMaxKwcw = $row_chkMaxKwcw['MAXKWCW'];
		
		/*echo 'max cw from database = ', $get_chkMaxKwcw, '<br>';
		echo "getfromcondensing = ".$getfromcondensing."<br>";
		echo $getfromcondensing - $get_chkMaxKwcw, '<br>';*/
		if($getfromcondensing > $get_chkMaxKwcw ){ //compare cooler max 
		    //echo "คอนเด็นซิงมากกว่าจริงๆ นะ", '<br>';
			$getsedcw = $getfromcondensing % $get_chkMaxKwcw;
			 //echo "เศษเท่าไรจ๊ะ ", $getsedcw, '<br>';
			if(($getsedcw==0) && ($getfromcondensing-$get_chkMaxKwcw)>1){
				//echo "หารลงตัว",'<br>';
				$coolermaxqty = $getfromcondensing / $get_chkMaxKwcw;
				//echo "<br>"."coolermaxqty = ".$coolermaxqty."<br>";
			}else{
				//echo "หารไม่ลงตัว ต้องมากว่า 1 ตัว";
				//หาค่า cw5 หรือ cw20 ที่มีค่ามากที่สุด 10 อันดับแรก เพื่อเลือก cooler ที่เหมาะสมที่สุด
				if($temp_num==0){
					$sqlcw = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE  p.p_cate = 2 ORDER BY p.p_cw5 DESC Limit 0,10";
				}else{
					$sqlcw = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE  p.p_cate = 2 ORDER BY p.p_cw20 DESC Limit 0,10";
				}
				$resultcw = mysql_query($sqlcw);
				$numcw = mysql_num_rows($resultcw);
				
				//หาจำนวนของ condensing ว่าเราจะใช้ทั้งหมดกี่ตัว โดยแต่ละตัวต้องมีค่า cw เท่าๆ กัน หรือใกล้เคียงกัน
				$firstcw = number_format($getfromcondensing / $get_chkMaxKwcw, 2, '.', ''); 
				$coolermaxqty = ceil($firstcw);
				list($fdeccw, $fsedcw) = explode('.',$firstcw);
				//echo "<br>"."coolermaxqty = ".$coolermaxqty."<br>";
				//ลูปเพื่อหาว่า ค่าไหนเหมาะสมที่สุด
				for($i=1; $i<=$numcw; $i++){
					$rowcw = mysql_fetch_array($resultcw);
					/*echo "<br>"."cw5 = ".$rowcw['p_cw5']."<br>";
					echo "<br>"."fdeccw = ".$fdeccw."<br>";*/
					
					
					//แบ่งค่าออกมา ห้ามเกินตัวนั้น เช่น 150/40  = 3.75  ตัวแรกห้ามเกิน 3 หลังจุดหาให้เข้าใกล้ 9 มากที่สุดจะดี
					if($temp_num==0){
						$subcw = number_format($getfromcondensing / $rowcw['p_cw5'], 2, '.', '');
					}else{
						$subcw = number_format($getfromcondensing / $rowcw['p_cw20'], 2, '.', '');
					}
					list($deccw, $sedcw) = explode('.',$subcw);
					
					
					if($deccw == $fdeccw){
						$goodvaluecw[$i] = $rowcw['p_id'];
						//echo $rowcw['p_id'];
						//print_r(array_values($goodvaluecw));
					}else{
						break;
					}
						
				}//end for 
				//print_r(array_values($goodvalue));
				$lastvaluecw = end($goodvaluecw);
                //echo "cooler_id = ".$lastvaluecw;	
			} //end getsedcw
			$sql_cooler = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_id = '$lastvaluecw'";		
			$qtycooler = $condensingmaxqty*2; 
		}else{ 
		    //echo "<br>"."no more"."<br>";
			if($temparature <= 4){
				 /*echo "cw5","<br>"; 
				 echo "เลือก 0.2 ช่วง 0 องศา","<br>"; */
				 //เลือกค่า kw ที่ต่ำกว่าได้ ยอมรับค่าที่ต่ำกว่าได้ไม่เกิน 0.2 และ kw สูงกว่าเท่าไรก็ได้ แต่ต้องได้ราคาที่ถูกที่สุด
				$sql_cooler = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_cw5 > ('$total_result_t'/$condensingmaxqty)-0.2 AND p.p_cate = 2 ORDER BY p.p_price_sell ASC Limit 0,1";
			}else{			
				/* echo "cw20","<br>";
				 echo "เลือก 0.2 ช่วง -20 องศา","<br>"; */
				 $sql_cooler = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_cw20 > ('$total_result_t'/$condensingmaxqty)-0.2 AND p.p_cate = 2 ORDER BY p.p_price_sell ASC Limit 0,1";				
			}
			$qtycooler = $condensingmaxqty;
		}//end compare cooler max
		
		/*echo "<br>"." condensingmaxqty = ".$condensingmaxqty;
		echo "<br>"." qtycooler = ".$qtycooler;*/
		
		$result_cooler = mysql_query($sql_cooler);
		//$num_cooler = mysql_num_rows($result_cooler);
		$row_cooler = mysql_fetch_array($result_cooler);
		
		//echo "count : ",$num_cooler, '<br>';
		
		
		

	
	//Tube 
    $sql_tube1 = "SELECT * 
			   FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate
		       WHERE p.p_size LIKE '$row_condensing[p_kw1]' AND p.p_cate = 5";
			  
	$sql_tube2 = "SELECT * 
			   FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate
		       WHERE p.p_size LIKE '$row_condensing[p_kw2]' AND p.p_cate = 5";
	
	$result_tube1 = mysql_query($sql_tube1);
	$row_tube1 = mysql_fetch_array($result_tube1);
	
	
	$result_tube2 = mysql_query($sql_tube2);
	$row_tube2 = mysql_fetch_array($result_tube2);
	
	
	
	// Expand
	  //echo "<br><br>"."expand=================================================="."<br>";
	  //หาค่าสูงสุดของ expantion vavle ก่อน
		$sql_maxtemp = "SELECT MAX(p_temp) AS MAXTEMP FROM tb_product WHERE p_cate = 4";
		$result_maxtemp = mysql_query($sql_maxtemp);
		$row_maxtemp = mysql_fetch_array($result_maxtemp);
		
		$get_maxtemp = $row_maxtemp[MAXTEMP];
		//echo "get_maxtemp = ".$get_maxtemp."<br>";
		
		if($temparature <= 4){
			$getfromcooler = $row_cooler['p_cw5'];	
		}else{
			$getfromcooler = $row_cooler['p_cw20'];	
		}
		
	   //เช็คก่อนนว่าค่า p_temp ของมากว่า kw ที่คำนวณมาหรือไม่   
	   //echo "<br>".$getfromcooler." > ".$get_maxtemp."<br>"; 
	   if($getfromcooler  > $get_maxtemp){// compare max temp
	        //echo "ค่าที่คำนวณได้มากกว่า แสดงว่าต้องมี expand หลายตัว"."<br>"; 
			//คิวรี่ขึ้นมา 10 แถวเพื่อหาค่าที่เหมาะสมที่สุด
			$sqlexp = " SELECT * 
					FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate
					WHERE  p.p_cate = 4
					ORDER BY p.p_temp DESC Limit 0,10";
			$resultsqlexp = mysql_query($sqlexp);
			$numsqlexp = mysql_num_rows($resultsqlexp);
		  
			//หาจำนวนของ expantion ว่าเราจะใช้ทั้งหมดกี่ตัว โดยแต่ละตัวต้องมีค่า temp เท่าๆ กัน หรือใกล้เคียงกัน
			$firstexp = number_format($getfromcooler / $get_maxtemp, 2, '.', ''); 
			list($fdecexp, $fsedexp) = explode('.',$firstexp);
			$expandmaxqty = ceil($firstexp);
			
			//echo "<br>"."Expand = ".$expandmaxqty."<br>"; 
			
			
			//ลูปเพื่อหาว่า ค่าไหนเหมาะสมที่สุด
			for($i=1; $i<=$numsqlexp; $i++){
				$rowexp = mysql_fetch_array($resultsqlexp);
				/*echo "<br>"."p_temp = ".$rowexp['p_temp']."<br>";
				echo "<br>"."fdecexp = ".$fdecexp."<br>";*/
												
				//แบ่งค่าออกมา ห้ามเกินตัวนั้น เช่น 150/40  = 3.75  ตัวแรกห้ามเกิน 3 หลังจุดหาให้เข้าใกล้ 9 มากที่สุดจะดี
				$subexp = number_format($getfromcooler / $rowexp['p_temp'], 2, '.', '');
				list($decexp, $sedexp) = explode('.',$subexp);
											
				if($decexp == $fdecexp){
					$goodvalueexp[$i] = $rowexp['p_id'];
					/*echo $rowexp['p_id'];
					print_r(array_values($goodvalueexp));*/
				}else{
					break;
				}							
			}//end for
			$expand_id = end($goodvalueexp);
			//echo "<br>"."expand_id = ".$expand_id."<br>";
		    $sql_expand = "SELECT * FROM tb_product p JOIN tb_category c ON p.p_cate = c.cat_id  WHERE p_cate = 4 AND p_id = '$expand_id'";  
	   }else{
		   //หาค่ามากกว่า 1 แถว
		  // echo "ค่าที่คำนวณได้น้อยกว่า แสดงว่าต้องมี expand แถวเดียว"."<br>"; 
		   $sql_expand = 
				"SELECT * 
		        FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
		        WHERE p.p_temp > '$getfromcooler' AND p.p_cate = 4 
				ORDER BY p.p_temp Limit 0,1";
			$expandmaxqty = $qtycooler;
			//echo "<br>".$expandmaxqty."<br>";
 
	   }// end if compare max temp
	  
	  $result_expand = mysql_query($sql_expand);
	  $row_expand = mysql_fetch_array($result_expand);
	   
	   
	   
	// Numya
	if($temparature <= 4){
		$sql_numya = 
				"SELECT * 
		        FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
		        WHERE p.p_model LIKE 'R22' AND p.p_cate = 7";
		
	}else{
		$sql_numya = 
				"SELECT * 
		        FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
		        WHERE p.p_model LIKE 'R404a' AND p.p_cate = 7";
		
	}
				
	$result_numya = mysql_query($sql_numya);
	$row_numya = mysql_fetch_array($result_numya);
	
	
	//Digital Control
	$sql_dc = "SELECT * 
	           FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
			   WHERE p.p_hp > '$row_condensing[p_hp]' AND p.p_cate = 3 
			   ORDER BY p.p_hp ASC Limit 0,1 ";
   
	$result_dc = mysql_query($sql_dc);
	$row_dc = mysql_fetch_array($result_dc);
	
	
	
	//Insulation 
	
	$sql_ins = "SELECT * 
	           FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
			   WHERE p.p_size LIKE '$row_condensing[p_kw2]' AND p.p_cate = 6 
			   ORDER BY p.p_size Limit 0,1 ";
   
	$result_ins = mysql_query($sql_ins);
	$row_ins = mysql_fetch_array($result_ins);
	
	//Pipe curve 
	$sql_curve1 = "SELECT * 
	           FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
			   WHERE p.p_size LIKE '$row_condensing[p_kw2]' AND p.p_cate = 11 
			   ORDER BY p.p_size Limit 0,1 ";
   
	$result_curve1 = mysql_query($sql_curve1);
	$row_curve1 = mysql_fetch_array($result_curve1);
	
	$sql_curve2 = "SELECT * 
	           FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
			   WHERE p.p_size LIKE '$row_condensing[p_kw1]' AND p.p_cate = 11 
			   ORDER BY p.p_size Limit 0,1 ";
   
	$result_curve2 = mysql_query($sql_curve2);
	$row_curve2 = mysql_fetch_array($result_curve2);
	
	
	$sql_curve3 = "SELECT * 
	           FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate 
			   WHERE p.p_size LIKE '$row_condensing[p_kw2]' AND p.p_cate = 12 
			   ORDER BY p.p_size Limit 0,1 ";
   
	$result_curve3 = mysql_query($sql_curve3);
	$row_curve3 = mysql_fetch_array($result_curve3);
	
	
	$numyaQty = ceil($row_condensing['p_hp']*0.1);
	/*echo "hp = ".$row[p_hp]."<br>";
	echo "ท่อกลับ =". $row_tube1[p_size]. "<br>";
	echo "p_kw1 = ".$row[p_kw1]."<br>";
	echo "p_kw2 = ".$row[p_kw2]."<br>";
	echo "น้ำยา = "; echo $numyaQty."<br>";*/
	
	//cable
   if($row_condensing['p_hp']>=21){
	    $cable = 28000;
   }else if($row_condensing['p_hp']>12){
		$cable = 20000;
   }elseif($row_condensing['p_hp']>=1){
		$cable = 15000;
   }
	
	
	
	$tatal_price =  ($row_condensing['p_price_sell']*$percentprice*$condensingmaxqty) + 
					($row_cooler['p_price_sell']*$percentprice*$qtycooler) +
					($row_dc['p_price_sell']*$percentprice*$condensingmaxqty) + 
					($row_expand['p_price_sell']*$percentprice*$expandmaxqty) + 
					($row_tube2['p_price_sell']*$percentprice*2*$qtycooler) +
					($row_tube1['p_price_sell']*$percentprice*2*$qtycooler) +
					($row_curve1['p_price_sell']*$percentprice*5*$condensingmaxqty) +
					($row_curve2['p_price_sell']*$percentprice*5*$condensingmaxqty) + 
					($row_curve3['p_price_sell']*$percentprice*$qtycooler) +
					($row_ins['p_price_sell']*$percentprice*$qtycooler*2*3) + 
					($row_numya['p_price_sell']*$percentprice*$numyaQty*$condensingmaxqty) + 
					$cable*$percentprice*$condensingmaxqty
										;
	
	//current electric calculate
	   //1. compressor 
	         
			 $cur1 = $row_condensing['p_kw'];

			 $curunit = 4;
			 $totalcur = $cur1*$curunit*30*$condensingmaxqty*1.2*$timeperiod;
			 
			 /*echo "<br>", "cur1: " , $cur1 , "<br>";
			 echo "<br>", "timeperiod: " ,$timeperiod , "<br>";
			 echo "<br>", "totalcur1: " ,$totalcur1 , "<br>";*/

?>
<?php require_once('../include/googletag.php');?>


<script>

	$(document).ready(function(){
		$("#corp_addr_ini").clone().appendTo(".cover_header");
		$('#findcost').click(function(){
			 $('#form1').attr('action', 'cost.php');
			 $('#form1').submit();
		});
		
		$("#search_custname").autocomplete({
				source: "../ajax/search_cust.php",
				minLength: 1
		});
		
	});
	

</script>

<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">

            <div id="corp_addr_ini">
				<?php require_once('../include/tcl_addr.php'); ?>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php //require_once('../include/custaddress.php'); ?>
					<span>ค้นหาลูกค้า : <input type="text" name="search_custname" id="search_custname"></span> <br>
					<span><a href="../sys/customer/cust_add.php" target="_blank">เพิ่มชื่อลูกค้า</a> </span><br>
					<span><a href="../sys/customer/customer.php" target="_blank">ดูข้อมูลลูกค้า</a> </span><br>
					
					
					<!--<span>ค้นหาจากเบอร์โทร :  <input type="text" name="search_custphone" id="search_custphone">	</span><br>-->
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Matchine</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ เครื่อง</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP <?php echo $temps?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1. <input name="m1" class="pdesc" type="text" value="<?php echo $row_condensing['cat_name']." "; if($row_condensing['cat_id']==1){  echo $row_condensing['p_name'];  } echo $row_condensing['p_model']." ";  echo $row_condensing['p_hp']."HP "; echo $row_condensing['p_volt']."V";?>"></td>
						<td colspan="2" class="l" align="center"><input name="m1q" class="punit" type="text" value="<?php echo $condensingmaxqty; ?>"></td>
						<td class="l" align="right"><input name="m1p" class="punit" type="text" value="<?php echo number_format($row_condensing['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_condensing['p_price_sell']*$percentprice*$condensingmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>2. <input name="m2" class="pdesc" type="text" value="<?php echo $row_cooler['cat_name']." "; echo $row_cooler['p_name']; echo $row_cooler['p_model']." "; echo $row_cooler['p_volt']."V ".$row_cooler['p_amp']."A" ;?>"></td>
						<td colspan="2" class="l" align="center"><input name="m2q" class="punit" type="text" value="<?php echo $qtycooler; ?>"></td>
						<td class="l" align="right"><input name="m2p" class="punit" type="text" value="<?php echo number_format($row_cooler['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_cooler['p_price_sell']*$percentprice*$qtycooler, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>3. <input name="m3" class="pdesc" type="text" value="<?php echo $row_dc['cat_name']." "; echo $row_dc['p_name'];   echo $row_dc['p_model'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="m3q" class="punit" type="text" value="<?php echo $condensingmaxqty; ?>"></td>
						<td class="l" align="right"><input name="m3p" class="punit" type="text" value="<?php echo number_format($row_dc['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_dc['p_price_sell']*$percentprice*$condensingmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr>
						<td>4. <input name="m4" class="pdesc" type="text" value="<?php echo $row_expand['cat_name']." "; echo $row_expand['p_name'];  echo $row_expand['p_model'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="m4q" class="punit" type="text" value="<?php echo $expandmaxqty; ?>"></td>
						<td class="l" align="right"><input name="m4p" class="punit" type="text" value="<?php echo number_format($row_expand['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_expand['p_price_sell']*$percentprice*$expandmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					
					
					<tr>
						<td>5. <input name="m5" class="pdesc" type="text" value="<?php echo $row_tube2['cat_name']."ทางกลับ"; echo " Type ".$row_tube2['p_type']." Size "; echo $row_tube2['p_size'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="m5q" class="punit" type="text" value="<?php echo $qtycooler*2; ?>"></td>
						<td class="l" align="right"><input name="m5p" class="punit" type="text" value="<?php echo number_format($row_tube2['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_tube2['p_price_sell']*$percentprice*2*$qtycooler, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>6. <input name="m6" class="pdesc" type="text" value="<?php echo $row_tube1['cat_name']."ทางส่ง"; echo " Type ".$row_tube1['p_type']." Size "; echo $row_tube1['p_size'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="m6q" class="punit" type="text" value="<?php echo $qtycooler*2; ?>"></td>
						<td class="l" align="right"><input name="m6p" class="punit" type="text" value="<?php echo number_format($row_tube1['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_tube1['p_price_sell']*$percentprice*2*$qtycooler, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>7. <input name="m7" class="pdesc" type="text" value="<?php echo $row_curve1['cat_name']." Size ".$row_curve1['p_size']; ?>"></td>
						<td colspan="2" class="l" align="center"><input name="m7q" class="punit" type="text" value="<?php echo $condensingmaxqty*5;?>"></td>
						<td class="l" align="right"><input name="m7p" class="punit" type="text" value="<?php echo number_format($row_curve1['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_curve1['p_price_sell']*$percentprice*5*$condensingmaxqty, 2, '.', ','); ?></td>
						
					</tr>
					
					<tr>
						<td>8. <input name="m8" class="pdesc" type="text" value="<?php echo $row_curve2['cat_name']." Size ".$row_curve2['p_size']; ?>"></td>
						<td colspan="2" class="l" align="center"><input name="m8q" class="punit" type="text" value="<?php echo $condensingmaxqty*5;?>"></td>
						<td class="l" align="right"><input name="m8p" class="punit" type="text" value="<?php echo number_format($row_curve2['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format(($row_curve2['p_price_sell']*$percentprice*5*$condensingmaxqty), 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>9. <input name="m9" class="pdesc" type="text" value="<?php echo $row_curve3['cat_name']." Size ".$row_curve3['p_size']; ?>"></td>
						<td colspan="2" class="l" align="center"><input name="m9q" class="punit" type="text" value="<?php echo $qtycooler?>"></td>
						<td class="l" align="right"><input name="m9p" class="punit" type="text" value="<?php echo number_format($row_curve3['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_curve3['p_price_sell']*$percentprice*$qtycooler, 2, '.', ','); ?></td>
						
					</tr>
					
					<tr>
						<td>10. <input name="m10" class="pdesc" type="text" value="<?php echo $row_ins['cat_name']." "; echo $row_ins['p_name']; echo " Size ";  echo $row_ins['p_size'].'"'. "  หนา ".$row_ins['p_thin'] ;?>"></td>
						<td colspan="2" class="l" align="center"><input name="m10q" class="punit" type="text" value="<?php echo $qtycooler*2*3;?>"></td>
						<td class="l" align="right"><input name="m10p" class="punit" type="text" value="<?php echo number_format($row_ins['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_ins['p_price_sell']*$percentprice*$qtycooler*2*3, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>11. <input name="m11" class="pdesc" type="text" value="<?php echo $row_numya['cat_name']." "; echo $row_numya['p_name'];   echo $row_numya['p_model'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="m11q" class="punit" type="text" value="<?php echo $condensingmaxqty*$numyaQty; ?>"></td>
						<td class="l" align="right"><input name="m11p" class="punit" type="text" value="<?php echo number_format($row_numya['p_price_sell']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_numya['p_price_sell']*$percentprice*$numyaQty*$condensingmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>12. <input name="m12" class="pdesc" type="text" value="<?php echo "สายไฟและท่อเดินสายไฟ"?>"></td>
						<td colspan="2" class="l" align="center"><input name="m12q" class="punit" type="text" value="<?php echo $condensingmaxqty; ?>"></td>
						<td class="l" align="right"><input name="m12p" class="punit" type="text" value="<?php echo number_format($cable*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($cable*$percentprice*$condensingmaxqty, 2, '.', ','); ?></td>
						
					</tr>
					
					<tr>
						<td>13. <input name="m13" class="pdesc" type="text" value="ค่าแรงและค่าติดตั้งเครื่อง"></td>
						<td colspan="2" class="l" align="center"><input name="labormachineunit" style="width:45px;" class="punit" type="text" value="1"> ชุด</td>
						<td class="l" align="right"><input name="labormachinepirce" class="punit" type="text" value="0"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>14.  <input name="m14" class="pdesc" type="text" value="ค่าขนส่งเครื่อง"></td>
						<td colspan="2" class="l" align="center"><input name="shipmachineunit" style="width:40px;" class="punit" type="text" value="1"> เที่ยว</td>
						<td class="l" align="right"><input name="shipmachineprice" class="punit" type="text" value="0"></td>
						<td class="l" align="right"></td>
					</tr>

					
					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($tatal_price, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format($tatal_price*0.07, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($tatal_price+($tatal_price*0.07)); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format($tatal_price+($tatal_price*0.07), 2, '.', ','); ?></td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
					<br>
				</div>
				
				
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				<span><strong><u>เงื่อนไขการคำนวณ</u> </strong></span><br>
				<span>ระยะเวลาลดอุณหภูมิสินค้า :  <?php echo $timeperiod?> ชั่วโมง</span><br>
				<span>อุณหภูมิสินค้าก่อนเข้าห้อง : <?php echo $temp_before?> องศาเซลเซียส</span><br>
				<span>ปริมาณสินค้า : <?php echo number_format($qty, 2, '.', ',') ?> กิโลกรัม</span><br> <br> 
				<span><strong><u>ค่าไฟเฉลี่อต่อเดือน :</u> </strong><?php echo number_format($totalcur, 2, '.', ','), " บาท   ", " (อัตราค่าไฟปกติ ไม่ใช่ TOU)"; ?> </span><br> 
				
				<input type="hidden" name="timeperiod" value="<?php echo $timeperiod;?>">
				<input type="hidden" name="temp_before" value="<?php echo $temp_before;?>">
				<input type="hidden" name="qty" value="<?php echo $qty;?>">
				<input type="hidden" name="totalcur" value="<?php echo $totalcur;?>">
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
			<!--	<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>-->
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
		
		
		
		
		
		
		
		
		<?
		
		    $row_inch = mysql_fetch_array(mysql_query("SELECT pr_size, pr_sell_price FROM tb_productroom WHERE pr_cate = 1 AND pr_temp = '$temps'"));	
			$isoprice = $row_inch['pr_sell_price'];

			echo 'isoprice : '. $isoprice . '<br>';
			
			if($r_length >= $r_length2){
				$max_length = $r_length;
			}else{
				$max_length = $r_length2;
			}
			
			//ISOWALL
			$isoside = ceil((($r_length+$r_width) + ($r_length2+$r_width2))/1.2);
			$isosidecost = $r_height*1.2*$isoside*$isoprice;
			$isosidearea = 1.2*$r_height*$isoside;
			
			
			
			$isoceil = ceil($max_length/1.2);
			$isoceilcost = $max_width*1.2*$isoceil*$isoprice;
			$isoceilarea = 1.2*$max_width*$isoceil;
			
			$cuteiso = ($r_height*1.2*$isoside)+($max_length*1.2*$isoceil);
			
			echo 'isoside : '. $isoside . '<br>';
			echo 'isosidecost : '. $isosidecost . '<br>';
			echo 'isosidearea : '. $isosidearea . '<br>';
			echo 'cuteiso : '. $cuteiso . '<br><br>';
			
			echo 'isoceil : '. $isoceil . '<br>';
			echo 'isoceilarea : '. $isoceilarea . '<br>';
			echo 'isoceilcost : '. $isoceilcost . '<br><br>';
			
			//Fome Floor
			$inchs = $row_inch['pr_size'];
			$inch2 = $inchs/2;
			if($inch2 < 2 ){ //ถ้าคำนวนโฟมได้น้อยกว่า 2 นิ้ว ให้ใช้ 2 นิ้ว
				$inch2 = 2;
			}
			$fqty = $max_width*$max_length*2;
			$qtypaper = ceil($fqty/3.66);
			

			
			
			$row_flr_cost = mysql_fetch_array(mysql_query("SELECT * FROM tb_productroom WHERE pr_cate = 2 AND pr_size = '$inch2'"));
			$flr_cost = $row_flr_cost['pr_sell_price'];
			
			$flr_area = $qtypaper*3.6;
			$fome_flr_cost = $flr_area*$flr_cost;
			
			echo 'inch2 : '. $inch2 . '<br>';
			echo 'fqty : '. $fqty . '<br>';
			echo 'qtypaper : '. $qtypaper . '<br>';
			echo 'flr_area : '. $flr_area . '<br>';
			echo 'flr_cost : '. $flr_cost . '<br>';
			echo 'fome_flr_cost : '. $fome_flr_cost . '<br><br>';
			
			
			

			$chakbold = ceil(($r_height*4)/6);    
			$chaklthing = ceil((($r_width+$r_width2) + ($r_length+$r_length2))/6);
			$chak2in = $chakbold + $chaklthing;
			$chakf = ceil((($r_width+$r_width2)+($r_length+$r_length2))/6);
			$miniumbau = ceil(((($r_width+$r_width2)+($r_length+$r_length2))/6)*2);
			$all_menium = $chakbold + $chaklthing + $chak2in + $chakf + $miniumbau;
			
			$price_chkbold = $chakbold*$cost_chakbold;
			$price_chkl = $chaklthing*$cost_chakl;
			$price_chkcurve = $cost_chakcurve*$chak2in;
			$price_chkf = $chakf*$cost_chakf;
			$price_bua = $miniumbau*$cost_minuimbua;
			$all_price_chak =  $price_chkbold + $price_chkl + $price_chkcurve + $price_chkf + $price_bua;
					

			
			$printcode = ceil((($r_width*$r_length) + ($r_width2*$r_length2))/36);
			$plasticflr = ceil(($max_width*$max_length)/45);
			$seland_ = ceil($area_room*0.5);
			$silicon_ = ceil($area_room/8);
			$revet = ceil((($all_menium*6*2*0.35)/0.25)/1000);
			$prsur = ceil(($max_width*$max_length*$r_height)/100);
			

			
			
			
			if($area_room <= 100){
				$laborcost = 15000;
			}else if($area_room <= 200){
				$laborcost = 25000;
			}else{
				$laborcost = $area_room*120;
			}

			
			//exit();
			$price_isoside = $isoside*$isoprice*$stdardwall*$r_height;
			$price_isoceil = $isoceil*$isoprice*$stdardwall*$r_width;
			$price_flrfome = 3.6*$qtypaper*$flr_cost; 
			
			$all_price_flrfome =  $price_isoside + $price_isoceil +  $price_flrfome;

			$price_chkbold = $chakbold*$cost_chakbold;
			$price_chkl = $chaklthing*$cost_chakl;
			$price_chkcurve = $cost_chakcurve*$chak2in;
			$price_chkf = $chakf*$cost_chakf;
			$price_bua = $miniumbau*$cost_minuimbua;
			$all_price_chak =  $price_chkbold + $price_chkl + $price_chkcurve + $price_chkf + $price_bua;

			$price_printcode = $printcode*$cost_printcode;
			$price_plastic = $plasticflr*$cost_plastic;
			$price_seland = $seland_*$cost_seland;
			$price_silicon = $silicon_*$cost_silicon;
			$price_revet = $revet*$cost_revet;
			$price_resur = $prsur*$cost_pressure;
			
			$all_price_acces = $price_printcode + $price_plastic + $price_seland + $price_silicon + $price_revet + $price_resur  + $laborcost; 
			
			$total_price = $all_price_flrfome + $all_price_chak + $all_price_acces;
			
			$tatal_price2 = $total_price;
			
			echo 'temparature : '. $temparature.'<br>';
				echo 'r_width : '. $r_width.'<br>';
				echo 'r_length : '. $r_length.'<br>';
				echo 'r_height : '.$r_height .'<br><br>';
				echo 'area_room : '. $area_room.'<br>';
				echo 'isoprice : '. $isoprice.'<br>';

				echo 'isoside : '. $isoside.'<br>';
				echo 'isoceil : '.$isoceil .'<br><br>';
				
				echo 'isosidecost : '. $isosidecost.'<br>';
				echo 'isoceilcost : '. $isoceilcost.'<br><br>';

				echo 'flr_cost : '.$flr_cost.'<br>';
			echo 'fome_flr_cost : '.$fome_flr_cost.'<br><br>';
				
			echo 'inchs : '.$inchs.'<br>';
			echo 'inch2 : '.$inch2.'<br>';
			echo 'fqty : '.$fqty.'<br>';
			echo 'qtypaper : '.$qtypaper.'<br><br>';

			echo 'chakbold : '.$chakbold.'<br>';
			echo 'chaklthing : '.$chaklthing.'<br>';
			echo 'chak2in : '.$chak2in.'<br>';
			echo 'chakf : '.$chakf.'<br>';
			echo 'miniumbau : '.$miniumbau.'<br><br>';
			echo 'all_menium : '.$all_menium.'<br><br>';
			
			echo 'price_chkbold : '.$price_chkbold.'<br>';
			echo 'price_chkl : '.$price_chkl.'<br>';
			echo 'price_chkcurve : '.$price_chkcurve.'<br>';
			echo 'price_chkf : '.$price_chkf.'<br>';
			echo 'price_bua : '.$price_bua.'<br>';
			echo 'all_price_chak : '.$all_price_chak.'<br><br>';

			echo 'printcode : '.$printcode.'<br>';
			echo 'plasticflr : '.$plasticflr.'<br>';
			echo 'seland_ : '.$seland_.'<br>';
			echo 'silicon_ : '.$silicon_.'<br>';
			echo 'revet : '.$revet.'<br>';
			echo 'prsur : '.$prsur.'<br><br>';
			echo 'laborcost : '.$laborcost.'<br>';
			echo 'all_price_flrfome : '. $all_price_flrfome.'<br>';
			echo 'all_price_chak : '. $all_price_chak.'<br>';
			echo 'all_price_acces : '. $all_price_acces.'<br>';
			//exit();
			if($temparature <=4 ){
				
				
				$sql_pressure   = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate WHERE p.pr_cate = 10 AND p.pr_size = 4";
				

			}else{
				
				
				$sql_pressure  = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate WHERE p.pr_cate = 10 AND p.pr_size = 8";
				
			}
			$row_isowall = mysql_fetch_array(mysql_query("SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate WHERE p.pr_cate = 1 AND p.pr_temp = $temps"));
			

			
			$sql_plastic = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
							WHERE p.pr_cate = 9";
			$result_plastic = mysql_query($sql_plastic);
			$row_plastic = mysql_fetch_array($result_plastic);
			
			
			$sql_aluminium = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
							WHERE p.pr_cate = 3";
			$result_aluminium = mysql_query($sql_aluminium);
			$row_aluminium = mysql_fetch_array($result_aluminium);
			
			$sql_seal = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
							WHERE p.pr_cate = 4";
			$result_seal = mysql_query($sql_seal);
			$row_seal = mysql_fetch_array($result_seal);
			
			
			$sql_silicon = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
							WHERE p.pr_cate = 8";
			$result_silicon = mysql_query($sql_silicon);
			$row_silicon = mysql_fetch_array($result_silicon);
			
			//ดูข้อมูล pressure
			$row_pressure = mysql_fetch_array(mysql_query($sql_pressure));	
			//ราคาทุน pressure 
			$pressure_cost = $row_pressure['pr_sell_price'];
			
			//ราคาทุน  บวกกำไร 1 ตัว
			//   ราคารวมกำไรไม่คูณหน่วย                                        ทุน                                    +                     กำไร 
			//$pressure_unit_profit = $pressure_cost*$percentprice;
			
			//นับ pressure ว่ามีกี่ตัว เศษปัดขึ้น
			$count_pressure = ceil($var_room/100);	

			//ราคา pressure ทั้งหมด รวมกำไร คูณหน่วย
			//ราคาทั้งหมด                                   =                  ทุน                             x     จำนวน                       +            กำไร
			//$pressure_profit = $pressure_cost*$count_pressure*$percentprice;
			//echo ' ปริมาตรห้อง  : '.$var_room .'<br>'.' ราคาทุน pressure : '.$pressure_cost .'<br>'.' นับ pressure ว่ามีกี่ตัว เศษปัดขึ้น : '.$count_pressure .'<br>'.' รวมราคา pressure ทั้งหมด รวมกำไร  ไม่คุณหน่วย : '.$pressure_unit_profit .'<br>'.' ราคา pressure ทั้งหมด รวมกำไร : '.$pressure_profit .'<br>';
			
			
			
			
			
			if($cute < 120){ //selectDoor
				if($temparature <= 4){ //select tempdoor 
					$sql_door = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate WHERE p.pr_cate = 5 AND p.pr_temp = 0 AND p.pr_size = 4";
					 
				}else{
					$sql_door = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate  WHERE p.pr_cate = 5 AND p.pr_temp = -20 AND p.pr_size = 4";
					
				}//end select tempdoor 
				
				$sql_man = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate WHERE p.pr_cate = 6 AND p.pr_size = 4";
				//$textdoor = "ประตูสิ"
				
			}else{
				$sql_door = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate  WHERE p.pr_cate = 5 AND p.pr_size = 6";
				
				$sql_man = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate WHERE p.pr_cate = 6 AND p.pr_size = 6";
			}//end if selectDoor
			
			
			$result_door = mysql_query($sql_door);
			$row_door = mysql_fetch_array($result_door);
			
			
			
			$result_man = mysql_query($sql_man);
			$row_man = mysql_fetch_array($result_man);
			
			$sql_gerneral = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
						   WHERE p.pr_cate = 7";
			$result_gerneral = mysql_query($sql_gerneral); 
			$row_gerneral = mysql_fetch_array($result_gerneral);
			
			$var_seal = ceil(($var_room*0.7));
			$var_silicon = ceil(($var_room*0.2));
			
			/*echo "num_isowall = ".$num_isowall."<br>";
			echo "num_floor = ".$num_floor."<br>";*/
			
			//สรุปราคาแต่ละหัวข้อก่อน รวมราคาห้องทั้งหมด  b = before sum
			$b_isowall_price = $row_isowall['pr_sell_price']*($isosidearea+$isoceilarea);
			$b_isoflr_price =  $fome_flr_cost;
			$b_plastic_price = $row_plastic['pr_sell_price']*$var_florom;
			$b_chak_price =  $all_price_chak;
			$b_seland_price = $row_seal['pr_sell_price']*$seland_;
			$b_silicon_price = $row_silicon['pr_sell_price']*$silicon_;
			$b_pressure_price = $pressure_cost*$count_pressure;
			$b_door_price = $row_door['pr_sell_price'];
			$b_man_price = $row_man['pr_sell_price'];
			$b_other_price = $row_gerneral['pr_sell_price']*$var_room;
			$b_labor_price = $laborcost;
			
			
			$tatal_price2 =  $b_isowall_price + $b_isoflr_price + $b_plastic_price + $b_chak_price + 
					 $b_seland_price + $b_silicon_price + $b_pressure_price + $b_door_price + 
					 $b_man_price + $b_other_price + $b_labor_price;
					 	
			
			
			echo '<br><br>'.'b_isowall_price : '.$b_isowall_price.'<br>';
			echo 'b_isoflr_price : '.$b_isoflr_price.'<br>';
			echo 'b_plastic_price : '.$b_plastic_price.'<br>';
			echo 'b_chak_price : '.$b_chak_price.'<br>';
			echo 'b_seland_price : '.$b_seland_price.'<br>';
			echo 'b_silicon_price : '.$b_silicon_price.'<br>';
			echo 'b_pressure_price : '.$b_pressure_price.'<br>';
			echo 'b_door_price : '.$b_door_price.'<br>';
			echo 'b_man_price : '.$b_man_price.'<br>';
			echo 'b_other_price : '.$b_other_price.'<br>';
			echo 'b_labor_price : '.$b_labor_price.'<br>';
			echo 'sum_ : '.$sum_.'<br><br>';
			
			
			
			
							


		?>

    </div> <!--end page-->
    <div class="page">
        <div class="subpage">

            <div class="cover_header">
				
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('../include/custaddress1.php'); ?>
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ ห้อง</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP <?php echo $temps?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1.<input name="r1" class="pdesc" type="text" value="<?php echo "แผ่นฉนวนสำเร็จรูปสำหรับผนังและเพดาน "." หนา ".$row_isowall['pr_size']." นิ้ว Type ".$row_isowall['pr_type'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="r1q" style="width:45px;" class="punit" type="text" value="<?php echo $isosidearea+$isoceilarea;?>"> ตร.ม.</td>
						<td class="l" align="right"><input name="r1p" class="punit" type="text" value="<?php echo number_format($row_isowall['pr_sell_price'], 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_isowall['pr_sell_price']*($isosidearea+$isoceilarea), 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>2. <input name="r2" class="pdesc" type="text" value='<?php echo "แผ่นฉนวนพื้น หนา ".$row_flr_cost['pr_size']." นิ้ว ความหนาแน่น ".$row_flr_cost['pr_density']."lb";?>'></td>
						<td colspan="2" class="l" align="center"><input name="r2q" style="width:45px;" class="punit" type="text" value="<?php echo $flr_area?>"> ตร.ม.</td>
						<td class="l" align="right"><input name="r2p" class="punit" type="text" value="<?php echo number_format($row_flr_cost['pr_sell_price'], 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($fome_flr_cost, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>3. <input name="r3" class="pdesc" type="text" value="<?php echo $row_plastic['catr_name'];?>"></?></td>
						<td colspan="2" class="l" align="center"><input name="r3q" style="width:45px;" class="punit" type="text" value="<?php echo $var_florom?>"> ตร.ม.</td>
						<td class="l" align="right"><input name="r3p" class="punit" type="text" value="<?php echo number_format($row_plastic['pr_sell_price'], 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_plastic['pr_sell_price']*$var_florom, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr>
						<td>4. <input name="r4" class="pdesc" type="text" value="<?php echo $row_aluminium['catr_name']."หน้าตัดต่างๆ ชนิดชุบอโนไดส์";?>"></?></td>
						<td colspan="2" class="l" align="center"><input name="r4q" style="width:45px;" class="punit" type="text" value="1"> ชุด </td>
						<td class="l" align="right"><input name="r4p" class="punit" type="text" value="<?php echo number_format($all_price_chak, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($all_price_chak, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr>
						<td>5. <input name="r5" class="pdesc" type="text" value="<?php echo $row_seal['catr_name'];?>"></td> 
						<td colspan="2" class="l" align="center"><input name="r5q" style="width:45px;" class="punit" type="text" value="<?php echo $seland_?>"> หลอด</td>
						<td class="l" align="right"><input name="r5p" class="punit" type="text" value="<?php echo number_format($row_seal['pr_sell_price']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_seal['pr_sell_price']*$seland_, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>6. <input name="r6" class="pdesc" type="text" value="<?php echo $row_silicon['catr_name']."ชนิดกันเชื้อรา";?>"></td> 
						<td colspan="2" class="l" align="center"><input name="r6q" style="width:45px;" class="punit" type="text" value="<?php echo $silicon_?>"> หลอด</td>
						<td class="l" align="right"><input name="r6p" class="punit" type="text" value="<?php echo number_format($row_silicon['pr_sell_price']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_silicon['pr_sell_price']*$silicon_, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>7. <input name="r_pressure" class="pdesc" type="text" value="<?php echo $row_pressure['catr_name'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="r_pressureq" style="width:45px;" class="punit" type="text" value="<?php echo $count_pressure?>"> ตัว</td>
						<td class="l" align="right"><input name="r_pressure_p" class="punit" type="text" value="<?php echo number_format($pressure_cost, 2, '.', ','); ?>"></td>
						<td class="l" align="right"><?php echo number_format($b_pressure_price, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>8. <input name="r7" class="pdesc" type="text" value="<?php echo $row_door['catr_name'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="r7q" style="width:45px;" class="punit" type="text" value="1"> หน่วย</td>
						<td class="l" align="right"><input name="r7p" class="punit" type="text" value="<?php echo number_format($row_door['pr_sell_price'], 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_door['pr_sell_price'], 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>9. <input name="r8" class="pdesc" type="text" value="<?php echo $row_man['catr_name'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="r8q" style="width:45px;" class="punit" type="text" value="1"> หน่วย</td>
						<td class="l" align="right"><input name="r8p" class="punit" type="text" value="<?php echo number_format($row_man['pr_sell_price'], 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_man['pr_sell_price'], 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>10. <input name="r9" class="pdesc" type="text" value="<?php echo $row_gerneral['catr_name'];?>"></td>
						<td colspan="2" class="l" align="center"><input name="r9q" style="width:45px;" class="punit" type="text" value="<?php echo $var_room?>"> ตร.ม.</td>
						<td class="l" align="right"><input name="r9p" class="punit" type="text" value="<?php echo number_format($row_gerneral['pr_sell_price']*$percentprice, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($row_gerneral['pr_sell_price']*$var_room, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>11. <input name="r10" class="pdesc" type="text" value="ค่าแรงและค่าติดตั้งห้อง"></td>
						<td colspan="2" class="l" align="center"><input name="laborroomunit" style="width:45px;" class="punit" type="text" value="1"> ชุด</td>
						<td class="l" align="right"><input name="laborroomprice" class="punit" type="text" value="<?php echo number_format($laborcost, 2, '.', ',');?>"></td>
						<td class="l" align="right"><?php echo number_format($laborcost, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>12. <input name="r11" class="pdesc" type="text" value="ค่าขนส่งห้อง"></td>
						<td colspan="2" class="l" align="center"><input name="shiproomunit" style="width:40px;" class="punit" type="text" value="1"> เที่ยว</td>
						<td class="l" align="right"><input name="shiproomprice" class="punit" type="text" value="0"></td>
						<td class="l" align="right"></td>        
					</tr>
					 
				
					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($tatal_price2, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format($tatal_price2*0.07, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($tatal_price2+($tatal_price2*0.07)); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format($tatal_price2+($tatal_price2*0.07), 2, '.', ','); ?></td>
					</tr>
					
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
				</div>
			</div><!--end footer-->
			
			
		
			<br><br><br>
			<div id="note" style="clear: both; margin: 150px 0 0 200px;">
				
				<!--<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>-->
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->

	   
	    <input type="hidden" name="temp_num" value="<?php echo $temp_num?>">
		<input type="hidden" name="r_width" value="<?php echo $r_width?>">
		<input type="hidden" name="r_length" value="<?php echo $r_length?>">
		<input type="hidden" name="r_height" value="<?php echo $r_height?>">
		
		
	
	
	<div class="page">
        <div class="subpage">

            <div class="cover_header">
				
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('../include/custaddress2.php'); ?>
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของค่าแรงติดตั้งงานที่นำเสนอ</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1. ชุดเครื่องทำความเย็น</td> 
						<td colspan="2" class="l" align="center"><input name="mrmixu" style="width:45px;" class="punit" type="text" value="1"> ชุด</td>
						<td class="l" align="right"><?php echo number_format($tatal_price, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($tatal_price, 2, '.', ','); ?></td>
						
					</tr>
					
					<tr>
						<td>2. แผ่นฉนวนและอุปกรณ์ติดตั้ง</td>
						<td colspan="2" class="l" align="center"><input name="crmixu" style="width:45px;" class="punit" type="text" value="1"> ชุด</td>
						<td class="l" align="right"><?php echo number_format($tatal_price2, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($tatal_price2, 2, '.', ','); ?></td>
					</tr>
					
					<!--<tr>
						<td>3. ค่าแรงและค่าติดตั้ง</td>
						<td colspan="2" class="l" align="center"><input name="laboru" style="width:45px;" class="punit" type="text" value="1"> ชุด</td>
						<td class="l" align="right"><input name="laborp" class="punit" type="text" value="0"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>4. ค่าขนส่ง</td>
						<td colspan="2" class="l" align="center"><input name="shipu" style="width:40px;" class="punit" type="text" value="1"> เที่ยว</td>
						<td class="l" align="right"><input name="shipp" class="punit" type="text" value="0"></td>
						<td class="l" align="right"></td>
					</tr>-->

					
					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($tatal_price+$tatal_price2, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format(($tatal_price+$tatal_price2)*0.07, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion(($tatal_price+$tatal_price2)+(($tatal_price+$tatal_price2)*0.07)); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format(($tatal_price+$tatal_price2)+(($tatal_price+$tatal_price2)*0.07), 2, '.', ','); ?></td>
					</tr>   
					
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">

					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>ราคาที่เสนอมาไม่รวมรายการดังนี้</u> </strong></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">- งานเพิ่มเติมจากแบบและ Quotation </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">- และรายการอื่นๆ ที่มิได้ระบุไว้ข้างต้น </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>เงื่อนไขการชำระเงิน </u></strong></td>
					</tr>
					<?php 
						$ep_split =  ($tatal_price+$tatal_price2)+(($tatal_price+$tatal_price2)*0.07);
					?>
					<tr class="highs" style="">   
						<td class="l" colspan="5">งวดที่ 1   40%  ชำระเมื่อได้รับใบสั่งซื้อ  <?php echo '(', number_format($ep_split*0.4, 2, '.', ','), ')';?> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">งวดที่ 2   40% ชำระเมื่อส่งอุปกรณ์ <?php echo '(', number_format($ep_split*0.4, 2, '.', ','), ')';?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">งวดที่ 3   20% ชำระเมื่อส่งมอบงาน <?php echo '(', number_format($ep_split*0.2, 2, '.', ','), ')';?> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>การรับประกัน</strong></u> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">-  ทางบริษัทฯ มีความยินดีรับประกันเป็นระยะเวลา 1 ปี  </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">-  การรับประกันดังกล่าวมิได้รวมถึงผลเสียหายที่เกิดจากความบกพร่องของผู้ใช้งาน  </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>รายละเอียดเลขที่บัญชีสำหรับโอนเงิน</u></strong></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">บัญชีธนาคารกสิกรไทย ชูเกียรติ เทียนอำไพ   ออมทรัพย์  เลขที่บัญชี 855-2-05499-8 </td>
					</tr>
					
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
				</div>
			</div><!--end footer-->
			
			
		
			<br><br><br>
			<div id="note" style="clear: both; margin: 150px 0 0 200px;">
				
				<!--<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>-->
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->
	
		<div style="margin-left: 500px;">
			<table>
				<tr style="height: 60px;">
					<td style="width:150px;">กำไร <input type="text" value="" name="percentprofit" style="width:50px;"> % </td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td>โฟมบวก <input type="text" value="" name="fomeadd" style="width:50px;"> บาท </td>
					<td><input type="submit" value="คำนวณราคา"></td>
				</tr>
				
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				
				<tr>
					<td rowspan="2"> หัวบิลบริษัท </td>
					<td><input type="radio" name="corp_addr" value="1" checked> TOPCOOLING </td>
				</tr>
				
				<tr>
					<td style="padding:0;"><input type="radio" name="corp_addr" value="2"> TP WALL </td>
				</tr>
				<!--<tr>
					<td style="width:200px;">กำไร <input type="text" value="" name="percentprofit" > % </td>
					<td style="width:150px;" align="center">ราคาทุน</td>
					<td colspan="2" align="center">หัวบิล บริษัท</td>
				</tr>
				<tr>
					<td align="center"><input type="submit" value="คำนวณราคา"></td>
					<td align="center"><input type="button" value="ราคาทุน" id="findcost"></td>
					<td> <input type="radio" name="corp_addr" value="1" checked> TOPCOOLING </td>
					<td> <input type="radio" name="corp_addr" value="2"> TPWALL </td>
				</tr>-->
				
		
			</table>
		</div>
		
	</form>
	
</div>
<span style="float:right;"><?php echo $total_result_t;?></span>
</body>
</html>