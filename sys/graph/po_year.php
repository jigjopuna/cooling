<?php session_start();
	  require_once('../include/connect.php');
	  
	  $year = date("Y");
	  $month = date('m');
	 
	 $profit = $yodown - $yoduse - $yodservice - $yodoffice;
	 
	 $sql_cost = "SELECT COUNT(po_id), SUM(po_price) price, Date(po_date) dates FROM   tb_po  WHERE po_date LIKE '2019%' GROUP  BY Month(po_date) ";
			 
	 $result_cost = mysql_query($sql_cost);
	 $num_cost = mysql_num_rows($result_cost);
	 
	 $sql_income = "SELECT SUM(o_price) oprice, Date(o_date) odates FROM tb_orders WHERE o_date LIKE '2019%' GROUP BY Month(o_date)";
	 $result_income = mysql_query($sql_income);
	 $num_income = mysql_num_rows($result_income);
	
	 for($i=1; $i<=$num_cost; $i++){
		 $row_cost = mysql_fetch_array($result_cost);
		 $chart_data .= "{ period:'".$row_cost["dates"]."', Cost:".$row_cost["price"]."}, ";	 
	 }
	 
	 $chart_data = substr($chart_data, 0, -2);
	 
	 
	 
	 /*for($i=1; $i<=$num_income; $i++){
		 $row_income = mysql_fetch_array($result_income);
		 $chart_income .= "{ period:'".$row_income["odates"]."', Income:".$row_income["oprice"]."}, ";	
		
        		 
	 }*/
	
	 /*exit();
	 $chart_income = substr($chart_income, 0, -2);*/
	 
	$arrincome = array();
	
	  	  
	   
	  

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>รายการสั่งซื้อ</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>

<link href="../vendor/morrisjs/morris.css" rel="stylesheet">
	
	<script>
		$(document).ready(function(){
			
		});
		

	</script> 
</head>

<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เลือกรายงาน</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
		<!-- /.row -->
		
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							เลือกรายงาน
                        </div>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>	
        </div>
		
		
	
		
            

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php //require_once ('../include/inc_js.php');
		/*$chart_data = "{ period:'2019-11-02 13:11:58', Temp:12.29}, { period:'2019-11-02 13:10:57', Temp:12.52}, { period:'2019-11-02 13:09:56', Temp:12.69}, { period:'2019-11-02 13:08:55', Temp:12.87}, { period:'2019-11-02 13:07:54', Temp:12.89}, { period:'2019-11-02 13:06:53', Temp:12.54}, { period:'2019-11-02 13:05:52', Temp:11.85}, { period:'2019-11-02 13:04:51', Temp:11.03}, { period:'2019-11-02 13:03:50', Temp:9.86}, { period:'2019-11-02 13:02:49', Temp:8.8}, { period:'2019-11-02 13:01:48', Temp:7.34}, { period:'2019-11-02 13:00:47', Temp:5.97}, { period:'2019-11-02 12:59:46', Temp:4.46}, { period:'2019-11-02 12:58:45', Temp:3.09}, { period:'2019-11-02 12:57:44', Temp:1.74}, { period:'2019-11-02 12:56:43', Temp:0.43}, { period:'2019-11-02 12:55:42', Temp:-0.59}, { period:'2019-11-02 12:54:41', Temp:-1.19}, { period:'2019-11-02 12:53:40', Temp:-1.72}, { period:'2019-11-02 12:52:39', Temp:-1.77}, { period:'2019-11-02 12:51:38', Temp:-4.08}, { period:'2019-11-02 12:50:37', Temp:-6.46}, { period:'2019-11-02 12:49:36', Temp:-8.94}, { period:'2019-11-02 12:48:35', Temp:-10.39}, { period:'2019-11-02 12:47:34', Temp:-10.99}, { period:'2019-11-02 12:46:33', Temp:-10.79}, { period:'2019-11-02 12:45:32', Temp:-10.35}, { period:'2019-11-02 12:44:31', Temp:-8.97}, { period:'2019-11-02 12:43:30', Temp:-7.79}, { period:'2019-11-02 12:42:29', Temp:-7.75}, { period:'2019-11-02 12:41:28', Temp:-7.79}, { period:'2019-11-02 12:40:27', Temp:-7.69}, { period:'2019-11-02 12:39:26', Temp:-8}, { period:'2019-11-02 12:38:25', Temp:-8.12}, { period:'2019-11-02 12:37:24', Temp:-8.15}, { period:'2019-11-02 12:36:23', Temp:-8.19}, { period:'2019-11-02 12:35:22', Temp:-8.19}, { period:'2019-11-02 12:34:21', Temp:-8.25}, { period:'2019-11-02 12:33:20', Temp:-8.25}, { period:'2019-11-02 12:32:19', Temp:-8.47}, { period:'2019-11-02 12:31:18', Temp:-8.22}, { period:'2019-11-02 12:30:17', Temp:-8.4}, { period:'2019-11-02 12:29:16', Temp:-8.56}, { period:'2019-11-02 12:28:15', Temp:-8.75}, { period:'2019-11-02 12:27:14', Temp:-8.65}, { period:'2019-11-02 12:26:13', Temp:-8.78}, { period:'2019-11-02 12:25:12', Temp:-8.87}, { period:'2019-11-02 12:24:11', Temp:-8.97}, { period:'2019-11-02 12:23:10', Temp:-9.35}, { period:'2019-11-02 12:22:09', Temp:-9.13}, { period:'2019-11-02 12:21:08', Temp:-9.32}, { period:'2019-11-02 12:20:07', Temp:-9.16}, { period:'2019-11-02 12:19:06', Temp:-9.57}, { period:'2019-11-02 12:18:05', Temp:-9.9}, { period:'2019-11-02 12:17:04', Temp:-9.73}, { period:'2019-11-02 12:16:03', Temp:-9.93}, { period:'2019-11-02 12:15:02', Temp:-9.8}, { period:'2019-11-02 12:14:01', Temp:-10.16}, { period:'2019-11-02 12:13:00', Temp:-10.45}, { period:'2019-11-02 12:11:59', Temp:-10.52}";*/
		
		//$chart_data = "{ period:'2019', Temp:12.29}, { period:'2019-02', Temp:18}, { period:'2019-03', Temp:18}, { period:'2019-04', Temp:18}, { period:'2019-05-02', Temp:8}, { period:'2019-06', Temp:35}";
   ?>

    <!-- Bootstrap Core JavaScript -->

    <!-- Metis Menu Plugin JavaScript -->

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script>
    $(document).ready(function(){
     
	 Morris.Line({
      element: 'morris-area-chart',
      data: [<?php echo $chart_data;?>],
      xkey: 'period',
      //ykeys: ['iphone', 'ipad', 'itouch'],
      //labels: ['iPhone', 'iPad', 'iPod Touch'],
      ykeys: ['Cost'],      
      labels: ['Cost'],
      pointSize: 0,
      hideHover: 'auto',
      resize: true
      
      });
      
    });
  </script>

</body>

</html>
