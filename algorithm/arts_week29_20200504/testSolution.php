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
        $result = $this->cls->findMedianSortedArrays([1, 3], [2]);
        $this->assertEquals(2.0,$result);
        self::assertTrue(true);
    }

    function test2()
    {
        $result = $this->cls->findMedianSortedArrays([1, 2], [3, 4]);
        $this->assertEquals(2.5,$result);
        self::assertTrue(true);
    }
}
