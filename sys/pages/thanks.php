<?php  session_start(); 
	$u_id = $_SESSION[ss_uid];
	
	require_once('../include/connect.php');
	
	$aa = $_GET[user];
	$today = date("Y-m-d");
	
	//ค้นหาออเดอร์ทั้งหมดของวันนี้  ของลูกค้าที่ login เข้ามา 
	/*$sql = "";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);*/
	

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ขอบคุณนะคะ ที่ไว้ใจเรา</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
		<?php 
			if($u_id==""){
				exit("
				<script>
					alert('กรุณา login ก่อนนะคะ');
					window.location = 'login.php';
				</script>");
				}
		?>
		

        <!-- Navigation -->
        <?php require_once ('../include/navcust.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ขอบคุณนะคะ ที่ตั้งใจร่วมธุรกิจกับเรา</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
				<div class="col-lg-12"><img src="http://vrphone.in.th/content/images/large/thank-you-vr-phone.jpg" style="width:75%; margin: 0 auto;"></div>
			</div>
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
								รายการออเดอร์ที่สั่งวันนี้ <?php  echo $today."  ".number_format(122522, 0, '.', ',') ?> รายการ   จำนวน  <?php echo number_format(1222222, 0, '.', ',') ?>  ชิ้น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
                                        <th>ชื่อเค้ก</th>
                                        <th>จำนวนชิ้น</th>
                                        <th>ราคา (บาท)</th>
										<th>เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
									
                                 
                                    
                                </tbody>
                            </table>
							
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>

    </script>

</body>

</html>
