<?php require_once('../include/connect.php'); 

	$sql = "SELECT * FROM tb_customer ORDER BY cust_id DESC ";
	$result = mysql_query($sql);
	$num	= mysql_num_rows($result);
?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Top Cooling</title>
<link type="text/css" rel="stylesheet" href="../css/app.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
	$(document).ready(function(){
		
	});
</script>
</head>
<body>

 <form id="form1" name="form" method="post" action="edit/record_edit.php">
        	<header>
                <h2>ค้นหาข้อมูลลูกค้า</h2>
                <div></div>
            </header>
            
            <div>
              <label>ชื่อลูกค้า</label>
               <div>
                  <input type="text" id="search" name="search">
               </div>
            </div><!--end div User Sku--->
        
            <input type="submit" value="ค้นหา">
 </form>
 <br><hr><br>
<table border=1 style="width: 100%">
	<tr><td colspan='4' align="center">30 รายชื่อล่าสุด</td></tr>
	<tr>
		<td style="width: 10%">ID</td>
		<td style="width: 20%">ชื่อ/บริษัท</td>
		<td style="width: 30%">จังหวัด</td>
		<td style="width: 30%">วันที่</td>
	</tr>
	<?php for($i=1; $i<=$num; $i++){ 
		$row = mysql_fetch_array($result);
	?>
	<tr>
	    <td><?php echo $row['cust_id'] ?></td>
		<td  class="more"><?php echo $row['cust_name'] ?></td>
		<td><?php echo $row['cust_province'] ?></td>	
		<td><?php echo $row['cust_date'] ?></td>
	</tr>
	<tr class="moreDetail">
		<td></td>
		<td colspan=3>
			Cust Address : <?php echo $row['cust_address'] ?> <br>
			อำเภอ :<?php echo $row['price'] ?> <br>
			ตำบล : <?php echo $row['ems_price'] ?> <br>
			เบอร์ : <?php echo $row['cust_tel'] ?> <br>
			email : <?php echo $row['cust_email'] ?> <br>
			
		</td>

	</tr>
	<?php } ?>
</table> 
	<script>
   $(document).ready(function(){
          $( ".more" ).click(function() {
                 $( ".moreDetail" ).toggle( "slow" );
           });
		  
          $('.moreDetail').hide();
          getCurrentDate();
   }); //end document ready
  
</script>
</body>
</html>
