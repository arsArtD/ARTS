
const assert = require('assert') // 使用node内置的断言库
const buildTree = require('../../util/buildTree')
const solution = require('./Solution')

describe('solution.js', function(){
    it('maxdepth is ok!', () => {
        var treeInstance = buildTree.sortedArrayToBST([3,9,20,null,null,15,7]);
        assert.strictEqual(3, solution.maxDepth(treeInstance));
    })

})
