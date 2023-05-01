<?php require_once('../include/connect.php'); ?>
<?php	
	$sql = "SELECT * FROM tb_tools_office ORDER BY of_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	

    if($num==0)
		exit();
	
    echo "<div class='form-group has-success adddiv'>
				<label class='control-label' for='inputSuccess'>หมวดออฟฟิต</label>
				<select class='form-control' id='po_subcate' name='po_subcate'>
												";
	while($row = mysql_fetch_array($result)){ 
  		echo "<option value='$row[of_id]'>$row[of_name]</option>\n";
    } 
	
	 echo "</select> </div";
  mysql_close($conn);
?>