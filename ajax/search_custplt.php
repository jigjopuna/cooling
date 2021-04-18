<?php require_once('../include/connect.php'); ?>
<?php
	$keyword = $_GET['term'];		
	$data = array();
	
	/*$sql = "select * from member_emp";
	$sql .= " where name like '$keyword%'";*/
	$sql = "SELECT cuplt_id, cuplt_name FROM tb_cust_depo WHERE cuplt_name LIKE '%$keyword%'";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if ($num==0){
		$data[] = array(
					"label" => "ไม่พบชื่อลูกค้าที่สั่งซื้อ",
					"value" => ""
						);
	}

	 while($row = mysql_fetch_array($result)){ 
			$data[] = array(
						"label" => $row['cuplt_name'],
						"value" => $row['cuplt_id']
							);
	  }

echo json_encode($data);
flush();
?>

