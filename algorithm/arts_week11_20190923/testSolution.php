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
        $list = $this->cls->getListFromArr([-1, 5, 4, 3, 0]);
        $result = $this->cls->getResultForArr($this->cls->sortList($list));
        $this->assertEquals(json_encode([-1,0,3,4,5]), json_encode($result));
    }

    function test2()
    {
        $list = $this->cls->getListFromArr([4,2,1,3]);
        $result = $this->cls->getResultForArr($this->cls->sortList($list));
        $this->assertEquals(json_encode([1,2,3,4]), json_encode($result));
    }
}
