<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/26
 * Time: 8:39
 */

class Solution
{
    /**
     * @ref https://leetcode-cn.com/problems/merge-two-sorted-lists/solution/php-jie-fa-by-zzpwestlife-19/
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2)
    {
        $dummyHead = new ListNode(null);
        $curr  = $dummyHead;
        while($l1 !== null && $l2 !== null) {
            if($l1->val <= $l2->val) {
                $curr->next = $l1;
                $l1 = $l1->next;
            } else {
                $curr->next = $l2;
                $l2 = $l2->next;
            }
            $curr = $curr->next;
        }

        if($l1 != null) {
            $curr->next = $l1;
        } elseif($l2 != null) {
            $curr->next = $l2;
        }

        return $dummyHead->next;
    }

    function mergeTwoLists2($l1, $l2) {
        if($l1 == null) return $l2;
        if($l2 == null) return $l1;

        if($l1->val < $l2->val) {
            $l1->next = $this->mergeTwoLists2($l1->next, $l2);
            return $l1;
        } else {
            $l2->next = $this->mergeTwoLists2($l1, $l2->next);
            return $l2;
        }
    }

}
