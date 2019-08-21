<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/8/12
 * Time: 19:57
 */

//题目参照 readme.md

include  'TreeNode.php';

class Solution {

    private $maxL = 0;
    /**
     * @param TreeNode $root
     * @return Integer
     */
    function longestUnivaluePath($root) {
        if (is_null($root)) return 0;
        $this->getMaxL($root, $root->val);
        return $this->maxL;
    }

    private function getMaxL($root, $val) {

        if (is_null($root)) return 0;

        $left = $this->getMaxL($root->left, $root->val);

        $right = $this->getMaxL($root->right, $root->val);

        $this->maxL = max($this->maxL, $left+$right);

        if ($root->val == $val)
            return max($left,$right) + 1;

        return 0;

    }
}

/*

              5
             / \
            5   5
           / \   \
          1   1   5
                   \
                    5

 */

$root = new TreeNode(5);
$root->left = new TreeNode(5);
$root->left->left = new TreeNode(1);
$root->left->right = new TreeNode(1);
$root->right = new TreeNode(5);
$root->right->right = new TreeNode(5);
$root->right->right->right = new TreeNode(5);

$s = new Solution();
$res = $s->longestUnivaluePath($root);
var_dump($res); //4
