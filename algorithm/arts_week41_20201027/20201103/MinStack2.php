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
class MinStack2 {

    protected $data;
    // 使用不等长的辅助栈
    protected $helper;
    /**
     * initialize your data structure here.
     */
    function __construct()
    {
        $this->data = new SplStack();
        $this->helper = new SplStack();
    }

    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x)
    {
        $this->data->push($x);
        // 入栈时，值小于等于辅助栈栈顶元素时才入栈
        if ($this->helper->count() == 0 || $x <= $this->helper->top()) {
            $this->helper->push($x);
        }
    }

    /**
     * @return NULL
     */
    function pop()
    {
        $x = null;
        if ($this->data->count()) {
            $x = $this->data->pop();
        }
        // 出栈时，出栈元素等于辅助栈栈顶元素才出栈
        if (isset($x) && $this->helper->count() && $this->helper->top() == $x) {
            $this->helper->pop();
        }
    }

    /**
     * @return Integer
     */
    function top()
    {
        if ($this->data->count() == 0) {
            return null;
        }
        return $this->data->top();
    }

    /**
     * @return Integer
     */
    function getMin()
    {
        if ($this->helper->count() == 0) {
            return null;
        }
        return $this->helper->top();
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
