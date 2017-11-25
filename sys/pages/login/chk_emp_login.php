<?php session_start();
	
	require_once('../../include/connect.php');
	$e_user = trim($_POST["e_user"]);
	$e_pass = trim($_POST["e_pass"]);
	
	
	if(isset($_SESSION['ss_basket_id'])){ 
		 $basket_id = $_SESSION['ss_basket_id'];	 
	 }
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?

	 $sql = "SELECT e_id, e_user, e_pass, e_type, e_name FROM tb_emp";
	 $result = mysql_query($sql);   
	 $num = mysql_num_rows($result); 
	 
		 for($i=1; $i<=$num; $i++) { 
			$row = mysql_fetch_array($result);
			
			$user = $row['e_user'];
			$pass = $row['e_pass'];
			
			/*echo $user.' | '. $e_user .'<br>';
			echo $pass.' | '.$e_pass.'<br>';*/
			
			if(($e_user==$user)&&($e_pass==$pass)){
				$_SESSION['ss_emp_id'] = $row['e_id'];  
			    $_SESSION['ss_emp_type'] = $row['e_type'];
				$_SESSION['ss_emp_name'] = $row['e_name'];
				exit("<script>window.location='login.php'</script>");
			}
		
		}//end for
		exit("<script>alert('Username หรือ Password ไม่ถูกต้อง'); window.location='login.php'</script>");
	
?>

</body>
</html>     