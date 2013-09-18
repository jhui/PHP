<?php
function validate_price($price)
{
	if (is_null($price))
		throw new InvalidArgumentException("Price is missing");
	if (!is_numeric($price)) {
		$price = trim($price);
		throw new InvalidArgumentException("Price '{$price}' is non-numeric");
	}
	$price = floatval($price);
	if ($price<0)
		throw new InvalidArgumentException("Price '{$price}' is not positive");	
}

function validate_label($label)
{
	if (empty($label))
		throw new InvalidArgumentException("Label is missing/empty");
	if (is_numeric($label)) {		
		$label = trim($label);
		throw new InvalidArgumentException("Label '{$label}' should not be numeric");
	}
}
