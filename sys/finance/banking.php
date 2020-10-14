<?php session_start();
	  require_once('../include/connect.php');
	

	$today = date("Y-m-d");
	$year = date("Y");
	$month = date('m');
	$bankcode = trim($_GET['bankcode']);
	  
	$select_month =  $year.'-'.$months.'%';
	
	$sql = "SELECT s.sl_name, p.po_shop, SUM(p.po_price)prices, SUM(p.po_mudjum) mudjums, SUM(p.po_price)-SUM(p.po_mudjum) remain
			FROM tb_po p JOIN tb_sellers s ON p.po_shop = s.sl_id 
			WHERE p.po_credit = 1 AND p.po_credit_complete != 1 AND s.sl_pay = '$bankcode' 
			GROUP BY po_shop ORDER BY prices DESC";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	
	$banks = mysql_fetch_array(mysql_query("SELECT * FROM tb_bank WHERE bk_code ='$bankcode'"));
	$bankname = $banks['bk_name'];
	
	$sql_tol = "SELECT * FROM tb_tools_office ORDER BY of_id";
	$result_tol = mysql_query($sql_tol);
	$num_tol = mysql_num_rows($result_tol);
	
	$sql_oftol = "SELECT * FROM tb_tools_office WHERE of_pay = '$bankcode'";
	$result_oftol = mysql_query($sql_oftol);
	$num_oftol = mysql_num_rows($result_oftol);
	
	//เงินเข้าจากภายนอก
	//เงินเข้าแยกตามแบงค์ ไม่ได้เแยกตามบัญชี ต่อไปจะให้เข้าออมทรัพย์เท่านั้น ส่วนออกให้ออกกระแสรายวัน
	$sql_inc = "SELECT c.cust_name, op.pay_id, ot.ort_name, o.o_price, op.pay_amount, op.pay_date, o.o_date, b.bk_type
				FROM (((tb_ord_pay op JOIN tb_bank b ON b.bk_id = op.pay_bank) 
					  JOIN tb_orders o ON o.o_id = op.o_id)
					  JOIN tb_ord_type ot ON o.o_type = ot.ort_type)
					  JOIN tb_customer c ON c.cust_id = o.o_cust
				WHERE b.bk_code = '$bankcode'";
				
	$result_inc = mysql_query($sql_inc);
	$num_inc = mysql_num_rows($result_inc);
	
	//เงินออก โอนออกภายนอก 
	$sql_out = "SELECT po.po_id, po.po_name, po.po_date, po.po_price, tt.to_typename, po.po_orders
				FROM (tb_po po JOIN tb_bank b ON b.bk_id = po.po_pay_bank) JOIN tb_tools_type tt ON tt.to_typeid = po.po_cate
				WHERE b.bk_code = '$bankcode'";
	$result_out = mysql_query($sql_out);
	$num_out = mysql_num_rows($result_out);
	
	
	//โยกย้ายเข้า ภายใน
	$sql_yokin = "SELECT * 
				  FROM tb_intra_acc ia JOIN tb_bank b ON b.bk_id = ia.inc_to 
				  WHERE b.bk_code = '$bankcode'";
	$result_yokin = mysql_query($sql_yokin);
	$num_yokin = mysql_num_rows($result_yokin);
	
	
	
	//โอนออกภายนอก
	$sql_yokout = "SELECT * 
				  FROM tb_intra_acc ia JOIN tb_bank b ON b.bk_id = ia.inc_from
				  WHERE b.bk_code = '$bankcode'";
	$result_yokout = mysql_query($sql_yokout);
	$num_yokout = mysql_num_rows($result_yokout);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>ธนาคาร รายละเอียด</title>
<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
<?php require_once('../include/inc_role.php'); ?>

<script>
	$(document).ready(function(){ 
		$('.btn-success').click(validation);
		$('#paydate').datepicker({dateFormat: 'yy-mm-dd'});
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		$("#search_ord").autocomplete({
				source: "../../ajax/search_ord.php",
				minLength: 1
		});
		
		function validation(){
			var search_ord = $('#search_ord').val(); 
			var bfrom = $('#bfrom').val();
			var bto = $('#bto').val();
			var yokprice = $('#yokprice').val();
			var yokname = $('#yokname').val();
			
			if(search_ord==''){
				alert('กรุณาเลือกหมายเลขออเดอร์ด้วยนะค่ะ');
				return false;
			   }
				if((isNaN(search_ord))){
				alert('กรุณาใส่เลขออเดอร์ลูกค้านะค่ะ');
				return false;
			}
			
			if((search_ord=='') || (bto==0) || (bfrom==0) || (yokprice==0) || (yokname=='')){ 
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
			}
		}
		
		
	});
	
</script>

</head>

