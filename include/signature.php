				<div id="signature">
					<?php if($approv_sign == 1){ ?>
						<div class="sign"> 
							<div style="width:20%; float:left;"><p>ผู้อนุมัติ</p></div>
							<div style="width:80%;">
								<img src="https://topcooling.net/content/images/sign/<?php echo $e_id;?>.jpg" width="140px;">
							</div>
						</div>
					<?php } else {  ?>
						<div class="sign">ผู้อนุมัติ ..........................</div>
					<?php } ?>
					
					<div class="sign">ผู้รับเงิน ...........................</div>
					<div class="sign">ผู้รับสินค้า .........................</div>				
				</div>
				
				<div id="custname">
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; กัญญาณัฐ เย็นสุข  &nbsp;&nbsp;)</div>
					<div class="sign1">&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp;<?php echo $appv_name;	?>&nbsp;&nbsp;)</div>		
				</div>