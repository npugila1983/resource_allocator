<?php

use PHPUnit\Framework\TestCase;

use Core\Service\AllocationService;
use Core\Dao\AllocationDao;
use Core\Model\Allocation;

class AllocationServiceTest extends TestCase{

	/**
	 * @var AllocationService
	 */
    private $service;
	
	/**
	 * @var AllocationDao
	 */
    private $dao;
	
    /**
     * Setup AllocationService ready for test
     * 
     * @before
     */
    public function init(){
		$this->dao = $this->createMock(AllocationDao::class);
		$this->service = new AllocationService($this->dao);
	}
	
	/**
     * @dataProvider allocationData
     */
	public function testAllocation($hours, $capacity, $mockCountry, $mockSizes, $mockCapacity, $mockCost, $expectedResult){
		
		$this->dao->expects($this->any())
                ->method('getCountries')
                ->willReturn($mockCountry);
		
		$this->dao->expects($this->any())
                ->method('getSizes')
                ->willReturn($mockSizes);
				
		$this->dao->expects($this->any())
                ->method('getCapacity')
                ->willReturn($mockCapacity);
				
		$this->dao->expects($this->any())
                ->method('getCost')
                ->willReturn($mockCost);
		
		$actual = $this->service->allocate($hours, $capacity);
		
		echo json_encode(array('Output' => $actual)) . "\n\n";
		
		$this->assertEquals($expectedResult, $actual);
		
	}
	
	public function allocationData(){
		return [
			//Test Data for Sample given in Assigment
			[
				1, 
				1150,
				['NY'=>'Newyork', 'IN'=>'India', 'CN'=>'China'],
				['L'=>'Large', 'XL'=>'XLarge', '2XL'=>'2XLarge', '4XL'=>'4XLarge', '8XL'=>'8XLarge', '10XL'=>'10XLarge'],
				['Large' => 10, 'XLarge' => 20, '2XLarge' => 40, '4XLarge' => 80, '8XLarge' => 160, '10XLarge' => 320],
				[
					'Newyork' => ['Large' => 120, 'XLarge' => 230, '2XLarge' => 450, '4XLarge' => 774, '8XLarge' => 1400, '10XLarge' => 2820],
					'India' => ['Large' => 140, '2XLarge' => 413, '4XLarge' => 890, '8XLarge' => 1300, '10XLarge' => 2970],
					'China' => ['Large' => 110, 'XLarge' => 200, '4XLarge' => 670, '8XLarge' => 1180]
				],
				[
					new Allocation('Newyork', '$10150', ["(8XLarge, 7)","(XLarge, 1)","(Large, 1)"]),
					new Allocation('India', '$9520', ["(8XLarge, 7)","(Large, 3)"]),
					new Allocation('China', '$8570', ["(8XLarge, 7)","(XLarge, 1)","(Large, 1)"]),
				]
			],
			
			//Test Data given in the Other Sample Input
			[
				12, 
				1100,
				['NY'=>'Newyork', 'IN'=>'India', 'CN'=>'China'],
				['L'=>'Large', 'XL'=>'XLarge', '2XL'=>'2XLarge', '4XL'=>'4XLarge', '8XL'=>'8XLarge', '10XL'=>'10XLarge'],
				['Large' => 10, 'XLarge' => 20, '2XLarge' => 40, '4XLarge' => 80, '8XLarge' => 160, '10XLarge' => 320],
				[
					'Newyork' => ['Large' => 120, 'XLarge' => 230, '2XLarge' => 450, '4XLarge' => 774, '8XLarge' => 1400, '10XLarge' => 2820],
					'India' => ['Large' => 140, '2XLarge' => 413, '4XLarge' => 890, '8XLarge' => 1300, '10XLarge' => 2970],
					'China' => ['Large' => 110, 'XLarge' => 200, '4XLarge' => 670, '8XLarge' => 1180]
				],
				[
					new Allocation('Newyork', '$9854', ['(8XLarge, 6)', '(4XLarge, 1)', '(2XLarge, 1)', '(XLarge, 1)']),
					new Allocation('India', '$9319', ['(8XLarge, 6)', '(2XLarge, 3)', '(Large, 2)']),
					new Allocation('China', '$8350', ['(8XLarge, 6)', '(4XLarge, 1)', '(XLarge, 3)']),
				]
			],
			
			//Test for empty or null input
			[
				null, 
				null,
				['NY'=>'Newyork', 'IN'=>'India', 'CN'=>'China'],
				['L'=>'Large', 'XL'=>'XLarge', '2XL'=>'2XLarge', '4XL'=>'4XLarge', '8XL'=>'8XLarge', '10XL'=>'10XLarge'],
				['Large' => 10, 'XLarge' => 20, '2XLarge' => 40, '4XLarge' => 80, '8XLarge' => 160, '10XLarge' => 320],
				[
					'Newyork' => ['Large' => 120, 'XLarge' => 230, '2XLarge' => 450, '4XLarge' => 774, '8XLarge' => 1400, '10XLarge' => 2820],
					'India' => ['Large' => 140, '2XLarge' => 413, '4XLarge' => 890, '8XLarge' => 1300, '10XLarge' => 2970],
					'China' => ['Large' => 110, 'XLarge' => 200, '4XLarge' => 670, '8XLarge' => 1180]
				],
				[ 'error_message' => 'Invalid inpur for hours & capacity. Both should be positive number']
			]
		];
	}
}