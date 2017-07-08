<?php session_start();
	require_once ('../../include/connect.php');
	
	$e_id = $_SESSION[ss_emp_id];
	if($e_id!=""){
		exit("
			<script>
				window.location = '../../index.php';
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
	<?php require_once('../../include/metatagsys.php');?>
	
    <title>เข้าสู่ระบบ Admin Topcooling</title>

	<?php require_once('../../include/css_pages.php');?>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">เข้าสู่ระบบ Admin Topcooling</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="chk_emp_login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ยูชเซอร์เนม" id="e_user" name="e_user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="พาสเวิร์ด" id="e_pass" name="e_pass" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <!--<label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>-->
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                 <!--<a href="register.php" class="btn btn-lg btn-success btn-block">ลงทะเบียน</a>-->
								<button type="button" class="btn btn-lg btn-success btn-block">Login</button><br>
								 <a href="register.php" class="">ลงทะเบียน</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php require_once('../../include/js_pages.php');?>
   
	<script>
		$(document).ready(function(){
			$('button').click(submitlogin);

		});
		
		function submitlogin(){
			var e_user = $('#e_user').val();
			var e_pass = $('#e_pass').val();
			
			if(e_user=='' || e_pass==''){
				alert('ใส่ยูซเซอร์เนมกับพาสเวิร์ดด้วยนะคะ');
				return false;
			}
			$('form').submit();
			
		}
	</script>

</body>

</html>
