<?php session_start();
	  require_once('../include/connect.php');
	
	$pars_id = trim($_GET['pars_id']);
	$row = mysql_fetch_array(mysql_query("SELECT * FROM tb_part_sec ps JOIN province p ON p.id = ps.pars_province WHERE ps.pars_id = '$pars_id'"));
    $imgs = $row['pars_img'];
	$descr = $row['pars_descr'];
    list($img1, $img2,$img3, $img4, $img5) = explode(':',$imgs);
	
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<title>ออเดอร์ลูกค้า</title>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<style>
	.o_image { width: 65%; margin-top:20px;}
	@media screen and (max-width: 1024px){.o_image { width: 100%; }}
	@media print{ .page{ background-color:red;}}
</style>
<?php require_once('../include/metatagsys.php');?>
<?php require_once('../include/inc_role.php');?>
<script>
	$(document).ready(function(){ 
		var quots = $('#quot').html();
		var ord_id = $('#ord_id').html();
		
		$("#notes").click(function(){
			var note = $('#o_note').val();
			if(note==''){
				alert("ใส่คอมเม้นด้วยนะคะ");
				return false;
			}else{
				$('#form1').submit();
			}	
		});
		
		$("#picattach").click(function(){
			var imgs = $('#imgattach').val();
			if(imgs==''){
				alert('ใส่รูปด้วยนะคะ');
				return false;
			}else{
				$('#form2').submit();
			}
		});
		
		$('#quotationfile').click(function(){
			window.location = '../quotation/files/'+quots;
		});
		$('#process').click(function(){
			window.location = '../../admin/job.php'+'?e_id='+ord_id;
		});
		
	
	});
	
	
	
	
	
</script>
</head>
<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รายละเอียด </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<strong>รายละเอียดสินค้า</strong> 
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						     <?php // echo '../images/art_secondhand/'.trim($descr).'/'.'1.php';?>
						     <?php  include('../../images/art_secondhand/CabinetFreezer/1.php');?>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			

			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
						 ใส่รูป
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							  <table width="100%" class="table table-striped table-bordered table-hover data_table">
								<form action="../db/order/orderattach.php" method="post" name="form2" id="form2" enctype="multipart/form-data">
								   <tbody>
										<tr>
										<td> 
											<div class="form-group has-success">
											<label class="control-label" for="inputSuccess">แนบรูป</label>
											<input type="file" class="form-control require" id="imgattach" name="imgattach">
											</div>
										</td>
										<td> <button type="button" id="picattach" class="btn btn-lg btn-primary btn-block" style="float:left;">บันทึกรูป</button>  </td>
								      </tr>
                                   
                                   </tbody>
								   <input type="hidden" name="o_ids" id="o_ids" value="<?php echo $o_id?>"> 
								</form>
							  </table>                           
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
		
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
						 รูป
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="col-lg-12"> 
								<?php if($img1 != '') { ?>
									<img class="o_image" src="../images/part_secondhand/<?php echo trim($descr);?>/<?php echo $img1;?>">
								<?php } ?>
								
								<?php if($img2 != '') { ?>
									<img class="o_image" src="../images/part_secondhand/<?php echo trim($descr);?>/<?php echo $img2;?>">
								<?php } ?>
								
								<?php if($img3 != '') { ?>
									<img class="o_image" src="../images/part_secondhand/<?php echo trim($descr);;?>/<?php echo $img3;?>">
								<?php } ?>
								
								<?php if($img4 != '') { ?>
									<img class="o_image" src="../images/part_secondhand/<?php echo trim($descr);?>/<?php echo $img4;?>">
								<?php } ?>
								
								<?php if($img5 != '') { ?>
									<img class="o_image" src="../images/part_secondhand/<?php echo trim($descr);?>/<?php echo $img5;?>">
								<?php } ?>
							</div>
							
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
		
		
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							คอมเม้นท์ Comment
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                              <form action="../db/order/order_note.php" id="form1" name="form" method="post">
                                <tbody>
                                   <tr>
										<td> 
											<div class="form-group">
											  <input type="text" class="form-control" id="o_note" name="o_note" value="<?php echo $comments;?>">
											  <input type="hidden" name="orders_id" value="<?php echo $o_id;?>">
											</div> 
										</td>
										<td> <button type="button" id="notes" class="btn btn-lg btn-primary btn-block" style="float:left;">บันทึก</button>  </td>
								   </tr>
                                   
                                </tbody>
							   </form>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			
        </div>
        <!-- /#page-wrapper -->
		<div id="pars_id" style="display:none"><?php echo $pars_id;?></div>
    </div>
    <!-- /#wrapper -->

   

</body>

</html>
