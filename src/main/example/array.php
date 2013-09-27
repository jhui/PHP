<?php

// Array
$a1 = array();
$a1 = array(2, 1, 0);
$a1[] = 4;

// Map
$a2 = array('text' => 'string', 10 => 4, 'absent' => TRUE);
$a2['text'];  	    	      
$a2[10]; 

unset($a2['absent']);

// Key/values
$k = array_keys($a2);
$v = array_values($a2);

// Indexing
array_key_exists('key', $a2);
in_array('x', $a2);
$k = array_search('x', $a2);

// Sub-array
$sub_array = array_slice($a2, 1, 2);     // From index 1 with 2 elements
$sub_array = array_splice($a2, 1, 2);    // Remove index 1 and up to 2 element

list($v1, $v2, $v3, $v4) = array(1, 2, 3, 4);

// Array set operation
array_merge($a1, $a2);
array_diff($a1, $a2);

// Function
count($a1);
array_sum($a1);
array_reverse($a1);

// foreach
$months = array(1=>'Jan', 'Feb', 'Mar', 'Apr');
foreach ($months as $month) {
}

foreach ($months as $key => $month) {
}

// sort
sort($a1);