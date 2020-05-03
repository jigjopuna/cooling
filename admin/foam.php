<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	
</head>
<body>
<?php 

	$r_width  = 2.4; //trim($_POST['r_width']);
	$r_length  = 4.0; //trim($_POST['r_length']);
	$r_height  = 2.3; //trim($_POST['r_height']);
	
	
	//รู้แล้วได้กี่แผ่น แต่ยังไม่รู้ว่าแต่ละแผ่นยาวเท่าไร
	$panleftright = ceil($r_length/1.2)*2;
	$panalang = ceil($r_width/1.2)*2;
	$panpedan =  ceil($r_length/1.2);
	$panpeun  =  $panpedan;
	
	
	$areapan = $r_height*1.2;
	$areapanfar = $r_width*1.2;
	
	$arar_p_lr = $areapan*$panleftright;
	$arar_p_nl = $areapan*$panalang;
	$arar_p_ce = $areapanfar*$panpedan;
	$arar_p_fl = $areapanfar*$panpeun;
	
	$sum_area = $arar_p_lr + $arar_p_nl + $arar_p_ce + $arar_p_fl;
	
	
	/* แผ่นเพดาน อยากวางตามแนวยาวหรือแนวกว้าง ก็ต้องดูว่า ห้องกว้างยาว เกินกว่า 5 เมตร ไหม ถ้าเกิน 5 เมตร จะติดปัญหาเรื่องการขนส่ง */
	
	echo "แผ่นซ้ายขวา ". $panleftright . ' แผ่น (ขนาด  1.2x'.$r_height.') 1 แผ่น '.$areapan.' ตร.ม. '.' รวม '.$arar_p_lr.' ตร.ม.<br>';
	echo "แผ่นหน้าหลัง ". $panalang . ' แผ่น (ขนาด  1.2x'.$r_height.') 1 แผ่น '.$areapan.' ตร.ม. '.' รวม '.$arar_p_nl.' ตร.ม.<br>';
	echo "แผ่นเพดาน ". $panpedan . ' แผ่น (ขนาด  1.2x'.$r_width.') 1 แผ่น '.$areapanfar.' ตร.ม. '.' รวม '.$arar_p_ce.' ตร.ม.<br>';
	echo "แผ่นพื้น ". $panpeun . ' แผ่น (ขนาด  1.2x'.$r_width.') 1 แผ่น '.$areapanfar.' ตร.ม. '.' รวม '.$arar_p_fl.' ตร.ม.<br>';
	echo "รวม ". $sum_area .' ตร.ม.<br>';

?>
</body>
</html>