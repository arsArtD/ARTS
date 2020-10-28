<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/10/15
 * Time: 8:39
 */

class Solution
{
    /**
     * @param TreeNode $root
     * @param TreeNode $p
     * @param TreeNode $q
     * @return TreeNode
     */
    function lowestCommonAncestor($root, $p, $q) {
        if($root == null) return null;
        if($root->val == $p->val || $root->val == $q->val) return $root;
        //如果left为空，说明这两个节点在cur结点的右子树上，我们只需要返回右子树查找的结果即可
        $left = $this->lowestCommonAncestor($root->left, $p, $q);
        $right = $this->lowestCommonAncestor($root->right, $p, $q);
        if($left == null)  return $right;
        if($right == null) return $left;

        //如果left和right都不为空，说明这两个节点一个在cur的左子树上一个在cur的右子树上，
        //我们只需要返回cur结点即可。
        return $root;
    }

    function lowestCommonAncestor1($root, $p, $q) {
        //如果根节点和p,q的差相乘是正数，说明这两个差值要么都是正数要么都是负数，也就是说
        //他们肯定都位于根节点的同一侧，就继续往下找
        while (($root->val - $p->val) * ($root->val - $q->val) > 0)
            $root = $p->val < $root->val ? $root->left : $root->right;
        //如果相乘的结果是负数，说明p和q位于根节点的两侧，如果等于0，说明至少有一个就是根节点
        return $root;
    }
}
