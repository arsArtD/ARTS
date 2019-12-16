
const assert = require('assert') // 使用node内置的断言库
const tree = require('./tree')
const solution = require('./solution')

describe('solution.js', function(){
    it('sum is true', () => {
        var treeInstance = tree.buildTree([5,4,8,11,null,13,4,7,2,null,null,null,1]);
        assert.strictEqual(true, solution.hasPathSum(treeInstance, 22));
    })

})
