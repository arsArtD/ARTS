
const assert = require('assert') // 使用node内置的断言库
const solution = require('./solution')

describe('solution.js', function(){
    it('maxProfit is true', () => {
        var rec1 = solution.removeDuplicates([1,1,2]);
        assert.strictEqual(2, rec1);
        var rec2 = solution.removeDuplicates([0,0,1,1,1,2,2,3,3,4]);
        assert.strictEqual(5, rec2);
    })

})
