<?php require_once('../include/connect.php'); ?>
<?php
	$keyword = $_GET['term'];		
	$data = array();
	
	/*$sql = "select * from member_emp";
	$sql .= " where name like '$keyword%'";*/
	$sql = "SELECT t_id, t_name FROM tb_tools WHERE t_name LIKE '%$keyword%'";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if ($num==0){
		$data[] = array(
					"label" => "ไม่พบอะไหล่",
					"value" => ""
						);
	}

	 while($row = mysql_fetch_array($result)){ 
			$data[] = array(
						"label" => $row['t_name'],
						"value" => $row['t_id']
							);
	  }

echo json_encode($data);
flush();
?>
