<?php

require_once "./vendor/autoload.php";

use Core\Controller\AllocationController;

$hours = $capacity = 0;

if(isset($argv) && $argv){
	$hours = isset($argv[2]) ? $argv[2] : 0;
	$capacity = isset($argv[1]) ? $argv[1] : 0;
}else{
	$hours = isset($_REQUEST['hours']) ? $_REQUEST['hours'] : 0;	//default value used
	$capacity = isset($_REQUEST['capacity']) ? $_REQUEST['capacity'] : 0; //default value used
}
$hours = (int)$hours;
$capacity = (int)$capacity;

$allocator = new AllocationController($hours, $capacity);
$allocator->allocate();
