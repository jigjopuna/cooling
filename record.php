<?php require_once('include/connect.php'); ?>

<?php
	$sql = "SELECT * 
			FROM product p JOIN suplier s ON p.p_sup = s.sup_id 
			ORDER BY p_id DESC LIMIT 0,30";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Amazon Seller </title>
<link type="text/css" rel="stylesheet" href="css/app.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
  <a href="edit.php">ดูข้อมูลแก้ไขข้อมูล </a>| <a href="report.php">ดูรายงาน</a>
    	<form id="form1" name="form" method="post" action="savedb/record_save.php">
        	<header>
                <h2>Amazon by Platinum Goods Shop</h2>
                <div></div>
            </header>
            
            <div>
              <label>Sku</label>
               <div>
                  <input type="text" name="sku">
               </div>
            </div><!--end div User Sku--->
			
            
            <div>
              <label>ASIN</label>
               <div>
                   <input type="text" name="asin">
               </div>
            </div><!--end div ASIN--->
			
			 <div>
              <label>UPC</label>
               <div>
                  <input type="text" name="upc">
               </div>
            </div><!--end div User Sku--->
			
            <hr>
             <div>
              <label>Title</label>
               <div>
                   <input type="text" name="title">
               </div>
            </div><!--end div Title--->
            
          
            <div>
              <label>Category</label>
               <div>
                  <input type="text" id="cate" name="cate">
               </div>
            </div><!--end div Category --->
            
            <div>
              <label>Cost</label>
               <div>
                    <input type="text" id="cost" name="cost">
               </div>
            </div><!--end div Cost --->
            
            <div>
              <label>Price</label>
               <div>
                   <input type="text" id="price" name="price">
               </div>
            </div><!--end div Price --->
			
			<div>
              <label>Supplier</label>
               <div>
					<select id="supplier" name="supplier">
						<option value="1">ebay</option>
						<option value="2">aliexpress</option>
						<option value="3">ebay & aliexpress</option>
						<option value="4">etsy</option>
						<option value="5">ขายเอง</option>
					</select>
               </div>
            </div><!--end div Supplier --->
            
            <div>
              <label>Link1</label>
               <div>
                    <input type="text" id="link1" name="link1">
               </div>
            </div><!--end div Link --->
			
			 <div>
              <label>Link2</label>
               <div>
                    <input type="text" id="link2" name="link2">
               </div>
            </div><!--end div Link --->
			
			<div>
              <label>Keyword</label>
               <div>
                    <input type="text" id="keyword" name="keyword">
               </div>
            </div><!--end div Keyword --->
            
            <div>
              <label>Stock</label>
               <div>
                   <input type="text" id="stock" name="stock">
               </div>
            </div><!--end div Quantity --->
			
			
			<div>
              <label>Status</label>
               <div>
                   <select id="status" name="status">
						<option value="1">มีของ</option>
						<option value="2">ไม่มีของ</option>
					</select>
               </div>
            </div><!--end div Status --->
			
			
			
			<div>
              <label>ขายได้</label>
                <div>
                   <input type="text" id="sell" name="sell"> ชิ้น
               </div>
            </div><!--end div ขายได้ --->
			
            
            <input type="submit" id="regis_confirm" class="send" value="บันทึก">
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
	<tr><td colspan='6' align="center">10 รายการที่บันทึกล่าสุด</td></tr>
	<tr>
		<td style="width: 10%">ID</td>
		<td style="width: 15%">SKU</td>
		<td style="width: 85%">NAME</td>
	</tr>
	<?php for($i=1; $i<=$num; $i++){ 
		$row = mysql_fetch_array($result);
	?>
	<tr>
		<td><?php echo $row['p_id'] ?></td>
		<td><?php echo $row['p_sku'] ?></td>	
		<td class="more"><?php echo $row['p_name'] ?></td>
	</tr>
	<tr class="moreDetail">
		<td></td>
		<td colspan=2>
			ASIN : <?php echo $row['p_asin'] ?> <br>
			Cost : $<?php echo $row['p_cost'] ?> <br>
			Price : $<?php echo $row['p_price'] ?> <br>	
			Date : <?php echo $row['p_date'] ?> <br>
			Suplier : <?php echo $row['sup_name'] ?> <br>
			Keyword : <?php echo $row['p_keyword'] ?> <br>
			Link1 : <a href="<?php echo $row['p_link1'] ?>" target="blank">ดูของ</a><br>
			Link2 : <a href="<?php echo $row['p_link2'] ?>" target="blank">ดูของ</a><br>
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
