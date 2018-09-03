<?php


function getSum($numbers): int {
	$sum = 0;
	for ($i = 0; $i < getLength($numbers); ++$i) {
		$sum += $numbers[$i];
	}
	return $sum;
}


function getAverage($numbers): int {
	$sum = getSum($numbers);
	return ($sum / getLength($numbers));
}


function getMedian($numbers): int {
}