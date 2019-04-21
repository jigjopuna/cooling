<?php require_once('../include/connect.php'); 
	$sqlajax = "SELECT * FROM tb_productroom";
	$resultajax = mysql_query($sqlajax);
	$numajax = mysql_num_rows($resultajax);

?>
<table width='100%' class='table table-striped table-bordered table-hover data_table'>
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ชื่อสินค้า</th> 
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
											<td><?php echo $row['pr_id'];?></td>
											<td><a href="room_edit.php?pr_id=<?php echo $row['pr_id'];?>"><?php echo $row['pr_name'].' '.$row['pr_type'].' '.$row['pr_size'];?></a></td>
											<td><?php echo number_format($row['pr_price'], 0, '.', ',');?></td>
											<td><?php echo number_format($row['pr_sell_price'], 0, '.', ',');?></td>
											
											
										</tr>
								<?php } ?>
									
                                </tbody>
                            </table>