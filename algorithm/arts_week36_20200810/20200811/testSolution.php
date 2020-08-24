<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/20
 * Time: 9:51
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
        $result = $this->cls->myAtoi("   -42");
        $this->assertEquals(-42, $result);

        $result = $this->cls->myAtoi("   42");
        $this->assertEquals(42, $result);

        $result = $this->cls->myAtoi("4193 with words");
        $this->assertEquals(4193, $result);

        $result = $this->cls->myAtoi("words and 987");
        $this->assertEquals(0, $result);

        $result = $this->cls->myAtoi("-91283472332");
        $this->assertEquals(-2147483648, $result);
    }
}
