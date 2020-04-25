<?php


require_once '../../vendor/autoload.php';
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
        $result = $this->cls->getMaxRepetitions("acb", 4,'ab',2);
        $this->assertEquals(2,$result);
        self::assertTrue(true);
    }


    function test2()
    {
        $result = $this->cls->getMaxRepetitions("abaacdbac", 100,'adcbd',4);
        $this->assertEquals(12,$result);
        self::assertTrue(true);
    }

    function test3()
    {
        $result = $this->cls->getMaxRepetitions("abaacdbac", 2,'adcbd',1);
        $this->assertEquals(1,$result);
        self::assertTrue(true);
    }

    function test4()
    {
        $result = $this->cls->getMaxRepetitions("abaacdbac", 1,'adcbd',1);
        $this->assertEquals(0,$result);
        self::assertTrue(true);
    }

    function test5()
    {
        $result = $this->cls->getMaxRepetitions("phqghumeaylnlfdxfircvscxggbwkfnqduxwfnfozvsrtkjprepggxrpnrvystmwcysyycqpevikeffmznimkkasvwsrenzkycxf", 1000000,
            'xtlsgypsfadpooefxzbcoejuvpvaboygpoeylfpbnpljvrvipyamyehwqnqrqpmxujjloovaowuxwhmsncbxcoksfzkvatxdknly',100);
        $this->assertEquals(303,$result);
        self::assertTrue(true);
    }
}
