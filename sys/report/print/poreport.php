<?php require_once('../../include/connect.php'); ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="../../content/images/favicon.png">
	<title>รายงาน</title>
</head>
<body>
<?php 
		$dates = trim($_GET['dates']);
		
		$result_po = mysql_query("SELECT e.e_name, p.po_bill_img, p.po_shop, p.po_buyer, p.po_subyer, p.po_name, p.po_price, p.po_qty, p.po_credit, p.po_credit_complete, p.po_date FROM tb_po p JOIN tb_emp e ON e.e_id = p.po_buyer WHERE p.po_date LIKE '$dates'");
		$num_po = mysql_num_rows($result_po);
		
		$rowsum_ = mysql_fetch_array(mysql_query("SELECT SUM(po_price) poprice FROM tb_po WHERE po_date LIKE '$dates'"));		  
		$rowcount_ = mysql_fetch_array(mysql_query("SELECT count(po_id) countpo FROM tb_po WHERE po_date LIKE '$dates'"));
		$rowsum = $rowsum_['poprice'];
		$rowcount = $rowcount_['countpo'];
?>
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
.box {width: 45%; float:left; margin-left: 20px; padding-bottom: 20px;}
#header{ background-color:#EEEEE; width: 100%; text-align: center; height:60px; font-size: 2em;  }
.header{ background-color:#EEEEE; width: 100%; text-align: center; height:50px; font-size: 2em;  }
.header1{ background-color:#EEEEE; width: 100%; text-align: center; height:40px; font-size: 1.7em;  }
.topic { font-size: 18px; font-weight: bold; text-decoration: underline; }
#pay, #income { border-bottom: 1px solid #EEEEEE; overflow: hidden; margin-bottom:35px;}

</style>
</head>

<body>

<div class="book">
	<div class="page">
        <div class="subpage">
			<div id="header">สรุป ค่าใช้จ่าย </div>
			<div class="header">ประจำวันที่ <?php echo $dates; ?></div>
			<div id="podetail" style="/*background-color:olive;*/ width:100%; /*height:200px;*/ float:none; overflow:hidden;">
				
					<table style="width:100%; border: 1px solid black;">
						<tr>
							<td colspan="6" align="center">รายการสั่งซื้อ / ค่าใช้จ่าย <?php echo $rowcount;?> รายการ</td>
						</tr>
						<tr>
							<td>#</td>
							<td>รายการ</td>
							<td>จำนวน</td>
							<td>ราคา</td>
							<th>ร้านค้า</th>
							<td>วันที่</td>
						</tr>
						<?php for($i=1; $i<=$num_po; $i++) {  
							$row_po = mysql_fetch_array($result_po);
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row_po['po_name'];?></td>
								<td><?php echo $row_po['po_qty'];?></td>
								<td><?php echo number_format($row_po['po_price'], 0, '.', ',');?></td>
								<td><?php echo $row_po['po_shop'];?></td>
								<td><?php echo $row_po['po_date'];?></td>
							</tr>
						<?php } ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo number_format($rowsum, 0, '.', ',');?> บาท</td>
							<th>&nbsp;</th>
							<td>&nbsp;</td>
						</tr>
					</table>
					
					<br><br>
					
					
					
						
					
				
			</div>

        </div>  <!--end subpage-->
    </div> <!--end page-->
</div>
</body>
</html>