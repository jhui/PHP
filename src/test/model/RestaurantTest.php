<?php
require_once __DIR__ . '/../../main/model/Restaurant.php';
require_once __DIR__ . '/../../main/model/MenuItem.php';

class RestaurantTest extends PHPUnit_Framework_TestCase
{
	const ID =  123;
	const PRICE = 5.6;
	const LABEL = "item2";
	
	private $test_restaurant;	
	private $test_menu_items;
	private $test_offers;
	protected function setUp()
	{
		$this->test_restaurant = new Restaurant(self::ID);
		$this->test_menu_items = array();
		$this->test_menu_items[] = new MenuItem("item1", 12.3);
		$this->test_menu_items[] = new MenuItem(self::LABEL, self::PRICE);
		$this->test_menu_items[] = new MenuItem("item3", 6.6);
		
		$this->test_offers = array();
		$this->test_offers[] = new AnyItemOffer(array("item1", "item2", "item3"), 35.6);	
		$this->test_offers[] = new AnyItemOffer(array("item3", "item4", "item5"), 12.6);	
		$this->test_offers[] = new AnyItemOffer(array("item1", "item3", "item2"), 34.1);	
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_empty_id()
	{
		$restaurant = new Restaurant(NULL);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_invalid_id()
	{
		$restaurant = new Restaurant("illegal");
	}

	public function test_id()
	{
		$this->assertEquals(self::ID, $this->test_restaurant->id);		
	}
	
	public function test_add_menu_items()
	{		
		$this->test_restaurant->add_menu_item($this->test_menu_items[0]);
		$this->test_restaurant->add_menu_item($this->test_menu_items[1]);
		$this->test_restaurant->add_menu_item($this->test_menu_items[2]);
		$label = "item1";
		$menuItem = $this->test_restaurant->get_menu_item($label);
		$this->assertEquals($label, $menuItem->label);
		$label = "item3";
		$menuItem = $this->test_restaurant->get_menu_item($label);
		$this->assertEquals($label, $menuItem->label);
	}

	public function test_add_offers()
	{
		$this->test_restaurant->add_offer($this->test_offers[0]);
		$this->test_restaurant->add_offer($this->test_offers[1]);
		$this->test_restaurant->add_offer($this->test_offers[2]);
		$this->assertEquals(2, $this->test_restaurant->offer_count());
		$this->test_restaurant->add_offer($this->test_offers[2]);
		$this->assertEquals(2, $this->test_restaurant->offer_count());
	}
	
	public function test_price()
	{
		$this->test_restaurant->add_menu_item($this->test_menu_items[0]);
		$this->test_restaurant->add_menu_item($this->test_menu_items[1]);
		$this->test_restaurant->add_menu_item($this->test_menu_items[2]);
		$this->assertEquals(self::PRICE, $this->test_restaurant->item_price(self::LABEL));

		$this->assertEquals(INF, $this->test_restaurant->item_price("unknown"));	

		$this->assertEquals(18.9, $this->test_restaurant->price(array("item1", "item3")));
		$this->assertEquals(INF, $this->test_restaurant->price(array("item1", "item3", "unknown")));
		
	}
	
	public function test_sell_items()
	{
		$this->test_restaurant->add_menu_item($this->test_menu_items[0]);
		$this->test_restaurant->add_menu_item($this->test_menu_items[1]);
		$this->test_restaurant->add_menu_item($this->test_menu_items[2]);
		
		$this->assertTrue($this->test_restaurant->can_sell_items("item1"));
		$this->assertTrue($this->test_restaurant->can_sell_items(array("item1", "item2")));
		$this->assertTrue($this->test_restaurant->can_sell_items(array("item1", "item2", "item3")));

		$this->assertFalse($this->test_restaurant->can_sell_items("item4"));
		$this->assertFalse($this->test_restaurant->can_sell_items(array("item1", "item4")));
		$this->assertFalse($this->test_restaurant->can_sell_items(array("item1", "item4", "item3")));

	}
}