<?php
require_once __DIR__ . '/../../main/service/Pricing.php';

class PricingTest extends PHPUnit_Framework_TestCase
{	
	public function testPricingNoOffer()
	{
		$restaurant = new Restaurant(125);
		$items = array("item1", "item2", "item3");
		
		$menu_items = array();						
		$menu_items[] = new MenuItem("item1", 12.3);
		$menu_items[] = new MenuItem("item2", 4.5);
		$menu_items[] = new MenuItem("item3", 6.6);
		$restaurant->add_menu_item($menu_items[0]);		
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		
		$engine = new Pricing($restaurant);
		list ($price, $purchased) = $engine->price($items);
		$this->assertEquals(23.4, $price);
	}

	public function testPricingWithOffersFail()
	{
		$restaurant = new Restaurant(125);
		$items = array("item1", "item2", "item2", "item3");
	
		$menu_items = array();
		$menu_items[] = new MenuItem("item1", 12.3);
		$menu_items[] = new MenuItem("item2", 4.5);
		$menu_items[] = new MenuItem("item3", 6.6);
		$menu_items[] = new MenuItem("item4", 7.6);
		$restaurant->add_menu_item($menu_items[0]);
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		$restaurant->add_menu_item($menu_items[3]);
	
		$offer = array();
		$offer[] = new AnyItemOffer(array("item5", "item5", "item7", "item8"), 1.2);
		$offer[] = new AnyItemOffer(array("item11", "item12", "item12", "item13"), 1.5);
		$restaurant->add_offer($offer[0]);
		$restaurant->add_offer($offer[1]);
	
		$engine = new Pricing($restaurant);
		list ($price, $purchased) = $engine->price($items);
		$this->assertEquals(27.9, $price);
	}	
	public function testPricingWithOneOffer()
	{
		$restaurant = new Restaurant(125);
		$items = array("item1", "item2", "item2", "item3");
	
		$menu_items = array();
		$menu_items[] = new MenuItem("item1", 12.3);
		$menu_items[] = new MenuItem("item2", 4.5);
		$menu_items[] = new MenuItem("item3", 6.6);
		$menu_items[] = new MenuItem("item4", 7.6);
		$restaurant->add_menu_item($menu_items[0]);
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		$restaurant->add_menu_item($menu_items[3]);

		$offer = array();
		$offer[] = new AnyItemOffer(array("item5", "item5", "item7", "item8"), 1.2);
		$offer[] = new AnyItemOffer(array("item1", "item2", "item2", "item3"), 1.5);
		$restaurant->add_offer($offer[0]);
		$restaurant->add_offer($offer[1]);
		
		$engine = new Pricing($restaurant);
		list ($price, $purchased) = $engine->price($items);
		$this->assertEquals(1.5, $price);
	}


	
	public function testPricingWithOverpurchaseOffer()
	{
		$restaurant = new Restaurant(125);
		$items = array("item1", "item2", "item2", "item3");
	
		$menu_items = array();
		$menu_items[] = new MenuItem("item1", 12.3);
		$menu_items[] = new MenuItem("item2", 4.5);
		$menu_items[] = new MenuItem("item3", 6.6);
		$menu_items[] = new MenuItem("item4", 7.6);
		$restaurant->add_menu_item($menu_items[0]);
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		$restaurant->add_menu_item($menu_items[3]);
	
		$offer = array();
		$offer[] = new AnyItemOffer(array("item5", "item5", "item7", "item8"), 1.2);
		$offer[] = new AnyItemOffer(array("item1", "item2", "item2", "item4", "item3"), 1.5);
		$restaurant->add_offer($offer[0]);
		$restaurant->add_offer($offer[1]);
	
		$engine = new Pricing($restaurant);
		list ($price, $purchased) = $engine->price($items);
		$this->assertEquals(1.5, $price);
	}

	public function testPricingWithOverpurchaseOfferFail()
	{
		$restaurant = new Restaurant(125);
		$items = array("item1", "item2", "item2", "item3");
	
		$menu_items = array();
		$menu_items[] = new MenuItem("item1", 12.3);
		$menu_items[] = new MenuItem("item2", 4.5);
		$menu_items[] = new MenuItem("item3", 6.6);
		$menu_items[] = new MenuItem("item4", 7.6);
		$restaurant->add_menu_item($menu_items[0]);
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		$restaurant->add_menu_item($menu_items[3]);
	
		$offer = array();
		$offer[] = new AnyItemOffer(array("item5", "item5", "item7", "item8"), 1.2);
		$offer[] = new AnyItemOffer(array("item1", "item2", "item2", "item4", "item3"), 29);
		$restaurant->add_offer($offer[0]);
		$restaurant->add_offer($offer[1]);
	
		$engine = new Pricing($restaurant);
		list ($price, $purchased) = $engine->price($items);
		$this->assertEquals(27.9, $price);
	}

	public function testPricingWithMultipleOffer()
	{
		$restaurant = new Restaurant(125);
		$items = array("item1", "item2", "item2", "item3");
	
		$menu_items = array();
		$menu_items[] = new MenuItem("item1", 12.3);
		$menu_items[] = new MenuItem("item2", 4.5);
		$menu_items[] = new MenuItem("item3", 6.6);
		$menu_items[] = new MenuItem("item4", 7.6);
		$restaurant->add_menu_item($menu_items[0]);
		$restaurant->add_menu_item($menu_items[1]);
		$restaurant->add_menu_item($menu_items[2]);
		$restaurant->add_menu_item($menu_items[3]);
	
		$offer = array();
		$offer[] = new AnyItemOffer(array("item1", "item7", "item8"), 22.2);
		$offer[] = new AnyItemOffer(array("item1", "item3", "item7", "item8"), 1.2);
		$offer[] = new AnyItemOffer(array("item1", "item2", "item2", ), 2.2);
		$restaurant->add_offer($offer[0]);
		$restaurant->add_offer($offer[1]);
		$restaurant->add_offer($offer[2]);
		
		$engine = new Pricing($restaurant);
		list ($price, $purchased) = $engine->price($items);
		$this->assertEquals(3.4, $price);
	}
	
}


