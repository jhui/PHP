<?php
require_once __DIR__ . "/Offer.php";
require_once __DIR__ . "/../../helper/array_helper.php";		

class AnyItemOffer extends Offer
{	
	const ID_NAME = "ANY:";
	
	public function match($items)
	{
		if (empty($items))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Items are emtpy");
		if (!is_array($items))
			$items = array($items);
		
		list($common, $rest) = array_common_items($items, $this->items);

		$success = count($common)>0;
		if ($success) 				
			return array($success, $common, $rest, $this->price);
		else 
			return array($success, NULL, $items, INF);
	}
	
	public function id()
	{
		$name = self::ID_NAME;
		$sorted = $this->items;
		asort($sorted);
		
		foreach ($sorted as $item) {
			$name .= "{$item}:";
		} 
		return $name;
	}
	
}
