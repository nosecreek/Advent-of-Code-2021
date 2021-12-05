<?php
include("input4.php");
$data = explode("\r\n\r\n",$inputData);
$board = [];
$winner = -1;
$score = 0;
$call = 0;

foreach($data as $i => $x) {
	if($i==0) {
		$draw = explode(",",$x);
	} else {
		$board[$i] = explode("\n",$x);
		
		foreach($board[$i] as $j => $y) {
			$board[$i][$j] = explode(" ",trim(str_replace("  ", " ", $y)));
		}
	}
}

foreach($draw as $x) {
	foreach($board as $i => $y) {
		foreach($board[$i] as $j => $z) {
			foreach($board[$i][$j] as $k => $ab) {
				if(intval($x) == intval($ab)) {
					unset($board[$i][$j][$k]);
				}
			}
		}
	}
	
	//check if we have a row
	foreach($board as $i => $y) {
		foreach($board[$i] as $j => $z) {
			for($k=0; $k < 5; $k++) {
				if(isset($board[$i][$j][$k])) {
					break;
				}
				if($k==4) {
					if(count($board)>1) {
						unset($board[$i]);
						
						break 2;
					} else {
						$winner = $i;
						$call = intval($x);
						break 4;
					}
				}
			}
		}
	}
	$board = array_values($board);
	
	//check if we have a column
	foreach($board as $i => $y) {
		for($j=0;$j<5;$j++) {
			for($k=0;$k<5;$k++) {
				if(isset($board[$i][$k][$j])) {
					break;
				}
				if($k==4) {
					if(count($board)>1) {
						unset($board[$i]);
						break 2;
					} else {
						$winner = $i;
						$call = intval($x);
						break 4;
					}
				}
			}
		}
	}
	$board = array_values($board);
}

//get the winning board's score
foreach($board[$winner] as $x) {
	foreach($x as $y) {
		$score += intval($y);
	}
}

$answer = $score*$call;
?>
<html>
<head>
	<title>Advent of Code Day 3 Part 2</title>
</head>
<body><?php echo $answer; ?></body>
</html>
