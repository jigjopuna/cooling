<!DOCTYPE html>
<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TCL Monitoring</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
			    <a class="navbar-brand" > : <?php echo $cust_name;?> </a>
				
            </div>
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                           
                        </li>
					</ul>
				</div>
			</div>
						
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">อุณหภูมิ 10C<sup>o<sup></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<style>
				.iconstatus img { width: 150px; height: 150px; }
			</style>
		    
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-6">Compressor 
					<div class='iconstatus'>
						
							<img src="icon/icon-com-on.gif">
						
						
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-6">Cooler Unit	
					<div class='iconstatus'>
							<img src="icon/fan-on.gif">
					</div>
				</div>
				
				<div class="clearfix visible-sm"></div>
				
				<div class="col-md-3 col-sm-6 col-xs-6">Defrost	
					<div class='iconstatus'>
							<img src="icon/icon-defrost-on.gif">
						
					</div>
				</div>
				
				<!--<div class="col-md-3 col-sm-6 col-xs-6">Status	<div class='iconstatus'><img src="icon/fan-on.gif"></div></div>-->
			</div>
			
			<div style="height:10px;">&nbsp;</div>
			
			<style>
				.button {
				  background-color: #838383; /* Green */
				  border: none;
				  color: white;
				  text-align: center;
				  text-decoration: none;
				  display: inline-block;
				  font-size: 12px;
				  margin: 4px 2px;
				  cursor: pointer;
				  padding: 5px 10px;
				}

				.button1 {}
			</style>
			
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟอุณหภูมิ 
							<a href="http://80.211.47.159/index.php?search=<?php //echo $search;?>&vela=60"><button class="button">1H</button></a>
							<a href="http://80.211.47.159/index.php?search=<?php //echo $search;?>&vela=180"><button class="button">3H</button></a>
							<a href="http://80.211.47.159/index.php?search=<?php //echo $search;?>&vela=360"><button class="button">6H</button></a>
							<a href="http://80.211.47.159/index.php?search=<?php //echo $search;?>&vela=720"><button class="button">12H</button></a>
							<a href="http://80.211.47.159/index.php?search=<?php //echo $search;?>&vela=1440"><button class="button">D</button></a>
							<a href="http://80.211.47.159/index.php?search=<?php //echo $search;?>&vela=10080"><button class="button">W</button></a>
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> สถานะการทำงาน
                            <div class="pull-right">
							    
								<?php echo $TTime ;?>
								
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
						
						<tr>
							
							<th>Detail</th>
							<th>Status</th>
							
						<tr>
					</thead>
					<
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-1">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					
                </div>
				
                
					 
					 
					 
                    <div class="panel panel-default" id="donut"  >
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <a href="#" class="btn btn-default btn-block">View Details</a>
                        </div>
                       
                    </div>
                   
            </div>
            <!-- /.row -->
			
			
		
		
		
        </div>
        <!-- /#page-wrapper -->
	<!--div id="ccc"><?php echo $chart_data; ?></div-->
    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>

	<script>
		$(document).ready(function(){
			Morris.Line({
			element: 'morris-area-chart',
			data: [<?php echo $chart_data;?>],
			xkey: 'period',
			//ykeys: ['iphone', 'ipad', 'itouch'],
			//labels: ['iPhone', 'iPad', 'iPod Touch'],
			ykeys: ['Temp'],			
			labels: ['Temperature'],
			pointSize: 0,
			hideHover: 'auto',
			resize: true
			
			});
			$('#morris-bar-chart').hide(); //fa fa-clock-o fa-fw  notifi
			//$('.fa fa-clock-o fa-fw').hide(); //classใช้  .    idใช้  #
			$('#timeline').hide();
			$('#notifi').hide();
			$('#donut').hide();
			$('#chat').hide();
			
		});
	</script>

</body>

</html>
