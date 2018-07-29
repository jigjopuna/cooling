<?php require_once('../include/connect.php'); ?>
<?php
	$keyword = $_GET['term'];		
	$data = array();
	
	/*$sql = "select * from member_emp";
	$sql .= " where name like '$keyword%'";*/
	$sql = "SELECT sl_id, sl_name FROM tb_sellers WHERE sl_name LIKE '%$keyword%'";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if ($num==0){
		$data[] = array(
					"label" => "ไม่พบชื่อร้านค้า",
					"value" => ""
						);
	}

	 while($row = mysql_fetch_array($result)){ 
			$data[] = array(
						"label" => $row['sl_name'],
						"value" => $row['sl_id']
							);
	  }

echo json_encode($data);
flush();
?>

