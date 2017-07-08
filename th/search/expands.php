<?php 
    require_once('../../sys/include/connect.php');
	
	$productname = trim($_POST["productname"]);
	$cate_id = trim($_POST["cate_id"]);
	
	
	$brand = trim($_POST["brand_search"]);
	$inlet = trim($_POST["inlet_search"]);
	$outlet = trim($_POST["outlet_search"]);
	$numya = trim($_POST["numya_search"]);
	$price = trim($_POST["price_search"]);
	$count_first_and = 0;
	$condition = '';
	
	/*echo "brand: ".$brand. '<br>';
	echo "inlet: ".$inlet. '<br>';
	echo "outlet: ".$outlet. '<br>';
	echo "numya: ".$numya. '<br>';
	echo "price: ".$price. '<br>';*/
	//http://stackoverflow.com/questions/8731504/php-multiarray-loop-where-clause
	
	$sql = "SELECT * FROM tb_prodacces WHERE ";
	
	// sql เป็นการ query ต่อเนื่อง ว่าลูกค้าจะใช้เงื่อนไขใดในการค้นหา ถ้าลูกค้าเลือก ก็ให้มาเป็นเงื่อนไขในการค้นหา ถ้าไม่เลือกก็ไม่ต้องเอามา query
	// condition โชว์เฉพาะเงื่อนไขที่ลูกค้าเลือก
	
	//brand ต้องไม่เป็นค่าว่างหรือเป็น 0 
	if($brand != '' && $brand != '0'){
		if($count_first_and==0){
			$sql .= " p_name = '$brand'"; 
			$count_first_and = 1;
		}else{
			$sql .= " AND p_name = '$brand'"; 
		}	
		$condition = "ยี่ห้อ : ". $brand ;
	}
	
	
	if($inlet !='' && $inlet != '0'){
		if($count_first_and==0){
			$sql .= " p_inlet = '$inlet'"; 
			$count_first_and = 1;
		}else{
			$sql .= " AND p_inlet = '$inlet'"; 
		}
		$condition .= " |  ท่อเข้า : ". $inlet ;
	}	
	
	if($outlet !='' && $outlet != '0'){
		if($count_first_and==0){
			$sql .= " p_outlet = '$outlet'"; 
			$count_first_and = 1;
		}else{
			$sql .= " AND p_outlet = '$outlet'"; 
		}
		$condition .= " |  ท่อออก : ". $outlet ;
	}
	
	
	if($numya !='' && $numya != '0'){
		if($count_first_and==0){
			$sql .= " p_numya = '$numya'"; 
			$count_first_and = 1;
		}else{
			$sql .= " AND p_numya LIKE '%$numya%'"; 
		} 
		$condition .= " |  น้ำยา : ". $numya ;
	}
	
	
	if($price !=''&& $price != '0' ){
		if($price==1){
			$prict_st = 2000;
			$prict_en = 5000;
		}else if($price==2){
			$prict_st = 5000;
			$prict_en = 7000;
		}else if($price==3){
			$prict_st = 7000;
			$prict_en = 12000;
		}else{
			$prict_st = 12000;
			$prict_en = 20000;
		}
		if($count_first_and==0){
			$sql .= " p_price BETWEEN '$prict_st' AND '$prict_en' "; 
			$count_first_and = 1;
		}else{
			$sql .= " AND p_price BETWEEN '$prict_st' AND '$prict_en'"; 
		} 
		
		$condition .= " |  ราคา  : ". $prict_st. ' - '.$prict_en ;
	}
	
	
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	
	//exit();

	

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
	<meta property="og:url" content="<?php echo $cate_id;?>.php?p_cate=<?php echo $cate_id;?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $productname.' '.'ราคาและราละเอียด';?>" />
	<meta property="og:description" content="อยากรู้ราคา <?php echo $productname; ?> อยู่ใช่ไหมล่ะ เข้ามาดูอะไหล่และอุปกรณ์ห้องเย็นได้เลย พร้อมบริการ โดย Topcooling" />
	<meta property="og:image" content="../../img/product/<?php echo $cate_id;?>/fb.jpg" />

    <title><?php echo $productname.' '.'ราคาและราละเอียด';?></title>
	
	<?php require_once('../../include/inc_css.php');?>


</head>

<body id="page-top" class="index">
<!--
debug mode
echo $sql; echo '<br>';
echo $num; 
-->
<?php require_once('../../include/googltag.php');?>
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
             <?php require_once('../../include/inc_menu_cat.php');?>
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <!--<header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To Our Studio!</div>
                <div class="intro-heading">It's Nice To Meet You</div>
                <a href="#services" class="page-scroll btn btn-xl">Tell Me More</a>
            </div>
        </div>
    </header>-->

	
	<section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"> ผลการค้นหา  
                    <h3 class="section-subheading text-muted"> <?php echo $productname."  ทั้งหมด  ". $num . "  รายการ" ?> </h3>
                </div>
            </div>
			<p>เงื่อนไข <?php echo $condition; ?></p>
           <?php if($num==0){ ?>
				 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                         <tr>
							<td align='center'>ไม่พบรายการค้นหา</td>
                         </tr>
                     </thead>
				</table>
		   <? } else {?>
            <div class="row">
				
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
					<thead>
							 <tr>
							 <th>#</th>
							 <th>รูป</th>
							 <th>ชื่อ/ยี่ห้อ <?php echo $productname; ?></th>
							 <th>Model</th>
							 <th>ท่อเข้า</th>
							 <th>ท่อออก</th>
							 <th>น้ำยา</th>
							 <th>ราคา</th>           
                         </tr>         
									 
					</thead>
					<tbody>
					  <?php 
							for ($i=1; $i<=$num; $i++){
										
						       $row = mysql_fetch_array($result);
					  ?>
							<?php 
							for ($i=1; $i<=$num; $i++){
							
								$row = mysql_fetch_array($result);
						?>
						 <tr class="odd gradeX">
							<td><?php echo $i; ?></td> 
							<td width="70px;"><a href="../productdetail/<?php echo $cate_id;?>.php?p_id=<?php echo $row['p_id']?>&amp;p_cate=<?php echo $cate_id;?>" target="_blank"><img src="../../img/product/4/s/com01.jpg"></a></td>
							<td><a href="../productdetail/<?php echo $cate_id;?>.php?p_id=<?php echo $row['p_id']?>&amp;p_cate=<?php echo $cate_id;?>" target="_blank"><?php echo $row['p_name']?></a></td>
							<td><?php echo $row['p_model']?></td>
							<td><?php echo $row['p_inlet']?></td>
							<td><?php echo $row['p_outlet']?></td>
							<td><?php echo $row['p_numya']?></td>
							<td align="right"><?php echo number_format($row['p_price'], 0, '.', ',');?></td>
						</tr>
						<?php } ?>														
					 </tbody>
					<?php } ?>	
					  
					</tbody>
				  </table>
				</div>
					
            </div>
			
		   <?php } ?>
			

        </div>
    </section>


     <!-- Clients Aside -->
	<?php require_once('../../include/inc_expand_partner.php');?> 

    <!-- Contact Section -->
    <?php require_once('../../include/inc_contact_footer.php');?>

    <!-- Script Section -->
    <?php require_once('../../include/inc_script_footer.php');?>

</body>

</html>
