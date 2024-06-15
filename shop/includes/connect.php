<?php   
	   /*$host = 'localhost';
       $user = 'u175850674_top';
       $pass = 'top18553';
       $db = 'u175850674_top';*/
	   
	   $host = 'localhost';
       $user = 'topcooli_db';
       $pass = 'Webpom123456';
       $db = 'topcooli_db';
	   
	   
	   @$conn = mysqli_connect($host, $user, $pass) or exit('server fail');
       mysqli_select_db($db, $conn) or die('Not found database');
       mysqli_query('set names utf8'); 
	   
	   $httpurl = 'https://topcooling.net/';
	
	   include('inc_addbasket_id.php');
?>