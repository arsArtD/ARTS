<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/18
 * Time: 13:37
 */

class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;
    function __construct($val = 0, $left = null, $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }

    function __toString()
    {
        return sprintf('val: %s, left : %s, right: %s', $this->val, $this->left, $this->right);
    }
}
