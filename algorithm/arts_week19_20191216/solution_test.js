
const assert = require('assert') // 使用node内置的断言库
const solution = require('./solution')

describe('solution.js', function(){
    it('sum is true', () => {
        var treeInstance = solution.sortedArrayToBST([-10,-3,0,5,9]);
        assert.strictEqual(-10, treeInstance.left.left.val);
        assert.strictEqual(9, treeInstance.right.val);
        assert.strictEqual(5, treeInstance.right.left.val);
    })

})
