<?php


require_once '../../vendor/autoload.php';
require_once 'solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new solution();
    }

    function test1()
    {
        $this->assertTrue($this->cls->isAnagram('abcd','adcb'));
    }

    function test2()
    {
        $this->assertFalse($this->cls->isAnagram('a','b'));
    }

}
