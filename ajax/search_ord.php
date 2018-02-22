<?php require_once('../include/connect.php'); ?>
<?php
	$keyword = $_GET['term'];		
	$data = array();
	
	/*
	$sql = "select * from member_emp";
	$sql .= " where name like '$keyword%'";
	ถ้าลูกค้ามีมากกว่า 1 ออเดอร์ จะเอาออเดอร์ล่าสุดเท่านั้น
	*/
	
	
	$sql = "SELECT o.o_id, c.cust_name
			FROM tb_orders o JOIN tb_customer c ON o.o_cust = c.cust_id
			WHERE c.cust_name LIKE '%$keyword%' ORDER BY o.o_id DESC LIMIT 1";
				
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
						"label" => $row['cust_name'],
						"value" => $row['o_id']
							);
	  }

echo json_encode($data);
flush();
?>

