<?php 
$json_url = "https://api.thingspeak.com/channels/328382/feeds.json?results=288";
$json = file_get_contents($json_url);
$data = json_decode($json);

$arrtemp = array();
$sum = 0;
$avg = 0;

for($i=0; $i<=288; $i++){
	//print_r($data->feeds[$i]->field1);
	$arrtemp[$i] = $data->feeds[$i]->field1;
	
}
for($j=0; $j<=sizeof($arrtemp); $j++ ){
	//echo $sum+$arrtemp[$j];
	$sum = $sum+$arrtemp[$j];
}
$avg = $sum/sizeof($arrtemp);

echo 'sum : '.$sum.'<br>';
echo 'avg : '.$avg.'<br>';
echo 'min : '.min(array_values($arrtemp));
print_r($arrtemp);

/*echo "<pre>";
print_r($data);
echo "</pre>";
*/


?>



