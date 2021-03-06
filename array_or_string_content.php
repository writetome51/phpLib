<?php


// Use this to replace both strlen() and count():
function getLength($arrayOrString): int {
	try {
		if (is_string($arrayOrString)) return strlen($arrayOrString);
		if (is_array($arrayOrString)) return count($arrayOrString);
		throw new Exception('Input must be either array or string.');
	} catch (Exception $e) {
		echo $e;
	}
}


function isEmpty($arrayOrString): bool {
	return (getLength($arrayOrString) === 0);
}


function notEmpty($arrayOrString): bool {
	return (!isEmpty($arrayOrString));
}
