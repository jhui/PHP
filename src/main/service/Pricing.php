<?php
class Pricing
{
	private $restaurant;

	function __construct($restaurant)
	{
		if (is_null($restaurant))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Restaurant is missing");

		$this->restaurant = $restaurant;
	}
	
	function price($items)
	{
		if (empty($items))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": Items are emtpy");
		if (!is_array($items))
			$items = array($items);
		
		// This restaurant cannot fullfill this order
		if (!$this->can_fullfill($items))
			return array(INF, NULL);
		
		$total = 0;
		$purchased = array();
		
		// Pricing from special offers first
		$offers = $this->restaurant->offers;
		if (!empty($offers)) {
			foreach ($offers as $offer) {
				// Check if the offer conditions are matched
				list ( $success, $common, $rest, $price ) = $offer->match($items);
				
				// Skip the offer if it is cheaper to buy the item individually
				$original_price = $success ? $this->restaurant->price($common) : 0.0;
				if ($original_price<=$price)
					$success = FALSE;
				
				// Accept the offer
				if ($success) {
					$items = $rest;
					$total += $price;
					$purchased = array_merge($purchased, $offer->items);
				}
				if (empty($items))
					break;
			}
		}
		
		// Price the remain items
		if (!empty($items)) {
			$total += $this->restaurant->price($items);
			$purchased = array_merge($purchased, $items);			
		}
		
		return array($total, $purchased);
	}
	
	function can_fullfill($items)
	{
		return $this->restaurant->can_sell_items($items);
	}		
}