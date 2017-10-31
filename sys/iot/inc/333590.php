<?php	
	$token = "5NyGjwO4G92GOhIYVb6i3jeAu7Uwowx6kBLtjDKsmwZ";
	$token1 = "jliLrNV8Biy1Gb51j6CnTYfMzO22RekxVh2KgqYETxt";
	$json_url = "https://api.thingspeak.com/channels/333590/feeds.json?results=288";
	$json = file_get_contents($json_url);
	$data = json_decode($json);
	$tempnow = $data->feeds[0]->field1;
?>