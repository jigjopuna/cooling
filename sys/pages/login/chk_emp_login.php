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
	

	/*echo "user: ".$user. '<br>';
	echo "pass: ".$pass. '<br>';
	echo "numya: ".$numya. '<br>';*/
	
	 $sql = "SELECT e_id, e_user, e_pass, e_type FROM tb_emp";
	 $result = mysql_query($sql);   
	 $num = mysql_num_rows($result); 
		 for($i=1; $i<=$num; $i++) { //start for 
			$row = mysql_fetch_array($result);
				/*if($username == "" || $password=="") {
					mysql_close($conn);
					echo 1;
					exit;
				}*/
					
			if($e_user == strtolower($row['e_user'])&& $e_pass == $row['e_pass']){
				$_SESSION['ss_emp_id'] = $row['e_id'];  
			    $_SESSION['ss_emp_type'] = $row['e_type'];
				
				exit("<script>window.location='login.php'</script>");
			}else{
				exit("<script>alert('Username หรือ Password ไม่ถูกต้อง'); window.location='login.php'</script>");
			}
		}//end for
	
	
?>

</body>
</html>     