<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็นสำเร็จรูป </td>
					</tr style="border: solid black 1px;">
					
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็น</td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">ห้องเย็นสำเร็จรูป แบบเคลื่อนย้ายได้ ปริมาณแผ่นฉนวน (<?php echo $cute; ?>) ตารางเมตร</td>
						<td style="width: 40%" class="b l" align="center" colspan="4"><strong>ขนาดห้องเย็น (กว้าง x ยาว x สูง) เมตร</strong></td>
						<!--<td colspan="2" style="width: 13%;" class="rlb">กว้าง  (เมตร)</td>
						<td style="width: 13%" class="br">ยาว   (เมตร)</td>
						<td style="width: 13%" class="b">สูง  (เมตร)</td>-->
					</tr>
					
					<tr align="center">
						<td align="left"><span style="font-size:17px; font-weight:bold; text-decoration: underline;"> อุณหภูมิในห้องเย็น</span> <span style="color:red; font-size:18px; font-weight:bold;"><?php echo $ord_temp; ?>C<Sup>o</Sup></span>  แช่ <?php echo $prods; ?>ได้สูงสุด <?php echo $maxqty;?> ตัน</td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายนอก <?php echo $r_width;?> x <?php echo $r_lenght;?> x <?php echo $r_high;?></td>
					</tr>
					
					<tr align="center">
						<td align="left">- ห้องเย็นแช่ <?php echo $prods; ?> สินค้าเข้าต่อวัน <?php echo $qtyperday; ?> kg </td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ขนาดวัดภายใน <span style="font-size:17px; font-weight:bold; color:red; text-decoration:underline;"><?php echo number_format($r_width-$cens, 2, '.', ',');?> x <?php echo number_format($r_lenght-$cens, 2, '.', ',') ;?> x <?php echo number_format($r_high-$cens, 2, '.', ',');?></span></td>
					</tr>
					
					<tr align="center">
						<td align="left">- อุณหภูมิก่อนเข้า <?php echo $tempbefore; ?>C<Sup>o</Sup> อุณหภูมิห้องที่ต้องการ <?php echo $ord_temp; ?>C<Sup>o</Sup></td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ฉนวน <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong></td>
					</tr>
					
					<tr align="center">
						<td align="left">- ลดอุณหภูมิจาก  <?php echo $tempbefore; ?>C<Sup>o</Sup> ถึง  <?php echo $ord_temp; ?>C<Sup>o</Sup> ปริมาณ <?php echo $qtyperday; ?>kg ใช้เวลา <?php echo $hours; ?> ชม.</td>
						<td class="l" align="left" colspan="4"> &nbsp;&nbsp;ระยะเดินท่อน้ำยาไม่เกิน 10 เมตร</td>

					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">1. ชุด Condensing 
							<strong><u>
							<?php echo $compressor_name;?>
							</u></strong>
							  
							
						</td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"><?php echo number_format($befor_ship, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($befor_ship, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l"> 2.  ชุดคอล์ยเย็น <strong><u><?php echo $coyen_name;?></u></strong>  </td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">3. ผนังห้องเย็น โฟม <span style="font-weight:bold; text-decoration:underline; font-size:18px; color:red;"> <?php echo $foams." ".$foaminch; ?> นิ้ว</span> <span style="font-size: 12px;">ensity 38-40 kg/m3 เหล็ก BHP 0.45 เมตร</span> </td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"><?php //echo number_format($coilyenprice, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php //echo number_format($coilyenprice, 2, '.', ','); ?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - 2CB/<?php echo $foams;?> ผิวเรียบ พร้อมอุปกรณ์ติดตั้ง</td>
						<td colspan="2" class="l" align="center"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">4. ระบบไฟฟ้า ควบคุมห้องเย็น <strong><u><?php echo $firefa;?> </u></strong> <span style="font-size:14px;">พร้อมระบบความปลอดภัย</span></td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">5. <?php echo $doortypes; ?> ขนาด <strong><u><?php echo $d_width.' x '.$d_high?> เมตร</u></strong>  กว้าง สูง</td>
						<td colspan="2" class="l" align="center">1 บาน</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">6. ระบบ IoT สำหรับตรวจสอบอุณหภูมิห้องเย็น แบบออนไลน์  24 ชั่งโมง</td>
						<td colspan="2" class="l" align="center">1 ชุด</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"><s>48,000.00</s></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; - แจ้งเตือนถ้าห้องเย็นมีปัญหาผ่านมือถือ ฟรีค่าบริการปีแรก 10,000 บาท</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  (ต้องมี Internet WiFi บริเวณห้องเย็น)</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l"> 7. ค่าติดตั้งและจัดส่งสินค้า</td>
						<td colspan="2" class="l" align="center">1 งาน</td>
						<td class="l" align="center"><?php if($ship_cost == 0) echo ''; ?></td>
						<td class="l" align="right"><?php if($ship_cost != 0) echo number_format($ship_cost, 2, '.', ','); ?></td>
					</tr>
					
					
					
					<?php if($gift != '') { ?>
						<tr class="highs" style="">
							<td class="l">5.  <?php echo $gift;?></td>
							<td colspan="2" class="l"></td>
							<td class="l" align="center"></td>
							<td class="l" align="right"></td>
						</tr>
					<?php } ?>
					
					<?php if($additional  != '') { ?>
						<tr class="highs" style="">
							<td class="l" > <?php if($gift == ''){ echo '4. ' ; }  echo $additional;?></td>
							<td colspan="2" align="center" class="l">1</td>
							<td class="l" align="center"><?php echo number_format($additional_price, 0, '.', ',');?></td>
							<td class="l" align="right"><?php echo number_format($additional_price, 2, '.', ',');?></td>
						</tr>
					<?php } ?>
					
					
					
					<tr class="highs" style="">
						<td class="l"><span style="text-decoration: underline;">สีขอบเหล็กห้องเย็น</span> : <?php echo $ord_color; ?></td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"> </td>
					</tr>
  
					
					<tr>
						<td></td>
						<td colspan="3" class="rlt">รวมราคารายการทั้งหมดเป็นเงิน</td>
						<td class="t l" align="right"><?php echo number_format($amount, 2, '.', ',');?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">ส่วนลด</td>
						<td class="rt l" align="right"><?php //echo number_format($vats, 2, '.', ','); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right" id="totolprice"><?php echo number_format($incvat, 2, '.', ',');?> </td>
					</tr>
				
				</table>