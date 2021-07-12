<?php
		$e_id = $_SESSION['ss_emp_id'];
		if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../pages/login/login.php';</script>");}
		$role = mysql_fetch_array(mysql_query("SELECT * FROM tb_role WHERE ro_emp_id = '$e_id'"));
		
		$role_c = mysql_fetch_array(mysql_query("SELECT e_company FROM tb_emp WHERE e_id = '$e_id'"));
		$role_company = $role_c['e_company'];
?>