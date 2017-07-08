<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ร่วมเป็นพี่น้องกับ ปิ่นโต</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<style>
		label.valid {
		width: 24px;
		height: 24px;
		background: url(../img/valid.png) center center no-repeat;
		display: inline-block;
		text-indent: -9999px;
	}
	label.error {
		font-weight: bold;
		color: red;
		padding: 2px 8px;
		margin-top: 2px;
	}
	</style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ร่วมเป็นพี่น้องกับ ปิ่นโต มีความสุขแน่นอนคะ ^^</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="../db/regis/regis_save.php" method="post" id="registration-form">
                            <fieldset>
                                 <div class="form-group">
                                     <label class="control-label" for="inputSuccess">ชื่อ</label>
                                     <input type="text" class="form-control" name="name" id="">
                               </div>
							   
							   <div class="form-group">
                                     <label class="control-label" for="inputSuccess">เบอร์ติดต่อ</label>
                                     <input type="text" class="form-control" name="phonenumber" id="">
                               </div>
							   
							    <div class="form-group">
                                     <label class="control-label" for="inputSuccess">Username</label>
                                     <input type="text" class="form-control" name="username" id="">
                               </div>
							   
							    <div class="form-group">
                                     <label class="control-label" for="inputSuccess">Password</label>
                                     <input type="text" class="form-control" name="password" id="">
                               </div>
							   
                               <button type="submit" class="btn btn-primary">คลิก เพื่อเป็นครวบครัวปิ่นโตนะคะ</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	<script src="../js/jquery.validate.js"></script> 
	<script src="../js/validate.js"></script>
	<script>
		$(document).ready(function(){
			

		});
		
	</script>

</body>

</html>
