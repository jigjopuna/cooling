<?php require_once('../include/connect.php'); ?>

<?
	 $o_id = trim($_GET['o_id']);
	 $sql = "SELECT * FROM orders WHERE o_id = $o_id";
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

    	<form id="form1" name="form" method="post" action="../savedb/order_update.php">
        	<header>
                <h2>Order Recode</h2>
                <div></div>
            </header>
            
            <div>
              <label>Sku</label>
               <div>
                  <input type="text" name="sku" value="<?php echo $row['o_sku'] ?>">
               </div>
            </div><!--end div User Sku--->
			
            
            <div>
              <label>Order Amazon ID</label>
               <div>
                   <input type="text" name="orderid" value="<?php echo $row['o_amazon'] ?>">
               </div>
            </div><!--end div Order ID--->
			
			 <div>
              <label>Product name</label>
               <div>
                  <input type="text" name="productname" value="<?php echo $row['p_name'] ?>">
               </div>
            </div><!--end div productname--->


            	 <div>
              <label>Order Supplier</label>
               <div>
                  <input type="text" name="ordersup" value="<?php echo $row['o_sup'] ?>">
               </div>
            </div><!--end div Order Supplier--->
			
            <hr>
             <div>
              <label>Supplier</label>
               <div>
		           <select id="supplier" name="supplier">
						<option value="1" <?php if($row['o_sup_name']==1) echo "selected"?>>ebay</option>
						<option value="2" <?php if($row['o_sup_name']==2) echo "selected"?>>aliexpress</option>
						<option value="3" <?php if($row['o_sup_name']==3) echo "selected"?>>ebay & aliexpress</option>
						<option value="4" <?php if($row['o_sup_name']==4) echo "selected"?>>etsy</option>
						<option value="5" <?php if($row['o_sup_name']==5) echo "selected"?>>ขายเอง</option>
					</select>
               </div>
            </div><!--end div Sup Name--->
			
			
			 <div>
              <label>Customer name</label>
               <div>
                  <input type="text" name="custname" value="<?php echo $row['cus_name'] ?>">
               </div>
            </div><!--end div custname--->
            
            
            <div>
              <label>Income</label>
               <div>
                    <input type="text" id="income" name="income" value="<?php echo $row['real_imcome'] ?>">
               </div>
            </div><!--end div Income --->
            
            <div>
              <label>Cost</label>
               <div>
                   <input type="text" id="cost" name="cost" value="<?php echo $row['o_cost'] ?>">
               </div>
            </div><!--end div Cost--->
			
		 <div>
              <label>Tracking ID</label>
               <div>
                   <input type="text" id="trackid" name="trackid" value="<?php echo $row['track_id'] ?>">
               </div>
            </div><!--end div Cost--->
            
            <div>
              <label>Link</label>
               <div>
                    <input type="text" id="link" name="link" value="<?php echo $row['link_track'] ?>">
               </div>
            </div><!--end div Link --->
			
			 <div>
              <label>QTY</label>
               <div>
                    <input type="text" id="qty" name="qty" value="<?php echo $row['qty'] ?>">
               </div>
            </div><!--end div qty--->
			
			<div>
              <label>Order List</label>
               <div>
                    <input type="text" id="orderlist" name="orderlist" value="<?php echo $row['o_list'] ?>">
               </div>
            </div><!--end div orderlist--->
            
            <div>
              <label>State</label>
               <div>
                   <input type="text" id="state" name="state" value="<?php echo $row['o_state'] ?>">
               </div>
            </div><!--end div state--->
	   
           <div>
              <label>Country</label>
               <div>
                   <input type="text" id="country" name="country" value="<?php echo $row['o_country'] ?>">
               </div>
            </div><!--end div country--->
 

           <div>
              <label>Cust address</label>
               <div>
                   <input type="text" id="custaddress" name="custaddress" value="<?php echo $row['c_addr'] ?>">
               </div>
            </div><!--end div custaddress--->

            <div>
              <label>Pay Method</label>
               <div>
				    <select id="paymethod" name="paymethod">
						<option value="1" <?php if($row['pay_mehthod']==1) echo "selected"?>>Alipay</option>
						<option value="2" <?php if($row['pay_mehthod']==2) echo "selected"?>>Paypal</option>
						<option value="3" <?php if($row['pay_mehthod']==3) echo "selected"?>>K-WebShopping</option>
						<option value="4" <?php if($row['pay_mehthod']==4) echo "selected"?>>Cash</option>
					</select>
               </div>
            </div><!--end div paymethod--->



         <div>
              <label>Pay Time</label>
               <div>
                   <input type="text" id="paytime" name="paytime" value="<?php echo $row['pay_time'] ?>">
               </div>
            </div><!--end div paytime--->

         <div>
            <label>Order Status</label>
               <div>
					<select id="orderstatus" name="orderstatus">
                        <option value="0" <?php if($row['o_status']==0) echo "selected"?>>Shipping Process</option>
						<option value="1" <?php if($row['o_status']==1) echo "selected"?>>Delivery</option>
                        <option value="2" <?php if($row['o_status']==2) echo "selected"?>>Refund</option>					
					</select>
               </div>
            </div><!--end div orderstatus--->
			  
            <input type="submit" id="regis_confirm" class="send" value="บันทึก">
            <input type="hidden" value="<?php echo $o_id?>" name="o_id">
        </form>
        
 <br><br>

 

</body>
</html>