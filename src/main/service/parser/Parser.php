<?php
require_once __DIR__ . "/CSVParser.php";

class Parser
{
	public $filename;
	public $delimiter = ",";
	
	function __construct($filename)
	{
		if (empty($filename))
			throw new InvalidArgumentException(__FILE__ . ":" . __LINE__ . ": filename is emtpy");
		$this->filename = $filename;
	}
		
	// Use factory pattern to create the corresponding parser based on the file extension
	public static function create_parser($filename)
	{	
		$needle = ".csv";
		$csv_file = ($needle === "" || substr($filename, -strlen($needle)) === $needle);
		if ($csv_file) {
			return new CSVParser($filename);
		} 
			
		// Support .cvs extension for now
		throw new Exception("Un-recognized file extension for file: {$filename}");			
	}
}