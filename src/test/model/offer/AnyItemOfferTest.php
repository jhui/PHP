<?php
require_once __DIR__ . '/../../../main/model/offer/AnyItemOffer.php';

class AnyItemOfferTest extends PHPUnit_Framework_TestCase
{
	const PRICE = 35.6;
	
	public $test_offer;
	
	protected function setUp()
	{
		$this->test_offer = new AnyItemOffer(array("item1", "item2", "item3", "item2"), self::PRICE);
	}
		
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_null_item()
	{		
		$offer = new AnyItemOffer(NULL, NULL);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_empty_item()
	{		
		$offer = new AnyItemOffer(array(), NULL);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_invalid_items()
	{
		$offer = new AnyItemOffer(array("item1", 5), 12);
	}

	public function test_offers()
	{
		$label = "item1";
		$price = 12.34;
		$offer = new AnyItemOffer($label, $price);
		$this->assertEquals($label, $offer->items[0]);
		$this->assertEquals($price, $offer->price);

		$label = array("item1", "item2");
		$price = 12.34;
		$offer = new AnyItemOffer($label, $price);
		$this->assertEquals($label[1], $offer->items[1]);
	}
	
	public function test_match1()
	{
		$label = "item1";
		list($success, $common, $items, $price) = $this->test_offer->match($label);
		$this->assertTrue($success);
		$this->assertEquals($price, self::PRICE);		
		$this->assertEquals(count($common), 1);
		$this->assertEquals(count($items), 0);
	}

	public function test_match2()
	{
		list($success, $common, $items, $price) = $this->test_offer->match(array("item1", "item2", "item2"));
		$this->assertTrue($success);
		$this->assertEquals($price, self::PRICE);
		$this->assertEquals(count($common), 3);
		$this->assertEquals(count($items), 0);
	}

	public function test_match3()
	{
		list($success, $common, $items, $price) = $this->test_offer->match(array("item1", "item2", "item3", "item6", "item7"));
		$this->assertTrue($success);
		$this->assertEquals($price, self::PRICE);
		$this->assertEquals(count($common), 3);
		$this->assertEquals(count($items), 2);
	}
	
	public function test_match4()
	{
		list($success, $common, $items, $price) = $this->test_offer->match(array("item6", "item7"));
		$this->assertFalse($success);
		$this->assertEquals($price, INF);
		$this->assertEquals(count($common), 0);
		$this->assertEquals(count($items), 2);
	}
	
	public function test_id() 
	{
		$this->assertEquals("ANY:item1:item2:item2:item3:",  $this->test_offer->id());
	}
	
	
}