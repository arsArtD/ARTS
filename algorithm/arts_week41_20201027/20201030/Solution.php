<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/10/30
 * Time: 9:17
 */

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class Solution {
    /**
     * @url https://leetcode-cn.com/problems/intersection-of-two-linked-lists/solution/phpcha-zhao-lian-biao-jiao-cha-dian-by-fancor-2/
     *  关键有2点：
        1、先判断是否相交，不相交返回Null
        2、再来计算交叉点，方法是首尾相接法
     * @param ListNode $headA
     * @param ListNode $headB
     * @todo: 测试用例貌似是有问题的
     * @return ListNode
     */
    function getIntersectionNode($headA, $headB) {
        if($headA == null || $headB == null){
            return null;
        }
//        var_dump(serialize($headA)).PHP_EOL;
//        var_dump(serialize($headB)).PHP_EOL;

        //先判断是否相交，不相交直接返回
        if(!$this->isIntersect($headA, $headB)){
            return null;
        }
        //若相交再找交叉点：分别遍历，并指向另一链表的头，这样遍历的长度相等
        $cura = $headA;
        $curb = $headB;

        while($cura || $curb){
            //echo sprintf('compare:a: %s, b:%s'.PHP_EOL, $cura->val, $curb->val);
            if($cura === $curb){
                echo sprintf('compare:a: %s, b:%s, eq:%s'.PHP_EOL, spl_object_hash($cura), spl_object_hash($curb), spl_object_hash($cura) == spl_object_hash($curb));
                break;
            }
            $cura = $cura == null ? $headB : $cura->next;
            $curb = $curb == null ? $headA : $curb->next;
        }
        return $cura;
    }

    //判断是否相交
    function isIntersect($headA, $headB){
        if($headB == null || $headB == null){
            return false;
        }
        while($headA->next != null){
            $headA = $headA->next;
        }
        while($headB->next != null){
            $headB = $headB->next;
        }
        // echo sprintf('isIntersect:a: %s, b:%s'.PHP_EOL, $headA->val, $headB->val);
        return $headA === $headB;
    }
}
