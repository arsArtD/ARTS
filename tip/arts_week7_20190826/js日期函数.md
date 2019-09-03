Js获取年月日及时间转换  

1、获取年、月、日和将时间戳转换成日期格式  

// 简单的一句代码  
var date = new Date(时间戳); //获取一个时间对象  


/**
 1. 下面是获取时间日期的方法，需要什么样的格式自己拼接起来就好了  
 2. 更多好用的方法可以在这查到 -> http://www.w3school.com.cn/jsref/jsref_obj_date.asp  
 */
date.getFullYear();  // 获取完整的年份(4位,1970)  
date.getMonth();  // 获取月份(0-11,0代表1月,用的时候记得加上1)  
date.getDate();  // 获取日(1-31)  
date.getTime();  // 获取时间(从1970.1.1开始的毫秒数)  
date.getHours();  // 获取小时数(0-23)  
date.getMinutes();  // 获取分钟数(0-59)  
date.getSeconds();  // 获取秒数(0-59)  

 

// 比如需要这样的格式 yyyy-MM-dd hh:mm:ss  
var date = new Date(1398250549490);  
Y = date.getFullYear() + '-';  
M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';  
D = date.getDate() + ' ';  
h = date.getHours() + ':';  
m = date.getMinutes() + ':';  
s = date.getSeconds();   
console.log(Y+M+D+h+m+s);   
// 输出结果：2014-04-23 18:55:49  

 

2、将日期格式转换成时间戳  

// 也很简单  
var strtime = '2014-04-23 18:55:49:123';  
var date = new Date(strtime); //传入一个时间格式，如果不传入就是获取现在的时间了，这样做不兼容火狐。  
// 可以这样做  
var date = new Date(strtime.replace(/-/g, '/'));  


// 有三种方式获取，在后面会讲到三种方式的区别  
time1 = date.getTime();  
time2 = date.valueOf();  
time3 = Date.parse(date);  


/* 
三种获取的区别：
第一、第二种：会精确到毫秒  
第三种：只能精确到秒，毫秒将用0来代替  
比如上面代码输出的结果(一眼就能看出区别)：  
1398250549123
1398250549123
1398250549000 
*/

 

3、Date()参数常用的形式有以下几种  

 

new Date("yyyy/MM/dd hh:mm:ss");  
new Date("yyyy/MM/dd");  
new Date(yyyy,mth,dd);  

比如：  

new Date("2016/09/16 14:15:05");  
new Date("2016/09/16");  
new Date(2016,8,16);  
