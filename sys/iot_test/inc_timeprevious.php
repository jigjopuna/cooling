<?php
	//เวลาย้อนหลัง
		$spd = explode("T", $arrdate[0]);
		$predate = $spd[0];
		$pretime = rtrim($spd[1],"Z");
		
		echo '<br>  predate : '.$predate;
		echo '<br>  pretime : '.$pretime;
		
		$d2 = explode("-", $predate);
		$t2 = explode(":", $pretime);
		
		//เวลาล่าสุด
		$spd11 = explode("T", $arrdate[$time_period-1]);
		$postdate = $spd11[0];
		$postime = rtrim($spd11[1],"Z");
		
		echo '<br><br>  postdate : '.$postdate;
		echo '<br>  postime : '.$postime;
		
		$d3 = explode("-", $postdate);
		$t3 = explode(":", $postime);
		
		echo '<br><br>pretime : '.$pretime.'<br>'.$d2[0].'-'.$d2[1].'-'.$d2[2].' | '.$t2[0].'-'.$t2[1].'-'.$t2[2];
		echo '<br><br>postime : '.$postime.'<br>'.$d3[0].'-'.$d3[1].'-'.$d3[2].' | '.$t3[0].'-'.$t3[1].'-'.$t3[2];
		$a = (int)$d3[2];
		$b = (int)$d2[2];
		$diffday = $a-$b;
		$c = (int)$t3[0];
		$d = (int)$t2[0];
		$difftime = $c - $d;
		echo "<br> - - -  - - - - - - - - - - - -  - - - - - - - - - - - -  - - - - - - - - - - - -  - - - - - - - - -<br>";

?>