
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
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> ฝากสินค้า <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							
								<li>
                                    <a href="..//.php">รายการทั้งหมด</a>
                                </li>

								<li>
                                    <a href="..//.php">เบิกสินค้า</a>
                                </li>
								
                            </ul>
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