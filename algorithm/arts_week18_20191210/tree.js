
function TreeNode(val) {
    this.val = val;
    this.left = this.right = null;
}

/**
 * @param {*} arr
 */
function buildTree(data) {
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
    'buildTree': buildTree
}
