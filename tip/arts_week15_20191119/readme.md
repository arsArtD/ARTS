js对象数组深拷贝： 
var copyData = JSON.parse(JSON.stringify(data));

php二维数组去重： 
array_map("unserialize", array_unique(array_map("serialize", $result)));
