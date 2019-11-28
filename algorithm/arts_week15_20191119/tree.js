
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

    var depth = Math.ceil(Math.log2(arr.length));
    var root = null;
    var data = [];//存储各个子树的数据

    // 按照层级遍历
    for(var d = 1; d <= depth; d++) {
        if(d == 1) {
            data[0] =  new TreeNode(arr[0]);
        } else {
            var currDepthLastIndex = 0;
            var currDepthFirstIndex = Math.pow(2,d-1) - 1;
            if (d != depth) {
                currDepthLastIndex = Math.pow(2,d) - 2;
            } else {
                currDepthLastIndex = arr.length - 1;
            }
            for(var index = currDepthFirstIndex; index <= currDepthLastIndex; index++) {
                data[index] =  new TreeNode(arr[index]);

                var temp;
                if((index % 2) != 0) {
                    temp = data[Math.floor((index-1)/2)];
                    //奇数为左节点
                    temp && (temp['left'] = data[index]);
                } else {
                    temp = data[Math.floor((index-2)/2)];
                    //偶数为右节点
                    temp && (temp['right'] = data[index]);
                }
                //console.log(arr[index], '=====', index, d);
            }
        }
    }
    //console.log(data);
    return data[0];
}

//var tree = buildTree([3,5,1,6,2,0,8,null,null,7,4]);
//console.log(tree)
//console.log(JSON.stringify(tree))

module.exports = {
    'buildTree': buildTree
}