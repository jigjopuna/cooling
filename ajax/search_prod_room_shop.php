<?php require_once('../include/connect.php'); ?>
<?php
	$keyword = $_GET['term'];		
	$data = array();
	
	/*$sql = "select * from member_emp";
	$sql .= " where name like '$keyword%'";*/
	$sql = "SELECT pr_id, pr_name FROM tb_productroom WHERE pr_name LIKE '%$keyword%'";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if ($num==0){
		$data[] = array(
					"label" => "ไม่พบสินค้า",
					"value" => "", 
					"id" => ""
						);
	}

	 while($row = mysql_fetch_array($result)){ 
			$data[] = array(
						"label" => $row['pr_name'],
						"value" => $row['pr_name'],
						"id" => $row['pr_id']
							);
	  }

echo json_encode($data);
flush();
?>