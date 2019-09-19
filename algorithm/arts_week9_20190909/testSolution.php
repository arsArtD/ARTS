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
        $this->assertEquals([2,2],$this->cls->intersect([1,2,2,1],[2,2]));
    }

    function test2()
    {
        $this->assertEquals([2],$this->cls->intersect([1,2,2,1],[2,3]));
    }
}
