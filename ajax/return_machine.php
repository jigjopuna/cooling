<?php require_once('../include/connect.php'); 
	$sqlajax = "SELECT * FROM tb_product";
	$resultajax = mysql_query($sqlajax);
	$numajax = mysql_num_rows($resultajax);

?>
<table width='100%' class='table table-striped table-bordered table-hover data_table'>
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ชื่อสินค้า</th>                                     
                                        <th>Model</th>
                                        <th>ราคาลด</th>
										<th>ราคาเต็ม</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
									for($i=1; $i<=$numajax; $i++) {
										$row = mysql_fetch_array($resultajax);
								?>
										<tr class='gradeA'> 
											<td><?php echo $row['p_id'];?></td>
											<td><a href="machine_edit.php?p_id=<?php echo $row['p_id'];?>"><?php echo $row['p_name'];?></a></td>
											<td><?php echo $row['p_model'];?></td>
											<td><?php echo $row['p_sellprice'];?></td>
											<td><?php echo $row['p_price'];?></td>
											
										</tr>
								<?php } ?>
									
                                </tbody>
                            </table>