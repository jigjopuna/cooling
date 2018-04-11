<?php 
    require_once('../../../sys/include/connect.php');
	/*trim($_GET["productname"])*/
	$cate_id = 4;
	$productname = 'Expansion Valve';
	$sql = "SELECT p_id, p_name, p_cate, p_price, p_model, p_inlet, p_outlet, p_temp ,p_numya  FROM tb_prodacces WHERE p_cate = '$cate_id'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//แยกยี่ห้อ	
	$sql_brand = "SELECT p_name brand FROM tb_prodacces WHERE p_cate = '$cate_id' GROUP BY p_name";
	$result_brand = mysql_query($sql_brand);
	$num_brand = mysql_num_rows($result_brand);
	
	//inlet	
	$sql_inlet = "SELECT p_inlet  FROM tb_prodacces WHERE p_cate = '$cate_id' GROUP BY p_inlet";
	$result_inlet = mysql_query($sql_inlet);
	$num_inlet = mysql_num_rows($result_inlet);
	
	//outlet	
	$sql_outlet = "SELECT p_outlet FROM tb_prodacces WHERE p_cate = '$cate_id' GROUP BY p_outlet";
	$result_outlet = mysql_query($sql_outlet);
	$num_outlet = mysql_num_rows($result_outlet);
	
	
	//numya	
	$sql_numya = "SELECT p_numya FROM tb_prodacces WHERE p_cate = '$cate_id' GROUP BY p_numya";
	$result_numya = mysql_query($sql_numya);
	$num_numya = mysql_num_rows($result_numya);
	
	//count all category
	$count = mysql_fetch_array(mysql_query("SELECT count(p_id) countcate FROM tb_prodacces WHERE p_cate = '$cate_id'"));
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
	<?php require_once('../../../include/google-verify.php');?>
	<meta property="og:url" content="<?php echo $cate_id;?>.php?p_cate=<?php echo $cate_id;?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $productname.' '.'ราคาและราละเอียด';?>" />
	<meta property="og:description" content="อยากรู้ราคา <?php echo $productname; ?> อยู่ใช่ไหมล่ะ เข้ามาดูอะไหล่และอุปกรณ์ห้องเย็นได้เลย พร้อมบริการ โดย Topcooling" />
	<meta property="og:image" content="../../img/product/<?php echo $cate_id;?>/fb.jpg" />

    <title><?php echo $productname.' '.'ราคาและราละเอียด';?></title>
	
	<?php require_once('../../../include/inc_css.php');?>


</head>

