/**
 * Definition for a binary tree node.
 * function TreeNode(val) {
 *     this.val = val;
 *     this.left = this.right = null;
 * }
 */
/**
 * @param {TreeNode} root
 * @return {number[]}
 */
var inorderTraversal = function(root) {
    var list = [];
    var stack = [];
    var cur = root;
    while(cur != null || stack.length > 0) {
        if(cur != null) {
            stack.push(cur);
            cur = cur.left;
        } else {
            cur = stack.pop();
            list.push(cur.val);
            cur = cur.right;
        }
    }
    return list;
};


// [1,null,2,3,null,4,null] ==> [1,4,3,2]
