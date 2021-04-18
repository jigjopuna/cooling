<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ระบบจัดการฝาก-เบิกสินค้า ห้องเย็น</title>

<link rel="shortcut icon" href="../content/images/favicon.png">
<link rel="stylesheet" href="../sources/css/main.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<script type="text/javascript" src="../sys/js/jquery-1.11.1.min.js"></script>
<script>
	$(document).ready(function(){
		$('.btn').click(validation);
	});
	
	function validation(){	
		var user = $('#user').val();
		var pass = $('#pass').val();
		
		if((user=='') || (pass=='')){
			 alert('กรอกข้อมูลให้ถูกต้องนะคะ');
			 return false;
		}else{
			$('#form1').submit();
		}
	    
	}
</script>

</head>
<body>


<div class="section-header">
	<div class="container">
		
		<div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
		<form id="form1" name="form" method="post" action="stock.php">
			<div class="dealbox">
				<div class="wrapper">
				<div class="form-header">
				<div class="heading">
					ระบบจัดการฝาก-เบิกสินค้า ห้องเย็น
				</div>
				</div>

				<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-xs-6" style="text-align: left;">User Name</div>
							<div class="col-xs-6">
								<input id="user" name="user">
								
							</div>
							<span class="alert-text col-xs-12" style="display:block; text-align: left;"></span>
						</div>
					</div>
				</div> 

				<div class="form-group">
					<div class="form-select">
						<div class="row">
							<div class="col-xs-6" style="text-align: left;">Password</div>
							<div class="col-xs-6">
								<input id="pass" name="pass" >
								
							</div>
							<span class="alert-text col-xs-12" style="display:block; text-align: left;"></span>
						</div>
					</div>
				</div> 

				
				<div class="form-group">
					<button class="btn -primary" type="button">เข้าสู่ระบบ</button>
				</div>
				</div>
			</div>
		</form>
		</div>
		</div>
	</div>
</div>


</body>
</html>