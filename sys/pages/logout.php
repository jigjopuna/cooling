<?php
//include("include/function.php");
	session_start();
	//session_unregister("ss_username"); //ทำลายทีละตัว
	session_destroy(); //ทำลายทั้งหมด
	
	exit("<script>window.location='login.php';</script>");
?>