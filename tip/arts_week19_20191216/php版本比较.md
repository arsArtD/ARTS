```
$version1="v4.0";

$version2="v4.0.0";

print_r(version_compare($version1,$version2));exit();
```


对于上面的返回的结果是-1，但是在我们看来上面应该是相等的。因为这个函数是用于对比两个「PHP 规范化」的版本数字字符串，  
而对于PHP规范来说是设置三位版本号。如果我们使用这个函数来对比我们的app版本那么要注意使用三位版本号。  
这里提供一个修改后的函数：  

```
function version_code_compare($version1,$version2){

     $version1_arr=explode(".",$version1);

     $version2_arr=explode(".",$version2);

     $max_length=max(count($version1_arr),count($version2_arr));

     $version1_arr=array_pad($version1_arr,$max_length,0);

     $version2_arr=array_pad($version2_arr,$max_length,0);

     return version_compare(implode(".",$version1_arr),implode(".",$version2_arr));

 }
```

