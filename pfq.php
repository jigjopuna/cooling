<?php
   require_once('../include/connect.php');
   require_once('../include/thaibaht.php');
   //require_once('../savedb/cust_address.php');

    //1. receive data

    $temp_num = trim($_POST['temp_num']);
	$r_width = trim($_POST['r_width']);
	$r_length = trim($_POST['r_length']);
	$r_height = trim($_POST['r_height']);
	$vats = 7;

	$m1  = trim($_POST['m1']);
	$m2  = trim($_POST['m2']);
	$m3  = trim($_POST['m3']);
	$m4  = trim($_POST['m4']);
	$m5  = trim($_POST['m5']);
	$m6  = trim($_POST['m6']);
	$m7  = trim($_POST['m7']);
	$m8  = trim($_POST['m8']);
	$m9  = trim($_POST['m9']);
	$m10  = trim($_POST['m10']);
	$m11 = trim($_POST['m11']);
	$m12  = trim($_POST['m12']);
	
	$m1q  = str_replace(",", "",trim($_POST['m1q']));
	$m2q  = str_replace(",", "",trim($_POST['m2q']));
	$m3q  = str_replace(",", "",trim($_POST['m3q']));
	$m4q  = str_replace(",", "",trim($_POST['m4q']));
	$m5q  = str_replace(",", "",trim($_POST['m5q']));
	$m6q  = str_replace(",", "",trim($_POST['m6q']));
	$m7q  = str_replace(",", "",trim($_POST['m7q']));
	$m8q  = str_replace(",", "",trim($_POST['m8q']));
	$m9q  = str_replace(",", "",trim($_POST['m9q']));
	$m10q  = str_replace(",", "",trim($_POST['m10q']));
	$m11q = str_replace(",", "",trim($_POST['m11q']));
	$m12q  = str_replace(",", "",trim($_POST['m12q']));
	
	$m1p  = str_replace(",", "",trim($_POST['m1p']));
	$m2p  = str_replace(",", "",trim($_POST['m2p']));
	$m3p  = str_replace(",", "",trim($_POST['m3p']));
	$m4p  = str_replace(",", "",trim($_POST['m4p']));
	$m5p  = str_replace(",", "",trim($_POST['m5p']));
	$m6p  = str_replace(",", "",trim($_POST['m6p']));
	$m7p  = str_replace(",", "",trim($_POST['m7p']));
	$m8p  = str_replace(",", "",trim($_POST['m8p']));
	$m9p  = str_replace(",", "",trim($_POST['m9p']));
	$m10p  = str_replace(",", "",trim($_POST['m10p']));
	$m11p = str_replace(",", "",trim($_POST['m11p']));
	$m12p  = str_replace(",", "",trim($_POST['m12p']));
	
	$r1  = $_POST['r1'];
	$r2  = $_POST['r2'];
	$r3  = $_POST['r3'];
	$r4  = $_POST['r4'];
	$r5  = $_POST['r5'];
	$r6  = $_POST['r6'];
	$r7  = $_POST['r7'];
	$r8  = $_POST['r8'];
	$r9  = $_POST['r9'];
	

	
	$r1q  = str_replace(",", "",trim($_POST['r1q']));
	$r2q  = str_replace(",", "",trim($_POST['r2q']));
	$r3q  = str_replace(",", "",trim($_POST['r3q']));
	$r4q  = str_replace(",", "",trim($_POST['r4q']));
	$r5q  = str_replace(",", "",trim($_POST['r5q']));
	$r6q  = str_replace(",", "",trim($_POST['r6q']));
	$r7q  = str_replace(",", "",trim($_POST['r7q']));
	$r8q  = str_replace(",", "",trim($_POST['r8q']));
	$r9q  = str_replace(",", "",trim($_POST['r9q']));
	
	$r1p  = str_replace(",", "",trim($_POST['r1p']));
	$r2p  = str_replace(",", "",trim($_POST['r2p']));
	$r3p  = str_replace(",", "",trim($_POST['r3p']));
	$r4p  = str_replace(",", "",trim($_POST['r4p']));
	$r5p  = str_replace(",", "",trim($_POST['r5p']));
	$r6p  = str_replace(",", "",trim($_POST['r6p']));
	$r7p  = str_replace(",", "",trim($_POST['r7p']));
	$r8p  = str_replace(",", "",trim($_POST['r8p']));
	$r9p  = str_replace(",", "",trim($_POST['r9p']));
	
	
	$mrmixu  = str_replace(",", "",trim($_POST['mrmixu']));
	
	$crmixu  = str_replace(",", "",trim($_POST['crmixu']));
	
	$laboru  = str_replace(",", "",trim($_POST['laboru']));
	$laborp  = str_replace(",", "",trim($_POST['laborp']));
	$labort = $laboru*$laborp;
	
	$shipu  = str_replace(",", "",trim($_POST['shipu']));
	$shipp  = str_replace(",", "",trim($_POST['shipp']));
	$shipt = $shipu*$shipp;

	$timeperiod  = trim($_POST['timeperiod']);
	$temp_before  = trim($_POST['temp_before']);
	$qty  = trim($_POST['qty']);
	$totalcur  = trim($_POST['totalcur']);


	
	/*echo "temp_num : ", $temp_num, "<br>";
	echo "r_width : ", $r_width, "<br>";
	echo "r_length : ", $r_length, "<br>";
	echo "r_height : ", $r_height, "<br>";
	echo "m1 : ", $m1, "<br>"; 
	echo "m2 : ", $m2, "<br>";
	echo "m3 : ", $m3, "<br>";
	echo "m4 : ", $m4, "<br>";
	echo "m5 : ", $m5, "<br>";
	echo "m6 : ", $m6, "<br>";
	echo "m7 : ", $m7, "<br>";
	echo "m8 : ", $m8, "<br>";
	echo "m9 : ", $m9, "<br>";
	echo "m10 : ", $m10, "<br>";
	echo "m11 : ", $m11, "<br>";
	echo "m12 : ", $m12, "<br>";
	
	echo "m1q : ", $m1q, "<br>"; 
	echo "m2q : ", $m2q, "<br>";
	echo "m3q : ", $m3q, "<br>";
	echo "m4q : ", $m4q, "<br>";
	echo "m5q : ", $m5q, "<br>";
	echo "m6q : ", $m6q, "<br>";
	echo "m7q : ", $m7q, "<br>";
	echo "m8q : ", $m8q, "<br>";
	echo "m9q : ", $m9q, "<br>";
	echo "m10q : ", $m10q, "<br>";
	echo "m11q : ", $m11q, "<br>";
	echo "m12q : ", $m12q, "<br>";
	
	echo "m1p : ", $m1p, "<br>"; 
	echo "m2p : ", $m2p, "<br>";
	echo "m3p : ", $m3p, "<br>";
	echo "m4p : ", $m4p, "<br>";
	echo "m5p : ", $m5p, "<br>";
	echo "m6p : ", $m6p, "<br>";
	echo "m7p : ", $m7p, "<br>";
	echo "m8p : ", $m8p, "<br>";
	echo "m9p : ", $m9p, "<br>";
	echo "m10p : ", $m10p, "<br>";
	echo "m11p : ", $m11p, "<br>";
	echo "m12p : ", $m12p, "<br>";
	

	
	echo "r1 : ", $r1, "<br>"; 
	echo "r2 : ", $r2, "<br>";
	echo "r3 : ", $r3, "<br>";
	echo "r4 : ", $r4, "<br>"; 
	echo "r5 : ", $r5, "<br>";
	echo "r6 : ", $r6, "<br>";
	echo "r7 : ", $r7, "<br>"; 
	echo "r8 : ", $r8, "<br>";
	echo "r9 : ", $r9, "<br>";
	
	echo "r1q : ", $r1q, "<br>"; 
	echo "r2q : ", $r2q, "<br>";
	echo "r3q : ", $r3q, "<br>";
	echo "r4q : ", $r4q, "<br>"; 
	echo "r5q : ", $r5q, "<br>";
	echo "r6q : ", $r6q, "<br>";
	echo "r7q : ", $r7q, "<br>"; 
	echo "r8q : ", $r8q, "<br>";
	echo "r9q : ", $r9q, "<br>";
	
	echo "r1p : ", $r1p, "<br>"; 
	echo "r2p : ", $r2p, "<br>";
	echo "r3p : ", $r3p, "<br>";
	echo "r4p : ", $r4p, "<br>"; 
	echo "r5p : ", $r5p, "<br>";
	echo "r6p : ", $r6p, "<br>";
	echo "r7p : ", $r7p, "<br>"; 
	echo "r8p : ", $r8p, "<br>";
	echo "r9p : ", $r9p, "<br>";*/
	
	$nDay   = date("w");
	$nMonth = date("n");
	$date   = date("j");
	$year   = date("Y")+543;
	
	$thatdate = $date."/".$nMonth."/".$year;
	

	$m1t = $m1q*$m1p;
	$m2t = $m2q*$m2p;
	$m3t = $m3q*$m3p;
	$m4t = $m4q*$m4p;
	$m5t = $m5q*$m5p;
	$m6t = $m6q*$m6p;
	$m7t = $m7q*$m7p;
	$m8t = $m8q*$m8p;
	$m9t = $m9q*$m9p;
	$m10t = $m10q*$m10p;
	$m11t = $m11q*$m11p;	
	$m12t = $m12q*$m12p;
	$m_sum = $m1t + $m2t + $m3t + $m4t + $m5t + $m6t + $m7t+ $m8t + $m9t+ $m10t + $m11t + $m12t;
	$m_vat = ($m_sum*$vats)/100;
	$m_total = $m_vat+$m_sum;

	

	
	
	$r1t = $r1q*$r1p;
	$r2t = $r2q*$r2p;
	$r3t = $r3q*$r3p;
	$r4t = $r4q*$r4p;
	$r5t = $r5q*$r5p;
	$r6t = $r6q*$r6p;
	$r7t = $r7q*$r7p;
	$r8t = $r8q*$r8p;
	$r9t = $r9q*$r9p;
	$r_sum = $r1t + $r2t + $r3t + $r4t + $r5t + $r6t + $r7t+ $r8t + $r9t;
	$r_vat = ($r_sum*$vats)/100;
	$r_total = $r_vat+$r_sum;

	$bftotal = $m_total + $r_total + $labort + $shipt;
	$vatbftotal = $m_vat + $r_vat + (($labort*$vats)/100) + (($shipt*$vats)/100);

	$atotal = $bftotal + $vatbftotal;
	
	
	/*$mrmixt = 
	$crmixt = */
	
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="เช็คราคาห้องเย็น" />
	<meta name="description" content="ใบเสนอราคาห้องเย็น Quotation" />
	<title>ใบเสนอราคาห้องเย็น Topcooling</title>
