<?php

$start = TRUE;     
$start = 1.2;

static $v = 0;
const A_CONSTANT = 'world';

$v1 = $v2 = 10;
$v3 = &$v1;

function m1(&$p1) {
}

// Output
echo 'value= ', $start;
var_dump($start);
print_r($start);

PHP_INT_MAX;

$v = (int) (8/3);
$v = round(8/3); 

$a = array();
is_array($a);
is_numeric($a);
is_string($a);

$str = 'This ' . 'is ' . 'one ' . 'sentence';
"String is {$str}";

$r = explode(':', 'John:Paul:Mary');
$s = join(':', $r);

strcmp('ab', 'bf'); 
strcasecmp('FG', 'fg');

$s = " text";
$pos = strpos("abcd", "cd");
substr('0123456789', 4, 3);
strlen($s);
trim($s);
strtolower($s);

try {
	throw new Exception('Some error'); 
} catch (Exception $ex) { 
	echo 'Recover from error';
}

function m1($p1, $p2='some value')
{
}

if ($expression) {
} elseif ($expression) {
} else {
}

$a = array(1, 2, 3, 4);
for($i = 0; $i < sizeof($a); ++$i)
{
}

switch ($expression) {
	case 6:
		break;
	case 7:
	case 8:
		break;
	default:
		break;
}