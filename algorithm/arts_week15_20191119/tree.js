
function TreeNode(val) {
    this.val = val;
    this.left = this.right = null;
}

/**
 * @param {*} arr
 */
function buildTree(arr) {
    if (Object.prototype.toString.call(arr) != "[object Array]") {
        return null;
    }
    if(arr.length == 0)  return null;
    if(arr.length == 1)  return new TreeNode(arr[0]);
    var root = new TreeNode(arr[0]);
    for(var i=1; i<arr.length; i++) {
        if(2*i+1 < arr.length) {
            root.left = new TreeNode(arr[2*i+1]);
        }
        if(2*i+2 < arr.length) {
            root.right = new TreeNode(arr[2*i+2]);
        }
        if(root.left != null && root.right != null) {
            root = root.left;
        } else {

        }
    }
}

buildTree([3,5,1,6,2,0,8,null,null,7,4]);
