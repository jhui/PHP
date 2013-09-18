<?php
require_once __DIR__ . "/Pricing.php";
class PricingEngine
{
	private static $instance;

	public static function get_instance()
	{
		if (!isset(self::$instance)) {
			$class_name = __CLASS__;
			self::$instance = new $class_name;
		}

		return self::$instance;
	}

	public function __clone()
	{
		trigger_error('Clone is not allowed for singleton object.', E_USER_ERROR);
	}

	public function price($restaurants, $items)
	{
		$min_restaurant = NULL;
		$total = INF;
		foreach ($restaurants as $restaurant) {
			$engine = new Pricing($restaurant);					
			 list ($price, $purchased) = $engine->price($items);
			 if ($total>$price) {
			 	$total = $price;
			 	$min_restaurant = $restaurant;
			 }
		}
		return array($min_restaurant, $total);
	}
}