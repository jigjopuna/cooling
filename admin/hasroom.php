<div class="page" id="room">
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
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็น</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">ห้องเย็น ปริมาณแผ่นฉนวน (<?php echo $cute; ?>) ตารางเมตร</td>
						<td style="width: 40%" class="b l" align="center" colspan="4"><strong>ขนาดห้องเย็น (กว้าง x ยาว x สูง) เมตร</strong></td>
					</tr>
					
					<tr align="center">
						<td align="left">ฉนวน <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong></td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายนอก <?php echo $r_width;?> x <?php echo $r_lenght;?> x <?php echo $r_high;?></td>
					</tr>
					
					<tr align="center">
						<td align="left"></td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายใน <?php echo number_format($r_width-$cens, 2, '.', ',');?> x <?php echo number_format($r_lenght-$cens, 2, '.', ',') ;?> x <?php echo number_format($r_high-$cens, 2, '.', ',');?></td>
					</tr>
					
					
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
						
				
					
					
					<tr class="highs" style="">
						<td class="l">1. ผนังห้องเย็น โฟม <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong> density 38-40 kg/m3 เหล็ก BHP 0.45 เมตร </td>
						<td colspan="2" class="l" align="center">1 ห้อง</td>
						<td class="l" align="right"><?php echo number_format($walkai, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($walkai, 2, '.', ','); ?></td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - 2CB/<?php echo $foams;?> ผิวเรียบ พร้อมอุปกรณ์ติดตั้ง</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  แผ่นผนัง <?php echo $foams." ".$foaminch; ?>" นิ้ว 1.2 x <?php echo $r_high;?> เมตร  <?php echo $walqty;?>  แผ่น</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  แผ่นเพดาน  <?php echo $foams." ".$foaminch; ?>" นิ้ว 1.2 x <?php echo $r_width;?> เมตร จำนวน <?php echo $pedan;?>  แผ่น</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  แผ่นพื้น <?php echo $foams." ".$foaminch; ?>"  1.2 x <?php echo $r_width;?> เมตร จำนวน <?php echo $pedan;?>  แผ่น</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l">2. <?php echo $doortypes; ?> ขนาด <strong><u><?php echo $d_width.' x '.$d_high?> เมตร</u></strong>  กว้าง สูง</td>
						<td colspan="2" class="l" align="center">1 บาน</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<?php if($floor1==1){ ?>
					<tr class="highs" style="">
						<td class="l">3. พื้นอลูมิเนียมลายกันลื่น</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<?php } ?>
					
					
					<tr class="highs" style="">
						<td class="l"><?php if($floor1==1){ echo '4. '; } else { echo '3. '; } ?>  ค่าติดตั้งและจัดส่งสินค้า</td>
						<td colspan="2" class="l" align="center">1 งาน</td>
						<td class="l" align="center"><?php if($ship_cost == 0) echo ''; ?></td>
						<td class="l" align="right"><?php if($ship_cost != 0) echo number_format($ship_cost, 2, '.', ','); ?></td>
					</tr>
				
					
					<tr>
						<td rowspan="3">
							<div style="width:100%";>
								<div style="width:30%; float:left;">
									<img style="width:100px; height:100px;" src="../content/images/social/frame.png" />
								</div>
								<div style="width:70%; float:left; height:100px;">
									<p align="left;" style="margin-top:35px;"> ข้อมูลเพิ่มเติม SCAN ME </p>
								</div>
							</div>
						</td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($walkai, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">ภาษีมูลค่าเพิ่ม 7%</td>
						<td class="rt l" align="right"><?php echo number_format($vats, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ (Inc VAT 7%) </td>
						<td class="rt l" align="right" id="roomprice"><?php echo number_format($kaivat, 2, '.', ',');?> </td>
					</tr>
				
				</table>

			</div><!--end product_price-->
			
			
			
			<div id="amount" style="clear: both; margin-top: 10px;">
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td colspan="2" align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> การชำระเงิน</td>
						</tr>
						<tr>
							<td align="left" style="width: 60%">  <span style="text-decoration: underline;">งวดที่ 1</span>   70%  ชำระเมื่อได้รับใบสั่งซื้อ </td>
							<td align="left" style="width: 35%"><span class="roomngod1"><?php echo number_format($roomngod1, 2, '.', ',');?></span> บาท</td>
						</tr>
						
						<tr>
							<td align="left"> <span style="text-decoration: underline;">งวดที่ 2</span>   30% ชำระก่อนจัดส่งอุปกรณ์ </td>
							<td align="left"><span class="roomngod2"><?php echo number_format($roomngod2, 2, '.', ',');?></span> บาท</td>
						</tr
						
						
						
						<?php if($corp == 2) { ?>
						<tr>
							<td colspan="2" align="left">บัญชีธนาคารกสิกรไทย </td>
							<tr>
								<td colspan="2" align="left">  บจ.ซีพีเอ็น888  เลขที่บัญชี <!--ชื่อบัญชี เดชาธร ผลินธร--> <span style="text-decoration: underline; font-weight: bold;"> 075-8-81892-6 <!--855-2-01920-3--></span></td>
							</tr>
						</tr>
					<?php } else { ?>
						
						<tr>
							<td colspan="2" align="left">บัญชีธนาคารกสิกรไทย </td>
							<tr>
								<td colspan="2" align="left">  บจ.ซีพีเอ็น888  เลขที่บัญชี <!--ชื่อบัญชี เดชาธร ผลินธร--> <span style="text-decoration: underline; font-weight: bold;"> 075-8-81892-6 <!--855-2-01920-3--></span></td>
							</tr>
						</tr>
						
					<?php }  ?>
					</table>
					
				</div><br>
				<div style="width: 50%; float:left;">
					<table style="width: 100%; border-collapse: collapse;">
						<tr>
							<td align="left" style="text-decoration: underline; font-weight: bold; font-size: 18px;"> กำหนดยืนราคา</td>
						</tr>
						<tr>
							<td align="left">  ภายใน 20 วัน นับจากวันที่เสนอราคา</td>
						</tr>
						<tr>
							<td align="left">  ส่งสินค้าภายใน 20 วันหลังจากได้รับมัดจำงวดที่ 1</td>
						</tr>
					</table>
				</div>
			</div><!--end amount-->
			
			
			<div id="footer" style="clear: both;">
				<div style="width: 65%; float:left; margin-top: 20px;">
					<span>ตกลงสั่งซื้อตามรายการข้างต้น</span> <br><br><br>
					<span>ลงชื่อ......................................</span> <br><br>
					<span>วันที่ <?php echo $thatdate;?></span>
				</div>
				<div style="width: 35%; float:left; margin-top: 20px;">
					
					<span>&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ</span> <br><br><br><br>
					<span>(นายภูริชญ์ โชคอุตสาหะ)</span> <br><br>
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
    </div> <!--end page-->