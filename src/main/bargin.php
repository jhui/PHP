<?php
require_once __DIR__ . "/service/parser/Parser.php";
require_once __DIR__ . "/service/PricingEngine.php";

if (count($argv) < 3) {
	echo "Usage: bargin filename item1 [item2 item3...]\n";
	exit(-1);
}

$filename = $argv[1];
$food_items = array_slice($argv, 2);

// Create parser based on file extension type
$parser =  Parser::create_parser($filename);
$restaurants = $parser->parse();

// Compute the restaurant & price information
list($restaurant , $price) = PricingEngine::get_instance()->price($restaurants, $food_items);

// Output result
$r_id = empty($restaurant) ? "null" : $restaurant->id;
echo "\n\n\nResullt: ";
echo "{$r_id} {$price}\n\n\n";


