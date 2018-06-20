<?php session_start(); 
	require_once('../include/inc_role.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$('a').hover(function(){

			$(this).children().css("opacity", "0.5");
			},

			function(){
       	    $(this).children().css("opacity", "1");

		});
			
	});
</script>
<style>
	#wrapper{ background: #EEEEEE; margin: 150px auto; width: 345px; overflow: hidden; }
	.box { width: 150px; height: 150px; float: left; margin: 10px;  }
	.box .text { margin: 60px 0 0 35px; }
	.box .text span{ font-size: 30px; }
	 a:hover { background-color: yellow; }
</style>
</head>
<body>

	<div id="wrapper">
		
		<a href="custdetail.php">
			<div class="box" style="background: #ffbb00;">
				<div class="text"><span>ข้อมูลลูกค้า</span></div>

			</div>
		</a>


		<a href="regis.html">
			<div class="box" style="background: #7cbb00;">	
				<div class="text"><span>แก้ไขราคา</span></div>
			</div>
		</a>


		<a href="cost.php">	
			<div class="box" style="background: #00a1f1;">	
				<div class="text"><span>ดูต้นทุน</span></div>
			</div>
		</a>



		<a href="../data.php" target="_blank">	
			<div class="box" style="background: #f65314;">	
				<div class="text"><span>เพิ่มรายการ</span></div>
			</div>
		</a>
		
		<a href="admin/chkprice.php">	
			<div class="box" style="background: #00a1f1;">	
				<div class="text"><span>ใส่ข้อมูลเอง</span></div>
			</div>
		</a>

	</div><!--end wrapper-->

</body>
</html>