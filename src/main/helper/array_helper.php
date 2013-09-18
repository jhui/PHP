<?php

// Remove common from an array 
// Note: a1={item1, item2, item2, item3}, a2={item2, item3}
//    => {item1, item2} 
// Sensitive to quantity: Since there are 2 item2 in a1 and 1 in a2, only one item2 is removed
function remove_array_items($from, $delete) {
	foreach ($delete as $to_delete) {
		$key = array_search ( $to_delete, $from );
		if ($key !== FALSE) {
			unset ( $from[$key] );
		}
	}
	return $from;
}

// Find common and the remains between 2 arrays
// Sensitive to quantity
function array_common_items($from, $delete) {
	$common = array();
	foreach ($delete as $to_delete) {
		$key = array_search ( $to_delete, $from );
		if ($key !== FALSE) {
			$common[] = $from[$key];
			unset ( $from[$key] );
		}
	}
	return array($common, $from);
}