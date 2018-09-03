<?php

// All these functions modify $array and return nothing.


function getAndRemoveFirstItem(&$array) { // returns any.
	return array_shift($array);
}


function getAndRemoveLastItem(&$array) { // returns any.
	return array_pop($array);
}


function removeFirstItem(&$array): void {
	getAndRemoveFirstItem($array);
}


function removeLastItem(&$array): void {
	getAndRemoveLastItem($array);
}
