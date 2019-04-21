<?php
    session_start();
	$search= $_GET[search];
 
    //$search= "68D89BC40A24";
    $con=mysqli_connect("localhost","root","Topcooling482","basiccarel");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	//$sql="SELECT * FROM sum_data";
	$sql="SELECT * FROM register WHERE chipid = '$search'"; //  WHERE chipid = '$search' 

	if ($result=mysqli_query($con,$sql))
	  {

	  }
	  while($row = mysqli_fetch_array($result))
		{
		 $tempmin = $row["tempmin"];
		 $tempmax= $row["tempmax"];
		}
    $Tsql="SELECT * FROM datalogger WHERE chipid = '$search' ORDER BY no DESC LIMIT 1";

	if ($Tresult=mysqli_query($con,$Tsql))
	  {

	  }
	  while($Trow = mysqli_fetch_array($Tresult))
		{
		 $temp = $Trow["temp"];		 
		}
    echo $temp;
	echo $tempmin;
	echo $tempmax;
	
define('LINE_API',"https://notify-api.line.me/api/notify");

if (($temp < $tempmin)||($temp > $tempmax))
	{
		$token = "BDENtj4l1yhGJcM4iXqcCAgP0NTHmRxZ2RyJSTLM0z0"; //ใส่Token ที่copy เอาไว้
        $str = "อุณหภูมิของท่านไม่ปรกติ กรุณาตรวจสอบ  $temp องศา "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
	}
 
$res = notify_message($str,$token);
print_r($res);
function notify_message($message,$token){
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
 return $res;
}
//https://havespirit.blogspot.com/2017/02/line-notify-php.html
//https://medium.com/@nattaponsirikamonnet/%E0%B8%A1%E0%B8%B2%E0%B8%A5%E0%B8%AD%E0%B8%87-line-notify-%E0%B8%81%E0%B8%B1%E0%B8%99%E0%B9%80%E0%B8%96%E0%B8%AD%E0%B8%B0-%E0%B8%9E%E0%B8%B7%E0%B9%89%E0%B8%99%E0%B8%90%E0%B8%B2%E0%B8%99-65a7fc83d97f
?>