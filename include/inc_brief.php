<div class="page" id="compare" style="display:none;">
        <div class="subpage">
			
			<div id="cover_header">
				<?php 
					if($corp == 2)
						include ('../include/tcl_addr.php');
					else 
						include ('../include/cpn_addr.php');	
				?>
			</div><!--end cover_header-->
	
			<?php
					if($corp == 2)
						include ('../include/quotation_head.php');
					else 
						include ('../include/quotation_head_cpn.php');
			?>
			
			<div id="product_price" style="margin-top:105px; clear:both">
				<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tbody><tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">สรุปรายการห้องเย็น 3 แบบที่นำเสนอ</td>
					</tr>
					

					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
						
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" style="font-size: 18px; font-weight:bold; text-decoration:underline;">1. ห้องเย็นใหม่ เครื่องใหม่</td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;  ห้องเย็นเก็บ  <?php echo $prods. ' '.$ord_temp;?>C<sup>o</sup> <strong><u>ขนาด <?php echo $r_width. ' x '.$r_lenght . ' x '. $r_high; ?> เมตร</u></strong></td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"><?php echo number_format($incvat, 2, '.', ',');?> </td>
					</tr>
					

					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; ชุด Condensing <span style="color:red; font-weight:bold; text-decoration: underline;">
						
						<?php echo $compressor_name;?> </span>   | คอยล์เย็น <?php echo $coyen_name;?></td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; ช่องประตูบาน <?php echo $doortypes; ?> ขนาด <?php echo $d_width.' x '.$d_high?> เมตร กว้าง สูง <strong><u>บานใหม่</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style=""> 
						<td class="l">&nbsp;&nbsp;&nbsp; ผนังโฟมฉนวนชนิด <span style="color:red; font-weight:bold; text-decoration: underline;"><?php echo $foams." ".$foaminch; ?> นิ้ว </span> รองรับอุณหภูมิ  <?php echo $ord_temp;?>C<sup>o</sup> <strong><u>ชุดใหม่</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l" style="font-size: 18px; font-weight:bold; text-decoration:underline;">2. ห้องเย็นใหม่ เครื่องมือสอง</td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;  ห้องเย็นเก็บ  <?php echo $prods. ' '.$ord_temp;?>C<sup>o</sup> <strong><u>ขนาด <?php echo $r_width. ' x '.$r_lenght . ' x '. $r_high; ?> เมตร</u></strong></td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right">200,000.00 </td>
					</tr>
					

					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; เครื่องคอมเพรสเซอร์ COPELAND <span style="color:red; font-weight:bold; text-decoration: underline;"><?php echo $hp;?> HP</span> <strong><u>มือสอง</u></strong> | คอยล์เย็น KUBA <strong><u>มือสอง</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; ช่องประตูบาน <?php echo $doortypes; ?> ขนาด <?php echo $d_width.' x '.$d_high?> เมตร กว้าง สูง <strong><u>บานใหม่</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					<tr class="highs" style=""> 
						<td class="l">&nbsp;&nbsp;&nbsp; ผนังโฟมฉนวนชนิด <span style="color:red; font-weight:bold; text-decoration: underline;"><?php echo $foams." ".$foaminch; ?> นิ้ว </span> รองรับอุณหภูมิ  <?php echo $ord_temp;?>C<sup>o</sup> <strong><u>ชุดใหม่</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l" style="font-size: 18px; font-weight:bold; text-decoration:underline;">3. ห้องเย็นมือสอง เครื่องมือสอง</td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;  ห้องเย็นเก็บ <?php echo $prods. ' '.$ord_temp;?>C<sup>o</sup> <strong><u>ขนาด 2.20  x 4.00 x 2.2 เมตร</u></strong></td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right">178,000.00</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; เครื่องคอมเพรสเซอร์ COPELAND ขนาด <span style="color:red; font-weight:bold; text-decoration: underline;"><?php echo $hp;?> HP</span> <strong><u>มือสอง</u></strong>  | คอยล์เย็น KUBA <strong><u>มือสอง</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; ช่องประตูบานสวิงขนาด 0.75 x 1.80  เมตร กว้าง สูง <strong><u>มือสอง</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; ผนังโฟมฉนวนชนิด <span style="color:red; font-weight:bold; text-decoration: underline;">PU หนา 3 นิ้ว</span> รองรับอุณหภูมิ  <?php echo $ord_temp;?>C<sup>o</sup> <strong><u>มือสอง</u></strong> </td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;</td>
						<td colspan="2" class="l" align="center"> </td>
						<td class="l" align="right"> </td>
						<td class="l" align="right"> </td>
					</tr>
						
					
					
					<tr>
						<td rowspan="3">
							<div style="width:100%" ;="">
								<div style="width:30%; float:left;">
									<img style="width:100px; height:100px;" src="../content/images/social/frame.png">
								</div>
								<div style="width:70%; float:left; height:100px;">
									<p align="left;" style="margin-top:35px;"> ข้อมูลเพิ่มเติม SCAN ME </p>
								</div>
							</div>
						</td>
						<td colspan="3" class="rlt"></td>
						<td class="t l" align="right"></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl"></td>
						<td class="rt l" align="right"></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl"></td>
						<td class="rt l" align="right" id="totolprice"> </td>
					</tr>
					
				
				
				</tbody></table>

			</div><!--end product_price-->
			
			
			
			<div id="footer" style="clear: both; margin-top:20px;">
				<div style="width: 65%; float:left; margin-top: 50px;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left; margin-top: 50px;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายชูเกียรติ  เทียนอำไพ)</span> <br><br>
					<span style="font-size: 14pt;">&nbsp;&nbsp;หุ้นส่วนผู้จัดการ</span>
					<br>
				</div>
			</div><!--end footer-->
			
			
			
			<div id="conclude" style="clear: both; line-height:18px;">
				
				
				
			</div><!--end conclude -->
			<br><br><br>
			<div id="note" style="clear: both; margin: 0 0 0 200px;">
			</div><!--end note -->

        </div>  <!--end subpage-->
    </div>