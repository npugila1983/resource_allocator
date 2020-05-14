<?php
namespace Core\Model;

class Allocation
{

    public $region;

    public $total_cost;

    public $machines = array();

    public function __construct($region, $total_cost, $machines)
    {
        $this->region = $region;
        $this->total_cost = $total_cost;
        $this->machines = $machines;
    }
}
