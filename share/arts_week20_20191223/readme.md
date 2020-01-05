

预检请求  


浏览器将cors请求分为两种： 简单请求和非简单请求  

只要同时满足以下两大条件，就属于简单请求。

* 请求方法是以下三种方法之一：
HEAD  
GET  
POST  
* HTTP的头信息不超出以下几种字段： 
Accept  
Accept-Language  
Content-Language  
Last-Event-ID  
Content-Type：只限于三个值 application/x-www-form-urlencoded、 multipart/form-data、 text/plain  
凡是不同时满足上面两个条件，就属于非简单请求。


## 关于简单请求的请求方式：
发送的请求包含：origin  
response返回的关于cors的头：  
```
Access-Control-Allow-Origin: http://api.bob.com    ---- 必须的。它的值要么是请求时 Origin字段的值，要么是一个 *，表示接受任意域名的请求  
Access-Control-Allow-Credentials: true  ---- 选。它的值是一个布尔值，表示是否允许发送Cookie。默认情况下，Cookie不包括在CORS请求之中。设为 true，
    即表示服务器明确许可，Cookie可以包含在请求中，一起发给服务器。这个值也只能设为 true，如果服务器不要浏览器发送Cookie，删除该字段即可。
Access-Control-Expose-Headers: FooBar  ---- 可选。CORS请求时， XMLHttpRequest对象的 getResponseHeader()方法只能拿到6个基本字段： 
Cache-Control、 Content-Language、 Content-Type、 Expires、 Last-Modified、 Pragma。如果想拿到其他字段，
就必须在 Access-Control-Expose-Headers里面指定。上面的例子指定， getResponseHeader('FooBar')可以返回 FooBar字段的值。  

```

需要注意的是，如果要发送Cookie， Access-Control-Allow-Origin就不能设为星号，必须指定明确的、与请求网页一致的域名。  
同时，Cookie依然遵循同源政策，只有用服务器域名设置的Cookie才会上传，  
其他域名的Cookie并不会上传，且（跨源）原网页代码中的 document.cookie也无法读取服务器域名下的Cookie。  

## 非简单请求的处理方式： 
正式发送请求前，会发送过一次预检请求（preflight request）
预检请求头：   
```

OPTIONS /cors HTTP/1.1
Origin: http://api.bob.com
Access-Control-Request-Method: PUT    ---- 必须的，用来列出浏览器的CORS请求会用到哪些HTTP方法
Access-Control-Request-Headers: X-Custom-Header    ---- 逗号分隔的字符串，指定浏览器CORS请求会额外发送的头信息字段  
Host: api.alice.com 
Accept-Language: en-US
Connection: keep-alive
User-Agent: Mozilla/5.0...
``` 
预检请求结果：  
```
HTTP/1.1 200 OK
Date: Mon, 01 Dec 2008 01:15:39 GMT
Server: Apache/2.0.61 (Unix)
Access-Control-Allow-Origin: http://api.bob.com   ----关键，表示 http://api.bob.com可以请求数据。
    该字段也可以设为星号，表示同意任意跨源请求。
Access-Control-Allow-Methods: GET, POST, PUT    ---- 必需，它的值是逗号分隔的一个字符串，表明服务器支持的所有跨域请求的方法。
                                 注意，返回的是所有支持的方法，而不单是浏览器请求的那个方法。这是为了避免多次"预检"请求
Access-Control-Allow-Headers: X-Custom-Header
        ---- 如果浏览器请求包括 Access-Control-Request-Headers字段，则 Access-Control-Allow-Headers字段是必需的。
        ---- 它也是一个逗号分隔的字符串，表明服务器支持的所有头信息字段，不限于浏览器在"预检"中请求的字段。
Access-Control-Max-Age: 1728000  ----可选，用来指定本次预检请求的有效期，单位为秒。
        该结果中，有效期是20天（1728000秒），即允许缓存该条回应1728000秒（即20天），在此期间，不用发出另一条预检请求。
Content-Type: text/html; charset=utf-8
Content-Encoding: gzip
Content-Length: 0
Keep-Alive: timeout=2, max=100
Connection: Keep-Alive
Content-Type: text/plain
```
如果预检请求不通过,response中不会包含cors的任何头。  

预检请求通过后，其后的请求同简单请求的流程    

# 与jsonp的比较  

jsonp仅支持get的跨域请求。兼容旧有浏览器  
cors支持所有类型的http请求  