<body id="page-top" class="index">
<?php require_once('../../../include/googltag.php');?>
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <?php require_once('../../../include/inc_menu_cat.php');?>
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To Our Studio!</div>
                <div class="intro-heading">It's Nice To Meet You</div>
                <a href="#services" class="page-scroll btn btn-xl">Tell Me More</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ค้นหา <?php echo $productname; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <div class="row">
								<form action="../search/expands.php" method="post" name="form_search" id="form_search">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลือกยี่ห้อ <?php echo $productname; ?> </label>
											<select class="form-control" id="brand_search" name="brand_search">
												<option value="0">เลือกยี่ห้อ</option>
											<?php 
												for($i=1; $i<=$num_brand; $i++){
													$row_brand = mysql_fetch_array($result_brand);
											?>
												
												<option value="<?php echo $row_brand['brand']; ?>"><?php echo $row_brand['brand']; ?></option>
												
												<?php } ?>
											</select>
											<p class="help-block text-danger"></p>
										</div>
										
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ช่วงราคา</label>
											<select class="form-control" id="price_search" name="price_search">
												<option value="0">ราคา</option>
												<option value="1">2,000 - 5,000 บาท</option>
												<option value="2">5,000 - 7,000 บาท</option>
												<option value="3">7,000 - 12,000 บาท</option>
												<option value="4">12,000 - 20,000 บาท</option>
											</select>
											<p class="help-block text-danger"></p>
										</div>
										
										
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อเข้า (นิ้ว)</label>
											<select class="form-control" id="inlet_search" name="inlet_search">
												<option value="0">เลือกท่อเข้า</option>
											<?php 
												for($i=1; $i<=$num_inlet; $i++){
													$row_inlet = mysql_fetch_array($result_inlet);
											?>
												
												<option value="<?php echo $row_inlet['p_inlet']; ?>"><?php echo $row_inlet['p_inlet']; ?></option>
												
												<?php } ?>
											</select>
											<p class="help-block text-danger"></p>
										</div>
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่ออก (นิ้ว)</label>
											<select class="form-control" id="outlet_search" name="outlet_search">
												<option value="0">เลือกท่อออก</option>
											<?php 
												for($i=1; $i<=$num_outlet; $i++){
													$row_outlet = mysql_fetch_array($result_outlet);
											?>
												
												<option value="<?php echo $row_outlet['p_outlet']; ?>"><?php echo $row_outlet['p_outlet']; ?></option>
												
												<?php } ?>
											</select>
											<p class="help-block text-danger"></p>
										</div>

									 </div> <!-- row -->
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">น้ำยา</label>
											<select class="form-control" id="numya_search" name="numya_search">
												<option value="0">เลือกน้ำยา</option>
											<?php 
												for($i=1; $i<=$num_numya; $i++){
													$row_numya = mysql_fetch_array($result_numya);
											?>
												
												<option value="<?php echo $row_numya['p_numya']; ?>"><?php echo $row_numya['p_numya']; ?></option>
												
												<?php } ?>
											</select>
											<p class="help-block text-danger"></p>
										</div>
										
										<div class="form-group has-success">
											<button type="button" class="btn btn-lg btn-success btn-block" id="btn_search">ค้นหา</button>
										</div>
									
										
									 </div> <!-- row -->
								 
									<input type="hidden" value="<?php echo $cate_id; ?>" name="cate_id">	
									<input type="hidden" value="<?php echo $productname; ?>" name="productname">
								</form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
       
            </div>

        </div>
    </section>

	
	<section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $productname; ?></h2>
                    <h3 class="section-subheading text-muted">รายละเอียด  <?php echo $productname; ?></h3>
                </div>
            </div>
            
            <div class="row">
				<p><?php echo $productname; ?> มีทั้งหมด :  <?php echo $count['countcate']; ?> รายการ</p>
                
				
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
					<thead>
							<th>#</th>
							<th>รูป</th>
							<th>ชื่อ/ยี่ห้อ </th>
							<th>Model</th>
							<th>ท่อเข้า</th>
							<th>ท่อออก</th>
							<th>น้ำยา</th>
							<th>ราคา</th>
							<th colspan="2">.</th>
									 
					</thead>
					<tbody>
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
								<td><button type="button" class="btn btn-lg btn-success btn-block btn_buy" value="<?php echo $row['p_id']?>" >สั่งซื้อ</button></td>
								<td><button type="button" class="btn btn-lg btn-success btn-block btn_q"  value="<?php echo $row['p_id']?>">ใบเสนอราคา</button></td>

							</tr>
					<?php } ?>	
					  
					</tbody>
				  </table>
				</div>
					
            </div>
        </div>
    </section>
	
	
	 
	

    <!-- Clients Aside -->
	<?php require_once('../../../include/inc_expand_partner.php');?> 

    <!-- Contact Section -->
    <?php require_once('../../../include/inc_contact_footer.php');?>

    <!-- Script Section -->
    <?php require_once('../../../include/inc_script_footer.php');?>

    
	<script>
		$(document).ready(function(){
			$('#btn_search').click(function(){$('#form_search').submit();});	
			$('.btn_q').click(function(){window.location = '../quotation/q_add.php?p_id='+$(this).val();});
			$('.btn_buy').click(function(){window.location = '../basket/basket_add.php?p_id='+$(this).val();});
		});
	</script>

</body>

</html>
