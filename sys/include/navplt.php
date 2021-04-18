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
                <a class="navbar-brand" href="index.html">ยินดีต้อนรับคุณ <?php echo $_SESSION['ss_emp_name'];?></a>
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
						
						<?php if($ro_finance!=0) { ?>
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>การเงิน <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                               
								<li>
                                    <a href="../finance/summary_plt.php">สรุปการเงิน</a>
                                </li>
								
								<li>
                                    <a href="../finance/bill_plt.php">บิล/ใบเสร็จ</a>
                                </li>

								<li>
                                    <a href="../finance/bank_plt.php">เลขบัญชี</a>
                                </li>
							
                            </ul>
                        </li>
						<?php } ?>
						
						 
						 <?php if($ro_cust!=0) { ?>
						 <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> ลูกค้า <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="../customer/cusplt.php">รายชื่อลูกค้า</a>
                                </li>

								<li>
									<a href="../customer/cust_plt.php">เพิ่มลูกค้า</a>
									
                                </li>
								
                            </ul>
                        </li>
						 <?php } ?>
						
						<?php if($ro_order!=0) { ?>
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> รับฝากสินค้า <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                
								
								<li>
                                    <a href="../order/ord_deposit.php">รายการทั้งหมด</a>
                                </li>
								
								
								
								<li>
                                    <a href="../order/ord_plt.php">เพิ่มรายการรับฝาก</a>
                                </li>
								
                            </ul>
                        </li>
						<?php } ?>

						
						 <li>
                            <a href="../pages/login/logout.php" target="_blank"><i class="fa fa-edit fa-fw"></i> ออกจากระบบ </a>
                        </li>
						
                       
                       
                  
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>