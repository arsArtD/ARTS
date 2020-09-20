<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/8
 * Time: 8:53
 */

class Solution {
    /**
     * @param ListNode $node
     * @return
     */
    function deleteNode($node) {
        $node->val = $node->next->val;
        $node->next = $node->next->next;
    }
}
