<?php


require_once '../../vendor/autoload.php';
require_once 'solution.php';
require_once 'solution2.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;
    private $cls2;

    public function __construct()
    {
        $this->cls = new Solution();
        $this->cls2 = new Solution2();
    }

    function test1()
    {
        $result = $this->cls->multiply("2", "3");
        $this->assertEquals("6",$result);
        $result = $this->cls2->multiply("2", "3");
        $this->assertEquals("6",$result);
    }

    function test2()
    {
        $result = $this->cls->multiply("123", "456");
        $this->assertEquals("56088",$result);
        $result = $this->cls2->multiply("123", "456");
        $this->assertEquals("56088",$result);
    }

    function test3()
    {
        $result = $this->cls->multiply("123456789", "123456789");
        $this->assertEquals("15241578750190521",$result);
        $result = $this->cls2->multiply("123456789", "123456789");
        $this->assertEquals("15241578750190521",$result);
    }

    function test4() {
        $result = $this->cls->multiply("45", "123");
        $this->assertEquals("5535",$result);
        $result = $this->cls2->multiply("45", "123");
        $this->assertEquals("5535",$result);
    }

    function test5() {
        $result = $this->cls->multiply("10", "20");
        $this->assertEquals("200",$result);
        $result = $this->cls2->multiply("10", "20");
        $this->assertEquals("200",$result);
    }

}
