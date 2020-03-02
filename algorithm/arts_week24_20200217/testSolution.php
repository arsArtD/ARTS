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
        $list = $this->cls->getListFromArr([1,2,3,4,5]);
        $result = $this->cls->getResultForArr($this->cls->reverseList($list));
        $this->assertEquals(json_encode([5,4,3,2,1]), json_encode($result));
    }
}
