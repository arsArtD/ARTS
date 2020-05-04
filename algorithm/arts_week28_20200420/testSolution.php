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
        $result = $this->cls->jump([2,3,1,1,4]);
        $this->assertEquals(2,$result);
        self::assertTrue(true);
    }
}
