<div class="page" id="backoffice" class="backoffice" style="display:none;">
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
						<td style="width: 60%" align="left">ห้องเย็น ปริมาณแผ่นฉนวน (<?php echo $sqmsum; ?>) ตารางเมตร ของแผ่น</td>
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
						<td class="l">Cost</td>
						<td class="l">Amount</td>
					</tr>
						
				
					
					
					<tr class="highs" style="">
						<td class="l">1. ผนังห้องเย็น โฟม <strong><u> <?php echo $foams." ".$foaminch; ?> นิ้ว</u></strong> density 38-40 kg/m3 เหล็ก BHP 0.45 เมตร </td>
						<td colspan="2" class="l" align="center">1 ห้อง</td>
						<td class="l" align="right"><?php echo number_format($walkai, 2, '.', ','); ?></td>
						<td class="l" align="right"><?php echo number_format($walkai, 2, '.', ','); ?></td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  แผ่นผนัง <?php echo $foams." ".$foaminch; ?>" นิ้ว 1.2 x <?php echo $r_high;?> เมตร  <?php echo $sqmwall;?>  ตร.ม.</td>
						<td colspan="2" class="l" align="center"><?php echo $walqty; ?> แผ่น</td>
						<td class="l" align="right"><?php echo number_format($wall_price, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($walqty*$wall_price, 2, '.', ',');?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  แผ่นเพดาน  <?php echo $foams." ".$foaminch; ?>" นิ้ว 1.2 x <?php echo $r_width;?> เมตร จำนวน <?php echo $sqmpedan;?>    ตร.ม.</td>
						<td colspan="2" class="l" align="center"><?php echo $pedan; ?> แผ่น</td>
						<td class="l" align="right"> <?php echo number_format($wall_price, 2, '.', ','); ?> </td>
						<td class="l" align="right"><?php echo number_format($pedan*$wall_price, 2, '.', ',');?></td>
					</tr>
					
					<tr class="highs" style="">
						<td class="l">&nbsp;&nbsp;&nbsp; -  แผ่นพื้น <?php echo $foams." ".$foaminch; ?>"  1.2 x <?php echo $r_width;?> เมตร จำนวน <?php echo $sqmfloor;?>    ตร.ม.</td>
						<td colspan="2" class="l" align="center"><?php echo $floors; ?> แผ่น</td>
						<td class="l" align="right"> <?php echo number_format($wall_price, 2, '.', ','); ?> </td>
						<td class="l" align="right"><?php echo number_format($floors*$wall_price, 2, '.', ','); ?></td>
					</tr>
					
					
					
					<tr class="highs" style="">
						<td class="l">2. <?php echo $doortypes; ?> ขนาด <strong><u><?php echo $d_width.' x '.$d_high?> เมตร</u></strong>  กว้าง สูง</td>
						<td colspan="2" class="l" align="center">1 บาน</td>
						<td class="l" align="center"></td>
						<td class="l" align="right"><?php echo number_format($pratoo, 2, '.', ',');?></td> 
					</tr>
					
					<tr class="highs" style="">
						<td class="l">3. ชุด Compressor 
							<?php echo $compressor_name; ?> ขนาด <?php echo $hp?>HP
						</td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"><?php echo number_format($cdu_cost, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($qtyhp*$cdu_cost, 2, '.', ',');?></td>
					</tr>
					
					
					<tr class="highs" style="">
						<td class="l">4. คอยล์เย็น ยี่ห้อ  <?php echo $coyen_name; ?></td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?> ชุด</td>
						<td class="l" align="right"><?php echo number_format($cooler_cost, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($qtyhp*$cooler_cost, 2, '.', ',');?></td>
					</tr>
						
					<tr class="highs" style="">
						<td class="l">5. ตู้คอนโทรล </td>
						<td colspan="2" class="l" align="center"><?php echo $qtyhp; ?></td>
						<td class="l" align="right"><?php echo number_format($controlprice, 2, '.', ',');?></td>
						<td class="l" align="right"><?php echo number_format($controlprice*$qtyhp, 2, '.', ',');?></td>
					</tr>
					
					
					
					
					<?php if($floor1==1){ ?>
					<tr class="highs" style="">
						<td class="l"> พื้นอลูมิเนียมลายกันลื่น</td>
						<td colspan="2" class="l"></td>
						<td class="l" align="center"></td>
						<td class="l" align="right"></td>
					</tr>
					<?php } ?>
					
					
					
				
				</table>

			</div><!--end product_price-->
			

			
			
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