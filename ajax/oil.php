<?php require_once('../include/connect.php'); ?>
<?php	
	$sql = "SELECT * FROM tb_vehicle";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$sql_emp = "SELECT e.e_id, e.e_name FROM tb_emp e WHERE e.e_company = 3 AND e.e_publish = 1";
	$result_emp = mysql_query($sql_emp);
	$num_emp = mysql_num_rows($result_emp);
	

    if($num==0)
		exit();
	
    echo "<div class='form-group has-success adddiv'>
				<label class='control-label' for='inputSuccess'>เติมน้ำมัน</label>
				<select class='form-control' id='po_subcate' name='po_subcate'>
				
		 ";
	while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[v_id]'>$row[v_name] ($row[v_tabian])</option>\n";
    } 
	
	echo " <option value='0'>อื่นๆ ที่ไม่ใช่น้ำมัน</option></select> </div>";
	
	echo "<div class='form-group has-success adddiv'>
				<label class='control-label' for='inputSuccess'>ลิตร / บาท </label>
				<input type='text' class='form-control' id='oil_unit' name='oil_unit'>
		  </div>	
		 ";
		 
		 
	
	 echo "<div class='form-group has-success adddiv'>
				<label class='control-label' for='inputSuccess'>เติมน้ำมัน</label>
				<select class='form-control' id='oil_type' name='oil_type'>
				     <option value='1'> B7 </option>
					 <option value='2'> B10 </option>
					 <option value='3'> Gasohol 91 </option>
					 <option value='4'> Gasohol 95 </option>
					 <option value='5'> E20 </option>
					 <option value='6'> E85 </option>
				</select> </div>
		 ";
		 
		 
		 
	  echo "<div class='form-group has-success adddiv'>
				<label class='control-label' for='inputSuccess'>คนเติม</label>
				<select class='form-control' id='oil_emp' name='oil_emp'>
				
		 ";
	while($row_emp = mysql_fetch_array($result_emp)){ 
  		echo "<option value='$row_emp[e_id]'>$row_emp[e_name] </option>\n";
    } 
	
	echo "</div>";
	

	 

	
	
	
	 
	 
  mysql_close($conn);
  
?>