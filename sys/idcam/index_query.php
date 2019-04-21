<?php session_start();
      include('include/connect.php');
	
	  
	  $search = trim($_GET['search']);
	  $velas = $_GET['vela'];
	  $int_time = (int)$velas;

	  $sql = "SELECT no, in1, chipid, time, temp FROM datalogger WHERE chipid = 'A49C2AC40A24' ORDER BY no DESC LIMIT 720";
	  
	  
	  if( $result = mysqli_query($con,$sql) ){
	     $rowcount = mysqli_num_rows($result);	  
	  }

	  
	  $work = 0;
	  $stop = 0;
	  $count = 0;
	  $nub = 0;
	  $flag = 0;
	  $past = -20;
	  
	  for($i=1; $i<= $rowcount; $i++){
		  $row = mysqli_fetch_array($result);
		  $now = (float)$row['temp'];
		  
		  $dicision = $past - $now;
		  //echo $row['temp'].' : '.$row['in1'].' '.$row['time'].' '. $dicision .'<br>';
		  if($dicision <= 0){
			   $count += 1; 
			   echo $count.'<br>';
		  }else{
			  $count = 0;
		  }
	  }
	
?>