<?php
echo "<META HTTP-EQUIV='Refresh' CONTENT = '60;'>";	
    session_start();

	$id1 = "889E2AC40A24";

	$LineToken = "3aklyIn4i93ROTusrNhp70qjTckdn7zvdgrSjcXdYL5";
	
    $con=mysqli_connect("localhost","root","Topcooling482","basiccarel");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	//กล่องที่ 1
	$sql="SELECT * FROM register WHERE chipid = '$id1'"; //  WHERE chipid = '$search' 

	if ($result1=mysqli_query($con,$sql))
	  {

	  }
	  while($row1 = mysqli_fetch_array($result1))
		{
		 $tempmin1 = $row1["tempmin"];
		 $tempmax1= $row1["tempmax"];
		 //$cal1= $row1["CAL"];
		}
    $Tsql1="SELECT * FROM datalogger WHERE chipid = '$id1' ORDER BY no DESC LIMIT 1";

	if ($Tresult1=mysqli_query($con,$Tsql1))
	  {

	  }
	  while($Trow1 = mysqli_fetch_array($Tresult1))
		{
		 $temp1 = $Trow1["temp"];	
         $OVcom1 = $Trow1["in4"];
         $OVfan1 = $Trow1["in5"];	
         $OVcond1 = $Trow1["in6"];	
         $OVhl1 = $Trow1["in7"];
         $PHASE1 = $Trow1["in8"];		 		 
		}
 
	
	$TT1 = 	$temp1 ;//-$cal1 ;

		
    //echo $temp1;
	
	echo $TT1;
	echo "<br>";
	echo $cal1;
	echo "<br>";
	echo $tempmin1;
	echo $tempmax1;
	echo "<br>";
	echo $PHASE1;
	echo "<br>";
    
	
	
define('LINE_API',"https://notify-api.line.me/api/notify");

//แจ้งกล่อง1
if (($TT1 < $tempmin1)||($TT1 > $tempmax1))
	{
		$token = $LineToken; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str1 = "อุณหภูมิของท่านไม่ปรกติ กรุณาตรวจสอบ  ปัจจุบัน $TT1 องศาเซลเซียส  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร     $temp องศา
	}
if ($OVcom1 == "true")//false
   {
	    $token = $LineToken; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str2 = "ระบบCOMPRESSORของท่านไม่ปรกติ กรุณาตรวจสอบ  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร	   
   }
if ($OVfan1 == "true")//false
   {
	    $token = $LineToken; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str3 = "ระบบพัดลมของท่านไม่ปรกติ กรุณาตรวจสอบ  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร	   
   }
if ($OVcond1 == "true")//false
   {
	    $token = $LineToken; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str4 = "ระบบCONDENSINGของท่านไม่ปรกติ กรุณาตรวจสอบ  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร	   
   }   
if ($OVhl1 == "true")//false
   {
	    $token = $LineToken; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str5 = "ระบบแรงดันน้ำยาของท่านไม่ปรกติ กรุณาตรวจสอบ  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร	   
   }      
if ($PHASE1 == "true")//false
   {
	    $token = $LineToken; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str6 = "ระบบไฟฟ้าของท่านไม่ปรกติ กรุณาตรวจสอบ  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร	   
   }
 
 
$res1 = notify_message($str1,$token);
print_r($res1);
$res2 = notify_message($str2,$token);
print_r($res2);
$res3 = notify_message($str3,$token);
print_r($res3);
$res4 = notify_message($str4,$token);
print_r($res4);
$res5 = notify_message($str5,$token);
print_r($res5);
$res6 = notify_message($str6,$token);
print_r($res6);
function notify_message($message,$token)
{
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res1;
 return $res2;
 return $res3;
 return $res4;
 return $res5;
 return $res6;
}
//https://havespirit.blogspot.com/2017/02/line-notify-php.html
//https://medium.com/@nattaponsirikamonnet/%E0%B8%A1%E0%B8%B2%E0%B8%A5%E0%B8%AD%E0%B8%87-line-notify-%E0%B8%81%E0%B8%B1%E0%B8%99%E0%B9%80%E0%B8%96%E0%B8%AD%E0%B8%B0-%E0%B8%9E%E0%B8%B7%E0%B9%89%E0%B8%99%E0%B8%90%E0%B8%B2%E0%B8%99-65a7fc83d97f
?>