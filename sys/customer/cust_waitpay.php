<?php session_start();
	  require_once('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		require_once('../include/header.php');
		require_once('../include/metatagsys.php');
		require_once('../include/inc_role.php');
		
		$sql_all = "SELECT * 
					FROM ((tb_quo_cust q JOIN province p ON p.id = q.qcust_prov) 
						 JOIN tb_ord_status o ON o.ost_id = q.qcust_progress) 
						 JOIN tb_emp e ON e.e_id = q.qcust_emp";
		$result_all = mysql_query($sql_all);
		$num_all = mysql_num_rows($result_all);
	?>
</head>
<body>

    <div id="wrapper">
        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ลูกค้ายังไม่ปิดการขาย
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ชื่อลูกค้า</th>
										<?php if($ro_cust != 3) { //สิทธิ์การดูข้อมูลลูกค้า?>
										<th>สถานะ</th>
										<th>เบอร์ติดต่อ</th>
										<th>จังหวัด</th>
										
										<th>ผู้ขาย</th>
										
										<th>วันที่ลงระบบ</th>
										<th>วันที่อัปเดท</th>
										<th>มัดจำ</th>
									    <?php } ?>
										
                                    </tr>
                                </thead>  
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_all; $i++){
										  $row_all = mysql_fetch_array($result_all);
										  //num_all qcust_status btn-primary
									  ?>
										<tr class="gradeA">
											<td><a href="sellingdetail.php?custid=<?php echo $row_all['qcust_id']; ?>&custname=<?php echo $row_all['qcust_name'].' '.$row_all['qcust_corp']?>"><?php echo $row_all['qcust_id']; ?></a></td>
											
											<?php if($ro_cust == 1) { ?>
												<td><a href="custquo_edit.php?custquo_id=<?php echo $row_all['qcust_id'] ?>"><?php echo $row_all['qcust_name']; ?></a></td>
											<?php } else { ?>
												<td><?php echo $row_all['qcust_name']. '|' .$row_all['qcust_corp']; ?></td>
											<?php } ?>
											
											
											
											<?php if($ro_cust != 3) { //สิทธิ์การดูข้อมูลลูกค้า?>
												<td><a href="custalk_edit.php?q_id=<?php echo $row_all['qcust_id'];?>"><?php echo $row_all['ost_status']; ?></a></td>
												<td><?php echo $row_all['qcust_tel']; ?></td>
												<td><?php echo $row_all['pro_name'] ;?></td>
												
												<td><?php echo $row_all['e_name']; ?></td>
												
												<td><?php echo $row_all['qcust_day'];?></td>
												<td><?php echo $row_all['qcust_date'];?></td>
												<td>
													<?php if($row_all['qcust_status']==0){ ?>
														<a href="../db/cust/pay.php?qcust_id=<?php echo $rowall['qcust_id'] ?>" onclick="return confirm('ลูกค้ามัดจำแล้วใช่ไหม?');">
															<button id="btns" type="button" class="btn btn-lg btn-success btn-block">อัปเดทลูกค้า</button>
														</a>
													<?php }else{ ?>
															<button id="btns" type="button" class="btn btn-lg btn-primary btn-block">ลูกค้ามัดจำแล้ว</button>
													<?php } ?>
																	
												</td>
												
											<?php } ?>
										</tr>
									<?php } ?>

                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
