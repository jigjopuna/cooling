<?php require_once('include/connect.php'); 

	$sql = "SELECT * FROM tb_category ORDER BY cat_id ";
	$result = mysql_query($sql);
	$num	= mysql_num_rows($result);
	
	$r_width  = trim($_GET['r_width']);
	$r_height  = trim($_GET['r_height']);
	$r_length  = trim($_GET['r_length']);
	$temparature  = trim($_GET['temparature']);
	$temp_before  = trim($_GET['temp_before']);
	$timeperiod  = trim($_GET['timeperiod']);
	$qty  = trim($_GET['qty']);
	
	
	/*echo "r_width = ".$r_width."<br>";
	echo "r_length = ".$r_length."<br>";
	echo "r_height = ".$r_height."<br>";
	echo "temparature = ".$temparature."<br>";
	echo "temp_before = ".$temp_before."<br>";
	echo "timeperiod = ".$timeperiod."<br>";
	echo "qty = ".$qty."<br>";*/
?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ที่อยู่</title>
<link type="text/css" rel="stylesheet" href="css/app.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
	$(document).ready(function(){
		multiList();
		$('#btn').click(validation);
	}); //end ready
	
	function multiList(){
		$("#province").load("ajax/province_server.php");
		$("#province").change(function(){
	  		 var url = "ajax/amphur_server.php";
	  		 var param = "province="+$("#province").val();
	   
		   $.ajax({
				url      : url,
				data     : param,
				dataType : "html",
				type     : "POST",
				success: function(result){
					$("#amphur").html(result);	
				}
			});//end ajax province
		   $("#tumbon").html('');
	    });// end change province
		
		
		$("#amphur").load("ajax/amphur_onload.php");
		$("#amphur").change(function(){
			   var url = "ajax/tumbon_server.php";
			   var param = "amphur="+$("#amphur").val();
			   
			   $.ajax({
					url      : url,
					data     : param,
					dataType : "html",
					type     : "POST",
					success: function(result){
						$("#tumbon").html(result);	
					}
				});  //end ajax amphur
		});//end change amphur
	
	    $("#tumbon").load("ajax/tumbon_onload.php");
	}// end fn multiList0
	
	
	function validation(){

		  var province = $("#province").val();
		  if(province=='' || province == 0){
			  alert('กรุณาเลือกจังหวัดด้วยค่ะ');
			  return false;
		  }
		  
		  var amphur = $("#amphur").val();
		  if(amphur=='' || amphur == 0){
			  alert('กรุณาเลือกอำเภอัดด้วยค่ะ');
			  return false;
		  }
		  
		  var tumbon = $("#tumbon").val();
		  if(tumbon=='' || tumbon == 0){
			  alert('กรุณาเลือกตำบลหรือเขตด้วยค่ะ');
			  return false;
		  }
		  
		  var cust_name = $("#cust_name").val();
		  if(cust_name==''){
			  alert('กรุณากรอกชื่อหรือบริษัทด้วยนะค่ะ');
			  return false;
		  }
		  
		  var cust_address = $("#cust_address").val();
		  if(cust_address==''){
			  alert('กรุณากรอกชื่อที่อยู่ด้วยนะค่ะ');
			  return false;
		  }
		  
		   var cust_tel = $("#cust_tel").val();
		  if(cust_tel==''){
			  alert('กรุณากรอกชเบอร์ติดต่อด้วยนะค่ะ');
			  return false;
		  }
		  
		  
		 
	      $('#form1').submit();
	}
</script>
</head>
<body>
	
    	<form id="form1" name="form" method="post" action="quotation.php">
        	<header>
                <h2>กรอกฐานข้อมูล topcooling</h2>
                <div></div>
            </header>
            
			
            <div>
              <label>จังหวัด</label>
               <select size="1" name="province" id="province">
                            
                </select>
            </div><!--end div  province-->
			
			
			
            <div>
              <label>อำเภอ/เขต</label>
               <select size="1" name="amphur" id="amphur">
                            
                </select>
            </div><!--end div  amphur-->
			
			<div>
              <label>ตำบล/แขวง</label>
               <select size="1" name="tumbon" id="tumbon">
                            
                </select>
            </div><!--end div  tumbon-->
			
			<div>
              <label>ชื่อนามบุคคล / บริษัท</label>
               <div>
                    <input type="text" name="cust_name" id="cust_name">
               </div>
            </div><!--end div model -->
			
			
			<div>
              <label>ที่อยู่ / ถนน / อาคาร</label>
               <div>
                    <input type="text" name="cust_address" id="cust_address">
               </div>
            </div><!--end div model -->
			
			<div>
              <label>รหัสไปรษณีย์</label>
               <div>
                    <input type="text" name="custzip" id="custzip">
               </div>
            </div><!--end div custzip -->
			
			<div>
              <label>เบอร์ติดต่อ</label>
               <div>
                    <input type="text" name="cust_tel" id="cust_tel">
               </div>
            </div><!--end div model -->
			
			<div>
              <label>Email</label>
               <div>
                    <input type="text" name="cust_email" id="cust_email">
               </div>
            </div><!--end div model -->
			
			<input type="hidden" name="r_width" value="<?php echo $r_width?>">
			<input type="hidden" name="r_length" value="<?php echo $r_length?>">
			<input type="hidden" name="r_height" value="<?php echo $r_height?>">
			<input type="hidden" name="temparature" value="<?php echo $temparature?>">
			<input type="hidden" name="temp_before" value="<?php echo $temp_before?>"> 
			<input type="hidden" name="timeperiod" value="<?php echo $timeperiod?>">
			<input type="hidden" name="qty" value="<?php echo $qty?>">
					
	<input type="button" id="btn" value="Save">
			
 </form>
 <br><hr><br>
 
</body>
</html>
