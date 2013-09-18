<?php
require_once __DIR__ . '/../../main/model/MenuItem.php';

class MenuItemTest extends PHPUnit_Framework_TestCase
{
	const LABEL = "item1";
	const PRICE = 12.44;
	
	private $test_menu_item;
	
	protected function setUp()
	{
		$this->test_menu_item = new MenuItem(self::LABEL, self::PRICE);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_empty_label()
	{
		$item = new MenuItem(NULL, NULL);
		var_dump($item);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_invalid_label()
	{
		$item = new MenuItem("", 12);
	}
	
	public function test_label()
	{
		$this->assertEquals(self::LABEL, $this->test_menu_item->label);		
	}
	
	public function test_label_case_insensitive()
	{
		$labelUppercase = "Orange";
		$item = new MenuItem($labelUppercase, 12.34);
		$this->assertEquals(strtolower($labelUppercase), $item->label);		
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_empty_price()
	{
		$item = new MenuItem("orange", NULL);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_invalid_price()
	{
		$item = new MenuItem("orange", "invalid");
	}		
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function test_negative_price()
	{
		$item = new MenuItem("orange", -2);
	}		
	
	public function test_price()
	{
		$label = "orange";
		$price = 12.34;
		$item = new MenuItem($label, $price);
		$this->assertEquals($price, $item->price());
		
		$price = 12;
		$item = new MenuItem($label, $price);
		$this->assertEquals($price, $item->price());		
	}
	
}