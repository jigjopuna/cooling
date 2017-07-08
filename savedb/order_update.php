<?php require_once('../include/connect.php');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
	//1. receive data
	$o_id = trim($_POST['o_id']);
	$sku  = trim($_POST['sku']);
	$orderid= trim($_POST['orderid']);
	$custname= trim($_POST['custname']);
	$ordersup = $_POST['ordersup'];
	$custaddress= trim($_POST['custaddress']);
	$income= trim($_POST['income']);
	
	$supplier  = trim($_POST['supplier']);
	$cost = trim($_POST['cost']);
	$trackid= $_POST['trackid'];
	$link= $_POST['link'];
	$qty= $_POST['qty'];
	$orderlist= $_POST['orderlist'];
	$state= $_POST['state'];
    $country= $_POST['country'];
    $paymethod= $_POST['paymethod'];
    $paytime= $_POST['paytime'];
    $orderstatus= $_POST['orderstatus'];
	$p_name= $_POST['productname'];
	
       

     /*echo 'sku : '; echo $sku ; echo '<br>';
echo 'orderid: '; echo $orderid; echo '<br>';
echo 'custname: '; echo $custname; echo '<br>';
echo 'ordersup : '; echo $ordersup ; echo '<br>';
      echo 'custaddress: '; echo $custaddress; echo '<br>';
echo 'income: '; echo $income; echo '<br>';
echo 'supplier  : '; echo $supplier  ; echo '<br>';
echo 'cost : '; echo $cost ; echo '<br>';
      echo 'trackid: '; echo $trackid; echo '<br>';
echo 'link: '; echo $link; echo '<br>';
echo 'qty: '; echo $qty; echo '<br>';
echo 'orderlist: '; echo $orderlist; echo '<br>';
      echo 'state: '; echo $state; echo '<br>';
echo 'country: '; echo $country; echo '<br>';
echo 'paymethod: '; echo $paymethod; echo '<br>';
echo 'orderstatus: '; echo $orderstatus; echo '<br>';*/


	//2. insert into database	
	$sql = "UPDATE orders SET  
			o_sku='$sku', 
			o_amazon ='$orderid', 
			o_sup ='$ordersup ', 
			p_name ='$p_name', 
			o_sup_name='$supplier  ', 
			cus_name='$custname', 
			real_imcome ='$income', 
			o_cost='$cost ', 
			track_id='$trackid', 
			link_track='$link', 
			qty='$qty', 
            o_list='$orderlist', 			
			o_state='$state', 
			pay_mehthod='$paymethod', 
            o_status = '$orderstatus', 
            c_addr = '$custaddress', 
            o_country = '$country ',  
            pay_time='$paytime' WHERE o_id=$o_id";
	$result1 = mysql_query($sql);
	exit("
		<script>
			alert('อัปเดทข้อมูลแล้วจ๊ะอีหมู');
			window.location='../order.php';
		</script>
	");
	
?>
</body>
</html>