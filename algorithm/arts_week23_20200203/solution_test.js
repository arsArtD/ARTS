
const assert = require('assert') // 使用node内置的断言库
const solution = require('./solution')
const solution2 = require('./solution2');

describe('solution.js', function(){
    it('solution.js cache is useful!', () => {
        var cache = new solution.cache( 2 /* 缓存容量 */ );
        cache.put(1, 1);
        cache.put(2, 2);
        assert.ok(cache.get(1) == 1);       // 返回  1
        cache.put(3, 3);    // 该操作会使得密钥 2 作废
        assert.ok(cache.get(2) == -1);        // 返回 -1 (未找到)
        cache.put(4, 4);    // 该操作会使得密钥 1 作废
        assert.ok(cache.get(1) == -1);        // 返回 -1 (未找到)
        assert.ok(cache.get(3) == 3);        // 返回  3
        assert.ok(cache.get(4) == 4);         // 返回  4
    })
})

describe('solution2.js', function(){
    it('solution2.js cache is useful!', () => {
        var cache = new solution2.cache( 2 /* 缓存容量 */ );
        cache.put(1, 1);
        cache.put(2, 2);
        assert.ok(cache.get(1) == 1);       // 返回  1
        cache.put(3, 3);    // 该操作会使得密钥 2 作废
        assert.ok(cache.get(2) == -1);        // 返回 -1 (未找到)
        cache.put(4, 4);    // 该操作会使得密钥 1 作废
        assert.ok(cache.get(1) == -1);        // 返回 -1 (未找到)
        assert.ok(cache.get(3) == 3);        // 返回  3
        assert.ok(cache.get(4) == 4);         // 返回  4
    })
})

