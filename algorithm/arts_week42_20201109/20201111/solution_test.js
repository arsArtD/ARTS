
const assert = require('assert') // 使用node内置的断言库
const solution = require('./solution')

describe('solution.js', function(){
    it('maxSubArray is true', () => {
        // var rec1 = solution.maxSubArray([-2,1,-3,4,-1,2,1,-5,4]);
        // assert.strictEqual(6, rec1);
        var rec2 = solution.maxSubArray([-1,0,-2]);
        assert.strictEqual(0, rec2);
    })

})
