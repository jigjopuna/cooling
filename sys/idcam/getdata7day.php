<?php

session_start();
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include 'config.php';
 
 $chipid = "68D89BC40A24" ;
 $S = "2019-02-07" ;
 $F = "2019-02-11" ;
 
//$SQL = "SELECT * FROM datalogger WHERE (time between '2018-12-21' and '2018-12-22')"; ใช้เลือกวันที่ต้องการ
//$SQL = "SELECT COUNT(in1) FROM datalogger WHERE (time between '2019-01-22' and '2019-01-23') AND in1 LIKE 'true'"; //ใช้นับข้อมูลในฟิลล์ที่ละ1
$IN1 = "SELECT COUNT(in1) FROM datalogger WHERE (time between '$S' and '$F') AND in1 LIKE 'true' AND chipid = '$chipid'";
$IN2 = "SELECT COUNT(in2) FROM datalogger WHERE (time between '$S' and '$F') AND in2 LIKE 'true' AND chipid = '$chipid'";
$IN3 = "SELECT COUNT(in3) FROM datalogger WHERE (time between '$S' and '$F') AND in3 LIKE 'true' AND chipid = '$chipid'";
$IN4 = "SELECT COUNT(in4) FROM datalogger WHERE (time between '$S' and '$F') AND in4 LIKE 'true' AND chipid = '$chipid'";
$IN5 = "SELECT COUNT(in5) FROM datalogger WHERE (time between '$S' and '$F') AND in5 LIKE 'true' AND chipid = '$chipid'";
$IN6 = "SELECT COUNT(in6) FROM datalogger WHERE (time between '$S' and '$F') AND in6 LIKE 'true' AND chipid = '$chipid'";
$IN7 = "SELECT COUNT(in7) FROM datalogger WHERE (time between '$S' and '$F') AND in7 LIKE 'true' AND chipid = '$chipid'";
$IN8 = "SELECT COUNT(in8) FROM datalogger WHERE (time between '$S' and '$F') AND in8 LIKE 'true' AND chipid = '$chipid'";
$OUT1 = "SELECT COUNT(out1) FROM datalogger WHERE (time between '$S' and '$F') AND out1 LIKE 'true' AND chipid = '$chipid'";
$TEMPMAX = "SELECT MAX(temp) FROM datalogger WHERE (time between '$S' and '$F') AND chipid = '$chipid'";
$TEMPMIN = "SELECT MIN(temp) FROM datalogger WHERE (time between '$S' and '$F') AND chipid = '$chipid'";
$TIME = "SELECT time FROM datalogger WHERE (time between '$S' and '$F')  AND chipid = '$chipid'";
$SEND = "SELECT periodSend FROM datalogger WHERE (time between '$S' and '$F') AND chipid = '$chipid'";
$CHIPID = "SELECT chipid FROM datalogger WHERE (time between '$S' and '$F') AND chipid = '$chipid'";


foreach($conn->query($IN1) as $ROW1);
{
	$data1 = $ROW1['COUNT(in1)']  ;
	echo  $data1  ;
}
foreach($conn->query($IN2) as $ROW2);
{
	$data2 = $ROW2['COUNT(in2)']  ;
	echo  $data2 ;
}
foreach($conn->query($IN3) as $ROW3);
{   
    $data3 = $ROW3['COUNT(in3)']  ;
	echo  $data3 ;
}
foreach($conn->query($IN4) as $ROW4);
{
	$data4 = $ROW4['COUNT(in4)']  ;
	echo  $data4 ;
}
foreach($conn->query($IN5) as $ROW5);
{
	$data5 = $ROW5['COUNT(in5)']  ;
	echo  $data5 ;
}
foreach($conn->query($IN6) as $ROW6);
{
	$data6 = $ROW6['COUNT(in6)']  ;
	echo  $data6 ;
}
foreach($conn->query($IN7) as $ROW7);
{
	$data7 = $ROW7['COUNT(in7)']  ;
	echo  $data7 ;
}
foreach($conn->query($IN8) as $ROW8);
{
	$data8 = $ROW8['COUNT(in8)'] ;
	echo  $data8 ;
}
foreach($conn->query($OUT1) as $ROW9);
{
	$data9 = $ROW9['COUNT(out1)'] ;
	echo  $data9 ;
}
foreach($conn->query($TEMPMAX) as $ROW10)
{
	$data10 = $ROW10['MAX(temp)'] ;
	echo  $data10 ;
}
foreach($conn->query($TEMPMIN) as $ROW11);
{
	$data11 = $ROW11['MIN(temp)'] ;
	echo  $data11  ;
}
foreach($conn->query($CHIPID) as $ROW12);
{
	$data12 = $ROW12['chipid'] ;
	echo  $data12  ;
}
foreach($conn->query($TIME) as $ROW13);
{
	$data13 = $ROW13['time'] ;
	echo  $data13  ;
}
foreach($conn->query($SEND) as $ROW14);
{
	$data14 = $ROW14['periodSend'] ;
	echo  $data14  ;
}


$strSQL = "INSERT INTO sum_data (chipid,in1,in2,in3,in4,in5,in6,in7,in8,temp_max,temp_min,out1,periodSend,time)
           VALUES ('$data12','$data1','$data2','$data3','$data4','$data5','$data6','$data7','$data8','$data10','$data11','$data9','$data14','$data13')";

$objQuery = mysqli_query($conn,$strSQL);
	if($objQuery)
	{
		echo "Save Done.";
	}
	else
	{
		echo "Error Save ";	
	}
/*
$sql = "DELETE FROM datalogger WHERE (time between '$S' and '$F') AND chipid = '$chipid'";	
$objSQL = mysqli_query($conn,$sql);
	if($objSQL)
	{
		echo "DELETE Done.";
	}
	else
	{
		echo "Error DELETE ";	
	}
*/
	
  
?>

