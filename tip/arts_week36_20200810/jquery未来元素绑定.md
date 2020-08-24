


jQuery中对未来的元素绑定事件  
  
对未来的元素绑定事件不能用bind，  
  
1、可以用live代替，但是要注意jquery的版本,根据官方文档，从1.7开始就不推荐live和delegate了，1.9里就去掉live了。  
  
2、推荐用on代替(注：1.7及以上的版本才支持)。用法：
```
on(events,[selector],[data],fn)
```  
  
放在$(function(){})里才有效  
```
  $(document).on("click", "#testDiv", function(){
  //此处的$(this)指$( "#testDiv")，而非$(document)
  });

```
