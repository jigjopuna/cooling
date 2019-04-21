<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
session_start();
$con=mysqli_connect("localhost","root","Topcooling482","basiccarel");

	$mac = trim($_GET['mac']);
	echo 'MAC ADDRESS : '.$mac;
	echo "<BR>" ;
	$_SESSION['chipid'] = $mac;
	
	
	$sql="SELECT * FROM register WHERE chipid = '$mac'  "; //WHERE chipid LIKE $search 
	$result=mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	
			$cust_id = $row["cust_id"];
			//echo $row["cust_id"];
			echo "<BR>" ;
	
    $sqlID="SELECT * FROM register WHERE cust_id  = '$cust_id'  "; //WHERE chipid LIKE $search	
	if ($resultID=mysqli_query($con,$sqlID))
	  {
		$rowcount=mysqli_num_rows($resultID);
	  }
	
	if($rowcount == 1)
	{
		//ไปหน้า  index_show
		//echo $rowcount;
		echo "<meta http-equiv='refresh' content='1;URL=index_show.php?mac=$mac'>";
	}
	else if($rowcount > 1)
	{
		//ไปหน้า  index_list
		//echo $rowcount;
		echo "<meta http-equiv='refresh' content='1;URL=index_list.php?cust_id=$cust_id'>";
	}
	else if($rowcount < 1)
	{
		//ไปหน้า  register
		echo "กรุณาลงทะเบียน กล่อง IDMAC";
		//echo "<meta http-equiv='refresh' content='1;URL=register.php?mac=$mac'>";
	}
	
	
?>
</body>
</html>     