<?php require_once('include/connect.php'); 

	$sql = "SELECT * FROM tb_categoryroom ORDER BY catr_id ";
	$result = mysql_query($sql);
	$num	= mysql_num_rows($result);
?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Top Cooling</title>
<link type="text/css" rel="stylesheet" href="css/app.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
	$(document).ready(function(){

	});
</script>
</head>
<body>

    	<form id="form1" name="form" method="post" action="savedb/product_room.php">
        	<header>
                <h2>กรอกฐานข้อมูล topcooling</h2>
                <div></div>
            </header>
            
			 <div>
              <label>หมวดหมู่</label>
               <div>
					<select id="pr_category" name="pr_category">
						<?php 
							for($i=1; $i<=$num; $i++){
								$row = mysql_fetch_array($result);
						?>
						<option value="<?php echo $row[catr_id]?>"><?php echo $row[catr_name]?></option>	
						<?php } ?>
					</select>
               </div>
            </div><!--end div vr_type -->
			
            <div>
              <label>ยี่ห้อ</label>
               <div>
                  <input type="text" name="brand">
               </div>
            </div><!--end div  brand-->
			
			<div class="size">
              <label>ขนาด</label>
               <div>
                    <input type="text" name="size" id="size" >
               </div>
            </div><!--end div size -->
			
			
			<div class="size">
              <label>ขนาด ประตู, ม่าน</label>
               <div>
                    <input style="width: 20%" type="text" name="length" id="length" placeholder="ยาว">
					<input style=" margin-left:20px; width: 20%" type="text" name="width" id="width" placeholder="กว้าง">			
               </div>
            </div><!--end div size -->
			
			<div class="types">
              <label>Types</label>
               <div>
                    <input type="text" name="types" id="types">
               </div>
            </div><!--end div types -->
			
			
			<div class="types">
              <label>ความหนาแน่น</label>
               <div>
                    <input type="text" name="density" id="density">
               </div>
            </div><!--end div types -->
			
			
			<div class="temp">
              <label>อุณหภูมิ</label>
               <div>
                    <input type="text" name="temp">
               </div>
            </div><!--end div Temp1 -->
			
			<div>
              <label>ราคาเต็ม</label>
               <div>
                  <input type="text" name="price">
               </div>
            </div><!--end div price-->
			
			<div>
              <label>ราคาขาย</label>
               <div>
                  <input type="text" name="sell_price">
               </div>
            </div><!--end div sell_price-->
			

	<input type="submit" value="Save">
			
 </form>
 <br><hr><br>
 <form id="form1" name="form" method="post" action="edit/record_edit.php">
        	<header>
                <h2>Search Product</h2>
                <div></div>
            </header>
            
            <div>
              <label>SKU / ASIN / Order</label>
               <div>
                  <input type="text" id="search" name="search">
               </div>
            </div><!--end div User Sku--->
        
            <input type="submit" value="หาของ">
 </form>
 <br><hr><br>
<table border=1 style="width: 100%">
	<tr><td colspan='4' align="center">30 รายการที่บันทึกล่าสุด</td></tr>
	<tr>
		<td style="width: 10%">ID</td>
		<td style="width: 20%">VR</td>
		<td style="width: 30%">Customer Name</td>
		<td style="width: 30%">Province</td>
	</tr>
	<?php for($i=1; $i<=$num; $i++){ 
		$row = mysql_fetch_array($result);
	?>
	<tr>
	    <td><?php echo $row['v_id'] ?></td>
		<td  class="more"><?php echo $row['t_name'] ?></td>
		<td><?php echo $row['cust_name'] ?></td>	
		<td><?php echo $row['cust_province'] ?></td>
	</tr>
	<tr class="moreDetail">
		<td></td>
		<td colspan=3>
			Cust Address : <?php echo $row['cust_address'] ?> <br>
			Price : ฿<?php echo $row['price'] ?> <br>
			EMS : <?php echo $row['ems_price'] ?> <br>
			EMS Tracking : <?php echo $row['ems_tracking'] ?> <br>
			Date : <?php echo $row['dates'] ?> <br>
			shop : <?php if ($row['chanel']==0) echo "Online"; else echo "LAZADA" ?> <br>
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
