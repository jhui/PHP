<?php
require_once __DIR__ . "/Parser.php";
require_once __DIR__ . "/../../model/Restaurant.php";
require_once __DIR__ . "/../../model/offer/AnyItemOffer.php";
require_once __DIR__ . "/../../model/MenuItem.php";

class CSVParser extends Parser
{	
	public function parse()
	{
		$restaurants = array();
		$filename = "../../data/uploads/" . $this->filename;
		if(!file_exists($filename) || !is_readable($filename))
			throw new Exception(__FILE__ . ":" . __LINE__ . ": Cannot open {$filename}");
					
		if (($handle = fopen($filename, 'r')) !== FALSE) {
			while (($row_data = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {
				try {
					if (count($row_data)<3)
						throw new Exception("Require at least 3 fields in each row");								
					
					if (isset($row_data[0])) {
						$id = $row_data[0];
						if (!is_numeric($id))
							throw new Exception("Restaurant ID '{$id}' is non-numeric");
						
						$restaurant = $this->restaurant_exist($restaurants, $id);
						if (empty($restaurant)) {
							$restaurant = new Restaurant($id);
							$restaurants[] = $restaurant;
						}
						
						$price = $row_data[1];
						if (count($row_data)==3) {
							$item = $row_data[2];
							$menu = new MenuItem($item, $price);		
							$restaurant->add_menu_item($menu);
						} else {
							$items = array_slice($row_data, 2);
							$offer = new AnyItemOffer($items, $price);
							$restaurant->add_offer($offer);						
						}
					}
				} catch (Exception $e) {
					// Output parsing error to PHP error log
					$s = print_r($row_data, 1);
					error_log("Parsing error: " . $e->getMessage());
					error_log("Row data: " . $s);
				}
			}
			fclose($handle);
		}
		return $restaurants;
	}		
	
	function restaurant_exist($restaurants, $id) 
	{
		foreach ($restaurants as $restaurant) {
			if ($restaurant->id == $id)
				return $restaurant;
		}	
	}
	
}
