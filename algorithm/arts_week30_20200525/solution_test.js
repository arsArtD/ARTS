
const assert = require('assert') // 使用node内置的断言库
const solution = require('./solution')
const tree = require('./tree')

describe('solution.js', function(){
    it('isMirror function ok!', () => {
        var arr1 = [1,2,2,3,4,4,3];
        var tree1 = tree.tree_deserialize(arr1)
        // console.log(tree1);
        var isMirror = solution.isSymmetric(tree1)
        assert.strictEqual(isMirror, true);

        var arr2 = [1,2,2,null,3,null,3];
        var tree2 = tree.tree_deserialize(arr2)
        isMirror = solution.isSymmetric(tree2)
        assert.strictEqual(isMirror, false);

        var arr3 = [];
        var tree3 = tree.tree_deserialize(arr3)
        isMirror = solution.isSymmetric(tree3)
        assert.strictEqual(isMirror, true);
;    })

})
