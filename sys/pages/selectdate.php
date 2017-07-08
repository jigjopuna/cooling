<?php session_start();
	require_once ('../include/connect.php');
	$today = date("Y-m-d");
	
	$u_id = $_SESSION[ss_uid];
	if($u_id!=""){
		exit("
			<script>
				window.location = 'index.php';
			</script>");
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>เข้าสู่ระบบ ปิ่นโต</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">เลือกวันที่จะดูรายงาน</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="report/reportall.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="" value="<?php echo $today?>" id="selectDate" name="selectDate" type="text" autofocus>
                                </div>
								<button type="button" class="btn btn-success">ดูรายงาน</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function(){
			$('button').click(submitlogin);
			$('#selectDate').datepicker({dateFormat: 'yy-mm-dd'});

		});
		
		function submitlogin(){
			$('form').submit();
			
		}
	</script>

</body>

</html>
