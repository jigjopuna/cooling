<?php session_start(); 
	  echo "<META HTTP-EQUIV='Refresh' CONTENT = '60;'>";	

	$search = trim($_GET['search']);
	$velas = $_GET['vela'];
	$int_time = (int)$velas;
	
	$con=mysqli_connect("localhost","root","Topcooling482","basiccarel");
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$result_times = mysqli_query($con,$sql_times);
	$row_times = mysqli_num_rows($result_times);
	
	
	/*echo 'search : '.$search.'<br>';
	echo 'row_times : '.$row_times.'<br>';
	echo 'velas : '.$velas.'<br>'; 	
	echo 'int_time : '.$int_time.'<br>'; 
	exit();*/

	//http://80.211.47.159/index_1000_row.php?search=889E2AC40A24&vela=40320
	

	$Csql="SELECT * FROM register WHERE chipid = '$search'";
	$Cresult=mysqli_query($con,$Csql);
	$Crow = mysqli_fetch_array($Cresult);
	$CAL = $Crow["CAL"];
	
	
	if($velas == '720'){
		$sql = "SELECT * FROM datalogger WHERE chipid = '$search' ORDER BY no DESC LIMIT 720";
	}else if($velas == '1440'){
		$sql = "SELECT * FROM datalogger WHERE chipid = '$search' ORDER BY no DESC LIMIT 1440";
	}
	else if($velas == '10080'){
		$sql = "SELECT * FROM datalogger WHERE chipid = '$search' ORDER BY no DESC LIMIT 10080";
	}
	else if($velas == '40320'){
		$sql = "SELECT * FROM datalogger WHERE chipid = '$search' ORDER BY no DESC LIMIT 40320";
	} 
	
	if($result=mysqli_query($con,$sql)){
	  $rowcount=mysqli_num_rows($result);
	}
	  while($row = mysqli_fetch_array($result))
		{
		 $dataT = $row["temp"];	
		 $numTemp = number_format($dataT, 2, '.', '');
		 $chart_data .= "{ period:'".$row["time"]."', Temp:".$row["temp"]."}, ";
		 
		}
		$chart_data = substr($chart_data, 0, -2);

	$name1 = "COMPRESSOR (คอมเพรสเซอร์)";
	$name2 = "FAN EVAP (คอยยล์เย็น)";
	$name3 = "HEATER (ฮีทเตอร์)";
	$name4 = "OV.COMPRESSOR (ไฟฟ้า คอมฯ)";
	$name5 = "OV.FAN (คอยล์ยเย็น กระแสไฟสูง)";
	$name6 = "OV.CONDENSING  (คอยล์ยร้อน)";
	$name7 = "HI-LO PRESSURE (แรงดันน้ำยา)";
	$name8 = "PHASE PROTECTOR (ไฟฟ้า)";
	$name9 = "OUTPUT";	
	
	$Tsql="SELECT * FROM datalogger WHERE chipid = '$search' ORDER BY no DESC LIMIT 1";

	$Tresult = mysqli_query($con,$Tsql);
	$Tdata = mysqli_fetch_array($Tresult);
	
	$id = $Tdata["chipid"];
	$TTime = $Tdata["time"];
	$TTemp = $Tdata["temp"];
	
	if ($Tdata["in1"] == "true")
	{
		//$show1 = "ON" ;
		 $show1 ="<font color=\"lime\">ON</font>";
	}
	else
	{
		$show1 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["in2"] == "true")
	{
		$show2 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show2 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["in3"] == "true")
	{
		$show3 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show3 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["in4"] == "true")
	{
		$show4 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show4 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["in5"] == "true")
	{
		$show5 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show5 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["in6"] == "true")
	{
		$show6 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show6 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["in7"] == "true")
	{
		$show7 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show7 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["in8"] == "true")
	{
		$show8 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show8 = "<font color=\"red\">OFF</font>";
	}
	if ($Tdata["out1"] == "true")
	{
		$show9 = "<font color=\"lime\">ON</font>";
	}
	else
	{
		$show9 = "<font color=\"red\">OFF</font>";
	}
/////////////////อุณหภูมิ	
	
	$sql="SELECT * FROM register WHERE chipid = '$search'"; //  WHERE chipid = '$search' 

	if ($result=mysqli_query($con,$sql))
	  {

	  }
	  while($row = mysqli_fetch_array($result))
		{
		 $tempmin = $row["tempmin"];
		 $tempmax= $row["tempmax"];
		}

	//mysqli_close($con);
	
	
//https://www.webslesson.info/2017/03/morrisjs-chart-with-php-mysql.html	
?>
<!DOCTYPE html>
<html>

<head>

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
                <a class="navbar-brand" >ห้องเย็นไอศรีมละมุน  <?php echo $TTemp;?>C<sup>o</sup> <?php echo 'count : '.$rowcount;?></a>
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
                    <h1 class="page-header">อุณหภูมิ <?php echo $TTemp;?>C<sup>o<sup></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<style>
				.iconstatus img { width: 150px; height: 150px; }
			</style>
		
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-6">Compressor <div class='iconstatus'><img src="icon/icon-com-on.gif"></div></div>
				<div class="col-md-3 col-sm-6 col-xs-6">Cooler Unit	<div class='iconstatus'><img src="icon/fan-on.gif"></div></div>
				<div class="clearfix visible-sm"></div>
				<div class="col-md-3 col-sm-6 col-xs-6">Defrost	<div class='iconstatus'><img src="icon/fan-on.gif"></div></div>
				<div class="col-md-3 col-sm-6 col-xs-6">Status	<div class='iconstatus'><img src="icon/fan-on.gif"></div></div>
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
							<a href="http://80.211.47.159/index_1000_row.php?search=889E2AC40A24&vela=720"><button class="button">12H</button></a>
							<a href="http://80.211.47.159/index_1000_row.php?search=889E2AC40A24&vela=1440"><button class="button">D</button></a>
							<a href="http://80.211.47.159/index_1000_row.php?search=889E2AC40A24&vela=10080"><button class="button">W</button></a>
							<a href="http://80.211.47.159/index_1000_row.php?search=889E2AC40A24&vela=40320"><button class="button">M</button></a>
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
					<tbody>
						<tr>
							
							<td><?php echo $name1 ;?></td>
							<td><?php echo $show1 ;?></td>
							
						</tr>
						<tr>
							
							<td><?php echo $name2 ;?></td>
							<td><?php echo $show2 ;?></td>
							
						</tr>
						<tr>
						
							<td><?php echo $name3 ;?></td>
							<td><?php echo $show3 ;?></td>
							
						</tr>
						<tr>
							
							<td><?php echo $name4 ;?></td>
							<td><?php echo $show4 ;?></td>
							
						</tr>
						<tr>
							
							<td><?php echo $name5 ;?></td>
							<td><?php echo $show5 ;?></td>
							
						</tr>
						<tr>
						
							<td><?php echo $name6 ;?></td>
							<td><?php echo $show6 ;?></td>
							
						</tr>
						<tr>
						
							<td><?php echo $name7 ;?></td>
							<td><?php echo $show7 ;?></td>
							
						</tr>
						<tr>
							
							<td><?php echo $name8 ;?></td>
							<td><?php echo $show8 ;?></td>
							
						</tr>
						<tr>
							
							<td><?php echo $name9 ;?></td>
							<td><?php echo $show9 ;?></td>
							
						</tr>
					</tbody>
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
			pointSize: 3,
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
