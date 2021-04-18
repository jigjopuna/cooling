<?php 
	  require_once('../include/connect.php');
	
       /* $sql = "SELECT t_id, t_name, t_cost FROM tb_tools WHERE t_type = 1";
        $result = mysql_query($sql);
        $num = mysql_num_rows($result);*/
        

	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
</head>
<body>
<?php 
echo $num.'<br>';
    for($i=2; $i<=27; $i++){
        $row = mysql_fetch_array($result);
		$names = 'คืนเงินงวดที่ '.$i;
        
        $ints = "INSERT INTO tb_po SET 
					po_name = '$names', po_cate = 2,  po_qty = 1, po_price = 10000, po_buyer =10, 
					po_emp = 3, po_shop = 61, po_credit = 1, po_date = now()

				";
        $squery = mysql_query($ints);
		//echo $row[0]. ' | ' . $row[1] . ' | '. $row[2] .'<br>';
		
    }
   
?>

</body>
</html>