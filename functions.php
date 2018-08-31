<?php


function getLength($arrayOrString){
	try{
		if (is_string($arrayOrString)) return strlen($arrayOrString);
		if (is_array($arrayOrString)) return count($arrayOrString);
		throw new Exception('Input must be either array or string.');
	}
	catch (Exception $e){
		echo $e;
	}
}


function isEmpty($array){
	return (count($array) === 0);
}


function notEmpty($array){
	return (!isEmpty($array));
}
