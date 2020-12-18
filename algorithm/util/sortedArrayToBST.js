/**
 * Definition for a binary tree node.
 * function TreeNode(val) {
 *     this.val = val;
 *     this.left = this.right = null;
 * }
 */
/**
 * @param {number[]} nums
 * @return {TreeNode}
 */


function TreeNode(val) {
    this.val = val;
    this.left = this.right  = null;
}

// 将有序数组转换为二叉搜索树
// 将一个按照升序排列的有序数组，转换为一棵高度平衡二叉搜索树
var sortedArrayToBST = function(nums) {
    return sortedArrayToBST(nums, 0, nums.length - 1);
};

function sortedArrayToBST(nums, left, right) {
    if(left > right) {
        return null;
    }
    var mid = left + Math.ceil((right - left)/2);
    //console.log('mid is:', mid);
    var root = new TreeNode(nums[mid]);
    root.left = sortedArrayToBST(nums, left, mid - 1);
    root.right = sortedArrayToBST(nums, mid + 1, right);
    return root;
}

var result = sortedArrayToBST([-10,-3,0,5,9]);
//var result = sortedArrayToBST([0,1,2]);
//console.log(result);

module.exports = {
    'sortedArrayToBST' : sortedArrayToBST
}
