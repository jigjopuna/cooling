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
											<td><?php echo $row['pr_id'];?></td>
											<td><a href="room_edit.php?pr_id=<?php echo $row['pr_id'];?>"><?php echo $row['pr_name'];?></a></td>
											<td><?php echo $row['pr_price'];?></td>
											<td><?php echo $row['pr_sellprice'];?></td>
											<td><?php echo $row['pr_img'];?></td>
											
										</tr>
								<?php } ?>
									
                                </tbody>
                            </table>