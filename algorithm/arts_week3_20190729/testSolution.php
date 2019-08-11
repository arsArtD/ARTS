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
        $this->cls->setStr('()');
        $this->assertTrue($this->cls->isValid($this->cls->getStr()));
    }

    function test2()
    {
        $this->cls->setStr('()[]{}');
        $this->assertTrue($this->cls->isValid($this->cls->getStr()));
    }

    function test3()
    {
        $this->cls->setStr('(]');
        $this->assertFalse($this->cls->isValid($this->cls->getStr()));
    }

    function test4()
    {
        $this->cls->setStr('([)]');
        $this->assertFalse($this->cls->isValid($this->cls->getStr()));
    }

    function test5()
    {
        $this->cls->setStr('({})');
        $this->assertTrue($this->cls->isValid($this->cls->getStr()));
    }

    function test6()
    {
        $this->cls->setStr('');
        $this->assertTrue($this->cls->isValid($this->cls->getStr()));
    }
}