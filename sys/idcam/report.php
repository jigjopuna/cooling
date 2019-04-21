<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />
	<link rel="shortcut icon" href="content/images/favicon.png">
	<title>ใบเสนอราคาห้องเย็น Topcooling</title>
	<link rel="stylesheet" href="https://topcooling.net/css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style>
		.text_strong { font-weight: bold; }
		.text_emunder { text-decoration:underline; font-weight: bold; }
		.container { clear:both; border: 1px solid black; min-height:850px;}
		.row { width: 100%; clear:both; padding-bottom: 60px; overflow: hidden;}
		.col1 { float:left; width:45%; margin:0.5% 0.5% 0.5% 10px; /*background:red;*/ }
		.col2 { float:left; width:51%; margin:0.5% 0.5% 0 10px; /*background:blue;*/ }
		.col3 { float:left; width:53%; margin:0.5% 0.5% 0.5% 10px; /*background:red;*/ }
		.col4 { float:left; width:43%; margin:0.5% 0.5% 0 10px; /*background:blue;*/ }
		.topic { font-family: 'Kanit', sans-serif; font-size:18px; font-weight:bold; text-decoration:underline;}
		.intopic { font-family: 'Kanit', sans-serif; font-weight:bold; }
		
		@media print { 
			 #btn-calngod { display: none !important; } 
		}

	</style>
	<script src="https://topcooling.net/sys/js/jquery-1.11.1.min.js"></script>
</head>
<body>
<script>
	$(document).ready(function(){
		
	});
	
	

</script>

<?php 
	require_once('include/connect.php');
	
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	
	$sql= "SELECT temp, time FROM datalogger WHERE chipid = 'CD0F0C334FC4' ORDER BY no DESC";
	//$result = mysql_query($sql);
	/*$num = mysql_num_rows($result);*/
?>

</head>

<body>

<div class="book">
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				
			</div><!--end cover_header-->
			
			<?php //include('../include/quotation_head.php'); ?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr style="border: solid black 1px;">
						<td style="font-size:20px; font-weight: bold; text-align:center;" colspan='2'>รายอุณหภูมิห้องเย็น<td/>
						
					</tr>
					<tr style="border: solid black 1px;">
						<td align="center">อุณหภูมิ<td/>
						<td align="center">เวลา<td/>
					</tr>
					
					
					
					<tr border='1' align="center">
						<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3</td>
						<td align="center">dfsdf</td>
					</tr>
					
					
				</table>

			</div><!--end product_price-->
	

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
</div>
</body>
</html>