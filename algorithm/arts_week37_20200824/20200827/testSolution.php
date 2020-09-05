<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/27
 * Time: 9:06
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function test1()
    {
        $result = $this->cls->majorityElement([2,2,1,1,1,2,2]);
        $this->assertEquals(2, $result);
    }

    function test2()
    {
        $result = $this->cls->majorityElement2([2,2,1,1,1,2,2]);
        $this->assertEquals(2, $result);
    }

    function test3()
    {
        $result = $this->cls->majorityElement3([2,2,1,1,1,2,2]);
        $this->assertEquals(2, $result);
    }

    function test4()
    {
        $result = $this->cls->majorityElement4([2,2,1,1,1,2,2]);
        $this->assertEquals(2, $result);
    }
}
