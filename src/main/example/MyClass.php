<?php

class MyClass
{
	const MESSAGE = 'hello world';            

	public static $s1 = 'greeting';          

	public $v1 = 'welcome';                  
	public $v2 = array(1,2);
	public $v3;

	function __construct($val=1)             
	{
		$v3 = 10 * $val;
	}

	function __destruct()                 
	{
	}

	public function hi()
	{
		echo $this->v1;                      
		echo self::MESSAGE;                  
		static::greet();                     
	}

	public static function greet()
	{
		echo self::$s1;                     
	}
}

$test = new MyClass(10);

MyClass::greet();
$test->greet();

MyClass::$s1;
$test::$s1;

MyClass::MESSAGE;
$test::MESSAGE;

$test->hi();
$test->v1;

class MyChildClass extends MyClass       
{
	function __construct() {
		parent::__construct();            
	}

	function hi() {
		parent::hi();               
	}
}

$obj = new MyChildClass();
if ($obj instanceof MyChildClass) {
}
