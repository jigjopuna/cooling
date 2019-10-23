	<?php 
		$takaid = $_SESSION['session_basket'];
	    $getbas = "SELECT p.pr_name, p.pr_sell_price, a.qtys, a.bas_id, a.bas_prod
					FROM tb_productroom p JOIN (SELECT inb.bas_id, inb.bas_prod, SUM(inb.bas_qty) qtys
					 FROM tb_inbasket inb 
					 GROUP BY inb.bas_prod) AS a 
					ON p.pr_id = a.bas_prod
					WHERE a.bas_id = '$takaid'";
		
		$result_getbas = mysql_query($getbas);
		$num_getbas = mysql_num_rows($result_getbas);
		
		
		
		$sumpriceb = mysql_fetch_array(mysql_query("SELECT SUM(eachtotal) total
												FROM
												(SELECT  p.pr_sell_price*a.qtys eachtotal 
												FROM tb_productroom p JOIN (SELECT inb.bas_id, inb.bas_prod, SUM(inb.bas_qty) qtys
												 FROM tb_inbasket inb 
												 GROUP BY inb.bas_prod) AS a 
												ON p.pr_id = a.bas_prod
												WHERE a.bas_id = '$takaid') as b"));
		
		
	?>
						<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti"><?php echo $num_getbas;?></span>
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<?php 
									for($i=1; $i<=$num_getbas; $i++){
										$row_bas = mysql_fetch_array($result_getbas);
								?>
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="images/item-cart-01.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											<?php echo $row_bas['pr_name']?>
										</a>

										<span class="header-cart-item-info">
											<?php echo number_format($row_bas['qtys'], 0, '.', ',').' x '.number_format($row_bas['pr_sell_price'], 0, '.', ','). ' บาท'; ?>
										</span>
									</div>
								</li>
								
								<?php } ?>
								

								
							</ul>

							<div class="header-cart-total">
								รวมราคา : ฿<?php echo  number_format($sumpriceb['total'], 0, '.', ','); ?>
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										ดูตะกร้า
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										ชำระเงิน
									</a>
								</div>
							</div>
						</div>