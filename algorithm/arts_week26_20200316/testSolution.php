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
        $result = $this->cls->minDistance("horse", "ros");
        $this->assertEquals(3,$result);
        self::assertTrue(true);
    }

    function test2()
    {
        $result = $this->cls->minDistance("intention", "execution");
        $this->assertEquals(5,$result);
        self::assertTrue(true);
    }
}
