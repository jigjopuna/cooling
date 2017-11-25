<?php

	session_start();

	session_destroy(); //ทำลายทั้งหมด
	
	exit("<script> alert ('Thank You');window.location='../../index.php';</script>");
?>