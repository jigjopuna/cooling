<?php require_once('connect.php');
   
   $sql = "SELECT t_id
			FROM tb_tools 
			WHERE t_install = 1 AND t_id NOT IN  (SELECT cst_prod 
			FROM tb_count_stock) ORDER BY t_id";
   $result = mysql_query($sql);
   $num = mysql_num_rows($result);
   
  for($i=1; $i<= $num; $i++){
	  $row = mysql_fetch_array($result);
	   $vari = $row[t_id];
	   
	   mysql_query("INSERT tb_count_stock SET cst_prod = '$vari'");
  }
	   
   
	
?>