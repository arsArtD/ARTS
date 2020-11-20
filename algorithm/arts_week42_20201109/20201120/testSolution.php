<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/20
 * Time: 8:51
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
require_once 'Solution1.php';
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
        self::assertEquals(2, $this->cls->climbStairs(2));
        self::assertEquals(2, $this->cls1->climbStairs(2));
        self::assertEquals(2, $this->cls->climbStairs1(2));
    }

    function test2()
    {
        self::assertEquals(3, $this->cls->climbStairs(3));
        self::assertEquals(3, $this->cls1->climbStairs(3));
        self::assertEquals(3, $this->cls->climbStairs1(3));
    }

}
