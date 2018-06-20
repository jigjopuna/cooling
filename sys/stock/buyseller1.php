<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="content/images/favicon.png">
	<title>ใบสั่งซื้อของ.</title>
	<link rel="stylesheet" href="../../css/quotation.css">
	<script src='../js/jquery-1.11.1.min.js'></script>
	<style>
		.text_strong { font-weight: bold; }
		.text_emunder { text-decoration:underline; font-weight: bold; }
		.subpage { height: 500mm; }
		
		@media print {
			#sorn { display:none;}
		}
	</style>
	<script>
		$(document).ready(function(){
			$('#sorn').click(function(){
				$('.hide').css('display','none');
			});
		});
		
	</script>
</head>
<body>
<?php 
	require_once('../../include/connect.php');
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	$thatdate = $date."/".$nMonth."/".$year;
	
	$sql = "SELECT t.t_id, t.t_name, t.t_stock, t_cost_center, cs.cst_prod, cs.cst_five_meter, cs.cst_seller, A.count nub,  cs.cst_five_meter*A.count AS yod, sl.sl_name, sl.sl_id 
			FROM tb_count_stock cs JOIN tb_tools t ON t.t_id = cs.cst_prod 
							 JOIN (
								SELECT COUNT(*) count
								FROM tb_orders o 
								WHERE o.o_status = 1 OR o.o_status = 4 
							 ) AS A
							 JOIN tb_sellers sl ON sl.sl_id = cs.cst_seller
			WHERE t.t_stock-(cs.cst_five_meter*A.count) < 1
			ORDER BY sl.sl_id";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	/**/
?>

</head>

<body>
<div><input type='button' id='sorn' value="ซ่อน"></div>

<div class="book">
    <div class="page">
        <div class="subpage">
			
            <div id="cover_header">
				<div id="cover_header">
				<img src="../../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header--><br>
				
				
			</div><!--end cover_header-->
			
			<div id="product_price">
				<table style="width: 100%;">
					<?php 
						$compare = 0;
						for($i=1; $i<=$num; $i++){
						 $row = mysql_fetch_array($result);
						 if($i == 1){
							 $sl_id = $row['sl_id'];
							 $compare = $sl_id;
							 $change = 1;
						 }else{
							 $sl_id = $row['sl_id'];
							 $change = 0;

							if($compare != $sl_id){
								 $change = 1;
								 $compare = $sl_id;
							 }else { 
								$change = 0;
							 }							 
						 }
						 
						$yodd = $row['yod'];
						$stock = $row['t_stock'];
						$cost = $row['t_cost_center'];
						$qty = $row['cst_five_meter'];
						$nub = $row['nub'];
						$havetouse = $qty*$nub; //จำนวนที่ต้องใช้
						$buyadd = -1*($stock-$havetouse);
						if($buyadd < 0){
							$pricebuyadd = 0;
							$buyadd = 0 ;
						}else{
							 $pricebuyadd = $cost*$buyadd;
							 $money += $pricebuyadd;
						}
						 
					?>
					
					<?php if($change==1) { //ถ้าเปลี่ยนร้านให้ขึ้นแถวใหม่?>
						<tr>
							<td colspan='9' align="center">&nbsp;</td>
						</tr>
						<tr style="font-weight:bold; font-size:20px; background-color:#EEEEEE;">
							<td colspan='9' align="center"><?php echo $row['sl_name'];?></td>
						</tr>
						<tr style="font-weight:bold; background-color:#EEEEEE;">
							<td>ลำดับ</td>
							<td>รายการ</td>
							<td class="hide">สต็อค</td>
							<td class="hide">ราคาทุน</td>
							<td class="hide">ใช้ต่อห้อง</td>
							<td class="hide">จำนวนห้อง</td>
							<td class="hide">จำนวนที่ต้องใช้</td>
							<td>ต้องซื้อเพิ่ม</td>
							<td>ราคา</td>
					</tr>
					<?php } ?>
					
					<tr>
						<td><?php echo $row['t_id']; //ลำดับ?></td>
						<td><?php echo $row['t_name']; //รายการ?></td>
						<td class="hide"><?php echo number_format($stock, 0, '.', ','); //สต็อค ?></td> 
						<td class="hide"><?php echo number_format($cost, 0, '.', ',');//ราคา ?></td>
						<td class="hide"><?php echo $qty;//ใช้ต่อห้อง ?></td>
						<td class="hide"><?php echo $nub;//จำนวนห้อง ?></td>
						<td class="hide"><?php echo $havetouse;//จำนวนที่ต้องใช้ ?></td>
						<td><?php echo $buyadd; //ต้องซื้อเพิ่ม ?></td>
						<td><?php echo number_format($pricebuyadd, 0, '.', ','); //ราคาที่ต้องซื้อเพิ่ม ?></td>
					</tr>
					
					<?php } ?>
				</table>

			</div><!--end product_price-->
			
			<div id="condition" style="clear: both; margin-top: 20px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						
					</table>
				</div><br>
				<div style="width: 50%; float:left; margin-top: -17px;">
					
					<table style="width: 100%; border-collapse: collapse;">
						
					</table>
				</div>
			</div><!--end condition-->
			
			<div id="footer" style="clear: both;">
				<div style="width: 65%; float:left; margin-top: 20px;">
				
				</div>
				<div style="width: 35%; float:left; margin-top: 20px;">
					
					
				</div>
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
				
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div> <!--end page-->

    
</div>
</body>
</html>