<?php require_once('../include/connect.php'); 
	$sqlajax = "SELECT p.p_id, p.p_name, p.p_cate, p.p_subcate, p.p_price, p.p_price_sell, p.p_stock, p.p_model, p.p_volt, p.p_amp, p.p_kg, p.p_size, p.p_publish, c.cat_name, c.cat_type, c.cat_publish
				FROM tb_product p JOIN tb_category c ON p.p_cate = c.cat_id
				WHERE p_cate = 3";
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
											<td><a href="machine_edit.php?p_id=<?php echo $row['p_id'];?>&type=<?php echo $row['cat_type'];?>"><?php echo $row['p_name'];?></a></td>
											<td><?php echo $row['p_model'];?></td>
											<td><?php echo number_format($row['p_price_sell'], 0, '.', ',');?></td>
											<td><?php echo number_format($row['p_price'], 0, '.', ',');?></td>
											
										</tr>
								<?php } ?>
									
                                </tbody>
                            </table>