<?php require_once('../include/connect.php'); 

	$sql = "SELECT * FROM tb_category ORDER BY cat_id";
	$result = mysql_query($sql);
?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="เช็คราคาห้องเย็น" />
<meta name="description" content="รู้ราคาห้องเย็นภายใน 1 นาที " />
<title>เช็คราคาห้องเย็น Top Cooling</title>
<link type="text/css" rel="stylesheet" href="../css/app.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
	$(document).ready(function(){
		
		$('#btn').click(validation);
		

		
		/*var weight = $('#weight').val();
		   if((weight=="")||(isNaN(weight))){
			   if(weight==''){
				alert('กรุณากรอกน้ำหนักด้วยค่ะ');
				$('#weight').css("background-color","pink");
				return false;
			   }
				if((isNaN(weight))){
				alert('กรุณากรอกน้ำหนักด้วยตัวเลขค่ะ');
				$('#weight').css("background-color","pink");
				return false;
				}
				return false;
			}*/
	});
	
	function validation(){

		  var r_width = $("#r_width").val();
		  if(r_width==''){
				alert('กรุณาใส่ความกว้างของห้องด้วยค่ะ');
				//$('#r_width').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_width))){
				alert('กรุณาใส่ความกว้างของห้องด้วยตัวเลขค่ะ');
				//$("#r_width").css("background-color","pink");
				return false;
		  }
		  
		  
		   var r_length = $("#r_length").val();
		  if(r_length==''){
				alert('กรุณาใส่ความยาวของห้องด้วยค่ะ');
				//$('#r_length').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_length))){
				alert('กรุณาใส่ความยาวของห้องด้วยตัวเลขค่ะ');
				//$('#r_length').css("background-color","pink");
				return false;
		  }
		  
		  
		  
		  var r_height = $("#r_height").val();
		  if(r_height==''){
				alert('กรุณาใส่ความสูงของห้องด้วยค่ะ');
				//$('#r_height').css("background-color","pink");
				return false;
			   }
				if((isNaN(r_height))){
				alert('กรุณาใส่ความสูงของห้องด้วยตัวเลขค่ะ');
				//$("#r_height").css("background-color","pink");
				return false;
		  }  
		  
		  
		  var qty = $("#qty").val();
		  if(qty==''){
			  $("#qty").val(1000);
		  }
		  
		  var temp_before = $("#temp_before").val();
		  if(temp_before==''){
			  $("#temp_before").val(20);
		  }
		  
		  /*alert( $("#temp_before").val());
		  alert( $("#qty").val());*/
		  
		  
		  var temp_before = $("#temp_before").val();
		  if(temp_before==''){
				alert('กรุณาใส่อุณหภูมิด้วยค่ะ');
				//$('#temp_before').css("background-color","pink");
				return false;
			   }
				if((isNaN(temp_before))){
				alert('กรุณาใส่อุณหภูมิด้วยค่ะ');
				//$("#temp_before").css("background-color","pink");
				return false;
		  }
	      $('#form1').submit();
	}
</script>
</head>
<body>

    	<form id="form1" name="form" method="post" action="qadmin.php">
        	<header>
                <h2>เช็คราคาห้องเย็น</h2>
                <div>กรอกข้อมูลต่างๆ เพื่อตรวจสอบราคาห้องเย็น ตามที่เราต้องการได้เลย</div>
            </header>
            
			
            <div>
              <label><u>ขนาดห้อง</u></label>
            </div><!--end div  brand-->
			
			<div>
              <label>กว้าง</label>
               <div>
                    <input type="text" id="r_width" name="r_width">  <span> เมตร</span>
               </div>
            </div><!--end div model -->
			
			<div>
              <label>ยาว</label> 
               <div>
                    <input type="text" id="r_length" name="r_length"> <span>เมตร</span>
               </div>
            </div><!--end div model -->
			
			<div>
              <label>สูง</label>
               <div>
                    <input type="text" id="r_height" name="r_height"> <span>เมตร</span>
               </div>
            </div><!--end div model -->
				

			<hr>
			
			<div>
              <label>อุณหภูมิที่ต้องการ</label>
               <div>
                    <select id="temparature" name="temparature">
					
						<option value="1">10 องศา ถึง 0</option>	
						<option value="2">0 องศา ถึง - 20</option>	
						
					</select>
               </div>
            </div><!--end div model -->
			
			
			
			<div>
              <label>ระยะเวลาลดอุณหภูมิสินค้า</label>
               <div>
			         <select id="timeperiod" name="timeperiod">
					    <option value="18">18</option>
						<option value="12">12</option>
						<option value="8">8</option>
						<option value="6">6</option>	
					</select> ชั่วโมง
                   
               </div>
            </div><!--end div temp_before -->
			
			
			
			<div>
              <label>อุณหภูมิสินค้าก่อนเข้าห้อง</label>
               <div>
                   <input type="text" id="temp_before" name="temp_before"> <span>องศาเซลเซียส</span>
               </div>
            </div><!--end div temp_before -->
			
			
			
			
			<div>
              <label>ปริมาณ</label>
               <div>
                    <input type="text" id="qty" name="qty"> <span>กิโลกรัม/วัน</span>
               </div>
            </div><!--end div qty -->
			
			
			
	<input type="button" id="btn" value="คำนวณราคา">
			
 </form>
 
	<script>
   $(document).ready(function(){
          $( ".more" ).click(function() {
                 $( ".moreDetail" ).toggle( "slow" );
           });
		  
          $('.moreDetail').hide();
          getCurrentDate();
   }); //end document ready
  
</script>
</body>
</html>
