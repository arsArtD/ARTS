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
        $this->cls ->setTaskDisableTime(2);
    }

    function test1()
    {
        $this->cls->setTasks(["A","A","A","B","B","B"]);
        $this->assertEquals(8, $this->cls->leastInterval($this->cls->getTasks(), $this->cls->getTaskDisableTime()));
    }

    function test2()
    {
        $this->cls->setTasks(["A","B","A"]);
        $this->assertEquals(4, $this->cls->leastInterval($this->cls->getTasks(), $this->cls->getTaskDisableTime()));
    }

    function test3()
    {
        $this->cls->setTasks(["A","A","A","B","B","B", "C", "C"]);
        $this->assertEquals(8, $this->cls->leastInterval($this->cls->getTasks(), $this->cls->getTaskDisableTime()));
    }
}
