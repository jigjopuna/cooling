<?php session_start();
	  require_once('../../sys/include/connect.php');
	  
	  
	  
	  
	  
	  
	   if(isset($_SESSION['ss_user_id'])){ 
		 $user_id = $_SESSION['ss_user_id'];
		 
		}else {
			$user_id = '';
		}
		
		if(isset($_SESSION['ss_user_type'])){ 
		 $user_type = $_SESSION['ss_user_type'];
		 
		}else {
			$user_type = '';
		}
		
		if(isset($productname)){ 
		 $productname = $productname;
		 
		}else {
			$productname = '';
		}

	 

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="ราคา <?php echo $productname; ?>, ราคาห้องเย็น" />
    <meta name="description" content="อยากรู้ราคา <?php echo $productname; ?> อยู่ใช่ไหมล่ะ เข้ามาดูอะไหล่และอุปกรณ์ห้องเย็นได้เลย พร้อมบริการ โดย Topcooling">
    <meta name="author" content="">
	<?php require_once('../../include/google-verify.php');?>
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $productname.' '.'ราคาและราละเอียด';?>" />
	<meta property="og:description" content="อยากรู้ราคา <?php echo $productname; ?> อยู่ใช่ไหมล่ะ เข้ามาดูอะไหล่และอุปกรณ์ห้องเย็นได้เลย พร้อมบริการ โดย Topcooling" />
	<meta property="og:image" content="../../img/product/<?php echo $cate_id;?>/fb.jpg" />

    <title><?php echo $productname.' '.'ราคาและราละเอียด';?></title>
	
	<?php require_once('../../include/inc_css.php');?>


