<?php
require_once __DIR__ . '/../../main/helper/array_helper.php';

class ArrayHelperTest extends PHPUnit_Framework_TestCase
{
	public function test_array_remove() 
	{
		
		$a1 = array("item1", "item2", "item2", "item1", "item3");
		$a2 = array("item4", "item2", "item2", "item1");
		$result = remove_array_items($a1, $a2);
		$this->assertEquals(2, count($result));
		$this->assertTrue(in_array("item1", $result));
	}

	public function test_array_common()
	{	
		$a1 = array("item1", "item2", "item2", "item1", "item3");
		$a2 = array("item4", "item2", "item2", "item1");
		list($common, $rest_a1) = array_common_items($a1, $a2);
		$this->assertEquals(3, count($common));
		$this->assertEquals(2, count($rest_a1));
		$this->assertTrue(in_array("item1", $rest_a1));
		$this->assertTrue(in_array("item3", $rest_a1));
		$this->assertFalse(in_array("item2", $rest_a1));
		$this->assertTrue(in_array("item1", $common));
	}
	
}

