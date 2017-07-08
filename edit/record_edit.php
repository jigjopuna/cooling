<?php require_once('../include/connect.php'); ?>

<?
	 $p_id = trim($_POST['search']);
	 //echo $p_id; exit();
	 $sql = "SELECT * FROM product WHERE p_sku = '$p_id'";
     $result = mysql_query($sql);
	 $row = mysql_fetch_array($result);
	 
?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Amazon Seller </title>
<link rel="stylesheet" type="text/css" href="../css/app.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
	<form id="form1" name="form" method="post" action="record_edit.php">
				<header>
					<h2>Product Edit</h2>
				</header>
				
				<div>
				  <label>Sku</label>
				   <div>
					  <input type="text" name="sku" value="<?php echo $row['p_sku'] ?>">
				   </div>
				</div><!--end div User Sku--->
				
				
				<div>
				  <label>ASIN</label>
				   <div>
					   <input type="text" name="asin" value="<?php echo $row['p_asin'] ?>">
				   </div>
				</div><!--end div ASIN--->
				
				 <div>
				  <label>UPC</label>
				   <div>
					  <input type="text" name="upc" value="<?php echo $row['p_upc'] ?>">
				   </div>
				</div><!--end div User Sku--->
				
				<hr>
				 <div>
				  <label>Title</label>
				   <div>
					   <input type="text" name="title" value="<?php echo $row['p_name'] ?>">
				   </div>
				</div><!--end div Title--->
				
			  
				<div>
				  <label>Category</label>
				   <div>
					  <input type="text" id="cate" name="cate" value="<?php echo $row['p_cate'] ?>">
				   </div>
				</div><!--end div Category --->
				
				<div>
				  <label>Cost</label>
				   <div>
						<input type="text" id="cost" name="cost" value="<?php echo $row['p_cost'] ?>">
				   </div>
				</div><!--end div Cost --->
				
				<div>
				  <label>Price</label>
				   <div>
					   <input type="text" id="price" name="price" value="<?php echo $row['p_price'] ?>">
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
						<input type="text" id="link1" name="link1" value="<?php echo $row['p_link1'] ?>">
				   </div>
				</div><!--end div Link --->
				
				 <div>
				  <label>Link2</label>
				   <div>
						<input type="text" id="link2" name="link2" value="<?php echo $row['p_link2'] ?>">
				   </div>
				</div><!--end div Link --->
				
				<div>
				  <label>Keyword</label>
				   <div>
						<input type="text" id="keyword" name="keyword" value="<?php echo $row['p_keyword'] ?>">
				   </div>
				</div><!--end div Keyword --->
				
				<div>
				  <label>Stock</label>
				   <div>
					   <input type="text" id="stock" name="stock" value="<?php echo $row['p_stock'] ?>">
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
				
				
				<input type="submit" id="regis_confirm" class="send" value="ยืนยันแก้ไข">
	 </form> 

</body>
</html>