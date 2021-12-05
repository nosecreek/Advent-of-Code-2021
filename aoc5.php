<?php
include("input5.php");
$data = explode("\n",$inputData);
$vents = [];
foreach($data as $i => $x) {
	$data[$i] = explode(" -> ", $data[$i]);
	
	foreach($data[$i] as $j => $y) {
		$data[$i][$j] = explode(",", $data[$i][$j]);
	}
}

//check for columns
foreach($data as $i => $x) {
	
	if($data[$i][0][0] == $data[$i][1][0]) { //x coords match
		$thisx = $data[$i][0][0];
		$starty = intval($data[$i][0][1]);
		$endy = intval($data[$i][1][1]);
		if($starty > $endy) {
			$endy = $starty;
			$starty = intval($data[$i][1][1]);
		}
		for($j=$starty;$j<=$endy;$j++) {
			if(!isset($vents[$thisx][$j])) {
				$vents[$thisx][$j] = 1;
			} else {
				$vents[$thisx][$j]++;
			}
		}
	}
	
	if($data[$i][0][1] == trim($data[$i][1][1])) { //y coords match
		$thisy = $data[$i][0][1];
		$startx = intval($data[$i][0][0]);
		$endx = intval($data[$i][1][0]);
		if($startx > $endx) {
			$endx = $startx;
			$startx = intval($data[$i][1][0]);
		}

		for($j=$startx;$j<=$endx;$j++) {
			if(!isset($vents[$j][$thisy])) {
				$vents[$j][$thisy] = 1;
			} else {
				$vents[$j][$thisy]++;
			}
		}
	}
}

$count = 0;
//find the overlaping points
foreach($vents as $i => $x) {
	foreach($vents[$i] as $j => $y) {
		if(intval($y) >= 2) {
			$count++;
		}
	}
}

?>
<html>
<head>
	<title>Advent of Code Day 5</title>
</head>
<body>Count: <?php echo $count; ?></body>
</html>
