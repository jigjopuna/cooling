<?php
echo "<META HTTP-EQUIV='Refresh' CONTENT = '600;'>";	
    session_start();
	//$search= $_GET[search];
 
    //$search= "68D89BC40A24";
	$id1 = "B06E9CC40A24";
	$id2 = "8D280C334FC4";
	
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
		 $cal1= $row1["CAL"];
		}
    $Tsql1="SELECT * FROM datalogger WHERE chipid = '$id1' ORDER BY no DESC LIMIT 1";

	if ($Tresult1=mysqli_query($con,$Tsql1))
	  {

	  }
	  while($Trow1 = mysqli_fetch_array($Tresult1))
		{
		 $temp1 = $Trow1["temp"];	
         $OV1 = $Trow1["in8"];		 
		}
 
	
		//กล่องที่ 2
	$sql2="SELECT * FROM register WHERE chipid = '$id2'"; //  WHERE chipid = '$search' 

	if ($result2=mysqli_query($con,$sql2))
	  {

	  }
	  while($row2 = mysqli_fetch_array($result2))
		{
		 $tempmin2 = $row2["tempmin"];
		 $tempmax2= $row2["tempmax"];
		 $cal2= $row2["CAL"];
		}
    $Tsql2="SELECT * FROM datalogger WHERE chipid = '$id2' ORDER BY no DESC LIMIT 1";

	if ($Tresult2=mysqli_query($con,$Tsql2))
	  {

	  }
	  while($Trow2 = mysqli_fetch_array($Tresult2))
		{
		 $temp2 = $Trow2["temp"];
         $OV2 = $Trow2["in8"];		 
		}
	$TT1 = 	$temp1-$cal1 ;
	$TT2 = 	$temp2-$cal2 ;
		
    //echo $temp1;
	
	echo $TT1;
	echo "<br>";
	echo $cal1;
	echo "<br>";
	echo $tempmin1;
	echo $tempmax1;
	echo "<br>";
	echo $OV1;
	echo "<br>";
    //echo $temp2;
	echo $TT2;
	echo "<br>";
	echo $cal2;
	echo "<br>";
	echo $tempmin2;
	echo $tempmax2;
	echo "<br>";
	echo $OV2;
	
	
define('LINE_API',"https://notify-api.line.me/api/notify");

//แจ้งกล่อง1
if (($TT1 < $tempmin1)||($TT1 > $tempmax1))
	{
		$token = "LIKitN0sQ7UvNBBictpSZPWFxk6gY02EMCQkoj7ztJH"; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str1 = "อุณหภูมิของท่านไม่ปรกติ กรุณาตรวจสอบตู้ที่1  ปัจจุบัน $TT1 องศาเซลเซียส  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร     $temp องศา
	}
if ($OV1 == "true")//false
   {
	    $token = "LIKitN0sQ7UvNBBictpSZPWFxk6gY02EMCQkoj7ztJH"; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str2 = "ระบบไฟฟ้าของท่านไม่ปรกติ กรุณาตรวจสอบตู้ที่1  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร	   
   }
 //แจ้งกล่อง2
 
if (($TT2 < $tempmin2)||($TT2 > $tempmax2))
	{
		$token = "LIKitN0sQ7UvNBBictpSZPWFxk6gY02EMCQkoj7ztJH"; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str3 = "อุณหภูมิของท่านไม่ปรกติ กรุณาตรวจสอบตู้ที่2  ปัจจุบัน $TT2 องศาเซลเซียส "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร    $temp องศา
	}
	
if ($OV2 == "true")//true	
   {
	    $token = "LIKitN0sQ7UvNBBictpSZPWFxk6gY02EMCQkoj7ztJH"; //ใส่Token ที่copy เอาไว้
		//$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0";
        $str4 = "ระบบไฟฟ้าของท่านไม่ปรกติ กรุณาตรวจสอบตู้ที่2  "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร	   
   }  
 
$res1 = notify_message($str1,$token);
print_r($res1);
$res2 = notify_message($str2,$token);
print_r($res2);
$res3 = notify_message($str3,$token);
print_r($res3);
$res4 = notify_message($str4,$token);
print_r($res4);
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
}
//https://havespirit.blogspot.com/2017/02/line-notify-php.html
//https://medium.com/@nattaponsirikamonnet/%E0%B8%A1%E0%B8%B2%E0%B8%A5%E0%B8%AD%E0%B8%87-line-notify-%E0%B8%81%E0%B8%B1%E0%B8%99%E0%B9%80%E0%B8%96%E0%B8%AD%E0%B8%B0-%E0%B8%9E%E0%B8%B7%E0%B9%89%E0%B8%99%E0%B8%90%E0%B8%B2%E0%B8%99-65a7fc83d97f
?>