<?php 
	$ro_home = $role['ro_home'];
	$ro_order   = $role['ro_order'];
	$ro_finance = $role['ro_finance'];
	$ro_po      = $role['ro_po'];
	$ro_stock   = $role['ro_stock'];
	$ro_salary  = $role['ro_salary'];
	$ro_report  = $role['ro_report'];
	$ro_quotation = $role['ro_quotation'];
	$ro_income  = $role['income'];
	$ro_cust = $role['ro_cust'];
	$ro_shop = $role['ro_shop'];
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">ยินดีต้อนรับคุณ <?php echo $_SESSION['ss_emp_name'];?> </a>
            </div>
            <!-- /.navbar-header -->
 
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
						<?php if($ro_home!=0) { ?>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> หน้าหลัก</a>
                        </li>
						<?php } ?>
						
						
						<li>
                            <a href="quotation/select_room.php"><i class="fa fa-dashboard fa-fw"></i>ใบเสนอราคา</a>
                        </li>
					
						
						<!--<li>
                            <a href="quotation/q_fome.php"><i class="fa fa-dashboard fa-fw"></i>ต้นทุนห้องโฟม</a>
                        </li>-->
						
						
						<?php if($ro_finance!=0) { ?>
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>การเงิน <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="finance/outpay.php">รายการสั่งซื้อ</a>
                                </li>
								
								<li>
                                    <a href="finance/inpay.php">ยอดเงินเข้า</a>
                                </li>
								<?php if($ro_salary != 0) { ?>
								<li>
                                    <a href="finance/salary.php">เงินเดือน</a>
                                </li>
								<?php } ?>
								<li>
                                    <a href="finance/summary.php">สรุปการเงิน</a>
                                </li>
								
								<li>
                                    <a href="finance/bill.php">บิล/ใบเสร็จ</a>
                                </li>
								
								<li>
                                    <a href="finance/credit.php">เครดิต</a>
                                </li>
								
								<li>
                                    <a href="finance/bankacc.php">เลขบัญชี</a>
                                </li>
							
                            </ul>
                        </li>
						<?php } ?>
						
						
						<?php if($ro_cust!=0) { ?>
						 <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>ลูกค้า <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="customer/select_cust.php">รายชื่อลูกค้า (ซื้อแล้ว)</a>
                                </li>
								
								
								<li>
                                    <a href="customer/cust_waitpay.php">ลูกค้ายังไม่ปิดการขาย</a>
                                </li>
								
								<li>
									<a href="customer/cust_qoutation.php">เพิ่มลูกค้า</a>
                                </li>
								
								<li>
                                    <a href="customer/cust_sell.php">ผู้ติดต่อลูกค้า</a>
                                </li>
							
                            </ul>
                        </li>
						<?php } ?>
						
						
						<?php if($ro_order!=0) { ?>
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>ออเดอร์ <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="order/order.php">ออเดอร์ห้องเย็น</a>
                                </li>
								
								<li>
                                    <a href="order/opart_list.php">ออเดอร์อะไหล่</a>
                                </li>
								
								<li>
                                    <a href="order/ord_deposit.php">รับฝากสินค้า</a>
                                </li>
								
								<li>
                                    <a href="order/ord_source.php">ขายวัตถุดิบอาหาร</a>
                                </li>
								
								<li>
                                    <a href="order/select_order.php">เพิ่มออเดอร์</a>
                                </li>
                            </ul>
                        </li>
						<?php } ?>
						
						<?php if($ro_stock!=0) { ?>
						<li>
                            <a href="stock/stockout.php"><i class="fa fa-bar-chart-o fa-fw"></i> สต็อก / เบิกของ <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="stock/stockout.php">เบิกของ</a>
                                </li>
								
								<li>
                                    <a href="stock/stock.php">ดูสต็อก</a>
                                </li>
								
								
								<li>
                                    <a href="stock/buy.php">ซื้อของ</a>
                                </li>
								
								<li>
                                    <a href="stock/sell.php">ขายของ</a>
                                </li>
								
								
								<li>
                                    <a href="stock/seller.php">ร้านค้า</a>
                                </li>
                                
                                <li>
                                    <a href="part_sec/part_sec.php">รับซื้อมือสอง</a>
                                </li>
							
                            </ul>
                        </li>
						<?php } ?>
						
						<?php if($ro_shop!=0) { ?>
						<li>
                            <a href="shoptcl/dashboard.php"><i class="fa fa-dashboard fa-fw"></i> SHOP <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="shoptcl/product.php">แก้ไขข้อมูลสินค้า</a>
                                </li>
								
								<li>
                                    <a href="shoptcl/product_add.php">เพิ่มสินค้า</a>
                                </li>
								
								
								<li>
                                    <a href="shoptcl/buy.php">ออเดอร์</a>
                                </li>
								
								<li>
                                    <a href="shoptcl/sell.php">ยอดเงินเข้า</a>
                                </li>
								
								
								<li>
                                    <a href="shoptcl/seller.php">STOCK</a>
                                </li>
							
                            </ul>
                        </li>
						<?php } ?>
						
						

						
						
						<?php if($ro_report!=0) { ?>
						 <li>
                            <a href="report/selectreport.php"><i class="fa fa-bar-chart-o fa-fw"></i>รายงาน <span class="fa arrow"></span></a>  
							<ul class="nav nav-second-level">
								
                                <li>
                                    <a href="report/selectreport.php">รายงาน</a>
                                </li>
								
								<li>
                                    <a href="report/banks.php">Chart</a>
                                </li>
                            </ul>
                        </li>
						<?php } ?>
						
						<li>
                            <a href="part_sec/part_sec.php"><i class="fa fa-dashboard fa-fw"></i> โยกย้าย <span class="fa arrow"></span></a>
                            
                        </li>
						
						 <li>
                            <a href="pages/login/logout.php" target="_blank"><i class="fa fa-edit fa-fw"></i> ออกจากระบบ </a>
                        </li>
						
						
						
                       
                  
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>