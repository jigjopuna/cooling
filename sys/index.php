<?php session_start();
	include('include/connect.php');
	
	//for left nav menu path include/navcust.php
	$sql = "SELECT * FROM tb_category ORDER BY cat_name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
	
	//Product Summary
	$sql_all = "SELECT c.cat_id, c.cat_name, count(*) cnteachcate FROM tb_product p JOIN tb_category c ON p.p_cate = c.cat_id GROUP BY p_cate ORDER BY cnteachcate DESC";
	$result_all = mysql_query($sql_all);
	$num_all = mysql_num_rows($result_all);
	
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('include/metatagsys.php');?>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = 'https://topcooling.net/sys/pages/login/login.php';
				</script>");
		}
	
	?>

    <title>ระบบห้องเย็น ERP</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- LightBOx -->
	<script src="plugin/lightbox/js/jquery-1.11.0.min.js"></script>
	<link href="plugin/lightbox/css/lightbox.css" rel="stylesheet">
	<link href="plugin/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css">
	
	<script src="plugin/lightbox/js/lightbox.min.js"></script>
	<script src="plugin/jquery-ui-1.9.1.custom.min.js"></script>
	<script>
		$(document).ready(function(){
			$('button.btn-success').click(submitform);
			
			$(".shipstatus").each(function(){
				if($(this).text()=='ยังไม่ได้ส่ง'){
					$(this).css("background-color", "yellow");
				}else if ($(this).text()=='คืนของ'){
					$(this).css("background-color", "red");
					
				}
			});

		});
		
		function submitform(){
			var chklazid = $('#o_lazid').val();
			if(chklazid=="") { alert("ใส่ข้อมูลให้ครบนะค่ะ"); return false; }
			$('#ordform').submit();
			
		}
	</script>


    <style>
		.split-type { background-color: #ebf3aa !important;  }
		
	</style>

</head>

<body>

    <div id="wrapper">
		<?php 
			/*if($u_id==""){
				exit("
				<script>
					alert('กรุณา login ก่อนนะคะ');
					window.location = 'login.php';
				</script>");
				}*/
		?>
        <!-- Navigation -->
        <?php require_once ('include/navcust.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ระบบการจัดการ ERP บริษัท</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									</div>
                                    <div><a href="quotation/q.php" target="_blank" style="color:white;">ใบเสนอราคา</a></div>
                                </div>
                            </div>
                        </div>
                        <a href="custreport/custordtoday.php">
                            <div class="panel-footer">
                                <a href="quotation/q.php" target="_blank"><span class="pull-left">ใบเสนอราคา</span></a>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										111
									</div>
                                    <div>ระบบxxx</div>
                                </div>
                            </div>
                        </div>
                        <a href="custreport/custordreport.php">
                            <div class="panel-footer">
                                <span class="pull-left">ดูเพิ่มเติม</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">2222</div>
                                    <div>ระบบxxx</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">ดูเพิ่มเติม</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">3333</div>
                                    <div>ระบบxxx</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">ดูเพิ่มเติม</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
      
			
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							ข้อมูลอุปกรณ์ทั้งหมด
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>#</th>
										<th>ประเภทอุปกรณ์</th>
                                        <th>จำนวน</th>	
                                    
                                    </tr>
                                </thead>
                                <tbody>			
									<?php 
										for($i=1; $i<=$num_all; $i++){
											$row_all = mysql_fetch_array($result_all);
									?>
										<tr class="odd gradeX">
											<td><?php echo $i;?></td>
											<td><a href="product/<?php echo $row_all['cat_id'];?>.php?cate_id=<?php echo $row_all['cat_id'];?>"><?php echo $row_all['cat_name'];?></a></td>
											<td><?php echo $row_all['cnteachcate'];?></td>
										</tr>
										<?php } ?>
                                </tbody>
								</table>
						 
							 </div> <!-- row -->
                           
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

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
	
<!--
https://startbootstrap.com/template-categories/all/
https://startbootstrap.com/template-overviews/sb-admin-2/
 http://stackoverflow.com/questions/4383914/how-to-get-single-value-from-php-array
-->
</body>

</html>