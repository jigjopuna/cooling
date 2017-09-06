<?php session_start();
	  require_once('../include/connect.php');
	
	//โอนเข้ามา
	$sql = "SELECT c.cust_name, op.pay_amount, op.pay_date, o.o_id, e.e_name, op.pay_bill
			FROM ((tb_orders o JOIN tb_ord_pay op ON o.o_id = op.o_id) 
				 JOIN tb_customer c ON c.cust_id = o.o_cust) JOIN tb_emp e ON e.e_id = op.o_emp_receive
			ORDER BY op.pay_date DESC";
	$result= mysql_query($sql);
	$num = mysql_num_rows($result);
	
	$today = date("Y-m-d");
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php require_once ('../include/header.php');?>
<?php require_once('../include/metatagsys.php');?>
<link type="text/css" rel="stylesheet" href="../../css/redmond/jquery-ui-1.8.12.custom.css">
<script src="../../js/jquery-ui-1-12-1.min.js"></script>
	<?php 
		$e_id = $_SESSION[ss_emp_id];
		if($e_id==""){
			exit("
				<script>
					alert('กรุณา Login ก่อนนะคะ');
					window.location = '../pages/login/login.php';
				</script>");
		}
	
	?>

<script>
	$(document).ready(function(){
		$('.btn-success').click(validation);
		$("#search_custname").autocomplete({
				source: "../../ajax/search_cust.php",
				minLength: 1
		});
		
		function validation(){
			var search_custname = $('#search_custname').val();
			var payinqty = $('#payinqty').val();
			var paydate = $('#paydate').val();
			if((search_custname=='') || (payinqty=='') || (paydate=='')){
				alert("ใส่ข้อมูลให้ครบนะค่ะ"); 
			}else{
				$('#form1').submit();				
			}
		}
		
	});
	
</script>

</head>

<body>

    <div id="wrapper">

        <?php require_once ('../include/navproduct.php');?>
        <div id="page-wrapper">
			
			
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">คอนโทรล TEMP</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
								คอนโทรล TEMP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<div class="col-lg-4"> 
									<a href="https://detail.1688.com/offer/44296253957.html" target="_blank"><img src="../images/ass/control/rc-113m.jpg" style="width: 90%;"></a>
								</div>
																		
								<div class="col-lg-4">
									<a href="https://detail.1688.com/offer/534181100366.html" target="_blank"><img src="../images/ass/control/rc-316m.jpg" style="width: 90%;"></a>		
								</div>
	
								<div class="col-lg-4">
									<a href="https://detail.1688.com/offer/35511496865.html" target="_blank"><img src="../images/ass/control/rc-112e.jpg" style="width: 90%;"></a>			
								</div>
	
							 </div> <!-- row -->           
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

<!--
http://www.ringder.net
https://ringder.1688.com
-->
   

</body>

</html>
