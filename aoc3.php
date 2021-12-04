<?php
include("input3.php");
$data = explode("\n",$inputData);
$count = [];
$gamma = "";
$epsilon = "";

foreach($data as $x) {
	//split the string into numbers
	$x = str_split(trim($x));

	//add each number to it's column's total
	foreach($x as $i => $y) {
		if(!isset($count[$i])) { $count[$i] = 0; } 
		$count[$i] += intval($y);
	}
}

//divide each column by the length of the array & round to get the result
$length = count($data);
foreach($count as $i => $x) {
	$gamma[$i] = intval(round($x/$length));
	
	//invert each number for the epsilon value
	$epsilon[$i] = (int) !$gamma[$i];
}

//convert to decimal and multiply to get answer
$gamma = bindec($gamma);
$epsilon = bindec($epsilon);
$answer = $gamma * $epsilon
?>
<html>
<head>
	<title>Advent of Code Day 3</title>
</head>
<body><?php echo $answer; ?></body>
</html>
