<?php session_start(); 
      require_once('../../include/connect.php'); 
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>STOCK ปริ้น</title>
    <?php 
	
	 require_once('../../include/metatagsys.php');
	 require_once('../../include/inc_role.php'); 
	 require_once('../../include/inc_ro_report.php'); 
	 
	 ?>
</head>
<body>
<?php 
		$dates = date("Y-m-d");
		
		$result_stock = mysql_query("SELECT t_id, t_name, t_cost, t_stock, t_cost*t_stock as total FROM tb_tools WHERE t_install = 1  ORDER BY total DESC");
		$num_stock = mysql_num_rows($result_stock);
		
		$rowsum = mysql_fetch_array(mysql_query("
					SELECT SUM(tv.total) as rumrum
					FROM (
						SELECT  t_cost*t_stock as total
						FROM tb_tools
						WHERE t_install = 1 
						ORDER BY t_cost DESC)AS tv"));		
		$all = $rowsum['rumrum'];
?>
    <link rel="stylesheet" href="../../../css/quotation.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<style>
		#report_detail table tr{ font-size: 12px; height: 8px; }
		@media print { 
			 #btn-calngod,  #btn-addroom { display: none !important; } 
		}

	</style>

</style>
</head>

<body>

<div class="book">
	<div class="page">
        <div class="subpage">
			<div id="cover_header">
				<img src="../../../content/images/logo-small.jpg" style="float:left;">
				<div style="float:left; line-height:18px; margin: 0 0 0 40px;">
				
				<span>ห้างหุ้นส่วนจำกัด ท๊อปคูลลิ่ง 28/1 หมู่ 6 ต.ทัพหลวง อ.เมือง จ.นครปฐม 73000 (สำนักงานใหญ่)</span><br>
				<span>TOP COOLING Co.,Ltd,PART 28/1 M.6 TRAPRUANG MOUNG NAKORN PATHOM 73000</span><br>
				<span>Tel. 082-360-1523, 064-458-5689 &nbsp;&nbsp;&nbsp; เลขประจำตัวผู้เสียภาษี : 0733537000077 </span><br>
				<span>Web:  www.topcooling.net</span>
				</div>
			</div><!--end cover_header-->
			
			<div class="header_report" style="padding-top: 50px;"><p>STOCK ติดตั้ง </p></div>
			<div class="header_report header_date" style="margin-top: -25px;"><p>วันที่ <?php echo $dates; ?></p></div>
			<div id="report_detail" style="width:100%; /*height:200px;*/ float:none; overflow:hidden;">
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">รายการ STOCK ขึ้นห้อง <?php echo $num_stock;?> รายการ | <?php echo number_format($all, 0, '.', ',');?> บาท</td>
						</tr>
						<tr>
							<td style="width:3%;">###</td>
							<td align="center" style="width:15%;">รหัส</td>
							<td align="center" style="width:42%;">ชื่อรายการ</td>
							<td align="center" style="width:10%;">ต้นทุน</td>
							<td align="center" style="width:7%;">จำนวน</td>
							<th align="center" style="width:20%;">รวมราคา</th>
						</tr>
						<?php for($i=1; $i<=$num_stock; $i++) {  
							$row_stock = mysql_fetch_array($result_stock);
						?>
						
							<?php 
								$page = 56;
								if($i==45 || $i==102 || $i==158 || $i==214 || $i==271 || $i==327 || $i==384 || $i==443 || $i==500){ 
									
							?>
							    <tr>
									<td colspan='6' style="height:100px;">&nbsp;</td>
									
								</tr>
							<?php } ?>
								<tr>
									<td align="center"><?php echo $i.'.';?></td>
									<td align="center"><?php echo $row_stock['t_id'];?></td>
									<td align="center"><?php echo $row_stock['t_name'];?></td>
									<td align="center"><?php echo number_format($row_stock['t_cost'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row_stock['t_stock'], 0, '.', ',');?></td>
									<td align="center"><?php echo number_format($row_stock['total'], 0, '.', ',');?></td>
								</tr>
						<?php } ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo number_format($all, 0, '.', ',');?> </td>
							<td>บาท</td>
						</tr>
					</table>
					
					<br><br>
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>