</head>
<?php
	
		if(isset($_SESSION['ss_basket_id'])){ //เช็คว่ามีตะกร้า id แล้วหรือยัง
			 $basket_id = $_SESSION['ss_basket_id'];
		  }else{ 
			   exit("<script>alert('ยังไม่มีสินค้าในตะกร้า กรุณาเลือกสินค้าก่อนนะคะ');
					window.location = '../product/expand.php';
					</script>");
			  
		  }
	  
		/* echo 'user id : '.$user_id.'<br>';
	  echo 'user type : '.$user_type.'<br>'; */
	  
	  /*
		==========================================
		|| basket ||  login(u_id) ||
		------------------------------------------
		||   Yes  ||     No       || case 1 ได้ (หมายถึงเข้าหน้า basket ได้ พร้อมแสดงรายการสินค้าที่จะซื้อ) //guest user 
		||   Yes  ||     Yes      || case 2 ได้ (เอา id ตะกร้ามาใช้ และจะผูกกับ user id ด้วย)
		||   No   ||     Yes      || case 3 ได้ แต่ต้องดูต่อว่าลูกค้าที่ login มาแล้ว สถานะตะกร้าล่าสุดถูก checkout ไปหรือยัง
		||   No   ||     No       || case 4 ดีดกลับไปหน้าสินค้า
		||        ||              ||
		==========================================
		
	  */
	 
	 if($basket_id != '' && $user_id == ''){
		 //echo "case 1 <br>";
		 /* กรณีนี้คือลูกค้ามีของในตะกร้าแล้ว แต่ไม่ได้ login หรืออาจไม่เคย register เลย ให้แสดงตะกร้า*/
		 $sql =  "SELECT * 
				FROM (tb_inbasket inb JOIN tb_basket b ON inb.b_id = b.b_id) 
					  JOIN tb_prodacces p ON p.p_id = inb.p_id 
				WHERE inb.b_id = '$basket_id'";
		 $result = mysql_query($sql);
		 $num = mysql_num_rows($result );
		 
	 } else if($basket_id != '' && $user_id != ''){
		 //echo "case 2 <br>";
		  /* กรณีนี้ เป็นลูกค้าที่ register ไว้แล้ว และก็มีตะกร้าแล้ว  ให้เช็คต่อว่าเป็นลูกค้าประเภทไหน */
		 $sql =  "SELECT * 
				FROM (tb_inbasket inb JOIN tb_basket b ON inb.b_id = b.b_id) 
					  JOIN tb_prodacces p ON p.p_id = inb.p_id 
				WHERE inb.b_id = '$basket_id'";
		 $result = mysql_query($sql);
		 $num = mysql_num_rows($result );
		 
	 } else if($basket_id == '' && $user_id != ''){
		 //echo "case 3 <br>";
		   $fndbak = mysql_fetch_array(mysql_query("SELECT MAX(b_id) basketid FROM tb_basket WHERE u_id = '$user_id'"));
		   $basket_id = $fndbak['basketid'];
		   
		   //ถ้ามีตะกร้า และ ตะกร้ายังไม่ได้ checkout ให้ทำข้างใน
		   if($basket_id){
			    $sql =  "SELECT * 
						FROM (tb_inbasket inb JOIN tb_basket b ON inb.b_id = b.b_id) 
							  JOIN tb_prodacces p ON p.p_id = inb.p_id 
						WHERE inb.b_id = '$basket_id'";
			   $result = mysql_query($sql);
			   $num = mysql_num_rows($result );
		   }else{
			    exit("<script>alert('ยังไม่มีสินค้าในตะกร้า กรุณาเลือกสินค้าก่อนนะคะ');
				window.location = '../product/expand.php';
				</script>");
		   }
	 
	 }else{
		 
		  exit("<script>alert('ยังไม่มีสินค้าในตะกร้า ');
				window.location = '../product/expand.php';
				</script>");
	 }
	
	?>

<body id="page-top" class="index">
<?php require_once('../../include/googltag.php');?>
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <?php require_once('../../include/inc_menu_cat.php');?>
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
	
	
    


	
	<section id="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">ตะกร้าสินค้า</h2>
                    <h3 class="section-subheading text-muted">รายละเอียด  </h3>
                </div>
            </div>
            
            <div class="row">
                
					<table id="cart" class="table table-hover table-condensed table-striped">
    				<thead>
						<tr>
							<th style="width:50%">สินค้า</th>
							<th style="width:10%">ราคา (บาท)</th>
							<th style="width:8%">จำนวน</th>
							<th style="width:22%" class="text-center">รวม</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
					
					<?php 
						for($i=1; $i<=$num; $i++){
							$row = mysql_fetch_array($result);
							
							switch ($row['p_cate']) {
								case "1":
									$pdetail = "คอมเพรสเซอร์".' hp: '.$row['p_hp'].' โวลล์ : '.$row['p_volt'].' น้ำยา :  ' .$row['p_numya'];
									break;
								case "2":
									echo "Your favorite color is blue!";
									break;
								case "4":
									$pdetail = 'Expandsion '. $row['p_name'].' '.$row['p_model'].' in: '.$row['p_inlet'].' out: '.$row['p_outlet'].' for '.$row['p_numya'];
									break;
								default:
									echo "Your favorite color is neither red, blue, nor green!";
							}
					?>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin"><?php echo $row['p_name']. ' '. $row['p_model']?></h4>
										<p><?php echo $pdetail;?></p>
									</div>
								</div>
							</td>
							<td data-th="Price" align="center"><?php echo number_format($row['p_price'], 0, '.', ',');?></td>
							<td data-th="Quantity">
								<input type="number" class="form-control text-center" value="1">
							</td>
							<td data-th="Price" align="center"><?php echo number_format($row['p_price'], 0, '.', ',');?> ||</td>
							<td class="actions" data-th="">
								<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
								<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
							</td>
						</tr>
						<?php  } ?>
					</tbody>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>Total 1.99</strong></td>
						</tr>
						<tr>
							<td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"><a href="../quotation/q_add.php" class="btn btn-success btn-block">ขอใบเสนอราคา</a></td>
							<td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
							<td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
					
            </div>
        </div>
    </section>
	
	
	 
	

    <!-- Clients Aside -->
	<?php require_once('../../include/inc_expand_partner.php');?> 

    <!-- Contact Section -->
    <?php require_once('../../include/inc_contact_footer.php');?>

    <!-- Script Section -->
    <?php require_once('../../include/inc_script_footer.php');?>

    
	<script>
		$(document).ready(function(){
			$('#btn_search').click(function(){$('#form_search').submit();});	
			$('.btn_q').click(function(){window.location = '../quotation/q_add.php?p_id='+$(this).val();});
			$('.btn_buy').click(function(){window.location = '../basket/basket_add.php?p_id='+$(this).val();});
		});
	</script>
<?php require_once('../../include/debug_session.php');?>

</div>
</body>

</html>
