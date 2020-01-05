

阅读下文有感：  
https://medium.com/free-code-camp/secure-your-web-application-with-these-http-headers-fd66e0367628  

改文讲解了一些通过http头来使web应用更加安全的方法：

## HTFS(HTTP Strict Transport Security--强制安全传输技术)  

## HPKP(HTTP Public Key Pinning--HTTP公钥固定)  
不推荐

## Expect-CT

## X-Frame-Options  

## Content Security Policy (CSP)
主要用来防御xss  

## X-XSS-Protection  
不支持csp的较旧版本的浏览器防御xss的方法,该头不被firefox支持  

## Feature policy  
目前仅支持少数浏览器（safari,chrome.
一些例子： 
```
Feature-Policy: vibrate 'self'; push *; camera 'none'
```

## X-Content-Type-Options  
IE中嗅探MIME的一个头  

## Cross-Origin Resource Sharing (CORS)  
* CORS不是一个简单的规范。有相当多的场景需要记住，您很容易被一些细微的特性所困扰，比如预请求(preflight requests)。
* 永远不要公开通过GET改变状态的api。攻击者可以在没有飞行前请求的情况下触发这些请求，这意味着根本没有保护措施

## X-Permitted-Cross-Domain-Policies  
adobe 提出的类似cors的头(网站根目录的crossdomain.xml也是类似的目标)  

## Referrer-Policy
类似的头有Origin（浏览器端控制）

# 测试网站的header是否安全  
https://securityheaders.com/  
国内有如上安全头的： https://write.qq.com/  
