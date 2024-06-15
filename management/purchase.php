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
	<title>ฝ่ายจัดซื้อ</title>
	<link type="text/css" rel="stylesheet" href="../css/bill.css">
	<link type="text/css" rel="stylesheet" href="../css/redmond/jquery-ui-1.8.12.custom.css">
	<link type="text/css" rel="stylesheet" href="../css/billsignature.css">
	<script src="../sys/js/jquery-1.11.1.min.js"></script>
	<script src="../js/jquery-ui-1.9.1.custom.min.js"></script>
</head>
<body>
<?php 
	/*require_once('../include/googletag.php');*/
	$e_id = $_SESSION['ss_emp_id'];
	if($e_id==""){exit("<script>alert('กรุณา Login ก่อนนะคะ');window.location = '../../sys/pages/login/login.php';</script>");}
	$corp = 1;
	
?>

<script>

	$(document).ready(function(){
		$("#corp_addr_ini").clone().appendTo(".cover_header");
		
	});
	

</script>
<style>
#bill_title { height: 40px; clear:both; margin-top: 100px; text-align: center; font-size: 1.8em; vertical-align: middle }
</style>

<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">
			<div id="corp_addr_ini">
				<?php 
					if($corp == 1){
						include ('../include/cpn_addr.php'); 
					}else if ($corp == 2) {
						include ('../include/chk_addr.php');
					}
				?>
			</div><!--end cover_header-->
				
				
			
			<div id="bill_title">
				Quality  Procedure (QP) : ระเบียบปฏิบัติด้านคุณภาพ <br>
				Purchase : กระบวนการจัดซื้อ
			</div>
			<?php include('../include/billseller.php'); ?>

			<div id="detail" style="/*background-color: olive;*/ height:500px; float: none; margin-top: 15px;">
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
						<td>แผ่นผนัง ชนิด ______ หนา ______ นิ้ว</td>
						<td align='right'> ___ </td>
						<td align='center'>แผ่น </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>2</td>
						<td>แผ่นพื้น ชนิด _______ หนา _______ นิ้ว</td>
						<td align='right'> ___ </td>
						<td align='center'>แผ่น </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					
					<tr>
						<td>3</td>
						<td>แผ่นเพดาน ชนิด _____ หนา _____ นิ้ว</td>
						<td align='right'> ___ </td>
						<td align='center'>แผ่น </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td></td>
						<td>แผ่น______ ชนิด ______ หนา ____ นิ้ว</td>
						<td align='right'> ___ </td>
						<td align='center'>แผ่น </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>4</td>
						<td>คอยล์ร้อน 1 พัดลม</td>
						<td align='right'> ___ </td>
						<td align='center'>เครื่อง </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>5</td>
						<td>คอยล์ร้อน 2 พัดลม</td>
						<td align='right'> ___ </td>
						<td align='center'>เครื่อง </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>6</td>
						<td>คอยล์เย็น 1 พัดลม</td>
						<td align='right'> ___ </td>
						<td align='center'>เครื่อง </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>7</td>
						<td>คอยล์เย็น 2 พัดลม</td>
						<td align='right'> ___ </td>
						<td align='center'>เครื่อง </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>8</td>
						<td>คอยล์เย็น 3 พัดลม</td>
						<td align='right'> ___ </td>
						<td align='center'>เครื่อง </td>
						<td align='center'> </td>
						<td align='center'> </td>  
					</tr>
					
					
					
					<tr>
						<td>9</td>
						<td>คอยล์เย็น 4 พัดลม</td>
						<td align='right'> ___ </td>
						<td align='center'>เครื่อง </td>
						<td align='center'>  </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>10</td>
						<td>ตู้คอนโทรล</td>
						<td align='right'> ___ </td>
						<td align='center'>เครื่อง </td>
						<td align='center'>  </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>11</td>
						<td>ประตูห้องเย็น</td>
						<td align='right'> ___ </td>
						<td align='center'>บาน </td>
						<td align='center'>  </td>
						<td align='center'> </td>  
					</tr>
					
					
					<tr>
						<td>12</td>
						<td>ประตูกระจก</td>
						<td align='right'> ___ </td>
						<td align='center'>บาน </td>
						<td align='center'>  </td>
						<td align='center'> </td>  
					</tr>
					
					<tr>
						<td>13</td>
						<td>วงกบประตูกระจก</td>
						<td align='right'> ___ </td>
						<td align='center'>บาน </td>
						<td align='center'>  </td>
						<td align='center'> </td>  
					</tr>
					
					
					
				</table>
			</div>
			
			<div id="note" style="/*background-color:blue;*/ overflow:hidden; height:25px; border-bottom: 1px dashed black;">
				หมายเหตุ  
			</div>
			
			<div id="summary" style="/*background-color:red;*/ overflow:hidden; /*height: 80px;*/">
				
				
				
				<div id="signature" style="margin-top:50px;">
					<div class="sign">ผู้ส่งสินค้า ...........................</div>
					<div class="sign">ผู้ตรวจสอบ ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>
					
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
							
				</div>
			</div>
			

        </div>  <!--end subpage-->
    </div> <!--end page-->
	
	
	</form>
	
</div>
</body>
</html>