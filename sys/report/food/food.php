<?php session_start();
	  require_once('../../include/connect.php');
	
?>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="../../../content/images/favicon.png">
<style>
.box { float:left; width: 100%; /*background-color:pink;*/ }
.inbox { float:left; width: 50%; /*background-color:orange;*/ }
.logo { float:left; width: 40%; }
.detail{ float:left; width: 55%; /*background-color: yellow;*/ margin-top : 20px;}
.topic{ font-size: 18px; font-weight: bold; }
.num{ font-size: 18px; font-weight: bold; color: green; }
.sum{ font-size: 30px; font-weight: bold; color: blue; padding-left: 10px; padding-top: 10px;}
</style>

<title>วัตถุดิบ อาหาร</title>
</head>
<body>

<div style="/*background-color: red;*/ width: 960px; margin:auto; height: 1000px;">
	<div class="box" style="height: 120px; margin: auto; font-size: 36px; font-weight: bold;"> <p style="margin-left: 200px;"> ประเภท วัตถุดิบ  </p></div>
	<div class="box">
		<div class="inbox">
			<div class="logo"><a href="vitamin.php?ftype=1" target="_blank"><img src="../../images/food/p1.jpg"></a></div>
			<div class="detail">
				
			
			</div>
		</div>
		
		<div class="inbox">
			<div class="logo"><a href="#" target="_blank"><img src="../../images/food/p2.jpg"></a></div>
			<div class="detail">
				
			</div>
		
		</div>
	</div>
	
	<div class="box" style="margin-top: 50px;">
		<div class="inbox">
			<div class="logo"><a href="vitamin.php?ftype=3" target="_blank"><img src="../../images/food/p3.jpg"></a></div>
			<div class="detail">
				
			</div>
		</div>
		
		<div class="inbox">
			<div class="logo"><a href="vitamin.php?ftype=4" target="_blank"><img src="../../images/food/p4.jpg"></a></div>
			<div class="detail">
				
			</div>
		
		</div>
	</div>
	
	<div class="box" style="margin-top: 50px;">
		<div class="inbox">
			<div class="logo"><a href="vitamin.php?ftype=5" target="_blank"><img src="../../images/food/p5.jpg"></a></div>
			<div class="detail">
				
			</div>
		</div>
		
		<div class="inbox">
			<div class="logo"><a href="allcust.php" target="_blank"><img src="../../images/food/p6.jpg"></a></div>
			<div class="detail">
				
			</div>
		
		</div>
	</div>
</div>


</body>
</html>