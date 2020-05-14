<?php

namespace Core\Service;

use \Core\Dao\AllocationDao;
use \Core\Model\Allocation;

class AllocationService{

	/**
	* @var AllocationDao
	*/
	public $dao;
	
	public function __construct(AllocationDao $dao){
		$this->dao = $dao;
	}
	
	public function allocate(int $hours, int $capacity){
		
		$countries = $this->dao->getCountries();
		$sizes = $this->dao->getSizes();
		$machineCapacity = $this->dao->getCapacity();
		$machineCost = $this->dao->getCost();
		
		$unitCost = array();
		foreach($countries as $countryCode => $countryName){
			$unitCost[$countryName] = $this->getCostPerUnit($machineCost, $machineCapacity, $countryName);
		}
		
		$requiredMachines = array();
		foreach($unitCost as $countryName => $countryUnitCost){
			$requiredMachines[$countryName] = $this->getRequiredMachines($hours, $capacity, $machineCapacity, $countryUnitCost, $countryName);
		}
		
		$machinesPricing = $this->getPricing($requiredMachines, $machineCost);
		
		return $machinesPricing;
	}
	
	private function getPricing($requiredMachines, $machineCost){
		$output = array();
		foreach($requiredMachines as $countryName => $machines){
			$machineUsed = array();
			$total_cost = 0;
			foreach($machines as $size =>$usedHours){
				$machineUsed[] = "({$size}, {$usedHours})";	
				$total_cost += $usedHours * $machineCost[$countryName][$size];
			}
			$total_cost = '$' . $total_cost;
			$output[] = new Allocation($countryName, $total_cost, $machineUsed);
		}
		return $output;
	}
	
	private function getRequiredMachines($hours, $capacity, $machineCapacity, $unitCost){
		
		arsort($machineCapacity);
		//print_r($machineCapacity);
		
		$output = array();
		$sizes = array_keys($unitCost);
		foreach($sizes as $size){
			if($machineCapacity[$size]-$capacity > 0 ){
				continue;
			}
			for($i=1; $i<=$hours; $i++){
				//echo $size . ' - ' . $i . ' hrs : '. $capacity . ' - ' . $machineCapacity[$size] . '<BR />' ;
				if($capacity >= $machineCapacity[$size]){
					if(!isset($output[$size])){
						$output[$size] = 1;
					}else{
						$output[$size] += 1;
					}
					$capacity -= $machineCapacity[$size];
					$i--;
				}else{
					break;
				}
			}
		}
		return $output;		
	}
	
	private function getCostPerUnit($machineCost, $machineCapacity, $countryName){
		
		$unitCost = array();
		foreach($machineCost[$countryName] as $size=>$cost){
			$unitCost[$size] = $cost / $machineCapacity[$size];
		}
		asort($unitCost);
		return $unitCost;
	}
}