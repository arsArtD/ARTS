

js 关于将数组组合成树，将树遍历为数组的方式分别参照：  


https://github.com/joaonuno/tree-model-js  

https://github.com/joaonuno/flat-to-nested-js  
 
核心思想是： 必须有一个root元素。非root元素需要标记其父节点id  

以下为tree-model的示例用法：  

```

var a = [
    {
        id: 1,
        child: [
            {
                id:2,
                child: [
                    {
                        id:9,
                        child: [
                            {
                                id: 11
                            }
                        ]
                    }
                ]
            },
            {
                id:3,
                child: [
                    {
                        id: 12
                    }
                ]
            }
        ]
    },
    {
        id: 4,
        child: [
            {
                id:5,
                child: [
                    {
                        id:7
                    },
                    {
                        id:8
                    },
                ]
            },
            {
                id:6
            }
        ]
    }
]


findPath(a, 8);



function findPath(arrRaw, id) {
  
    var finalRes = [];
    for(var i=0; i<arrRaw.length; i++) {
        var TreeModel = require('tree-model');
        var tree = new TreeModel({
            childrenPropertyName: 'child'
        });
        var root = tree.parse(arrRaw[i])
        root.walk(function (node) {
            // Halt the traversal by returning false
            if(!node.model.hasOwnProperty('child')) {
                var path = node.getPath();
                var temp = [];
                path.forEach(function(value,index){
                    temp.push(value.model.id);
                }) 
                finalRes.push(temp);
            }
        });
    }

    console.log('树状结构的所有路径......', finalRes);
}


```
