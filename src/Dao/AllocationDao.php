<?php
namespace Core\Dao;

class AllocationDao
{

    public $size;

    public $countries;

    public function __construct()
    {
    }

    public function getCountries()
    {

        $countries = array();
        $countries['NY'] = 'Newyork';
        $countries['IN'] = 'India';
        $countries['CN'] = 'China';

        return $countries;
    }

    public function getSizes()
    {
        $sizes = array();
        $sizes['L'] = 'Large';
        $sizes['XL'] = 'XLarge';
        $sizes['2XL'] = '2XLarge';
        $sizes['4XL'] = '4XLarge';
        $sizes['8XL'] = '8XLarge';
        $sizes['10XL'] = '10XLarge';

        return $sizes;
    }

    public function getCapacity()
    {

        $sizes = $this->getSizes();

        $machineCapacity = array();
        $machineCapacity[$sizes['L']] = 10;
        $machineCapacity[$sizes['XL']] = 20;
        $machineCapacity[$sizes['2XL']] = 40;
        $machineCapacity[$sizes['4XL']] = 80;
        $machineCapacity[$sizes['8XL']] = 160;
        $machineCapacity[$sizes['10XL']] = 320;

        return $machineCapacity;
    }

    public function getCost()
    {

        $sizes = $this->getSizes();
        $countries = $this->getCountries();

        $machineCost = array();
        $machineCost[$countries['NY']][$sizes['L']] = 120;
        $machineCost[$countries['NY']][$sizes['XL']] = 230;
        $machineCost[$countries['NY']][$sizes['2XL']] = 450;
        $machineCost[$countries['NY']][$sizes['4XL']] = 774;
        $machineCost[$countries['NY']][$sizes['8XL']] = 1400;
        $machineCost[$countries['NY']][$sizes['10XL']] = 2820;

        $machineCost[$countries['IN']][$sizes['L']] = 140;
        $machineCost[$countries['IN']][$sizes['2XL']] = 413;
        $machineCost[$countries['IN']][$sizes['4XL']] = 890;
        $machineCost[$countries['IN']][$sizes['8XL']] = 1300;
        $machineCost[$countries['IN']][$sizes['10XL']] = 2970;

        $machineCost[$countries['CN']][$sizes['L']] = 110;
        $machineCost[$countries['CN']][$sizes['XL']] = 200;
        $machineCost[$countries['CN']][$sizes['4XL']] = 670;
        $machineCost[$countries['CN']][$sizes['8XL']] = 1180;

        return $machineCost;
    }
}
