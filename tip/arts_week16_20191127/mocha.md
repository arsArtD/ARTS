

js 测试库： mocha  

安装方法： npm install -g mocha  

使用方法： mocha source_test.js  

```
const assert = require('assert') // 使用node内置的断言库
const tree = require('./tree')

describe('tree.js', function(){
    it('left is right', () => {
        var treeInstance = tree.buildTree([3,5,1,6,2,0,8,null,null,7,4]);
        assert.strictEqual(5, treeInstance.left.val);
    })
})
```
