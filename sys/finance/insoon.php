<?php session_start();
	  require_once('../include/connect.php');
	
	//เงินที่กำลังจะเข้ามา
	$sql = "SELECT c.cust_name, oid, o_cust, payamount, o_price, sub 
			FROM tb_customer c JOIN (
				SELECT o.o_id oid, o.o_cust, b.o_id, b.payamount, o.o_price,  o.o_price - b.payamount as sub
				FROM tb_orders o JOIN (
				   SELECT o_id, SUM(pay_amount) as payamount
				   FROM tb_ord_pay 
				   GROUP BY o_id) AS b
			    WHERE o.o_id = b.o_id AND o.o_status != 5) AS t
			WHERE c.cust_id = t.o_cust";
			/* other solution query
			SELECT a.cust_name, opay.o_id, SUM(opay.pay_amount) paynow, a.o_price, (a.o_price-SUM(opay.pay_amount)) remain
			FROM tb_ord_pay opay JOIN (
				SELECT ord.o_cust, ord.o_id orderid, c.cust_name, ord.o_price FROM tb_orders ord JOIN tb_customer c ON ord.o_cust = c.cust_id WHERE o_date LIKE '2018%'
			) a on  opay.o_id = a.orderid
			WHERE opay.pay_date LIKE '2018%' GROUP BY opay.o_id 
			*/
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
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
	
	$today = date("Y-m-d");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รับเงิน</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>

<script>
	$(document).ready(function(){ 
		$('.btn-success').click(validation);
		$('#paydate').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		$("#search_emp").autocomplete({
				source: "../../ajax/search_emp.php",
				minLength: 1
		});
		
		$("#search_ord").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
		});
		
		function validation(){
			var search_custname = $('#search_custname').val(); 
			var payinqty = $('#payinqty').val();
			var paydate = $('#paydate').val();
			var emp_receive = $('#emp_receive').val();
			if((search_custname=='') || (payinqty=='') || (paydate=='') || (emp_receive==0)){ 
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
			}
		}
		
	});
	
</script>

</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ยอดกำลังจะโอนเข้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ยอดกำลังจะโอนเข้า : <?php echo number_format($yod, 0, '.', ','); ?> บาท
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ลูกค้า</th> 
										<th>คงเหลือ</th>
                                        <th>ราคาขาย</th>
                                        <th>ลูกค้าจ่าย</th>
										
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td style='width: 2%;'><?php echo $i;?></td>
											<td><?php echo $row['cust_name']; ?></td>
											<td><?php echo number_format($row['sub'], 0, '.', ','); ?></td>
											<td><?php echo number_format($row['o_price'], 0, '.', ','); ?></td>
											<td><?php echo number_format($row['payamount'], 0, '.', ','); ?></td>
											
										</tr>
									<?php } ?>

                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
