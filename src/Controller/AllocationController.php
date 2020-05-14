<?php
namespace Core\Controller;

use \Core\Dao\AllocationDao;
use \Core\Service\AllocationService;

class AllocationController
{

    /**
     * @var AllocationService
     */
    public $service;

    /**
     * @var $hours
     */
    public $hours;

    /**
     * @var $capacity
     */
    public $capacity;

    public function __construct($hours, $capacity)
    {
        $this->service = new AllocationService(new AllocationDao());
        $this->hours = $hours;
        $this->capacity = $capacity;
    }

    public function allocate()
    {
        $response = $this->service->allocate($this->hours, $this->capacity);
        echo json_encode(array('Output' => $response));
    }
}
