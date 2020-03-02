<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/03/02
 * Time: 08:40
 */

//题目参照 readme.md

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

@error_reporting(E_ALL);
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

/**
 * 参考：Sort List——经典（链表中的归并排序） https://www.cnblogs.com/qiaozhoulin/p/4585401.html
 *
 * 归并排序法：在动手之前一直觉得空间复杂度为常量不太可能，因为原来使用归并时，都是 O(N)的，
 * 需要复制出相等的空间来进行赋值归并。对于链表，实际上是可以实现常数空间占用的（链表的归并
 * 排序不需要额外的空间）。利用归并的思想，递归地将当前链表分为两段，然后merge，分两段的方
 * 法是使用 fast-slow 法，用两个指针，一个每次走两步，一个走一步，知道快的走到了末尾，然后
 * 慢的所在位置就是中间位置，这样就分成了两段。merge时，把两段头部节点值比较，用一个 p 指向
 * 较小的，且记录第一个节点，然后 两段的头一步一步向后走，p也一直向后走，总是指向较小节点，
 * 直至其中一个头为NULL，处理剩下的元素。最后返回记录的头即可。
 *
 * 主要考察3个知识点，
 * 知识点1：归并排序的整体思想
 * 知识点2：找到一个链表的中间节点的方法
 * 知识点3：合并两个已排好序的链表为一个新的有序链表
 */
class solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head) {
        $curr = $head;
        $prev = null;
        while($curr != null) {
            $nextTemp = $curr->next;
            $curr->next = $prev;
            $prev = $curr;
            $curr = $nextTemp;
        }
        return $prev;
    }



    function getResultForArr(ListNode $head) {
        $result = [];
        while ($head != null && $head->next != null) {
            $result[] = $head->val;
            $head = $head->next;
        }
        //记录尾指针
        $result[] = $head->val;
        return $result;
    }

    function getListFromArr($arr) {
        $head = null;
        if (sizeof($arr) > 0) {
            $head = null;
            $cur = null;
            foreach($arr as $key=>$value) {
                if ($key != sizeof($arr)-1) {
                    if ($key == 0) {
                        $head = new ListNode($value);
                        $head->next = new ListNode($arr[$key+1]);
                        $cur = $head->next;
                    } else {
                        $cur->next = new ListNode($arr[$key+1]);
                        $cur = $cur->next;
                    }
                }
            }
        }
        return $head;
    }
}

$solution = new solution();
$node1 = $solution->getListFromArr([1,2,3,4,5]);
$result = $solution->reverseList($node1);
var_dump($solution->getResultForArr($result));
