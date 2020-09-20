<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/15
 * Time: 8:47
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
        $reversArr = ["h","a","n","n","a","H"];
        $preArr = ["H","a","n","n","a","h"];
        $rs = $this->cls->reverseString($preArr);
        $this->assertEquals(json_encode($reversArr), json_encode($rs));
    }

}
