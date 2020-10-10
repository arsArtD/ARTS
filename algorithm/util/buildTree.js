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

var sortedArrayToBST = function(nums) {
    return buildTree(nums, 0, nums.length - 1);
};

function buildTree(nums, left, right) {
    if(left > right) {
        return null;
    }
    var mid = left + Math.ceil((right - left)/2);
    //console.log('mid is:', mid);
    var root = new TreeNode(nums[mid]);
    root.left = buildTree(nums, left, mid - 1);
    root.right = buildTree(nums, mid + 1, right);
    return root;
}

var result = sortedArrayToBST([-10,-3,0,5,9]);
//var result = sortedArrayToBST([0,1,2]);
//console.log(result);

module.exports = {
    'sortedArrayToBST' : sortedArrayToBST
}
