<?php require_once('../include/connect.php'); ?>
<?php 
	//1. receive data
	$sku  = trim($_POST['sku']);

	//2. insert into database	
	$sql = "SELECT * FROM product WHERE p_sku = '$sku'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Amazon Seller </title>
<link type="text/css" rel="stylesheet" href="../css/style.css">
</head>
<body>

  <a href="../record.php">หน้าหลัก </a>| <a href="../report.php">ดูรายงาน</a>
    	<form id="form1" name="form" method="post" action="savedb/record_save.php">
        	<header>
                <h2>แก้ไขข้อมูลรายการสินค้า  :  <?php echo $row['p_name']?></h2>
                <div></div>
            </header>
            
            <div>
              <label>Sku</label>
               <div>
                  <input type="text" name="sku" value="<?php echo $row['p_sku']?>">
               </div>
            </div><!--end div User Sku--->
			
            
            <div>
              <label>ASIN</label>
               <div>
                   <input type="text" name="asin" value="<?php echo $row['p_asin']?>">
               </div>
            </div><!--end div ASIN--->
			
			 <div>
              <label>UPC</label>
               <div>
                  <input type="text" name="upc" value="<?php echo $row['p_upc']?>">
               </div>
            </div><!--end div User Sku--->
			
            <hr>
             <div>
              <label>Title</label>
               <div>
                   <input type="text" name="title" value="<?php echo $row['p_name']?>">
               </div>
            </div><!--end div Title--->
            
          
            <div>
              <label>Category</label>
               <div>
                  <input type="text" id="cate" name="cate" value="<?php echo $row['p_cate']?>">
               </div>
            </div><!--end div Category --->
            
            <div>
              <label>Cost</label>
               <div>
                    <input type="text" id="cost" name="cost" value="<?php echo $row['p_cost']?>">
               </div>
            </div><!--end div Cost --->
            
            <div>
              <label>Price</label>
               <div>
                   <input type="text" id="price" name="price" value="<?php echo $row['p_price']?>">
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
                    <input type="text" id="link1" name="link1"  value="<?php echo $row['p_link1']?>">
               </div>
            </div><!--end div Link --->
			
			 <div>
              <label>Link2</label>
               <div>
                    <input type="text" id="link2" name="link2" value="<?php echo $row['p_link2']?>">
               </div>
            </div><!--end div Link --->
			
			<div>
              <label>Keyword</label>
               <div>
                    <input type="text" id="keyword" name="keyword" value="<?php echo $row['p_keyword']?>">
               </div>
            </div><!--end div Keyword --->
            
            <div>
              <label>Stock</label>
               <div>
                   <input type="text" id="stock" name="stock" value="<?php echo $row['p_stock']?>">
               </div>
            </div><!--end div Quantity --->
			
			
			<div>
              <label>Status</label>
               <div>
                   <select id="stat" name="stat">
						  	<option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="vw">VW</option>
  <option value="audi" selected="selected">Audi</option>
					</select>
               </div>
            </div><!--end div Status --->
			
			
			
			<div>
              <label>ขายได้</label>
                <div>
                   <input type="text" id="sell" name="sell" value="<?php echo $row['p_sell']?>"> ชิ้น
               </div>
            </div><!--end div ขายได้ --->
			
            
            <input type="submit" id="regis_confirm" class="send" value="บันทึก">
			
			
      
        </form>
           
    
</body>
</html>     