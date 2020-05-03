<?php session_start();
	  require_once('../include/connect.php');
	
	
	$resu =  mysql_fetch_array(mysql_query("SELECT * FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	
	$kbank = $resu['cash_now'];
	$kbank1 = $resu['cash_now1'];
	
	$tmb = $resu['cash1'];
	$tmb1 = $resu['cash2'];
	
	$bkk = $resu['cash_salary'];
	$bkk1 = $resu['cash_bank'];
	
	$scb = $resu['cash_emp'];
	$scb1 = $resu['cash_emp1'];
	
	$krug = $resu['cash_temp'];
	$krug1 = $resu['cash_temp1'];
	
	$sum =  $kbank + $kbank1 + $tmb + $tmb1 + $bkk + $bkk1 + $scb + $scb1 + $krug + $krug1;
	
	
	
?>
<html>
<head>
<meta charset="utf-8">
<style>
.box { float:left; width: 100%; /*background-color:pink;*/ }
.inbox { float:left; width: 50%; /*background-color:orange;*/ }
.logo { float:left; width: 40%; }
.detail{ float:left; width: 55%; /*background-color: yellow;*/ margin-top : 20px;}
.topic{ font-size: 18px; font-weight: bold; }
.num{ font-size: 18px; font-weight: bold; color: green; }
.sum{ font-size: 30px; font-weight: bold; color: blue; padding-left: 10px; padding-top: 10px;}
</style>

<title>รวมบัญชี ธนาคาร</title>
</head>
<body>

<div style="/*background-color: red;*/ width: 960px; margin:auto; height: 1000px;">
	<div class="box" style="height: 120px; margin: auto; font-size: 36px; font-weight: bold;"> <p align = "center"> รวมยอดเงิน  : <?php echo number_format($sum, 2, '.', ','); ?>  </p></div>
	<div class="box">
		<div class="inbox">
			<div class="logo"><a href="../finance/banking.php?bankcode=1" target="_blank"><img src="../images/bank/kbank_.jpg"></a></div>
			<div class="detail">
				<span class="topic"> ออมทรัพย์ :  </span> <span class="num"> <?php echo number_format($kbank, 2, '.', ','); ?>  </span><br>
				<span class="topic"> กระแสรายวัน :  </span> <span class="num"> <?php echo number_format($kbank1, 2, '.', ','); ?>  </span>
				<span class="sum"><span class="sum"><?php echo number_format($kbank+$kbank1, 2, '.', ','); ?> </span> </span>
			
			</div>
		</div>
		
		<div class="inbox">
			<div class="logo"><a href="../finance/banking.php?bankcode=2" target="_blank"><img src="../images/bank/tmb_.jpg"></a></div>
			<div class="detail">
				<span class="topic"> ออมทรัพย์ :  </span> <span class="num"> <?php echo number_format($tmb, 2, '.', ','); ?> </span><br>
				<span class="topic"> กระแสรายวัน :  </span> <span class="num"> <?php echo number_format($tmb1, 2, '.', ','); ?>  </span>
				<span class="sum"><?php echo number_format($tmb+$tmb1, 2, '.', ','); ?> </span>
			</div>
		
		</div>
	</div>
	
	<div class="box" style="margin-top: 50px;">
		<div class="inbox">
			<div class="logo"><a href="../finance/banking.php?bankcode=3" target="_blank"><img src="../images/bank/bbl_.jpg"></a></div>
			<div class="detail">
				<span class="topic"> ออมทรัพย์ :  </span> <span class="num"> <?php echo number_format($bkk, 2, '.', ','); ?>  </span><br>
				<span class="topic"> กระแสรายวัน :  </span> <span class="num"><?php echo number_format($bkk1, 2, '.', ','); ?>  </span>
				<span class="sum"><?php echo number_format($bkk+$bkk1, 2, '.', ','); ?> </span>
			</div>
		</div>
		
		<div class="inbox">
			<div class="logo"><a href="../finance/banking.php?bankcode=4" target="_blank"><img src="../images/bank/scb_.jpg"></a></div>
			<div class="detail">
				<span class="topic"> ออมทรัพย์ :  </span> <span class="num"> <?php echo number_format($scb, 2, '.', ','); ?>  </span><br>
				<span class="topic"> กระแสรายวัน :  </span> <span class="num"> <?php echo number_format($scb1, 2, '.', ','); ?>  </span>
				<span class="sum"><?php echo number_format($scb+$scb1, 2, '.', ','); ?> </span>
			</div>
		
		</div>
	</div>
	
	<div class="box" style="margin-top: 50px;" style="width: 100%;">
		<div class="inbox" style="width: 100%;">
			<div class="logo" ><a href="../finance/banking.php?bankcode=5" target="_blank"><img style="float:right;" src="../images/bank/kru_.jpg"></a></div>
			<div class="detail" style="margin-left:30px; margin-top:30px;">
				<span class="topic"> ออมทรัพย์ :  </span> <span class="num"> <?php echo number_format($krug, 2, '.', ','); ?>  </span><br>
				<span class="topic"> กระแสรายวัน :  </span> <span class="num"> <?php echo number_format($krug1, 2, '.', ','); ?>  </span><br>
				<span class="sum"><?php echo number_format($krug+$krug1, 2, '.', ','); ?> </span>
			</div>
		</div>
		
	</div>
</div>


</body>
</html>