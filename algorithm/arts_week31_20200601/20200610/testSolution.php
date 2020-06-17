<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/6/10
 * Time: 9:49
 */

require_once '../../../vendor/autoload.php';
require_once 'solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;
    private $cls2;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function test1()
    {
        $this->assertEquals(false, $this->cls->isPalindrome(-123));
        $this->assertEquals(true, $this->cls->isPalindrome(121));
        $this->assertEquals(false, $this->cls->isPalindrome("abc"));
        $this->assertEquals(false, $this->cls->isPalindrome(10));
        $this->assertEquals(false, $this->cls->isPalindrome(123));
        $this->assertEquals(true, $this->cls->isPalindrome(9));
        self::assertTrue(true);
    }

    function test2()
    {
        $this->assertEquals(false, $this->cls->isPalindrome2(123));
        $this->assertEquals(false, $this->cls->isPalindrome2(-123));
        $this->assertEquals(true, $this->cls->isPalindrome2(121));
        $this->assertEquals(false, $this->cls->isPalindrome2("abc"));
        $this->assertEquals(false, $this->cls->isPalindrome2(10));
        $this->assertEquals(true, $this->cls->isPalindrome2(9));
        self::assertTrue(true);
    }

}
