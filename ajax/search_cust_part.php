<?php require_once('../include/connect.php'); ?>
<?php
	$keyword = $_GET['term'];		
	$data = array();
	
	/*$sql = "select * from member_emp";
	$sql .= " where name like '$keyword%'";*/
	$sql = "SELECT cusp_id, cusp_name FROM tb_cust_part WHERE cusp_name LIKE '%$keyword%'";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if ($num==0){
		$data[] = array(
					"label" => "ไม่พบชื่อลูกค้า",
					"value" => ""
						);
	}

	 while($row = mysql_fetch_array($result)){ 
			$data[] = array(
						"label" => $row['cusp_name'],
						"value" => $row['cusp_id']
							);
	  }

echo json_encode($data);
flush();
?>

