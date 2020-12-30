<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/30
 * Time: 12:22
 */

require_once '../../util/ListNode.php';

class Solution
{
    /**
     * @ref https://leetcode-cn.com/problems/linked-list-cycle-ii/solution/huan-xing-lian-biao-ii-by-leetcode-solution/
     * @param ListNode $head
     * 空间复杂度：O(N)
     * 时间复杂度：O(N)
     * @return ListNode
     */
    function detectCycle(ListNode $head) {
        $pos = $head;
        $map = [];
        while($pos != null) {
            if(isset($map[spl_object_hash($pos)])) {
                return $pos;
            } else{
                $map[spl_object_hash($pos)] = 1;
            }
            $pos = $pos->next;
        }
        return null;
    }

    /**
     * 快慢指针
     * 时间复杂度：O(N)
     * 空间复杂度：O(1)
     * @param ListNode $head
     * @return ListNode|null
     */
    function detectCycle1(ListNode $head) {
        $slow = $fast = $head;
        while($fast != null) {
            $slow = $slow->next;
            if($fast->next == null) {
                return null;
            }

            $fast = $fast->next->next;

            echo sprintf('slow value: %s, fast value: %s'.PHP_EOL, $slow->val, $fast->val);

            if($fast == $slow) {
                $ptr = $head;

                while($ptr != $slow) {

                    echo sprintf('slow value: %s, fast value: %s'.PHP_EOL, $slow->val, $ptr->val);
                    $ptr = $ptr->next;
                    $slow = $slow->next;
                }

                echo sprintf('slow value: %s, fast value: %s'.PHP_EOL, $slow->val, $ptr->val);
                return $ptr;
            }
        }
        return null;
    }
}
