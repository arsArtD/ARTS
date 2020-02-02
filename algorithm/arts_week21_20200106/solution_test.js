
const assert = require('assert') // 使用node内置的断言库
const solution = require('./solution')

describe('solution.js', function(){
    it('maxProfit is true', () => {
        var rec1 = solution.maxProfit([7,1,5,3,6,4]);
        assert.strictEqual(7, rec1);
        var rec2 = solution.maxProfit([1,2,3,4,5]);
        assert.strictEqual(4, rec2);
        var rec3 = solution.maxProfit([7,6,4,3,1]);
        assert.strictEqual(0, rec3);
    })

})
