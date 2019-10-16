<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/10/09
 * Time: 09:09
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
    function sortList(ListNode $head) {
        return is_null($head) ? null : $this->mergeSort($head);
    }

    function mergeSort(ListNode $head) {
        if ($head->next == null) return $head;

        $p = $head;
        $q = $head;
        $pre = null;
        while ($q != null && $q->next != null) {
            $pre = $p;
            $p = $p->next;
            $q = $q->next->next;
        }
        $pre->next = null;
        $l = $this->mergeSort($head);
        $r = $this->mergeSort($p);
        return $this->merge($l, $r);
    }

    function merge(ListNode $l, ListNode $r) {
        $dummyHead = new ListNode(0);
        $cur = $dummyHead;
        while ($l != null && $r != null) {
            if ($l->val <= $r->val) {
                $cur->next = $l;
                $cur = $cur->next;
                $l = $l->next;
            } else {
                $cur->next = $r;
                $cur = $cur->next;
                $r = $r->next;
            }
        }
        if ($l != null) {
            $cur->next = $l;
        }
        if ($r != null) {
            $cur->next = $r;
        }
        return $dummyHead->next;
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

/*
$node1 = new ListNode(4);
$node2 = new ListNode(2);
$node3 = new ListNode(1);
$node4 = new ListNode(3);
$node1->next = $node2;
$node2->next = $node3;
$node3->next = $node4;

$solution = new Solution();
$result = $solution->sortList($node1);
//var_dump($result->val);
//var_dump($result->next->val);
//var_dump($result->next->next->val);
//var_dump($result->next->next->next->val);


$node1 = new ListNode(-1);
$node2 = new ListNode(5);
$node3 = new ListNode(3);
$node4 = new ListNode(4);
$node5 = new ListNode(0);
$node1->next = $node2;
$node2->next = $node3;
$node3->next = $node4;
$node4->next = $node5;

$node1 = $solution->getListFromArr([-1,5,3,4,0]);
$result = $solution->sortList($node1);

var_dump($solution->getResultForArr($result));
*/
