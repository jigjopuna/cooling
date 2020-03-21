<?php	
        
		$role = mysql_fetch_array(mysql_query("SELECT * FROM tb_role WHERE ro_emp_id = '$e_id'"));
		$roles = $role['ro_report'];
		if($roles == 0){ exit("<script>alert('You not allow to access this report'); window.location = '../pages/login/login.php';</script>"); }
?>