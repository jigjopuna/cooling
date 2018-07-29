<?php
	$arrstring = array();
	$arrcredit = array();
	$arrremain = array();
	
	// ซื้อของจ่ายเงินสด หรือ สำรองจ่ายไปก่อน ชาย พี่ ส่วนกลาง
	$sql_cash = "SELECT e.e_id, e.e_name, SUM(po_price) poprice1 FROM tb_po p JOIN tb_emp e ON p.po_buyer = e.e_id WHERE p.po_date = '$dates' AND p.po_credit != 1 GROUP BY po_buyer";
	$result_cash = mysql_query($sql_cash );
	$num_cash = mysql_num_rows($result_cash);
	
	//แยกส่วนกลางแต่ละบัญชี
	$sql_cashemp = "SELECT e.e_name, SUM(po_price) priceemp FROM tb_po p JOIN tb_emp e ON p.po_subyer = e.e_id WHERE p.po_date = '$dates' GROUP BY po_subyer";
	$result_cashemp = mysql_query($sql_cashemp);
	$num_cashemp = mysql_num_rows($result_cashemp);
	
	//จ่ายเงินพนักงาน
	$sql_paysal =  "SELECT e.e_name, SUM(sal.sal_amount) salaries 
					FROM (tb_salary sal JOIN tb_cash_center cs ON sal.sal_id = cs.cash_salary)
						  JOIN tb_emp e ON e.e_id = sal.sal_emp
					WHERE sal.sal_date = '$dates'
					GROUP BY sal.sal_emp";
	$result_paysal = mysql_query($sql_paysal);
	$num_paysal = mysql_num_rows($result_paysal);
	
	
	
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
	/*
		cash_now = กองเงินรับเข้าาจากลูกค้า
		cash1 = กองเงินซื้อของ
		cash2 = กองเงินกำไร
		cash_emp = กองเงินไว้จ่ายพนักงาน
		cash_temp = กองไว้เผื่อทำอะไร
	*/
	
	$monery = mysql_fetch_array(mysql_query("SELECT cash_now, cash1, cash2, cash_emp, cash_temp FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cur_cash = number_format($monery['cash_now'], 0, '.', ','); 
	$cash1 = number_format($monery['cash1'], 0, '.', ','); 
	$cash2 = number_format($monery['cash2'], 0, '.', ',');
	$cash_emp = number_format($monery['cash_emp'], 0, '.', ',');	
	$cash_temp = number_format($monery['cash_temp'], 0, '.', ',');
	//ค่าใช้จ่ายทั้งหมดวันนี้ทั้ง เงินสดและเครดิต
	$sumdates = mysql_fetch_array(mysql_query("SELECT SUM(po_price) paydates FROM tb_po WHERE po_date = '$dates'"));
	$paydates = number_format($sumdates['paydates'], 0, '.', ',');
	
	
	//โยกย้ายเงิน  
	/*
		23 หมายถึงโยกย้ายเงินจากชายไปพี่ไพรฑูรย์ 
		24 โยกย้ายเงินจากพี่ไพรฑูรย์ ไป ชาย
	*/
	$sql_trancash = "SELECT cash_id, cash_salary, cash_now, cash1, cash2 FROM tb_cash_center WHERE (cash_salary = 23 OR cash_salary = 24) AND cash_date = '$dates'";
	$result_trancash = mysql_query($sql_trancash);
	$num_trancash = mysql_num_rows($result_trancash);
	
	$nkpt = 2;
	$ktb  = 3;

	//-----------------------นครปฐม---------------------------------
	//ซื้อ
	$rowbuynkpt = mysql_fetch_array(mysql_query("SELECT COUNT(po_id) countpo, SUM(po_price) sumpo FROM tb_po WHERE po_date = '$dates' AND po_subyer = $nkpt"));
	$cntbuynkpt = $rowbuynkpt['countpo'];
	$sumbuynkpt = number_format($rowbuynkpt['sumpo'], 0, '.', ',');
	
	
	//เพิ่มสต็อค
	$rowstknkpt = mysql_fetch_array(mysql_query("SELECT SUM(pu.pu_qty*t.t_cost_center) coststk, COUNT(pu.pu_id) countpu FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $nkpt"));
	$cntstknkpt = $rowstknkpt['countpu'];
	$coststknkpt = number_format($rowstknkpt['coststk'], 0, '.', ',');

	//เบิก
	$rowburknkpt = mysql_fetch_array(mysql_query("SELECT COUNT(orpd.orpd_id) countburk, SUM(orpd.orpd_cost) costburk FROM tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd_date = '$dates' AND orpd_wh = $nkpt"));
	$cntburknkpt = $rowburknkpt['countburk'];
	$costburknkpt = number_format($rowburknkpt['costburk'], 0, '.', ',');
	
	//nktp cash center
	$rowcashnkpt = mysql_fetch_array(mysql_query("SELECT cash1 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cashnkpt = number_format($rowcashnkpt['cash1'], 0, '.', ',');
	
	//ซื้อ
	$sql_ponkpt = "SELECT po_id, po_subyer, po_buyer, po_name, po_price, po_date FROM tb_po WHERE po_date = '$dates' AND po_subyer = $nkpt";
	$result_ponkpt = mysql_query($sql_ponkpt);
	$num_ponkpt = mysql_num_rows($result_ponkpt);
	
	
	//เพิ่มสต็อค
	$sql_stknkpt = "SELECT pu.pu_id, pu.pu_qty, pu.pu_date, t.t_name, t.t_cost_center, t.t_stock, t.t_stock1 FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $nkpt";
	$result_stknkpt = mysql_query($sql_stknkpt);
	$num_stknkpt = mysql_num_rows($result_stknkpt);
	
	
	//เบิก
	$sql_burknkpt = "SELECT t.t_name, t.t_cost_center, orpd.orpd_id, orpd.orpd_qty, orpd.orpd_date, e.e_name, c.cust_name FROM (((tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp) JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_customer c ON c.cust_id = o.o_cust WHERE orpd_date = '$dates' AND orpd.orpd_wh = $nkpt";
	$result_burknkpt = mysql_query($sql_burknkpt);
	$num_burknkpt = mysql_num_rows($result_burknkpt);
  
    /*echo "num_ponkpt : ".$num_ponkpt.'<br>';
	echo "num_stknkpt : ".$num_stknkpt.'<br>';
	echo "num_burknkpt : ".$num_burknkpt.'<br>';*/
	
	//exit();
	
	//----------------------------กระทุ่มแบน--------------------------------
	
	//ซื้อ
	$rowbuyktb = mysql_fetch_array(mysql_query("SELECT COUNT(po_id) countpo, SUM(po_price) sumpo FROM tb_po WHERE po_date = '$dates' AND po_subyer = $ktb"));
	$cntbuynktb = $rowbuyktb['countpo'];
	$sumbuyktb = number_format($rowbuyktb['sumpo'], 0, '.', ',');
	
	
	//เพิ่มสต็อค
	$rowstkktbt = mysql_fetch_array(mysql_query("SELECT SUM(pu.pu_qty*t.t_cost_center) coststk, COUNT(pu.pu_id) countpu FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $ktb"));
	$cntstkktb = $rowstkktb['countpu'];
	$coststkktb = number_format($rowstkktb['coststk'], 0, '.', ',');

	//เบิก
	$rowburkktb = mysql_fetch_array(mysql_query("SELECT COUNT(orpd.orpd_id) countburk, SUM(orpd.orpd_cost) costburk FROM tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id WHERE orpd_date = '$dates' AND orpd_wh = $ktb"));
	$cntburkktb = $rowburkktb['countburk'];
	$costburkktb = number_format($rowburkktb['costburk'], 0, '.', ',');
	
	//nktp cash center
	$rowcashktb = mysql_fetch_array(mysql_query("SELECT cash1 FROM tb_cash_center ORDER BY cash_id DESC LIMIT 1"));
	$cashktb = number_format($rowcashktb['cash1'], 0, '.', ',');
	
	//ซื้อ
	$sql_poktb = "SELECT po_id, po_subyer, po_buyer, po_name, po_price, po_date FROM tb_po WHERE po_date = '$dates' AND po_subyer = $ktb";
	$result_poktb = mysql_query($sql_poktb);
	$num_poktb = mysql_num_rows($result_poktb);
	
	
	//เพิ่มสต็อค
	$sql_stkktb = "SELECT pu.pu_id, pu.pu_qty, pu.pu_date, t.t_name, t.t_cost_center, t.t_stock, t.t_stock1 FROM tb_pushstock pu JOIN tb_tools t ON t.t_id = pu.pu_tid WHERE pu_date = '$dates' AND pu.pu_wh = $ktb";
	$result_stkktb = mysql_query($sql_stkktb);
	$num_stkktb = mysql_num_rows($result_stkktb);
	
	
	//เบิก
	$sql_burkktb = "SELECT t.t_name, t.t_cost_center, orpd.orpd_id, orpd.orpd_qty, orpd.orpd_date, e.e_name, c.cust_name FROM (((tb_ord_prod orpd JOIN tb_tools t ON t.t_id = orpd.ot_id) JOIN tb_emp e ON e.e_id = orpd.ot_emp) JOIN tb_orders o ON o.o_id = orpd.o_id) JOIN tb_customer c ON c.cust_id = o.o_cust WHERE orpd_date = '$dates' AND orpd.orpd_wh = $ktb";
	$result_burkktb = mysql_query($sql_burkktb);
	$num_burkktb = mysql_num_rows($result_burkktb);
	
	
	$money = mysql_fetch_array(mysql_query("
		SELECT SUM(s.sub) total FROM (
			SELECT c.cust_name, oid, o_cust, payamount, o_price, sub 
			FROM tb_customer c JOIN (
				SELECT o.o_id oid, o.o_cust, b.o_id, b.payamount, o.o_price,  o.o_price - b.payamount as sub
				FROM tb_orders o JOIN (
					 SELECT o_id, SUM(pay_amount) as payamount
					 FROM tb_ord_pay 
					 GROUP BY o_id) AS b
					WHERE o.o_id = b.o_id AND o.o_status != 5) AS t
				WHERE c.cust_id = t.o_cust
			) as s
		"));
	
	$yod = $money['total'];

	
?>