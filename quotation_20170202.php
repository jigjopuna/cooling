<?php
   require_once('include/connect.php');
   require_once('include/thaibaht.php');
   require_once('savedb/cust_address.php');
   

    //1. receive data
	$r_width  = trim($_POST['r_width']);
	$r_length  = trim($_POST['r_length']);
	$r_height  = trim($_POST['r_height']);
	$temparature  = $_POST['temparature'];
	$temp_before  = $_POST['temp_before']; 
	$timeperiod  = $_POST['timeperiod'];
	$qty  = $_POST['qty'];
	$percentprice = 1.1;
	
	$area_room = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)))*1.1;
	$cute = $r_width*$r_length*$r_height;
	
	
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
	if($temparature==1){
		$pps = 100;
		$var13 = 35;
		$temp_num = 0;
	//Temparature -20
	} else{
		$pps = 200;
		$var13 = 55;
		$temp_num = -20;
	}
	
	$result_cool = ($r_width-($pps/1000)*2)*($r_length-($pps/1000)*2)*($r_height-($pps/1000)*2);
	
	$var11 = (($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)*2);
	$var_room = ((($r_width*$r_height)*2)+ (($r_length*$r_height)*2) + (($r_length*$r_width)))*1.1;
	$var_florom = $r_length*$r_width*1.1;
	$var12 = 0.033/($pps/1000);
	
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
	 
	// echo "all_result = ".$all_result."<br>";
    // echo "safety = ".$safety."<br>";		 
	
	
	/*echo $result_cool; echo " ปริมาตรภายในห้องเย็น "; echo "<br>";
	echo "พื่้นที่คำนวนเครื่อง  "; echo $area_matchine; echo " ตารางเมตร "; echo "<br><br>";
	
	echo "1. ภาระที่ผ่านฉนวนห้องเย็น  "; echo $rusult; echo " KW "; echo "<br>";
	echo "2. ภาระอากาศจากภายนอก  "; echo $result2; echo " KW "; echo "<br>";
	echo "3. ภาระจากสินค้า เหนือจุดเยือแข็ง "; echo $result3; echo " KW "; echo "<br>";
	echo "4. ภาระอื่นๆ   "; echo $result4; echo " KW "; echo "<br><br>";
	
	echo "all_result  "; echo $all_result; echo " KW "; echo "<br>";
	echo "safety  "; echo $safety; echo " KW "; echo "<br><br>";*/
	//echo "ตารางที่ 1  = "; echo $total_result; echo " KW "; echo "<br><br>";
	

	
   // echo "=======================================================================";  echo "<br><br>";
	
	
	

	
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
	 
	/* echo 'result_t30 = '; echo $result_t30; echo "<br>";
	 echo 'result_t31 = '; echo $result_t31; echo "<br>";
	 echo 'result_t32 = '; echo $result_t32; echo "<br>";*/
	 
	 $all_result_t = $rusult_t1 + $resul_t2 + $result_t3 + $result4;
	// echo 'no saftry = '; echo $all_result_t; echo "<br>";
	 $safety_t = $all_result_t*0;
	 
	 $total_result_t = $all_result_t + $safety_t;
	 
	 
	 /*echo "all_result_t  "; echo $all_result_t; echo " KW "; echo "<br>";
	 echo "safety_t  "; echo $safety_t; echo " KW "; echo "<br><br>";*/
	// echo "ตารางที่ 2  = "; echo $total_result_t; echo " KW "; echo "<br><br>";
	 
	 
	
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
		$chkMaxKw = "SELECT MAX(p_cw5) as MAXKW FROM tb_product WHERE p_cate=1";
		$result_chkMaxKw = mysql_query($chkMaxKw);	
				
	}else{ //temp -20
		$chkMaxKw = "SELECT MAX(p_cw20) as MAXKW FROM tb_product WHERE p_cate=1";
		$result_chkMaxKw = mysql_query($chkMaxKw);
		
	}//end select 0 or -20
	
	    $row_chkMaxKw = mysql_fetch_array($result_chkMaxKw);
		$get_chkMaxKw = $row_chkMaxKw['MAXKW'];
		
		/*echo "get_chkMaxKwfromCWConedensing = ".$get_chkMaxKw."<br>";
		echo "ค่าที่คำนวณได้ = ".$total_result_t."<br>";*/
		
		
		if($total_result_t > $get_chkMaxKw){ //compare condensing max  
			$getsed = $total_result_t % $get_chkMaxKw;
			/*echo "เศษที่ได้ = ",$getsed."<br>";
			echo "หารกัน = ",$total_result_t / $get_chkMaxKw."<br>";
			echo "ลบกัน = ",$total_result_t - $get_chkMaxKw."<br>";*/
			if($getsed==0){
				$condensingmaxqty = $total_result_t / $get_chkMaxKw;
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
					//echo "<br>"."cw5 = ".$row['p_cw5']."<br>";
					//echo "<br>"."fdec = ".$fdec."<br>";
					
					
					//แบ่งค่าออกมา ห้ามเกินตัวนั้น เช่น 150/40  = 3.75  ตัวแรกห้ามเกิน 3 หลังจุดหาให้เข้าใกล้ 9 มากที่สุดจะดี
					if($temp_num==0){
						$sub = number_format($total_result_t / $row['p_cw5'], 2, '.', '');
					}else{
						$sub = number_format($total_result_t / $row['p_cw20'], 2, '.', '');
					}
					list($dec, $sed) = explode('.',$sub);
					
					
					if($dec == $fdec){
						$goodvalue[$i] = $row['p_id'];
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
				/*list($dec, $sed) = explode('.',$sub);			
				echo "<br>"."total_result_t = ".$total_result_t."<br>";
				echo "<br>"."get_chkMaxKw = ".$get_chkMaxKw."<br>";
				echo "<br>"."getsed = ".$getsed."<br>";
				echo "<br>"."sub = ".$sub."<br>";
				echo "<br>"."dec = ".$dec."<br>";
				echo "<br>"."sed = ".$sed."<br>";*/
			} //end getsed
			$sql_condensing = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_id='$lastvalue'";		
		}else{ 
			if($temparature==1){
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
		  //  echo "คอนเด็นซิงมากกว่าจริงๆ นะ", '<br>';
			$getsedcw = $getfromcondensing % $get_chkMaxKwcw;
			// echo "เศษเท่าไรจ๊ะ ", $getsedcw, '<br>';
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
			if($temparature==1){
				// echo "cw5","<br>";
				$sql_cooler = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_cw5 > '$getfromcondensing' AND p.p_cate = 2 ORDER BY p.p_cw5 Limit 0,1";		
			}else{
				// echo "cw20","<br>";
				$sql_cooler = "SELECT * FROM tb_product p JOIN tb_category c ON c.cat_id = p.p_cate WHERE p.p_cw20 > '$getfromcondensing' AND p.p_cate = 2 ORDER BY p.p_cw20 Limit 0,1";				
			}
			$qtycooler = $condensingmaxqty;
		}//end compare cooler max
		
		//echo "<br>"." qtycooler = ".$qtycooler;
		
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
		
		if($temparature==1){
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
	if($temparature==1){
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

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />
	<title>ใบเสนอราคาห้องเย็น Topcooling</title>
</head>
<body>
<?php require_once('include/googltag.php');?>
<style>

body {
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 21cm;
        min-height: 31cm;
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
       /* padding: 1cm;*/
        border: 1px white solid;
        height: 256mm;
       /*outline: 2cm #FFEAEA solid;*/
    }
	table { font-size: 10pt; }
	tr { height: 25px;}
	td.rlb{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; }
	td.rlt{ border-right:solid black 1px; border-left:solid black 1px;border-top:solid black 1px; }
	td.all{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; border-top:solid black 1px; }
	td.rl{ border-right:solid black 1px; border-left:solid black 1px; }
	td.rt{ border-right:solid black 1px; border-top:solid black 1px; }
	td.r{ border-right:solid black 1px;  }
	td.l{ border-left:solid black 1px; padding: 0 5px 0 0; }
	td.br{ border-right:solid black 1px;  border-bottom:solid black 1px;}
	td.b{border-bottom:solid black 1px;}
	td.t{border-top:solid black 1px;}
	tr td:first-child{ padding: 0 0 0 5px; }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            padding-top: 1.5cm;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('include/custaddress.php'); ?>
				
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
						<td align="left">COLD ROOM TEMP <?php echo $temp_num?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
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
						<td>1. <?php echo $row_condensing['cat_name']." "; if($row_condensing['cat_id']==1){ echo '"'; echo $row_condensing['p_name'];  echo '" '; } echo $row_condensing['p_model']." ";  echo $row_condensing['p_hp']."HP "; echo $row_condensing['p_volt']."V";?></?></td>
						<td colspan="2" class="l" align="center"><?php echo $condensingmaxqty; ?></td>
						<td class="l" align="right"><?php echo number_format($row_condensing['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_condensing['p_price_sell']*$percentprice*$condensingmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>2. <?php echo $row_cooler['cat_name']." ";echo '"'; echo $row_cooler['p_name']; echo '"'. " ";  echo $row_cooler['p_model']." "; echo $row_cooler['p_volt']."V ".$row_cooler['p_amp']."A" ;?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtycooler; ?></td>
						<td class="l" align="right"><?php echo number_format($row_cooler['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_cooler['p_price_sell']*$percentprice*$qtycooler, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>3. <?php echo $row_dc['cat_name']." ";echo '"'; echo $row_dc['p_name']; echo '"'. " ";  echo $row_dc['p_model'];?></td>
						<td colspan="2" class="l" align="center"><?php echo $condensingmaxqty; ?></td>
						<td class="l" align="right"><?php echo number_format($row_dc['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_dc['p_price_sell']*$percentprice*$condensingmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr>
						<td>4. <?php echo $row_expand['cat_name']." ";echo '"'; echo $row_expand['p_name']; echo '"'. " ";  echo $row_expand['p_model'];?></td>
						<td colspan="2" class="l" align="center"><?php echo $expandmaxqty; ?></td>
						<td class="l" align="right"><?php echo number_format($row_expand['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_expand['p_price_sell']*$percentprice*$expandmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					
					
					<tr>
						<td>5. <?php echo $row_tube2['cat_name']."ทางกลับ"; echo " Type ".$row_tube2['p_type']." Size "; echo $row_tube2['p_size'].'"'?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtycooler*2; ?></td>
						<td class="l" align="right"><?php echo number_format($row_tube2['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_tube2['p_price_sell']*$percentprice*2*$qtycooler, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>6. <?php echo $row_tube1['cat_name']."ทางส่ง"; echo " Type ".$row_tube1['p_type']." Size "; echo $row_tube1['p_size'].'"'?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtycooler*2; ?></td>
						<td class="l" align="right"><?php echo number_format($row_tube1['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_tube1['p_price_sell']*$percentprice*2*$qtycooler, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>7. <?php echo $row_curve1['cat_name']." Size ".$row_curve1['p_size'].'"' ?></td>
						<td colspan="2" class="l" align="center"><?php echo $condensingmaxqty*5;?></td>
						<td class="l" align="right"><?php echo number_format($row_curve1['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_curve1['p_price_sell']*$percentprice*5*$condensingmaxqty, 2, '.', ','); ?></td>
						
					</tr>
					
					<tr>
						<td>8. <?php echo $row_curve2['cat_name']." Size ".$row_curve2['p_size'].'"' ?></td>
						<td colspan="2" class="l" align="center"><?php echo $condensingmaxqty*5;?></td>
						<td class="l" align="right"><?php echo number_format($row_curve2['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format(($row_curve2['p_price_sell']*$percentprice*5*$condensingmaxqty), 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>9. <?php echo $row_curve3['cat_name']." Size ".$row_curve3['p_size'].'"' ?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtycooler?></td>
						<td class="l" align="right"><?php echo number_format($row_curve3['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_curve3['p_price_sell']*$percentprice*$qtycooler, 2, '.', ','); ?></td>
						
					</tr>
					
					<tr>
						<td>10. <?php echo $row_ins['cat_name']." ";echo '"'; echo $row_ins['p_name']; echo '"'. " Size ";  echo $row_ins['p_size'].'"'. "  หนา ".$row_ins['p_thin'].'"' ;?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtycooler*2*3;?></td>
						<td class="l" align="right"><?php echo number_format($row_ins['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_ins['p_price_sell']*$percentprice*$qtycooler*2*3, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>11. <?php echo $row_numya['cat_name']." ";echo '"'; echo $row_numya['p_name']; echo '"'. " ";  echo $row_numya['p_model'];?></td>
						<td colspan="2" class="l" align="center"><?php echo $condensingmaxqty*$numyaQty; ?></td>
						<td class="l" align="right"><?php echo number_format($row_numya['p_price_sell']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_numya['p_price_sell']*$percentprice*$numyaQty*$condensingmaxqty, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>12. <?php echo "สายไฟและท่อเดินสายไฟ"?></td>
						<td colspan="2" class="l" align="center"><?php echo $condensingmaxqty; ?></td>
						<td class="l" align="right"><?php echo number_format($cable*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($cable*$percentprice*$condensingmaxqty, 2, '.', ','); ?></td>
						
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
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
				<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
		
		
		
		
		
		
		
		
		<?
			if($temparature==1){
				
				$sql_isowall = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
								WHERE p.pr_cate = 1 AND p.pr_size = 4;
							   ";

							
				$sql_floor = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
								WHERE p.pr_cate = 2 AND p.pr_size = 4;
							   ";
				
				
				
			}else{
				
				$sql_isowall = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
								WHERE p.pr_cate = 1 AND p.pr_size = 8;
							   ";
				
						
				$sql_floor = "SELECT * FROM tb_categoryroom c JOIN tb_productroom p ON c.catr_id = p.pr_cate 
								WHERE p.pr_cate = 2 AND p.pr_size = 8;
							   ";
				
			}
			
			$result_isowall = mysql_query($sql_isowall);
			$num_isowall = mysql_num_rows($result_isowall);
			$row_isowall = mysql_fetch_array($result_isowall);
			
			$result_floor = mysql_query($sql_floor);
			$num_floor = mysql_num_rows($result_floor);
			$row_floor = mysql_fetch_array($result_floor);
			
			
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
			
			
			
			
			if($cute < 120){ //selectDoor
				if($temparature==1){ //select tempdoor 
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
			
			$tatal_price2 = ($row_isowall['pr_sell_price']*$percentprice*$var_room) +
							($row_floor['pr_sell_price']*$percentprice*$var_florom) +
							($row_plastic['pr_sell_price']*$percentprice*$var_florom) +
							($row_seal['pr_sell_price']*$percentprice*$var_seal) +
							($row_aluminium['pr_sell_price']*$percentprice*$var_room) +
							($row_silicon['pr_sell_price']*$percentprice*$var_silicon) +
							($row_door['pr_sell_price']*$percentprice) +
							($row_man['pr_sell_price']*$percentprice) + 
							($row_gerneral['pr_sell_price']*$percentprice*$var_room)
							; 
			
		
		?>
		
		
		
		
		
		

    </div> <!--end page-->
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('include/custaddress1.php'); ?>
				
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
						<td align="left">COLD ROOM TEMP <?php echo $temp_num?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
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
						<td>1. <?php echo "แผ่นฉนวนสำเร็จรูปสำหรับผนังและเพดาน "." หนา ".$row_isowall['pr_size'].'"' ." Type ".$row_isowall['pr_type'];?></?></td>
						<td colspan="2" class="l" align="center"><?php echo $var_room." ตร.ม."?></td>
						<td class="l" align="right"><?php echo number_format($row_isowall['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_isowall['pr_sell_price']*$percentprice*$var_room, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>2. <?php echo $row_floor['catr_name']." หนา ".$row_floor['pr_size'].'" '.$row_floor['pr_density']."lb"."<Sup>2</Sup>";?></?></td>
						<td colspan="2" class="l" align="center"><?php echo $var_florom." ตร.ม."?></td>
						<td class="l" align="right"><?php echo number_format($row_floor['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_floor['pr_sell_price']*$percentprice*$var_florom, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>3. <?php echo $row_plastic['catr_name'];?></?></td>
						<td colspan="2" class="l" align="center"><?php echo $var_florom." ตร.ม."?></td>
						<td class="l" align="right"><?php echo number_format($row_plastic['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_plastic['pr_sell_price']*$percentprice*$var_florom, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr>
						<td>4. <?php echo $row_aluminium['catr_name']."หน้าตัดต่างๆ ชนิดชุบอโนไดส์";?></?></td>
						<td colspan="2" class="l" align="center"><?php echo $var_room." ตร.ม."?></td>
						<td class="l" align="right"><?php echo number_format($row_aluminium['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_aluminium['pr_sell_price']*$percentprice*$var_room, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr>
						<td>5. <?php echo $row_seal['catr_name'];?></?></td> 
						<td colspan="2" class="l" align="center"><?php echo $var_seal." หลอด"?></td>
						<td class="l" align="right"><?php echo number_format($row_seal['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_seal['pr_sell_price']*$percentprice*$var_seal, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>6. <?php echo $row_silicon['catr_name']."ชนิดกันเชื้อรา";?></?></td> 
						<td colspan="2" class="l" align="center"><?php echo $var_silicon." หลอด"?></td>
						<td class="l" align="right"><?php echo number_format($row_silicon['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_silicon['pr_sell_price']*$percentprice*$var_silicon, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>7. <?php echo $row_door['catr_name'];?></?></td>
						<td colspan="2" class="l" align="center">1</td>
						<td class="l" align="right"><?php echo number_format($row_door['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_door['pr_sell_price']*$percentprice, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>8. <?php echo $row_man['catr_name'];?></?></td>
						<td colspan="2" class="l" align="center">1</td>
						<td class="l" align="right"><?php echo number_format($row_man['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_man['pr_sell_price']*$percentprice, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>9. <?php echo $row_gerneral['catr_name'];?></?></td>
						<td colspan="2" class="l" align="center"><?php echo $var_room." ตร.ม."?></td>
						<td class="l" align="right"><?php echo number_format($row_gerneral['pr_sell_price']*$percentprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($row_gerneral['pr_sell_price']*$percentprice*$var_room, 2, '.', ','); ?></td>
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
				
				<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->
	
	
	
	<div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('include/custaddress2.php'); ?>
				
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
						<td>1. <?php echo "ชุดเครื่องทำความเย็น ";?></td> 
						<td colspan="2" class="l" align="center"><?php echo $condensingmaxqty, " ชุด"?></td>
						<td class="l" align="right"><?php echo number_format($tatal_price/$condensingmaxqty, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($tatal_price, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td>2. <?php echo "แผ่นฉนวนและอุปกรณ์ติดตั้ง";?></td>
						<td colspan="2" class="l" align="center"><?php echo " 1 ชุด"?></td>
						<td class="l" align="right"><?php echo number_format($tatal_price2, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($tatal_price2, 2, '.', ','); ?></td>
					</tr>

					
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
				
				<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->
	
</div>
<span style="float:right;"><?php echo $total_result_t;?></span>
</body>
</html>