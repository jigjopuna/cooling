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
                        <li>
                            <a href="../index.php"><i class="fa fa-dashboard fa-fw"></i> หน้าหลัก</a>
                        </li>
						
						<li>
                            <a href="../quotation/q.php"><i class="fa fa-dashboard fa-fw"></i>ใบเสนอราคา</a>
                        </li>
						
						<li>
                            <a href="../quotation/q_fome.php"><i class="fa fa-dashboard fa-fw"></i>ต้นทุนห้องโฟม</a>
                        </li>
						
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>การเงิน <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="../finance/outpay.php">รายการสั่งซื้อ</a>
                                </li>
								
								<li>
                                    <a href="../finance/inpay.php">ยอดเงินเข้า</a>
                                </li>
								
								<li>
                                    <a href="../finance/salary.php">เงินเดือน</a>
                                </li>
								
								<li>
                                    <a href="../finance/summary.php">สรุปการเงิน</a>
                                </li>
								
								<li>
                                    <a href="../finance/bill.php">บิล/ใบเสร็จ</a>
                                </li>
							
                            </ul>
                        </li>
						
						 <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> ลูกค้า <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="../customer/customer.php">รายชื่อลูกค้า</a>
                                </li>
								
								<li>
                                    <a href="../customer/cust_add.php">เพิ่มลูกค้า</a>
                                </li>
							
                            </ul>
                        </li>
						
						
						<li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> ออเดอร์ <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="../order/order.php">รายการออเดอร์</a>
                                </li>
								
                            </ul>
                        </li>
						

						<li>
                            <a href="../stock/stockout.php"><i class="fa fa-bar-chart-o fa-fw"></i> สต็อก / เบิกของ <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								
                                <li>
                                    <a href="../stock/stockout.php">เบิกของ</a>
                                </li>
								
								<li>
                                    <a href="../stock/stock.php">ดูสต็อก</a>
                                </li>
								
								<li>
                                    <a href="../stock/sell.php">ขายของ</a>
                                </li>
							
                            </ul>
                        </li>
						
						 <li>
                            <a href="../report/selectreport.php"><i class="fa fa-bar-chart-o fa-fw"></i>รายงาน <span class="fa arrow"></span></a>                       
                        </li>
						
						
						
						 <li>
                            <a href="../pages/login/logout.php" target="_blank"><i class="fa fa-edit fa-fw"></i> ออกจากระบบ </a>
                        </li>
						
                       
                       
                  
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>