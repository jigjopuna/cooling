<?php 
       
	   $host = 'localhost';
       $user = 'root';
       $pass = 'Topcooling482';
       $db = 'basiccarel';
	   
	   
	   //@$conn = mysql_connectli($host, $user, $pass) or exit('server fail');
      // mysql_select_db($db, $conn) or die('Not found database');
      // mysql_query('set names utf8'); 
	   $conn = mysqli_connect($host, $user, $pass, $db) or exit('server fail');
	   
		
?>