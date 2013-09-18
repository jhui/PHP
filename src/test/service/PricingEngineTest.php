<?php

require_once __DIR__ . '/../../main/service/PricingEngine.php';

class PricingEngineTest extends PHPUnit_Framework_TestCase
{
	public function testPricingNoOffer()
	{
		$items = array("item1", "item2", "item2", "item3");		
		$restaurants = array();
		
		$restaurant = new Restaurant(125);
	
		$menu_items = array();
		$menu_items[] = new MenuItem("item1", 11.0);
		$menu_items[] = new MenuItem("item2", 14.0);
		$menu_items[] = new MenuItem("item3", 10.0);
		$menu_items[] = new MenuItem("item4", 5.0);
		$restaurant->add_menu_item($menu_items[0]);
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		$restaurant->add_menu_item($menu_items[3]);
	
		$offer = array();
		$offer[] = new AnyItemOffer(array("item1", "item3", "item7"), 3.0);
		$offer[] = new AnyItemOffer(array("item11", "item12", "item12", "item13"), 8.0);
		$restaurant->add_offer($offer[0]);
		$restaurant->add_offer($offer[1]);
	
		$restaurants[] = $restaurant;

		$restaurant = new Restaurant(126);
		$menu_items = array();
		$menu_items[] = new MenuItem("item1", 10.0);
		$menu_items[] = new MenuItem("item2", 11.0);
		$menu_items[] = new MenuItem("item3", 4.0);
		$menu_items[] = new MenuItem("item4", 3.0);
		$restaurant->add_menu_item($menu_items[0]);
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		$restaurant->add_menu_item($menu_items[3]);
		
		$offer = array();
		$offer[] = new AnyItemOffer(array("item1", "item3", "item7"), 6.0);
		$offer[] = new AnyItemOffer(array("item11", "item12", "item12", "item13"), 8.0);
		$restaurant->add_offer($offer[0]);
		$restaurant->add_offer($offer[1]);
		$restaurants[] = $restaurant;
		
		list($restaurant , $price) = PricingEngine::get_instance()->price($restaurants, $items);
		$this->assertEquals($price, 28);
	}
}
