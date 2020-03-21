<?php
		
		if($_SESSION['ss_takra_admin']==""){
			$sqlintbas = "INSERT INTO tb_basket SET b_cust = 0, b_type = 'A', b_status = 0";
			$intbas = mysql_query($sqlintbas);
			
			if($intbas){ 
				$a = mysql_insert_id($conn);
				$_SESSION['ss_takra_admin'] = $a;
					
			}			
		}
		
?>