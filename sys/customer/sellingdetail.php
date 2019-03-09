<?php session_start();
	  require_once('../include/connect.php');
	  $custid = trim($_GET['custid']);
	  $cust_name = trim($_GET['custname']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#btn').click(validation);
	});//end ready
	
	function validation(){
		if($('#talking').val()==''){
				 alert('ใส่รายละเอียดด้วยนะค่ะ');
				 return false;
			}
			$('#form1').submit();
	}
	</script>
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
                    <h1 class="page-header">ลูกค้า </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
							ใส่ข้อมูลที่คุยกับลูกค้า <?php echo $cust_name;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<form action="../db/cust/custalking.php" id="form1" name="form" method="post">
									<div class="col-lg-3">
										<div class="form-group">
										  <label for="comment">ข้อมูลที่คุย</label>
										  <textarea class="form-control" rows="5" id="talking" name="talking"></textarea>
										</div>
										
										<div class="form-group has-success">
											<button id="btn" type="button" class="btn btn-lg btn-success btn-block">บันทึกข้อมูลลูกค้า</button>
										</div>
									</div>

									
									<div class="col-lg-3">
									</div>
									
									<div class="col-lg-3">
									</div>
									
			
			
									<div class="col-lg-3">
										
									</div>
									
								</form>
							 </div> <!-- row -->
                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
