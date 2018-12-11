<table style="width: 100%; border: solid black 1px;  border-collapse: collapse;">
					<tr>
						<td colspan="5" align="center" style="background: #DAD7D7; border: 1px solid black;">รายละเอียดห้องเย็นสำเร็จรูป มือสองประกอบใหม่ </td>
					</tr style="border: solid black 1px;">
					
					<tr border='1' align="center">
						<td style="width: 60%" align="left">ห้องเย็นสำเร็จรูป  (เคลื่อนย้ายได้)  <strong><u>มือสอง ยาว <?php echo $r_lenght; ?> เมตร</u></strong></td>
						<td colspan="2" style="width: 13%;" class="rlb">กว้าง  (เมตร)</td>
						<td style="width: 13%" class="br">ยาว   (เมตร)</td>
						<td style="width: 13%" class="b">สูง  (เมตร)</td> 
					</tr>
					<tr align="center">
						<td align="left">COLD ROOM TEMP  <?php echo $ord_temp; ?>C<Sup>o</Sup> ขนาดห้อง (วัดภายนอก) </td>
						<td class="l"><?php echo $r_width; ?></td>
						<td class="r"></td>
						<td><?php echo $r_lenght; ?></td>
						<td class="l"><?php echo $r_high; ?> </td>
					</tr>
					
					<tr align="center" style="background: #DAD7D7; border: 1px black solid;">
						<td class="l">Description </td>
						<td colspan="2" class="l">QTY</td>
						<td class="l">Unit Price</td>
						<td class="l">Amount</td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">วัสดุและอุปกรณ์ที่ใช้ในการประกอบติดตั้งประกอบด้วย </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">1. ราคาห้องเย็นตามขนาดและรายการข้างต้น</td>
						<td colspan="2" class="l" align="center">1</td>
						<td class="l" align="center"><?php echo number_format($ord_price, 0, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($ord_price, 2, '.', ','); ?></td> 
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ระบบไฟฟ้า <strong><u><?php echo $firefa?> </u></strong></td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - คอมเพรสเซอร์ Copeland ของใหม่</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="right"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ประตูบานสวิงขนาด <strong><u>0.75 x 1.8 เมตร</u></strong> กว้าง สูง </td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>

					<tr class="highs" style="">
						<td class="l">2. ค่าจัดส่งสินค้า</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"><?php if($ship_cost == 0) echo 'ฟรี'; ?></td>
						<td class="l" align="right"><?php if($ship_cost != 0) echo number_format($ship_cost, 2, '.', ','); ?></td>
					</tr>
					
					<?php if($r_type==1) { ?>
					<tr class="highs" style="">
						<td class="l">3. ระบบ IoT สำหรับตรวจสอบอุณหภูมิห้องเย็น แบบออนไลน์  24 ชั่งโมง</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - และแจ้งเตือนหากห้องเย็นมีปัญหาผ่านมือถือ</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<?php } ?>
					
					<?php if($gift != '') { ?>
						<tr class="highs" style="">
							<td class="l">4.  <?php echo $gift;?></td>
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
						<td class="l"><span style="text-decoration: underline;">ตำแหน่ง</span> ประตู : <?php echo $door; ?>, ตู้คอนโทรล : <?php echo $control; ?>, คอล์ยร้อน : <?php echo $coilh; ?></td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l"><span style="text-decoration: underline;">สีขอบเหล็กห้องเย็น</span> : <?php echo $ord_color; ?></td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
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
						<td>ข้อมูลเพิ่มเติม https://topcooling.net/th/article/secondhand.php</td>
						<td colspan="3" class="rl">รวมเป็นเงินสุทธิ</td>
						<td class="rt l" align="right"><?php echo number_format($incvat, 2, '.', ',');?> </td>
					</tr>
				
				</table>