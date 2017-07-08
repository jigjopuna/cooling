<?php session_start();

	  if(isset($_SESSION['ss_user_id'])){ 
		 exit("<script>
			window.location='../product/expand.php';
		 </script>");
	 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="">
	<?php require_once('../../include/google-verify.php');?>
	<meta property="og:url" content="" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Login ระบบห้องเย็น Topcooling ดูราคาและรายละเอียด" />
	<meta property="og:description" content="ระบบตรวจสอบราคาห้องเย็น เอ็กแปนชั่นวาล์ว ไดเออร์ ไซด์กลาส คอล์ยเย็น คอลย์ร้อน อะไหล่และอุปกรณ์ต่างๆ พร้อมกับสิทธิประโยชน์มากมาย" />
	<meta property="og:image" content="../../img/product//fb.jpg" />

    <title>Login ระบบห้องเย็น Topcooling ดูราคาและรายละเอียด</title>
	
	<?php require_once('../../include/inc_css.php');?>

</head>

<body id="page-top" class="index">
<?php require_once('../../include/googltag.php');?>
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <?php require_once('../../include/inc_menu_cat.php');?>
        </div>
        <!-- /.container-fluid -->
    </nav>

	
	<section id="team" class="bg-light-gray">
        <div class="container">
			<div class="row">
			
				
			
                <div class="col-md-4 col-sm-6">
                    <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">เข้าสู่ระบบ Topcooling</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="formchklogin" id="formchklogin" action="chklogin.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ยูชเซอร์เนม" id="username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="พาสเวิร์ด" id="password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <!--<label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>-->
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                 <!--<a href="register.php" class="btn btn-lg btn-success btn-block">ลงทะเบียน</a>-->
								<button type="button" class="btn btn-lg btn-success btn-block" id="login">Login</button><br>
								 <a href="register.php" class="">ลืมรหัสผ่าน</a>
                            </fieldset>
                        </form>
                    </div>
					</div>
				
                </div>
				
				<div class="col-md-1 col-sm-6 sorn">
				
				</div>
				
                <div class="col-md-4 col-sm-6">
                     <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ลงทะเบียนลูกค้าใหม่</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name="formregis" id="formregis" action="../register.php" method="post">
                            <fieldset>
                                 <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="อีเมล">
                                  </div>
                                <div class="checkbox">
                                </div>
								<button type="button" class="btn btn-lg btn-success btn-block" id="newregis">ลงทะเบียน</button><br>
                            </fieldset>
                        </form>
                    </div>
					</div>
                </div>
                
            </div>
            
            <div class="row">
           <!-- <div class="col-md-4 col-md-offset-4">
                
            </div>-->
        </div>
        </div>
    </section>
	
	
	 
	

    <!-- Clients Aside -->
	<?php require_once('../../include/inc_expand_partner.php');?> 

    <!-- Contact Section -->
    <?php require_once('../../include/inc_contact_footer.php');?>

    <!-- Script Section -->
    <?php require_once('../../include/inc_script_footer.php');?>

    
	<script>
		$(document).ready(function(){
			$('#login').click(chklogin);
			$('#newregis').click(newregis);

		});
		
		function chklogin(){
			var username = $('#username').val();
			var password = $('#password').val();
			
			if(username=='' || password==''){
				alert('ใส่ยูซเซอร์เนมกับพาสเวิร์ดด้วยนะคะ');
				return false;
			}
			$('#formchklogin').submit();
			
		}
		
		function newregis(){
			var email = $('#email').val();
			
			if(email==''){
				alert('กรอกอีเมล ด้วยนะคะ');
				return false;
			}
			$('#formregis').submit();
			
		}
	</script>

</body>

</html>
