<?php require_once('../include/connect.php'); ?>
<?php
	$keyword = $_GET['term'];		
	$data = array();
	
	/*$sql = "select * from member_emp";
	$sql .= " where name like '$keyword%'";*/
	$sql = "SELECT t_id, t_name, t_stock FROM tb_tools WHERE t_name LIKE '%$keyword%'";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if ($num==0){
		$data[] = array(
					"label" => "ไม่พบอะไหล่",
					"value" => ""
						);
	}

	 while($row = mysql_fetch_array($result)){
			$stock = $row['t_stock'];
			/*$stock1 = $row['t_stock1'];
			$allstock = $stock + $stock1;*/
			
		/*	$data[] = array(
						"label" => $row['t_name'].' ('.$allstock.') ('.$stock.') ('.$stock1.')',
						"value" => $row['t_id']
							);*/
							
			$data[] = array(
						"label" => $row['t_name'].'('.$stock.')',
						"value" => $row['t_id']
							);
	  }

echo json_encode($data);
flush();
?>

