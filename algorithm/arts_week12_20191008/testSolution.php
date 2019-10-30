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
        $list = [2,1,0];
        $result = $this->cls->sortColors($list);
        $this->assertEquals([0,1,2], $result);
    }

    function test2()
    {
        $list = [1,2,0,0,2,1];
        $result = $this->cls->sortColors($list);
        $this->assertEquals([0,0,1,1,2,2], $result);
    }
}
