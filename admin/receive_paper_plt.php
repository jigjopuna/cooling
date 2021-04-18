<?php session_start();
	  require_once('../include/connect.php');
      require_once('../include/thaibaht.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="ราคาห้อง และโฟม" />
	<meta name="description" content="ราคาห้อง และโฟม" />
	<?php require_once('../sys/include/metatagsys.php');?>
	<title>ใบเสร็จรับเงิน</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
	<style>
		#signature { width: 100%; /*background-color:red;*/ float:none; overflow:hidden; margin-top: 200px; height:35px;}
		.sign { float: left; width: 33%; }
		.sign1 { float: right; width: 33%; }
	</style>
</head>
<body>
<?php 
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../../sys/pages/login/login.php';</script>");}
	
	$depo_id = trim($_GET['depo_id']);
	
	
	$row_cust = mysql_fetch_array(mysql_query(" SELECT * 
												FROM (((tb_deposit d JOIN tb_cust_depo c ON d.d_cust = c.cuplt_id) 
													JOIN tumbon t ON c.cuplt_tumbon = t.id) JOIN amphur a ON c.cuplt_amphur = a.id) 
													JOIN province p ON c.cuplt_province = p.id 
												WHERE d.d_id = '$depo_id'"));
	
	$dprice = $row_cust['d_price'];
	
	
?>

<script>

	$(document).ready(function(){
		$("#corp_addr_ini").clone().appendTo(".cover_header");
		
	});
	

</script>

<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
				<?php 
					include ('../include/plt_addr.php');
				?>
			</div><!--end cover_header-->
				
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				<?php //echo $bill_head;?>
				ใบฝากสินค้า / ใบแจ้งหนี้
			</div>
			<?php include('../include/billdetail_plt.php'); ?>

			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width: 100%;">
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align='center'>จำนวน</td>
						<td style="width:12%;" align='center'>หน่วยนับ</td>
						<td style="width:12%;" align='center'>ราคา</td>
						<td style="width:12%;" align='center'>รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>ฝากแช่สินค้า <?php echo $row_cust['d_prod']?>  อุณหภูมิ <?php echo $row_cust['d_temp']?> องศา </td>
						<td align='right'><?php echo number_format($row_cust['d_qty'], 0, '.', ',');?></td>
						<td align='center'>kg</td>
						<td align='center'>2.00</td>
						<td align='center'><?php echo number_format($dprice, 2, '.', ',');?></td>  
					</tr>
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p><?=ThaiBahtConversion($row_cust['d_price']); ?></p><br>
					
					
					
					
					
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.กสิกรไทย บจก.พระลักษณ์ไทย เลขที่บัญชี 085-3-28289-8 (ออมทรัพย์)  
					</p>
					
					
					
				
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right"><?php echo number_format($dprice, 2, '.', ',');?></td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td><?php if($vattype==1)  echo 'ภาษีมูลค่าเพิ่ม'; ?>  </td>
							<td align="right"><?php if($vattype==1)  echo number_format($vatprice*0.07, 2, '.', ','); else echo '';?></td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right"><?php echo number_format($dprice, 2, '.', ',');?></td>
						</tr>
					</table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;สุภาพร  ค้าทวี&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;ภิญญา โชคอุตสาหะ&nbsp;&nbsp;)</div>		
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	<div class="page">
        <div class="subpage">

            <div class="cover_header">
				
			</div><!--end cover_header-->
			
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				ใบแจ้งหนี้/ใบวางบิล
			</div>
			
			<?php include('../include/billdetail.php'); ?>
			
			
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width:100%">
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align='center'>จำนวน</td>
						<td style="width:12%;" align='center'>หน่วยนับ</td>
						<td style="width:12%;" align='center'>ราคา</td>
						<td style="width:12%;" align='center'>รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>ห้องเย็นเก็บสินค้า อุณหภูมิ <?php echo $row_order['o_temp']?> องศา ขนาดวัดภายนอก <?php echo $row_order['o_width'].' x '.$row_order['o_size'].' x '.$row_order['o_high'];?> เมตร (งวดที่ 2)</td>
						<td align='right'>1</td>
						<td align='center'>ห้อง</td>
						<td align='center'><?php echo number_format($ngod2, 0, '.', ',');?></td>
						<td align='center'><?php echo number_format($ngod2, 0, '.', ',');?></td>  
					</tr>
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  <?php echo ' จากยอดเต็ม : '.number_format($vatprice, 0, '.', ',').' บาท'?>
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p><?=ThaiBahtConversion($ngod2); ?></p><br>
					<?php if($corp == 1){  ?>
					
					
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.กรุงเทพ  บจก.ซีพีเอ็น888 เลขที่บัญชี 520-0-45057-4 (สะสมทรัพย์)  
					</p>
					
					<?php } else if ($corp == 2) { ?>
					
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.กสิกรไทย ท็อปคูลลิ่ง  เลขที่บัญชี 047-8-18623-1  (ออมทรัพย์)  
					</p>
					
					<?php } else if ($corp == 3) { ?>
						<p style="line-height:150%;">
						
					</p>
					<? } else { ?>
						<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.กสิกรไทย บจก.พระลักษณ์ไทย เลขที่บัญชี 085-3-28289-8 (ออมทรัพย์)  
					</p>
					<? }  ?>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right"><?php echo number_format($ngod2, 2, '.', ',');?></td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td><?php if($vattype==1)  echo 'ภาษีมูลค่าเพิ่ม'; ?>  </td>
							<td align="right"><?php if($vattype==1)  echo number_format($vatprice*0.07, 2, '.', ','); else echo '';?></td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right"><?php echo number_format($ngod2, 2, '.', ',');?></td>
						</tr>
					</table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;นายภูริชญ์ โชคอุตสาหะ &nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;<?php if($corp_addr == 1){ echo 'นายภูริชญ์ โชคอุตสาหะ'; }else{ echo 'นายภูริชญ์ โชคอุตสาหะ';}	?>&nbsp;&nbsp;)</div>		
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	<div class="page">
        <div class="subpage">
			<div class="cover_header">
				
			</div><!--end cover_header-->
			<div id="bill_title" style="/*background-color:green;*/ height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 2em; vertical-align: middle;">
				ใบแจ้งหนี้/ใบวางบิล
			</div>
			
			<?php include('../include/billdetail.php'); ?>
			
			
			<div id="detail" style="/*background-color: olive;*/ height:300px; float: none; margin-top: 15px;">
				<table style="width:100%">
					<tr>
						<td style="width:5%;">No.</td>
						<td style="width:40%;">รายการ</td>
						<td style="width:7%;" align='center'>จำนวน</td>
						<td style="width:12%;" align='center'>หน่วยนับ</td>
						<td style="width:12%;" align='center'>ราคา</td>
						<td style="width:12%;" align='center'>รวมเงิน</td>
					</tr>
					<tr>
						<td colspan="6"> <hr> </td>
					</tr>
					
					<tr>
						<td>1</td>
						<td>ห้องเย็นเก็บสินค้า อุณหภูมิ <?php echo $row_order['o_temp']?> องศา ขนาดวัดภายนอก <?php echo $row_order['o_width'].' x '.$row_order['o_size'].' x '.$row_order['o_high'];?> เมตร (งวดที่ 3)</td>
						<td align='right'>1</td>
						<td align='center'>ห้อง</td>
						<td align='center'><?php echo number_format($ngod3, 0, '.', ',');?></td>
						<td align='center'><?php echo number_format($ngod3, 0, '.', ',');?></td>  
					</tr>
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  <?php echo ' จากยอดเต็ม : '.number_format($vatprice, 0, '.', ',').' บาท'?>
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 200px;*/">
				<div id="pricetext" style="float:left; width:65%; /*background-color:brown;*/">
			
					<p><?=ThaiBahtConversion($ngod3); ?></p><br>
					<?php 
						if($corp == 2){
						
					?>
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.กสิกรไทย ท็อปคูลลิ่ง  เลขที่บัญชี 047-8-18623-1  (ออมทรัพย์)  
					</p>
					
					<?php } else { ?>
					
					<p style="line-height:150%;">
						* ได้รับสินค้าตามรายการข้างต้นในสภาพที่เรียบร้อยจำนวนสินค้าและราคาถูกต้องแล้ว<br>
						* เอกสารฉบับนี้จะสมบูรณ์ต่อเมื่อได้เรียกเก็บเงินจากลูกค้าหรือเช็คผ่านธนาคารเรียบร้อยแล้ว<br>
						* ธ.กรุงเทพ  บจก.ซีพีเอ็น888 เลขที่บัญชี 520-0-45057-4 (สะสมทรัพย์)  
					</p>
					
					<?php } ?>
				
				</div>
				
				<div id="price" style="float:left; width:34%; /*background-color:orange;*/ height:150px; border: 1px dashed black;  border-radius: 10px; padding-left:10px; padding-top: 10px;">
					<table style="width: 98%;">
						<tr>
							<td style="width:60%;">มูลค่าสินค้า </td>
							<td align="right"><?php echo number_format($ngod3, 2, '.', ',');?></td> 
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						
						<tr>
							<td>&nbsp; </td>
							<td> </td>
						</tr>
						<tr>
							<td><?php if($vattype==1)  echo 'ภาษีมูลค่าเพิ่ม'; ?>  </td>
							<td align="right"><?php if($vattype==1)  echo number_format($vatprice*0.07, 2, '.', ','); else echo '';?></td>
						</tr>
						<tr>
							<td>รวมทั้งสิ้น </td>
							<td align="right"><?php echo number_format($ngod3, 2, '.', ',');?></td>
						</tr>
					</table>
				
				</div>
				
				<div id="signature">
					<div class="sign">ผู้อนุมัติ ...........................</div>
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;นายภูริชญ์ โชคอุตสาหะ &nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;<?php if($corp_addr == 1){ echo 'นายภูริชญ์ โชคอุตสาหะ'; }else{ echo 'นายภูริชญ์ โชคอุตสาหะ';}	?>&nbsp;&nbsp;)</div>		
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	</form>
	
</div>
</body>
</html>