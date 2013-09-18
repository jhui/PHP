<?php
abstract class Offer
{
	public $items;
	public $price;
	
	function __construct($items, $price)
	{
		if (empty($items))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Items are emtpy");	
		if (!is_array($items))
			$items = array($items);
		$result = array();
		foreach ($items as $item) {
			validate_label($item);
			$result[] = trim($item);
		}
		validate_price($price);
				
		$this->items = $result;
		$this->price = $price;
	}
			
	abstract public function match($items);
	abstract public function id();	
}