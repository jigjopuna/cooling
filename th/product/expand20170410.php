<?php 
    require_once('../../sys/include/connect.php');
	/*trim($_GET["productname"])*/
	$cate_id = 4;
	$productname = 'Expansion Valve';
	$sql = "SELECT * FROM tb_prodacces WHERE p_cate = '$cate_id'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	//แยกยี่ห้อ	
	$sql_brand = "SELECT p_name brand FROM tb_prodacces WHERE p_cate = '$cate_id' GROUP BY p_name";
	$result_brand = mysql_query($sql_brand);
	$num_brand = mysql_num_rows($result_brand);

	

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
	<meta name="google-site-verification" content="" />
	<meta property="og:url" content="<?php echo $cate_id;?>.php?p_cate=<?php echo $cate_id;?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $productname.' '.'ราคาและราละเอียด';?>" />
	<meta property="og:description" content="อยากรู้ราคา <?php echo $productname; ?> อยู่ใช่ไหมล่ะ เข้ามาดูอะไหล่และอุปกรณ์ห้องเย็นได้เลย พร้อมบริการ โดย Topcooling" />
	<meta property="og:image" content="../../img/product/<?php echo $cate_id;?>/fb.jpg" />

    <title><?php echo $productname.' '.'ราคาและราละเอียด';?></title>
	
	<link rel="shortcut icon" href="../../img/logos/favicon.jpg">

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="../../css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Start Bootstrap</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="http://google.com">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
					 <li>
                        <a class="page-scroll" href="#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
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
								<form action="../../db/addprod.php" method="post" name="form1" id="form1">
									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">เลือกยี่ห้อ <?php echo $productname; ?> </label>
											<select class="form-control" id="timeperiod" name="timeperiod">
												<option>เลือกยี่ห้อ</option>
											<?php 
												for($i=1; $i<=$num_brand; $i++){
													$row_brand = mysql_fetch_array($result_brand);
											?>
												
												<option value="<?php echo $row_brand['brand']; ?>"><?php echo $row_brand['brand']; ?></option>
												
												<?php } ?>
											</select>
											<p class="help-block text-danger"></p>
										</div>
										
										
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อเข้า (นิ้ว)</label>
											<select class="form-control" id="timeperiod" name="timeperiod">
												<option>เลือกรุ่น</option>
												<option value="18">18</option>
												<option value="12">12</option>
												<option value="8">8</option>
												<option value="6">6</option>
											</select>
											<p class="help-block text-danger"></p>
										</div>
										
									 </div> <!-- row -->
									 
									 
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อเข้า (นิ้ว)</label>
											<input type="text" class="form-control require" id="p_inlet" name="p_inlet">
										</div>

									 </div> <!-- row -->
									 

									<div class="col-lg-3">
										<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">ท่อออก (นิ้ว)</label>
											<input type="text" class="form-control require" id="p_outlet" name="p_outlet">
										</div>
										
										<div class="form-group has-success">
											<button type="button" class="btn btn-lg btn-success btn-block">ค้นหา</button>
										</div>
									
										
									 </div> <!-- row -->
								
									<input type="hidden" value="4" name="p_cate">	
								</form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
       
            </div>
			
           <!-- <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">E-Commerce</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Responsive Design</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Web Security</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div>-->
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
            <!--<div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="../../img/team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Kay Garland</h4>
                        <p class="text-muted">Lead Designer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="../../img/team/2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Larry Parker</h4>
                        <p class="text-muted">Lead Marketer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="../../img/team/3.jpg" class="img-responsive img-circle" alt="">
                        <h4>Diana Pertersen</h4>
                        <p class="text-muted">Lead Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>-->
            <div class="row">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
						 <tr class="odd gradeX">
							<td><?php echo $row['p_id']?></td> 
							<td width="70px;"><img src="../../img/product/4/s/com01.jpg"></td>
							<td><a href="../../productupdate/<?php echo $cate_id;?>.php?p_id=<?php echo $row['p_id']?>&amp;p_cate=<?php echo $cate_id;?>" target="_blank"><?php echo $row['p_name']?></a></td>
							<td><?php echo $row['p_model']?></td>
							<td><?php echo $row['p_inlet']?></td>
							<td><?php echo $row['p_outlet']?></td>
							<td><?php echo $row['p_numya']?></td>
							<td align="right"><?php echo number_format($row['p_price'], 2, '.', ',');?></td>
						</tr>
						<?php } ?>														
					 </tbody>
				</table>
					
            </div>
			

        </div>
    </section>

    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="../../img/logos/danfoss.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="../../img/logos/eliwell.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="../../img/logos/bitzer.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="../../img/logos/carel.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Topcooling.Co,Ltd</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="https://www.facebook.com/pg/410001105718634" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="../../js/jqBootstrapValidation.js"></script>
    <script src="../../js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="../../js/agency.min.js"></script>

</body>

</html>
