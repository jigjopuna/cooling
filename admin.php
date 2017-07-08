<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Top Cooling Admin</title> 
        <link rel="stylesheet" href="source/css/style.css">

  </head>

  <body>

    <div class="wrapper">
	<div class="container">
		<h1>Welcome Top Cooling</h1>
		
		<form class="form1" action="admin/admin.php" method="post">
			<input type="text" name="admin_user" placeholder="Username">
			<input type="password" name ="admin_pass" placeholder="Password">
			<button type="button" id="login-button">Login</button>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!--<script src="source/js/index.js"></script>-->
	<script>
		 $("#login-button").click(function(event){
			 event.preventDefault();	 
			 $('form').fadeOut(500);
			 $('.wrapper').addClass('form-success');
			 $('.form1').submit();
         });
	</script>

  </body>
</html>
