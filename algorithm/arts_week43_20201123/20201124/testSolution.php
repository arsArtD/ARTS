<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/24
 * Time: 9:09
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
use PHPUnit\Framework\TestCase;


class testSolution extends TestCase
{
    private $cls;
    private $cls1;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function test1() {
        //echo 1%2;exit;
        self::assertEquals(false, $this->cls->isPowerOfTwo(-1));
        self::assertEquals(false, $this->cls->isPowerOfTwo(0));
        self::assertEquals(true, $this->cls->isPowerOfTwo(1));
        self::assertEquals(true, $this->cls->isPowerOfTwo(16));
        self::assertEquals(false, $this->cls->isPowerOfTwo(3));
        self::assertEquals(false, $this->cls->isPowerOfTwo(218));
    }

    function test2() {
        //echo 1%2;exit;
        self::assertEquals(false, $this->cls->isPowerOfTwo1(-1));
        self::assertEquals(false, $this->cls->isPowerOfTwo1(0));
        self::assertEquals(true, $this->cls->isPowerOfTwo1(1));
        self::assertEquals(true, $this->cls->isPowerOfTwo1(16));
        self::assertEquals(false, $this->cls->isPowerOfTwo1(3));
        self::assertEquals(false, $this->cls->isPowerOfTwo1(218));
    }

    function test3() {
        //echo 1%2;exit;
        self::assertEquals(false, $this->cls->isPowerOfTwo2(-1));
        self::assertEquals(false, $this->cls->isPowerOfTwo2(0));
        self::assertEquals(true, $this->cls->isPowerOfTwo2(1));
        self::assertEquals(true, $this->cls->isPowerOfTwo2(16));
        self::assertEquals(false, $this->cls->isPowerOfTwo2(3));
        self::assertEquals(false, $this->cls->isPowerOfTwo2(218));
    }

    function test4() {
        //echo 1%2;exit;
        self::assertEquals(false, $this->cls->isPowerOfTwo3(-1));
        self::assertEquals(false, $this->cls->isPowerOfTwo3(0));
        self::assertEquals(true, $this->cls->isPowerOfTwo3(1));
        self::assertEquals(true, $this->cls->isPowerOfTwo3(16));
        self::assertEquals(false, $this->cls->isPowerOfTwo3(3));
        self::assertEquals(false, $this->cls->isPowerOfTwo3(218));
    }

    function test5() {
        //echo 1%2;exit;
        self::assertEquals(false, $this->cls->isPowerOfTwo4(-1));
        self::assertEquals(false, $this->cls->isPowerOfTwo4(0));
        self::assertEquals(true, $this->cls->isPowerOfTwo4(1));
        self::assertEquals(true, $this->cls->isPowerOfTwo4(16));
        self::assertEquals(false, $this->cls->isPowerOfTwo4(3));
        self::assertEquals(false, $this->cls->isPowerOfTwo4(218));
    }
}
