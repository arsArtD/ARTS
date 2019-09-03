<?php


require_once '../../vendor/autoload.php';
require_once 'solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new solution();
    }

    function test1()
    {
        $this->assertEquals([[0,0],[0,1],[0,2]],$this->cls->allCellsDistOrder(1,3,0,0));
    }
}
