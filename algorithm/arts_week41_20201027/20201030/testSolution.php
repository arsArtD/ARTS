<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/10/30
 * Time: 9:34
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
require_once '../../util/ListUtil.php';
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
       $list1 = ListUtil::getListFromArr([4,1,8,4,5]);
       $list2 = ListUtil::getListFromArr([5,0,1,8,4,5]);
       $result = $this->cls->getIntersectionNode($list1, $list2);
       var_dump($result->val);
       self::assertTrue(true);
    }

    function test2()
    {
        $list1 = ListUtil::getListFromArr([8]);
        $list2 = ListUtil::getListFromArr([4,1,8,4,5]);
        $result = $this->cls->getIntersectionNode($list1, $list2);
        var_dump($result->val);
        self::assertTrue(true);
    }

    function test3()
    {
        $list1 = ListUtil::getListFromArr([1,9,1,2,4]);
        $list2 = ListUtil::getListFromArr([3,2,4]);
        $result = $this->cls->getIntersectionNode($list1, $list2);
        var_dump($result->val);
        self::assertTrue(true);
    }

    function test4() {
        //string(222) "O:8:"ListNode":2:{s:3:"val";i:1;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:9;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:1;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:2;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:4;s:4:"next";N;}}}}}"
        //string(134) "O:8:"ListNode":2:{s:3:"val";i:3;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:2;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:4;s:4:"next";N;}}}"
        $headA = unserialize('O:8:"ListNode":2:{s:3:"val";i:1;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:9;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:1;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:2;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:4;s:4:"next";N;}}}}}');
        $headB = unserialize( 'O:8:"ListNode":2:{s:3:"val";i:3;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:2;s:4:"next";O:8:"ListNode":2:{s:3:"val";i:4;s:4:"next";N;}}}');
        $result = $this->cls->getIntersectionNode($headA, $headB);
        var_dump($result->val);
        self::assertTrue(true);
    }

    public function testList() {
        $list1 = ListUtil::getListFromArr([8]);
        $list2 = ListUtil::getListFromArr([4,1,8,4,5]);
        $l1 = ListUtil::getResultForArr($list1);
        $l2 = ListUtil::getResultForArr($list2);
        echo json_encode($l1).PHP_EOL;
        echo json_encode($l2).PHP_EOL;
        self::assertTrue(true);
    }
}
