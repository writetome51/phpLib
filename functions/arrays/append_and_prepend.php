<?php

// All these functions modify $arrayToModify and return nothing.


function appendSingle($item, &$arrayToModify): void {
	$arrayToModify[] = $item;
}


function appendMultiple(array $items, &$arrayToModify): void {
	array_push($arrayToModify, ...$items);
}


function prependSingle($item, &$arrayToModify): void {
	array_unshift($arrayToModify, $item);
}


function prependMultiple(array $items, &$arrayToModify): void {
	array_unshift($arrayToModify, ...$items);
}
