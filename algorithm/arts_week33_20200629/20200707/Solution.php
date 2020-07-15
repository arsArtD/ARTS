<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/7
 * Time: 9:37
 */


/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution
{
    /**
     * 官方题解： https://leetcode-cn.com/problems/linked-list-cycle/solution/huan-xing-lian-biao-by-leetcode/
     *
     * @param ListNode $head
     * @return Boolean
     */
    function hasCycle($head) {
        if($head == null || is_null($head->next)) {
            return false;
        }
        $slow = $head;
        $fast = $head->next;
        while($slow != $fast) {
            if($fast == null || $fast->next == null) {
                return false;
            }
            $slow = $slow->next;
            $fast = $fast->next->next;
        }
        return true;
    }

    /**
     * @param $head
     * @return bool
    public boolean hasCycle(ListNode head) {
        Set<ListNode> nodesSeen = new HashSet<>();
        while (head != null) {
            if (nodesSeen.contains(head)) {
                return true;
            } else {
                nodesSeen.add(head);
            }
            head = head.next;
        }
        return false;
    }
     */

    function hasCycle2($head) {
        $hashArr = [];
        while($head != null) {
            $addr = spl_object_hash($head);
            if(isset($hashArr[$addr])) {
                return true;
            } else {
                //echo spl_object_hash($head).PHP_EOL;
                $hashArr[$addr] = $addr;
            }
            $head = $head->next;
        }
        return false;
    }
}

