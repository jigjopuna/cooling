<?php session_start();
	require_once('../include/connect.php');
	$cate_id = trim($_GET['cate_id']);

	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>IoT ห้องเย็นอัจฉริยะ</title>
	
	<?php require_once('../include/metatagsys.php');?>
	<?php require_once ('../include/header.php');?>
	<?php 
		/*$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = '../pages/login/login.php';
				</script>");
		}*/
	
	?>

</head>

<body>

    <div id="wrapper">
		<?php //require_once ('../include/navproduct.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">อุณหภูมิ สำนักงานห้องเย็น</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							อุณหภมิ สำนักงานห้องเย็น
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/285881/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
							 </div> <!-- row -->
                           
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
	
    

    </script>

</body>

</html>
