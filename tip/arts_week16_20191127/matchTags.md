
通过正则匹配标签的正则：  

```
// https://davidwells.io/snippets/regex-match-html-elements-and-react-components
			
var str1 = '标签1<span data-title="标签1"></span>标签2<span data-title="标签2"></span>标签3<span data-title="标签3">标签3</span>';
var str1 = '<h1>标签1</h1><h1>标签2</h1><h1>标签3</h1>';			
var str1 = '标签1<span data-title="标签1"><span data-title="测试嵌套"></span></span>标签2<span data-title="标签2"></span>标签3<span data-title="标签3">标签3</span>';
//var str1= '<span>123</span>';
var regexSingleTag = /<([a-zA-Z1-6]+)([^<]+)*(?:>(.*?)<\/\1>|\s+\/>)/;
var matchResult = str1.match(regexSingleTag);
console.log(matchResult[0]);
```

				




			
