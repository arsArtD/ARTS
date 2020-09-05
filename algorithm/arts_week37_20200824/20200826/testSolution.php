<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/26
 * Time: 8:56
 */


require_once '../../../vendor/autoload.php';
require_once '../../util/ListUtil.php';
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
        $l1 = ListUtil::getListFromArr([1,2,4]);
        $l2 = ListUtil::getListFromArr([1,3,4]);
        $l3 = ListUtil::getResultForArr($this->cls->mergeTwoLists($l1, $l2));
        $this->assertEquals(json_encode([1,1,2,3,4,4]), json_encode($l3));
    }

    function test2()
    {
        $l1 = ListUtil::getListFromArr([1,2,4]);
        $l2 = ListUtil::getListFromArr([1,3,4]);
        $l3 = ListUtil::getResultForArr($this->cls->mergeTwoLists2($l1, $l2));
        $this->assertEquals(json_encode([1,1,2,3,4,4]), json_encode($l3));
    }
}
