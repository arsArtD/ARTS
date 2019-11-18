/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/11/10
 * Time: 20:33
 */
/**
 * Definition for a binary tree node.
 * function TreeNode(val) {
 *     this.val = val;
 *     this.left = this.right = null;
 * }
 */
/**
 * @param {TreeNode} root
 * @param {TreeNode} p
 * @param {TreeNode} q
 * @return {TreeNode}
 */
var lowestCommonAncestor = function(root, p, q) {
    if(root == null) {
        return null;
    }
    if(root == p || root == q) {
        return root;
    }
    var left = lowestCommonAncestor(root.left, p, q);
    var right = lowestCommonAncestor(root.right, p, q);
    if (left != null && right != null) {
        return root;
    } else if(left != null) {
        return left;
    } else if(right != null) {
        return right;
    }
    return null;
};
