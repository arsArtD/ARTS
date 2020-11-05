<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/3
 * Time: 8:47
 */


/**
 * 用例： https://leetcode-cn.com/submissions/detail/120552534/testcase/
 * Class MinStack
 */
class MinStack {

    private $stack;

    /**
     * initialize your data structure here.
     */
    function __construct() {
        $this->stack = [];
    }

    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        array_push($this->stack, $x);
    }

    /**
     * @return NULL
     */
    function pop() {
        array_pop($this->stack);
    }

    /**
     * @return Integer
     */
    function top() {
        return end($this->stack);
    }

    /**
     * @return Integer
     */
    function getMin() {
        return min($this->stack);
    }
}

/**
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($x);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->getMin();
 */
