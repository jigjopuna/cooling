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