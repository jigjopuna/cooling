<?php 
	//คำสั่งเชื่อมต่อฐานข้อมูล
	include('include/connect.php');
	
	//ดึงข้อมูลจากฐานข้อมูล
	$sql = "SELECT t_id, t_name, t_cost FROM tb_tools";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//echo $result;exit();
	 
?>
<html>
<head>
<meta charset="utf-8">
<title>guitar</title>
	<style>
		/*
			# อ้างอิงถึง id
			. อ้างอิงถึง class
			html tag
		*/
		#box1 { color:red; background-color: yellow; height:100px; width:50%; float:left; }
		#box2 { color:red; background-color: green; height:200px; width:50%; float:left; }
		.product { border: 1px solid black; width:60%; margin-top:20px; }
		table { }
	
	
	</style>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script>
		$(document).ready(function(){
			$('#button').click(function(){
				$("#product").toggle();
			});
		});
	</script>

</head>
<body>
	<div id="box1"> 
		<div style="float:left;"><img src="https://topcooling.net/content/images/logo-small-cpn.jpg"> </div>
		<div style="float:left;">ยินดีต้อนรับเข้าสู่ Ecommerce</div>
	</div>
	
	<div id="box2">div กล่องที่ 2</div>
	
	<div> <input id="button" type="button" value="show product"> </div>
	
	<div> 
		<table class="product" id="product">
			<tr>
				<td>ลำดับ</td>
				<td>รหัสสินค้า</td>
				<td>รายการ</td>
				<td>ราคา</td>
			</tr>
			
			<?php for($i=1; $i<= $num; $i++){ 
				$row = mysql_fetch_array($result);
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['t_id']?></td>
					<td><?php echo $row['t_name']?></td>
					<td><?php echo $row['t_cost']?></td>
				</tr>
				
			<?php } ?>	
			
		</table>
	</div>
</body>
</html>