</head>
<body>
<style>

body {
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 21cm;
        min-height: 31cm;
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
       /* padding: 1cm;*/
        border: 1px white solid;
        height: 256mm;
       /*outline: 2cm #FFEAEA solid;*/
    }
	table { font-size: 10pt; }
	tr { height: 25px;}
	td.rlb{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; }
	td.rlt{ border-right:solid black 1px; border-left:solid black 1px;border-top:solid black 1px; }
	td.all{ border-right:solid black 1px; border-left:solid black 1px;border-bottom:solid black 1px; border-top:solid black 1px; }
	td.rl{ border-right:solid black 1px; border-left:solid black 1px; }
	td.rt{ border-right:solid black 1px; border-top:solid black 1px; }
	td.r{ border-right:solid black 1px;  }
	td.l{ border-left:solid black 1px; padding: 0 5px 0 0; }
	td.br{ border-right:solid black 1px;  border-bottom:solid black 1px;}
	td.b{border-bottom:solid black 1px;}
	td.t{border-top:solid black 1px;}
	tr td:first-child{ padding: 0 0 0 5px; }
    
    @page {
        size: A4;
        margin: 0;
    }
	
	.punit { text-align:right; width: 75px; }
	.pdesc { width:80%; }
	
    @media print {
        .page {
            margin: 0;
            padding-top: 1.5cm;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
	
	
	
</style>
</head>

<body>
<div class="book">
<form method="post" action="pfq.php"id="form1">
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('../include/custaddress.php'); ?>
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Matchine</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ เครื่อง</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP <?php echo $temp_num?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1. <?php echo $m1;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m1q;?></td>
						<td class="l" align="right"><?php echo number_format($m1p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m1t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>2. <?php echo $m2;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m2q;?></td>
						<td class="l" align="right"><?php echo number_format($m2p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m2t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>3. <?php echo $m3;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m3q;?></td>
						<td class="l" align="right"><?php echo number_format($m3p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m3t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>4. <?php echo $m4;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m4q;?></td>
						<td class="l" align="right"><?php echo number_format($m4p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m4t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>5. <?php echo $m5;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m5q;?></td>
						<td class="l" align="right"><?php echo number_format($m5p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m5t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>6. <?php echo $m6;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m6q;?></td>
						<td class="l" align="right"><?php echo number_format($m6p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m6t, 2, '.', ',');?></td>
					</tr>
					
					
					
					<tr>
						<td>7. <?php echo $m7;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m7q;?></td>
						<td class="l" align="right"><?php echo number_format($m7p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m7t, 2, '.', ',');?></td>
					</tr>
					
					
					<tr>
						<td>8. <?php echo $m8;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m8q;?></td>
						<td class="l" align="right"><?php echo number_format($m8p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m8t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>9. <?php echo $m9;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m9q;?></td>
						<td class="l" align="right"><?php echo number_format($m9p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m9t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>10. <?php echo $m10;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m10q;?></td>
						<td class="l" align="right"><?php echo number_format($m10p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m10t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>11. <?php echo $m11;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m11q;?></td>
						<td class="l" align="right"><?php echo number_format($m11p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m11q*$m11p, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>12. <?php echo $m12;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $m12q;?></td>
						<td class="l" align="right"><?php echo number_format($m12p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m12t, 2, '.', ',');?></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($m_sum, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php  echo number_format($m_vat, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($m_total); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format($m_total, 2, '.', ',');?></td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
					<br>
				</div>
				
				
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				<span><strong><u>เงื่อนไขการคำนวณ</u> </strong></span><br>
				<span>ระยะเวลาลดอุณหภูมิสินค้า : <?php echo $timeperiod; ?> ชม. </span><br>
				<span>อุณหภูมิสินค้าก่อนเข้าห้อง :  <?php echo $temp_before;?> องศาเซลเซียส</span><br>
				<span>ปริมาณสินค้า :  <?php  echo number_format($qty, 2, '.', ','); ?>  กิโลกรัม</span><br> <br> 
				<span><strong><u>ค่าไฟเฉลี่อต่อเดือน :</u> </strong> <?php echo number_format($totalcur, 2, '.', ','); ?>  บาท (อัตราค่าไฟปกติ ไม่ใช่ TOU) </span><br> 
				

				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
				
				<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
		
		
		
		
		
		
		
		
		
    </div> <!--end page-->
    <div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('../include/custaddress1.php'); ?>
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของงานที่นำเสนอ ห้อง</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP <?php echo $temp_num?> C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width?></td>
						<td class="r"></td>
						<td><?php echo $r_length?></td>
						<td class="l"><?php echo $r_height?></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1. <?php echo $r1;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r1q;?></td>
						<td class="l" align="right"><?php echo number_format($r1p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r1t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>2. <?php echo $r2;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r2q;?></td>
						<td class="l" align="right"><?php echo number_format($r2p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r2t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>3. <?php echo $r3;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r3q;?></td>
						<td class="l" align="right"><?php echo number_format($r3p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r3t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>4. <?php echo $r4;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r4q;?></td>
						<td class="l" align="right"><?php echo number_format($r4p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r4t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>5. <?php echo $r5;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r5q;?></td>
						<td class="l" align="right"><?php echo number_format($r5p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r5t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>6. <?php echo $r6;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r6q;?></td>
						<td class="l" align="right"><?php echo number_format($r6p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r6t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>7. <?php echo $r7;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r7q;?></td>
						<td class="l" align="right"><?php echo number_format($r7p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r7t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>8. <?php echo $r8;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r8q;?></td>
						<td class="l" align="right"><?php echo number_format($r8p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r8t, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>9. <?php echo $r9;?> </td>
						<td colspan="2" class="l" align="center"><?php echo $r9q;?></td>
						<td class="l" align="right"><?php echo number_format($r9p, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r9t, 2, '.', ',');?></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php  echo number_format($r_sum, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php  echo number_format($r_vat, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($r_total); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php  echo number_format($r_total, 2, '.', ',');?></td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
				</div>
			</div><!--end footer-->
			
			
		
			<br><br><br>
			<div id="note" style="clear: both; margin: 150px 0 0 200px;">
				
				<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->
	
	</form>
	
	<div class="page">
        <div class="subpage">

            <div id="cover_header">
				<img src="../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่6 อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING LTD.,PART 28/1 M.6TRAPRUANG  NAKORN PATHOM 73000</span><br>
				<span>Tel.034-209652, 082-3601523</span><br>
				<span>เลขประจำตัวผู้เสียภาษี : 0733537000077</span>
				</div>
			</div><!--end cover_header-->
			
			
			<div id="contect_detail" style="margin-top:85px;">
				<div class="cust" style="float:left; width:65%; line-height:18px;">
					<?php require_once('../include/custaddress2.php'); ?>
				
				</div><!--end cust-->
				
				<div class="oweneraddress" style="float:left; width: 32%; line-height:18px;">
					<span><strong>Quotation  T.C.L. </strong></span><br>
					<span>วันที่ <?php echo $thatdate;?></span><br>
					<span>ติดต่อ : ชูเกียรติ เทียนอำไพ </span><br>
					<span>โทร : 082-360-1523</span><br>
					<span>Email: Topcooling.ltd@gmail.com</span>
				</div><!--end oweneraddress-->
				
				
			</div><!--end contect_detail-->
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">รายละเอียดของค่าแรงติดตั้งงานที่นำเสนอ</td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง (เมตร)</td>
						<td style="width: 13%" class="br">ยาว (เมตร)</td>
						<td style="width: 13%" class="b">สูง (เมตร)</td>
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM </td>
						<td class="l"></td>
						<td class="r"></td>
						<td></td>
						<td class="l"></td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr>
						<td>1. ชุดเครื่องทำความเย็น</td> 
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"><?php echo number_format($m_sum, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($m_sum, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>2. แผ่นฉนวนและอุปกรณ์ติดตั้ง</td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"><?php echo number_format($r_sum, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($r_sum, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>3. ค่าแรงและค่าติดตั้ง</td>
						<td colspan="2" class="l" align="center"><?php echo $laboru;?> หน่วย</td>
						<td class="l" align="right"><?php echo number_format($laborp, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($labort, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td>4. ค่าขนส่ง</td>  
						<td colspan="2" class="l" align="center"><?php echo $shipu;?> เที่ยว </td>
						<td class="l" align="right"><?php echo number_format($shipp, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($shipt, 2, '.', ',');?></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($bftotal, 2, '.', ',');?></td>
					</tr>

					<tr>
						<td></td>
						<td colspan="3" class="rl">VAT 7%</td>
						<td class="rt l" align="right"><?php echo number_format($vatbftotal, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td><?=ThaiBahtConversion($atotal); ?></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" ><?php echo number_format($atotal, 2, '.', ',');?></td>
					</tr>   
					
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;"> Description Room</td>
					</tr style="border: solid black 1px;">

					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>ราคาที่เสนอมาไม่รวมรายการดังนี้</u> </strong></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">- งานเพิ่มเติมจากแบบและ Quotation </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">- และรายการอื่นๆ ที่มิได้ระบุไว้ข้างต้น </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>เงื่อนไขการชำระเงิน </u></strong></td>
					</tr>
					<tr class="highs" style="">   
						<td class="l" colspan="5">งวดที่ 1   40%  ชำระเมื่อได้รับใบสั่งซื้อ (<?php echo number_format($atotal*0.4, 2, '.', ',');?> บาท) </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">งวดที่ 2   40% ชำระเมื่อส่งอุปกรณ์ (<?php echo number_format($atotal*0.4, 2, '.', ',');?> บาท)</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">งวดที่ 3   20% ชำระเมื่อส่งมอบงาน  (<?php echo number_format($atotal*0.2, 2, '.', ',');?> บาท)</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>การรับประกัน</strong></u> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">-  ทางบริษัทฯ มีความยินดีรับประกันเป็นระยะเวลา 1 ปี  </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">-  การรับประกันดังกล่าวมิได้รวมถึงผลเสียหายที่เกิดจากความบกพร่องของผู้ใช้งาน  </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5"><strong><u>รายละเอียดเลขที่บัญชีสำหรับโอนเงิน</u></strong></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" colspan="5">บัญชีธนาคารกสิกรไทย ชูเกียรติ เทียนอำไพ   ออมทรัพย์  เลขที่บัญชี 855-2-05499-8 </td>
					</tr>
					
				
				</table>

			</div><!--end product_price-->
			
			<div id="footer" style="clear: both; margin-top: 20px;">
				<div style="width: 65%; float:left;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
				</div>
			</div><!--end footer-->
			
			
		
			<br><br><br>
			<div id="note" style="clear: both; margin: 150px 0 0 200px;">
				
				<span>*** ราคานี้ยังไม่รวมค่าติดตั้งและค่าขนส่ง ***</span>
				
			</div><!--end note -->
			
			
        
        </div>  <!--end subpage-->
       
    </div> <!--end page-->
	
</div>
<span style="float:right;"></span>
</body>
</html>