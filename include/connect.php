<?php 
       
	   
	   /*$host = 'localhost';
       $user = 'u175850674_top';
       $pass = 'top18553';
       $db = 'u175850674_top';*/
	   
	   $host = 'localhost';
       $user = 'root';
       $pass = '1234';
       $db = 'topcooling';
	   
	   
	   @$conn = mysql_connect($host, $user, $pass) or exit('server fail');
       mysql_select_db($db, $conn) or die('Not found database');
       mysql_query('set names utf8'); 
	   
	   $isuat = 1; // 1 = อยู่ในระบบ Local Host เพื่อใช้เทส
		
?>