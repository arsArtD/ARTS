<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/28
 * Time: 8:50
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
        $arr = [2,2,1];
        $rs = $this->cls->singleNumber($arr);
        $this->assertEquals(1, $rs);
    }

    function test2()
    {
        $arr = [122,122,3,456,99999,99999, 456];
        $rs = $this->cls->singleNumber($arr);
        $this->assertEquals(3, $rs);
    }
}
