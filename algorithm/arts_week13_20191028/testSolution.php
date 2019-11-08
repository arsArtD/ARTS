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
        $list = [[1,3],[2,6],[8,10],[15,18]];
        $result = $this->cls->merge($list);
        $this->assertEquals(json_encode([[1,6],[8,10],[15,18]]), json_encode($result));
    }

    function test2()
    {
        $list = [[1,4], [4,5]];
        $result = $this->cls->merge($list);
        $this->assertEquals(json_encode([[1,5]]), json_encode($result));
    }

    function test3()
    {
        $list = [[1,3]];
        $result = $this->cls->merge($list);
        $this->assertEquals(json_encode([[1,3]]), json_encode($result));
    }

    function test4()
    {
        $list = [[1,4],[0,1]];
        $result = $this->cls->merge($list);
        $this->assertEquals(json_encode([[0,4]]), json_encode($result));
    }

    function test5()
    {
        $list = [[1,4],[0,2],[3,5]];
        $result = $this->cls->merge($list);
        $this->assertEquals(json_encode([[0,5]]), json_encode($result));
    }

    function test6()
    {
        $list = [[2,3],[4,5],[6,7],[8,9],[1,10]];;
        $result = $this->cls->merge($list);
        $this->assertEquals(json_encode([[1,10]]), json_encode($result));
    }

    function test7()
    {
        $list = [[2,3],[2,2],[3,3],[1,3],[5,7],[2,2],[4,6]];;
        $result = $this->cls->merge($list);
        $this->assertEquals(json_encode([[1,3],[4,7]]), json_encode($result));
    }
}
