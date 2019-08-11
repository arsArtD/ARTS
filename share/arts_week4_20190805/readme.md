
element的cascader-panel组件初始化时
activepath的值修改需要进行延时。

因为在cascader-panel对数据的渲染是通过watch option，
需要数据渲染后，才能对activepath的值进行修改。

且需要注意elementui与vue的版本
建议 elementui 2.11.1, vue 2.6.10

核心代码如下：

```
that.resourcetree = temp;
if (type == 1) {
    that.dialogTitle = '添加';
    that.cascaderRefV = [];
} else {
    that.cascaderRefV = [[1,2,4],[1,2,3]];
    that.dialogTitle = '编辑';
    that.changename = data.data.tree_name;
}
that.dialogVisible = true;
setTimeout(function(){
    that.$refs.cascaderRef.activePath = [];
    that.$refs.cascaderRef.menus = [that.$refs.cascaderRef.menus[0]];
    if (type == 1) {
        that.$refs.cascaderRef.clearCheckedNodes();
    }
    $('.handlenamebox .el-input__inner').eq(0).focus()
},100);
```
