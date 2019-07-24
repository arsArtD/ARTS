

## 回文链表

请判断一个链表是否为回文链表。

示例 1:

输入: 1->2
输出: false
示例 2:

输入: 1->2->2->1
输出: true
进阶：
你能否用 O(n) 时间复杂度和 O(1) 空间复杂度解决此题？

```
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
     * @param ListNode $head
     * @return Boolean
     */
    function isPalindrome($head) {
      if ($head == null || $head->next == null) {
          return true;
      }
      
      $slow = $head;
      $fast = $head;
      while($fast->next != null && $fast->next->next != null) {
          $fast = $fast->next->next;
          $slow = $slow->next;
      }
      $slow = $this->reverse($slow->next);
      while($slow != null){
          if ($head->val != $slow->val) {
              return false;
          }
          $head = $head->next;
          $slow = $slow->next;
      }
      return true;
    }
    
    function reverse($head) {
        if ($head->next == null){
            return $head;
        }
        $newHead = $this->reverse($head->next);
        $head->next->next = $head;
        $head->next = null;
        return $newHead;
    }  
    
}
```