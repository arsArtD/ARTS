<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/30
 * Time: 16:35
 */

class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}
