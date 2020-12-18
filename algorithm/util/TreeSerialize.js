

var arr = [1,null,3,4];

function TreeNode(val) {
    this.val = val;
    this.left = this.right = null;
}

/**
 * Definition for a binary tree node.
 * function TreeNode(val) {
 *     this.val = val;
 *     this.left = this.right = null;
 * }
 */

/**
 * Encodes a tree to a single string.
 *
 * @param {TreeNode} root
 * @return {string}
 */
var serialize = function(root) {
    if(root == null) return [];
    let res = [];
    let node = root, queue = [node];
    while(queue.length > 0) {
        node = queue.shift();
        if(node == null) {
            res.push(null);
        } else {
            res.push(node.val)
            queue.push(node.left);
            queue.push(node.right);
        }
    }
    return res;
}

/**
 * Decodes your encoded data to tree.
 *
 * @param {string} data
 * @return {TreeNode}
 */
var deserialize = function(data) {
    if (data.length == 0)  return null;
    let root = new TreeNode(data.shift());
    let queue = [root];
    while(queue.length > 0) {
        let node = queue.shift();
        // 数组中的节点已经计算完毕
        if(data.length <= 0) break;
        let left = data.shift();
        if(left != null) {
            node.left = new TreeNode(left);
            queue.push(node.left);
        }
        if (data.length <= 0) break;
        let right = data.shift();
        if(right != null) {
            node.right = new TreeNode(right);
            queue.push(node.right);
        }
    }
    return root;
}

module.exports = {
    'tree_serialize' : serialize,
    'tree_deserialize' : deserialize
};


/*
var deserializeNode = deserialize(arr);
console.log(deserializeNode);
var serialize = serialize(deserializeNode);
console.log(serialize);
*/
