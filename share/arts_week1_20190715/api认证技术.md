
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
   
nginx配置方法参照： http://www.ttlsa.com/nginx/nginx-basic-http-authentication
   
   
## Digest Access

todo

## App Secret Key + HMAC

todo

## JWT – JSON Web Tokens

todo

## OAuth 1.0 – 3 legged & 2 legged 

todo

## OAuth 2.0 – Authentication Code & Client Credential 

todo

   
