<?php 
	  require_once('../include/connect.php');
	
        $sql = "SELECT t_id, t_name, t_cost FROM tb_tools WHERE t_type = 1";
        $result = mysql_query($sql);
        $num = mysql_num_rows($result);
        

	
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
    for($i=1; $i<=$num; $i++){
        $row = mysql_fetch_array($result);
        
        $ints = "INSERT INTO tb_product SET p_ref = '$row[0]', p_name = '$row[1]', p_price = '$row[2]', p_publish = 1, p_cate = 0";
        $squery = mysql_query($ints);
		echo $row[0]. ' | ' . $row[1] . ' | '. $row[2] .'<br>';
		
    }
   
?>

</body>
</html>