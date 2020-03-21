<?php 
      session_start();
	  echo "<META HTTP-EQUIV='Refresh' CONTENT = '60;'>";	
	  echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
	  
	  require_once('include/connect.php');
	  
	  $sql = ("SELECT * FROM register WHERE location !=' ' ");
	  $result= mysqli_query($con,$sql);
	  $num = mysqli_num_rows($result);
	
	  $today = date("d-m-Y / H:i:s");

	//echo 'NUM = '.$num.'<br>';
	
	for($i=1; $i<=$num; $i++)
	{
		
		
		
	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TCL Monitoring</title>
	
	<link rel="shortcut icon" href="icon/favicons.png">
    <link rel="icon" sizes="192x192" href="icon/app.jpg">
    <link rel="apple-touch-icon" sizes="128x128" href="icon/app.jpg">

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
	
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>
                            <div class="pull-right">
							    
								<?php echo $today ;?>
								
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
							
							<th>NO</th>
							<th>Customer</th>
							<th>Temp</th>
							<th>Status</th>
							<th>Connection</th>
							<th>Monitoring</th>
							
						<tr>
					</thead>
					<tbody>
					
					    <?php 
								for($i=1; $i<=$num; $i++)
								{
							        $row = mysqli_fetch_array($result);
									$chipid   = $row['chipid'];
									$name     = $row['name'];
									$tempmin  = $row['tempmin'];
									$tempmax  = $row['tempmax'];
									
								    $sql1 = "SELECT * FROM datalogger d JOIN register r ON r.chipid = d.chipid WHERE d.chipid = '$chipid' ORDER BY d.no DESC LIMIT 1";
									$result1 = mysqli_query($con, $sql1);
									$row1 = mysqli_fetch_array($result1);
									
									$temp   = $row1["temp"];	
									$OVcom  = $row1["in4"];
									$OVfan  = $row1["in5"];	
									$OVcond = $row1["in6"];	
									$OVhl   = $row1["in7"];
									$PHASE  = $row1["in8"];	
									
											if (($temp < $tempmin)||($temp > $tempmax))
												{
													$Alert = true; 	
												}
											else if ($OVcom == "true")//false
											   {
													$Alert = true; 
											   }
											else if ($OVfan == "true")//false
											   {
													$Alert = true; 	   
											   }
											else if ($OVcond == "true")//false
											   {
													$Alert = true; 
											   }   
											else if ($OVhl == "true")//false
											   {
													$Alert = true;  
											   }      
											else if ($PHASE == "true")//false
											   {
													$Alert = true;  
											   }
											else 
											{
													$Alert = false;
											}
											
											
									if ($Alert == "true")
									   {
											$show = "<font color=\"red\">FAIL</font>";  //"<font color=\"lime\">READY</font>"
									   }
									else
									   {
											$show = "<font color=\"lime\">READY</font>";    //"<font color=\"red\">FAIL</font>"
									   }			
		
						?>
						<tr>
						<?php
						        
						
						?>
						
							<td><?php echo $i ;?></td>
							<td><?php echo $row['name'] ;?></td>
							<td><?php echo $row1['temp'];?></td>
							<td><?php echo $show ;?></td>
							<td>   </td>
							<td><a href="http://80.211.47.159/index.php?search=<?php echo $chipid;?>"><button id="" type="button" class="btn btn-lg btn-success btn-block">View</button></a></td>
							
						</tr>
						<?php } ?>
						
					</tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                              
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					
                </div>
				
                   
            </div>
            <!-- /.row -->
			
			
		
		

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



</body>

</html>
