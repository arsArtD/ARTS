<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/6/9
 * Time: 9:41
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
        $this->assertEquals(5, $this->cls->translateNum(12258));
        $this->assertEquals(2, $this->cls->translateNum(25));
        self::assertTrue(true);
    }

}
