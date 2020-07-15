<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/7
 * Time: 10:12
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
        // [1,2,5,3,4,6,7]


        $a1 = new ListNode(3);
        $a2 = new ListNode(2);
        $a3 = new ListNode(0);
        $a4 = new ListNode(4);
        $a1->next = $a2;
        $a2->next = $a3;
        $a3->next = $a4;
        $a4->next = $a2;
//        var_dump(spl_object_hash($a1));
//        var_dump(spl_object_hash($a2));
//        var_dump(spl_object_hash($a3));
//        var_dump(spl_object_hash($a4));
//        var_dump(spl_object_hash($a4->next));

        $result = $this->cls->hasCycle2($a1);
        $this->assertEquals(true, $result);
        $result = $this->cls->hasCycle($a1);
        $this->assertEquals(true, $result);
    }
}
