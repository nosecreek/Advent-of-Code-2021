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

foreach($data as $i => $x) {
	$startx = intval($data[$i][0][0]);
	$endx = intval($data[$i][1][0]);
	$starty = intval($data[$i][0][1]);
	$endy = intval($data[$i][1][1]);
	$thisx = $startx;
	$thisy = $starty;
	
	if($startx == $endx) { //x coords match - this is a column
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
	} elseif($starty == $endy) { //y coords match - this is a row
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
	} else { //we've got a diaganol
		if(($startx<$endx && $starty<$endy) || ($startx>$endx && $starty>$endy)) { //diaganol goes up left or down right
			if($startx>$endx) { //if it is up left, make it down right
				$endx = intval($data[$i][0][0]);
				$startx = intval($data[$i][1][0]);
				$endy = intval($data[$i][0][1]);
				$starty = intval($data[$i][1][1]);
			}
			
			$thisy = $starty;
			for($j=$startx;$j<=$endx;$j++) {
				if(!isset($vents[$j][$thisy])) {
					$vents[$j][$thisy] = 1;
				} else {
					$vents[$j][$thisy]++;
				}
				$thisy++;
			}
		} else { //diaganol goes up right or down left
			if($startx>$endx) { //if it is down left, make it up right
				$endx = intval($data[$i][0][0]);
				$startx = intval($data[$i][1][0]);
				$endy = intval($data[$i][0][1]);
				$starty = intval($data[$i][1][1]);
			}
			
			$thisy = $starty;
			for($j=$startx;$j<=$endx;$j++) {
				if(!isset($vents[$j][$thisy])) {
					$vents[$j][$thisy] = 1;
				} else {
					$vents[$j][$thisy]++;
				}
				$thisy--;
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
	<title>Advent of Code Day 5 Part 2</title>
</head>
<body>Count: <?php echo $count; ?></body>
</html>
