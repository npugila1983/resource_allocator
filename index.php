<?php

require_once "./vendor/autoload.php";

use Core\Controller\AllocationController;

$hours = isset($_REQUEST['hours']) ? $_REQUEST['hours'] : 1;	//default value used
$capacity = isset($_REQUEST['capacity']) ? $_REQUEST['capacity'] : 1150; //default value used

$allocator = new AllocationController($hours, $capacity);
$allocator->allocate();
