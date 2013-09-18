<?php
require_once __DIR__ . "/validator.php";
		
class MenuItem
{
	public $label;							# Food item label
	private $price;							# Food price
	
	function __construct($label, $price)
	{
		validate_label($label);		
		validate_price($price);
		$label = trim($label);
		$this->label =  strtolower($label);
		$this->price = $price;
	}	
	
	function price()
	{
		return $this->price;
	}
}