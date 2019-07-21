
本文主要内容来自： https://coolshell.cn/articles/19395.html

文中涉及到的rfc  
 An Extension to HTTP : Digest Access Authentication： 
https://tools.ietf.org/html/rfc2069  

HTTP Authentication: Basic and Digest Access Authentication： 
https://tools.ietf.org/html/rfc2617  

api 认证技术的常用方法有如下几种方式：

HTTP Basic  
Digest Access  
App Secret Key + HMAC  
JWT – JSON Web Tokens  
OAuth 1.0 – 3 legged & 2 legged  
OAuth 2.0 – Authentication Code & Client Credential  

现在细说以上六种方法的实现方式：  

## HTTP Basic 

*  把 username和 password 做成  username:password 的样子（用冒号分隔） 
 
*  进行Base64编码。Base64("username:password") 得到一个字符串  
   如：把 haoel:coolshell 进行base64 后可以得到 aGFvZW86Y29vbHNoZWxsCg  
   
*  把 aGFvZW86Y29vbHNoZWxsCg放到HTTP头中 Authorization 字段中，  
   形成 Authorization: Basic aGFvZW86Y29vbHNoZWxsCg，然后发送到服务端。
   
*  服务端如果没有在头里看到认证字段，则返回401错，以及一个个
   WWW-Authenticate: Basic Realm='HelloWorld' 之类的头要求客户端进行认证。
   之后如果没有认证通过，则返回一个401错。如果服务端认证通过，那么会返回200。
   
具体实践参照： [nginx配置http basic](/nginx_http_basic.md)
   
   
## Digest Access

中文称“HTTP 摘要认证”，最初被定义在了 RFC 2069 文档中（后来被 RFC 2617 引入了一系列安全增强的选项；“保护质量”(qop)、  
随机数计数器由客户端增加、以及客户生成的随机数）。  

其基本思路是，请求方把用户名口令和域做一个MD5 –  MD5(username:realm:password) 然后传给服务器，  
这样就不会在网上传用户名和口令了，但是，因为用户名和口令基本不会变，所以，这个MD5的字符串也是比较固定的，  
因此，这个认证过程在其中加入了两个事，一个是 nonce 另一个是 qop  

*  首先，调用方发起一个普通的HTTP请求。比如：GET /coolshell/admin/ HTTP/1.1
服务端自然不能认证能过，服务端返回401错误，并且在HTTP头里的 WWW-Authenticate 包含如下信息：
 WWW-Authenticate: Digest realm="testrealm@host.com",  
 qop="auth,auth-int",  
 nonce="dcd98b7102dd2f0e8b11d0f600bfb0c093",  
 opaque="5ccc069c403ebaf9f0171e9517f40e41"  
其中的 nonce 为服务器端生成的随机数，

* 客户端做 HASH1=MD5(MD5(username:realm:password):nonce:cnonce) ，其中的 cnonce 为客户端生成的随机数，
这样就可以使得整个MD5的结果是不一样的。
如果 qop 中包含了 auth ，那么还得做  HASH2=MD5(method:digestURI) 其中的 method 就是HTTP的请求方法（GET/POST…），digestURI 是请求的URL。
如果 qop 中包含了 auth-init ，那么，得做  HASH2=MD5(method:digestURI:MD5(entityBody)) 其中的 entityBody 就是HTTP请求的整个数据体。

* 得到 response = MD5(HASH1:nonce:nonceCount:cnonce:qop:HASH2) 如果没有 qop则 response = MD5(HA1:nonce:HA2)
* 客户端对服务端发起如下请求—— 注意HTTP头的 Authorization: Digest ...
GET /dir/index.html HTTP/1.0  
Host: localhost  
Authorization: Digest username="Mufasa",  
realm="testrealm@host.com",  
nonce="dcd98b7102dd2f0e8b11d0f600bfb0c093",  
uri="%2Fcoolshell%2Fadmin",  
qop=auth,   
nc=00000001,  
cnonce="0a4f113b",  
response="6629fae49393a05397450978507c4ef1",  
opaque="5ccc069c403ebaf9f0171e9517f40e41"
维基百科上的 Wikipedia: Digest access authentication 词条非常详细地描述了这个细节。

摘要认证这个方式会比之前的方式要好一些，因为没有在网上传递用户的密码，而只是把密码的MD5传送过去，相对会比较安全，
而且，其并不需要是否TLS/SSL的安全链接。但是，别看这个算法这么复杂，最后你可以发现，整个过程其实关键是用户的password，
这个password如果不够得杂，其实是可以被暴力破解的，而且，
整个过程是非常容易受到中间人攻击——比如一个中间人告诉客户端需要的 Basic 的认证方式 或是 老旧签名认证方式（RFC2069）。

具体实践参照： [nginx配置auth_digest](/nginx_digest_access.md)

## App Secret Key + HMAC

todo

## JWT – JSON Web Tokens

todo

## OAuth 1.0 – 3 legged & 2 legged 

todo

## OAuth 2.0 – Authentication Code & Client Credential 

todo

   
