<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/18
 * Time: 11:13
 */

require_once '../../util/TreeNode.php';

class Solution
{

    /**
     * @ref https://leetcode-cn.com/problems/kth-smallest-element-in-a-bst/solution/er-cha-sou-suo-shu-zhong-di-kxiao-de-yuan-su-by-le/
     * 递归法： BST（二叉搜索树）的中序遍历是升序序列
     * @param TreeNode $root
     * @param Integer $k
     * @return Integer
     */
    function kthSmallest($root, $k) {
        $nums = [];
        $this->inorder($root, $nums);
        return $nums[$k -1];
    }

    private function inorder($root, array &$arr) {
        if($root == null) return $arr;

        $this->inorder($root->left, $arr);
        $arr[] = $root->val;
        $this->inorder($root->right, $arr);
        return $arr;
    }

    /**
     * 迭代法
     * @param $root
     * @param $k
     * @return mixed
     */
    function kthSmallest1($root, $k) {
        $stack = [];

        while(true) {
            while($root != null) {
                $stack[]= $root;
                $root = $root->left;
            }
            $root = array_pop($stack);
            $k -= 1;
            if($k == 0) return $root->val;
            $root = $root->right;
        }
    }
}
