<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/11
 * Time: 9:03
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
require_once 'Solution1.php';
require_once '../../util/ListUtil.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;
    private $cls1;

    public function __construct()
    {
        $this->cls = new Solution();
        $this->cls1 = new Solution1();
    }

    function test1()
    {
        $list1 = [-2,1,-3,4,-1,2,1,-5,4];
        $result = $this->cls->maxSubArray($list1);
        self::assertEquals(6, $result);
        self::assertTrue(true);
    }

    function test2()
    {
        $list1 = [-2,1,-3,4,-1,2,1,-5,4];
        $result = $this->cls1->maxSubArray($list1);
        self::assertEquals(6, $result);
        self::assertTrue(true);
    }

    function test3()
    {
        //var_dump((1+2) >> 1);
        $list1 = [-1,0,-2];
        $result = $this->cls1->maxSubArray($list1);
        self::assertEquals(0, $result);
        self::assertTrue(true);
    }
}
