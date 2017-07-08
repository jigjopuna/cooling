<?php require_once('include/connect.php'); 

	$sql = "SELECT * FROM tb_category ORDER BY cat_id ";
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
		$(".kg, .thin, .inlet, .outlet, .types").hide();
		$("#category").change(choose);
		
		function choose(){
			/*var a = $('#category :selected').val();*/			
			var cats = this.value;
			if(cats==1){
				$(".kw1, .kw2, .kg, .hp, .hz, .volt, .amp, .temp1, .temp2, .size").show('slow');
				$(".tempExpand, .kg, .thin, .inlet, .outlet, .types, .numya").hide('slow');
				
			}else if(cats==2){
				$(".kw1, .kw2, .hz, .volt, .amp, .temp1, .temp2, .size ").show('slow');
				$(".tempExpand, .kg, .thin, .kg, .inlet, .outlet, .hp, .types, .numya").hide('slow');
			}else if(cats==3){
				$(".kw1, .kw2, .hp, .hz, .volt, .amp, .size ").show('slow');
				$(".tempExpand, .kg, .thin,.kg, .inlet, .outlet, .temp1, .temp2, .numya").hide('slow');
			}else if(cats==4){
				$(".hp, .hz, .volt, .amp, .temp1, .temp2, .size, .types, .kg, .thin, .kw1, .kw2" ).hide('slow');
				$(".inlet, .outlet, .numya, .tempExpand").show('slow');
			}else if(cats==5){
				$(" .tempExpand, .kw1, .kw2, .hp, .hz, .volt, .amp, .temp1, .temp2, .kg, .thin, .numya, .inlet, .outlet").hide('slow');
				$(".size, .types").show('slow');
			}else if(cats==6){
				$(".tempExpand, .kw1, .kw2, .hp, .hz, .volt, .amp, .temp1, .temp2, .types, .numya, .kg").hide('slow');
				$(".size, .thin").show('slow');
			}else if(cats==7){
				$(".tempExpand, .kw1, .kw2, .hp, .hz, .volt, .amp, .temp1, .temp2, .size, .types, .numya, .inlet, .outlet").hide('slow');
				$(".kg").show('slow');
				
			}
			
			
			
		}//end fn choose
		
	});
</script>
</head>
<body>

    	<form id="form1" name="form" method="post" action="savedb/product.php">
        	<header>
                <h2>กรอกฐานข้อมูล topcooling</h2>
                <div></div>
            </header>
            
			 <div>
              <label>หมวดหมู่</label>
               <div>
					<select id="category" name="category">
						<?php 
							for($i=1; $i<=$num; $i++){
								$row = mysql_fetch_array($result);
						?>
						<option value="<?php echo $row[cat_id]?>"><?php echo $row[cat_name]?></option>	
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
			
			<div>
              <label>Model</label>
               <div>
                    <input type="text" name="model">
               </div>
            </div><!--end div model -->
				

			<hr>
			
			
			<div class="types">
              <label>Types</label>
               <div>
                    <input type="text" name="types" id="types">
               </div>
            </div><!--end div types -->
			
			<div class="size">
              <label>ขนาด</label>
               <div>
                    <input type="text" name="size" id="size">
               </div>
            </div><!--end div size -->
			
			
			<div class="hp">
              <label>HP</label>
               <div>
                  <input type="text" name="hp" id="hp">
               </div>
            </div><!--end div hp-->
			
            
			<div class="kw2">
              <label>Liq</label>
               <div>
                    <input type="text" name="kw2" id="kw2">
               </div>
            </div><!--end div kw2 -->
   
            <div class="kw1">
              <label>Suc</label>
               <div>
                    <input type="text" name="kw1" id="kw1">
               </div>
            </div><!--end div kw1 -->
			
			
			 <div class="volt">
              <label>Volt</label>
               <div>
                    <input type="text" name="volt" id="volt">
               </div>
            </div><!--end div volt -->

			
			<div class="amp">
              <label>Amp</label>
               <div>
                    <input type="text" name="amp" id="amp">
               </div>
            </div><!--end div amp-->
			
			<div class="hz">
              <label>HZ</label>
               <div>
                    <input type="text" name="hz">
               </div>
            </div><!--end div hz -->
			
			
			<div class="tempExpand">
              <label>TempExpand</label>
               <div>
                    <input type="text" name="tempExpand">
               </div>
            </div><!--end div Temp1 -->
			
			
			<div class="temp1">
              <label>Temp1</label>
               <div>
                    <input type="text" name="temp1">
               </div>
            </div><!--end div Temp1 -->
			
			<div class="temp2">
              <label>Temp2</label>
               <div>
                    <input type="text" name="temp2">
               </div>
            </div><!--end div Temp2 -->
			
			<div class="kg">
              <label>KG</label>
               <div>
                    <input type="text" name="kg" id=kg">
               </div>
            </div><!--end div kg -->
			
			<div class="thin">
              <label>ความหนา</label>
               <div>
                    <input type="text" name="thin" id="thin">
               </div>
            </div><!--end div ความหนา -->
			
			<div class="inlet">
              <label>Inlet</label>
               <div>
                    <input type="text" name="inlet">
               </div>
            </div><!--end div Inlet -->
			
			<div class="outlet">
              <label>Outlet</label>
               <div>
                    <input type="text" name="outlet">
               </div>
            </div><!--end div outlet -->
			
			<div class="numya">
              <label>น้ำยา</label>
               <div>
                    <input type="text" name="numya">
               </div>
            </div><!--end div น้ำยา -->
			

			<hr>
			
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
