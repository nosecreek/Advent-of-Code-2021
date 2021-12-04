<?php
include("input3.php");

function lifeSupportRating($data,$invert=false) {
	$z = count($data[0]);
	$count = [];
	$length = count($data);
	
	for($i=0;$i<$z;$i++) {
		foreach($data as $j => $x) {
			if(!isset($count[$i])) { $count[$i] = 0; } 
			$count[$i] += intval($data[$j][$i]);
		}

		$count[$i] = intval(round($count[$i]/$length));
		if($invert) {
			$count[$i] = (int) !$count[$i];
		}
		
		foreach($data as $j => $x) {
			if(intval($data[$j][$i]) != $count[$i]) {
				unset($data[$j]);
			}
		}

		$length = count($data);
		if($length == 1) {
			$data = array_values($data)[0];
			break;
		}
	}

	return bindec(implode("",$data));
}

$inputData = explode("\n",$inputData);

foreach($inputData as $i => $x) {
	//split the string into numbers
	$inputData[$i] = str_split(trim($x));
}

$oxygen = lifeSupportRating($inputData);
$co2 = lifeSupportRating($inputData,true);
$answer = $oxygen*$co2;
?>
<html>
<head>
	<title>Advent of Code Day 3, Part 2</title>
</head>
<body><?php echo $answer; ?></body>
</html>
