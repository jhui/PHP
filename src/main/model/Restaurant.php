<?php

class Restaurant
{
	public $id;								# Restaurant id in integer
	public $items = array();				# Array of MenuItem : food items offered
	public $offers = array();				# Array of Offer: offers

	function __construct($id)
	{
		if (is_null($id))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Restaurant id is missing");
		
		if (!is_numeric($id)) 
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Restaurant id {$id} is non-integer");

		$id = intval($id);		
		$this->id = $id;
	}
	
	function add_menu_item($item)
	{
		if (is_null($item))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Item is missing");
		
		$this->items[$item->label] = $item;
	}

	function get_menu_item($label)
	{
		return $this->items[$label];
	}

	function add_offer($offer)
	{
		if (is_null($offer))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Offer is missing");
	
		$this->offers[$offer->id()] = $offer;
	}
	
	function offer_count()
	{
		return count($this->offers);
	}
	
	function can_sell_items($items)
	{
		if (empty($items))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Items are emtpy");
		if (!is_array($items))
			$items = array($items);
		$keys = array_keys($this->items);
		$diff = array_diff($items, $keys);
		if (empty($diff))
			return TRUE;
		foreach ($this->offers as $offer) {
			$o_diff = array_diff($diff, $offer->items);
			if (empty($o_diff))
				return TRUE;
		}		
		return FALSE;		
	}	
	
	function price($labels) 
	{
		$cost = 0;
		foreach ($labels as $label) {
			$item_cost = $this->item_price($label);
			if ($item_cost==INF)
				return INF;
			$cost += $item_cost;
		}
		return $cost;
	}
	
	function item_price($label)
	{
		if (!isset($this->items[$label]))
			return INF;
		$item = $this->items[$label];
		return $item->price();
	}
}