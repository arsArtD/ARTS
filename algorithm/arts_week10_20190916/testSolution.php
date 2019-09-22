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
        $this->assertEquals(0,$this->cls->largestPerimeter([1,2,1]));
    }

    function test2()
    {
        $this->assertEquals(8,$this->cls->largestPerimeter([3,6,2,3]));
    }

    function test3()
    {
        $this->assertEquals(10,$this->cls->largestPerimeter([3,2,3,4]));
    }

    function test4()
    {
        $this->assertEquals(5,$this->cls->largestPerimeter([2,1,2]));
    }
}