<body>
<?php print_r($bankarr);?>
    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ธนาคาร <?php echo $bankname;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								คู่ค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>รหัสร้าน</th>
                                        <th>ชื่อร้าน</th>  
										<th>ยอดเต็ม</th>  
                                        <th>มัดจำ</th>
                                        <th>คงเหลือ</th>
										</tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num; $i++){
										  $row = mysql_fetch_array($result);
									  ?>
										<tr class="gradeA">
											<td><?php echo $row['po_shop']; ?></td>
											<td><a href="print/credit_sup.php?shop=<?php echo $row['po_shop'];?>" target="_blank"><?php echo $row['sl_name']; ?></a></td>
											<td><?php echo number_format($row['prices'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row['mudjums'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row['remain'], 2, '.', ','); ?></td>
										
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
			
			
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								ภาระที่ต้องชำระ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th> 
										<th>จำนวนเงิน</th>
										<th>สถานนะ</th>
									</tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_oftol; $i++){
										  $row_oftol = mysql_fetch_array($result_oftol);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_oftol['of_id']; ?></td>
											<td><?php echo $row_oftol['of_name']; ?></td>
											<td></td>
											<td>ยังไม่ชำระ</td>
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
			
			
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เงินเข้า <?php echo $bankname;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								เงินเข้า เคลื่อนไหว
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>ลูกค้า</th> 
										<th>ประเภท</th>
										<th>ราคาเต็ม</th>	
										<th>ลูกค้าจ่าย</th>											
										<th>วันทีจ่าย</th>
										<th>วันทีรับออเดอร์</th>
										<th>ประเภทธนาคา</th>
										</tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_inc; $i++){
										  $row_inc = mysql_fetch_array($result_inc);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_inc['pay_id']; ?></td>
											<td><?php echo $row_inc['cust_nameif(file_exists($_FILES['ord_quotation']['tmp_name']) || is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["ord_quotation"]["tmp_name"]);
				
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		
		// Check if file already exists
		if (file_exists($target_file)) { 
			echo "Sorry, file already exists."; exit();
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["ord_quotation"]["size"] > 5000000) { 
			echo "Sorry, your file is too large."; exit();
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "pdf" && $imageFileType != "xlsx" && $imageFileType != "docx") {
			echo "Sorry, only pdf, xlsx,  & docx files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) { 
			echo "Sorry, your file was not uploaded."; exit();
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["ord_quotation"]["tmp_name"], $target_file)) {
				//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
				echo "The file ". basename( $_FILES["ord_quotation"]["name"]). " has been uploaded."; 
			} else {
				echo "Sorry, there was an error uploading your file."; exit();
			}
		}
	}//end check is has file']; ?></td>
											<td><?php echo $row_inc['ort_name']; ?></td>
											<td><?php echo number_format($row_inc['o_price'], 2, '.', ','); ?></td>
											<td><?php echo number_format($row_inc['pay_amount'], 2, '.', ','); ?></td>
											<td><?php echo $row_inc['pay_date']; ?></td>
											<td><?php echo $row_inc['o_date']; ?></td>
											<td><?php echo $row_inc['bk_type']; ?></td>
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
			
			<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								เงินเข้ามา ภายใน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการโยกย้ายเข้า</th> 
										<th>ราคาเต็ม</th>
										<th>จาก</th>
										<th>วันที่</th>										
									</tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_yokin; $i++){
										  $row_yokin = mysql_fetch_array($result_yokin);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_yokin['inc_id']; ?></td>
											<td><?php echo $row_yokin['inc_name']; ?></td>
											<td><?php echo number_format($row_yokin['inc_price'], 2, '.', ','); ?></td>
											<td><?php echo $row_yokin['inc_from']; ?></td>
											<td><?php echo $row_yokin['inc_date']; ?></td>
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
			
			
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เงินออก <?php echo $bankname;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								เงินออกข้างนอก เคลื่อนไหว
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการ</th> 
										<th>ราคา</th>
										<th>ประเภท</th>	
										<th>วันที่</th>											
										<th>ออเดอร์</th>
										</tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_out; $i++){
										  $row_out = mysql_fetch_array($result_out);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_out['po_id']; ?></td>
											<td><?php echo $row_out['po_name']; ?></td>
											
											<td><?php echo number_format($row_out['po_price'], 2, '.', ','); ?></td>
											<td><?php echo $row_out['to_typename']; ?></td>
											<td><?php echo $row_out['po_date']; ?></td>
											<td><?php echo $row_out['po_orders']; ?></td>
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
			
			
			<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								เงินออก ภายใน
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รายการโยกย้ายออก</th> 
										<th>ราคา</th>
										<th>ออกไปที่</th>
										<th>วันที่</th>										
									</tr>
                                </thead>
                                <tbody>
                                    
									<?php 
										for($i=1; $i<=$num_yokout; $i++){
										  $row_yokout = mysql_fetch_array($result_yokout);
									  ?>
										<tr class="gradeA"> 
											<td><?php echo $row_yokout['inc_id']; ?></td>
											<td><?php echo $row_yokout['inc_name']; ?></td>
											<td><?php echo number_format($row_yokout['inc_price'], 2, '.', ','); ?></td>
											<td><?php echo $row_yokout['inc_to']; ?></td>
											<td><?php echo $row_yokout['inc_date']; ?></td>
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
			
			
			
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

</body>

</html>
