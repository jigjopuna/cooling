<?php
	$arrstring = array();
	$arrcredit = array();
	$arrremain = array();
	
	// ซื้อของจ่ายเงินสด หรือ สำรองจ่ายไปก่อน
	$sql_cash = "SELECT e.e_id, e.e_name, SUM(po_price) poprice1 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE p.po_date = '$dates' AND p.po_credit != 1 GROUP BY po_buyer";
	$result_cash = mysql_query($sql_cash );
	$num_cash = mysql_num_rows($result_cash);
	
	// ซื้อของแบบเครดิต ยังไม่จ่ายเงิน
	$sql_credit = "SELECT e.e_id, e.e_name, SUM(po_price) poprice1 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE p.po_date = '$dates' AND p.po_credit = 1 GROUP BY po_buyer";
	$result_credit = mysql_query($sql_credit);
	$num_credit = mysql_num_rows($result_credit);
	
	//ยอดเงินเข้าทั้งหมดวันนี้รวมของทุกคน
	$in_come = mysql_fetch_array(mysql_query("SELECT SUM(pay_amount) income FROM tb_ord_pay WHERE pay_date = '$dates' "));
	$incomes = number_format($in_come['income'], 0, '.', ',');
	
	
	//เงินเข้าวันนี้แยกตามคนรับเงิน
	$sql_income = "SELECT e.e_id, e.e_name, SUM(pay_amount) income FROM tb_ord_pay ord JOIN tb_emp e ON e.e_id = ord.o_emp_receive WHERE pay_date = '$dates' GROUP BY ord.o_emp_receive";
	$result_income = mysql_query($sql_income);
	$num_income = mysql_num_rows($result_income);

	//เครดิตคงค้างที่ยังไม่ได้จ่าย
	$sql_remain = "SELECT e.e_id, e.e_name, SUM(po_price) poprice2 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE p.po_credit = 1 AND p.po_credit_complete != 1 GROUP BY po_buyer";
	$result_remain = mysql_query($sql_remain);
	$num_remain = mysql_num_rows($result_remain);

	//เงินกองกลางคงเหลือ
	$monery = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cur_cash = number_format($monery['cash_now'], 0, '.', ','); 
	$cash1 = number_format($monery['cash1'], 0, '.', ','); 
	$cash2 = number_format($monery['cash2'], 0, '.', ','); 
	
	//ค่าใช้จ่ายทั้งหมดวันนี้ทั้ง เงินสดและเครดิต
	$sumdates = mysql_fetch_array(mysql_query("SELECT SUM(po_price) paydates FROM tb_po WHERE po_date = '$dates'"));
	$paydates = number_format($sumdates['paydates'], 0, '.', ',');
	

	
?>