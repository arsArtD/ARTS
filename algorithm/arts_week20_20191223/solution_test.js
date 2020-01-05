
const assert = require('assert') // 使用node内置的断言库
const solution = require('./solution')

describe('solution.js', function(){
    it('maxProfit is true', () => {
        var rec1 = solution.maxProfit([7,1,5,3,6,4]);
        assert.strictEqual(5, rec1);
    })

})
