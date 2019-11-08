
阅读下文有感： 

https://medium.com/swlh/hacking-json-web-tokens-jwts-9122efe91e4a 

JSON web tokens are a type of access tokens that are widely used in commercial applications. 
They are based on the JSON format and includes a token signature to ensure the integrity of 
the token.
JSON web令牌是一种广泛用于商业应用程序的访问令牌。它们基于JSON格式，并包含一个令牌签名以确保令牌的完整性


Today, we are going to talk about the security implications of using JSON web tokens (and s
ignature-based tokens in general), and how they can be exploited by attackers to bypass access 
control.
今天，我们将讨论使用JSON web令牌(以及通常基于签名的令牌)的安全含义，以及攻击者如何利用这些令牌绕过访问控制

# JSON Web Tokens是怎样工作的
jwt由三部分构成： header+payload+signature  

## header  
JSON web令牌的头部分标识用于生成签名的算法。它是一个base64url编码的JSON blob字符串，就像这样  
{
 "alg" : "HS256",
 "typ" : "JWT"
}  
base64url encoded string: eyBhbGcgOiBIUzI1NiwgdHlwIDogSldUIH0K  
其中header中算法最常用的是HMAC和RSA  

## payload  
有效负载(payload)部分包含实际用于访问控制的信息。此部分也是在令牌中使用之前编码的base64url  
{
 "user_name" : "admin",
}  
base64url encoded string: eyB1c2VyX25hbWUgOiBhZG1pbiB9Cg  

## signature  
签名是用来验证令牌未被篡改的部分。它是通过将报头与负载连接起来，然后使用报头中指定的算法进行签名来计算的
signature = HMAC-SHA256(base64urlEncode(header) + '.' + base64urlEncode(payload), secret_key)  
```
// Let's just say the value of secret_key is "key".  
-> signature function returns 4Hb/6ibbViPOzq9SJflsNGPWSk6B8F6EqVrkNjpXh7M
```

## 完整的token  
通过将每个部分(header、payload和signature)与一个“.”连接起来，您可以获得完整的令牌。  
eyBhbGcgOiBIUzI1NiwgdHlwIDogSldUIH0K.eyB1c2VyX25hbWUgOiBhZG1pbiB9Cg.4Hb/6ibbViPOzq9SJflsNGPWSk6B8F6EqVrkNjpXh7M  


# Ways to bypass JSON Web Token controls(绕过JSON Web令牌控件的方法)  

正确实现后，JSON web令牌提供了一种安全的方法来识别用户，因为有效负载部分中包含的数据不能被篡改。(因为用户不能访问密钥，所以她
不能自己签署令牌。)
但是如果实现不正确，攻击者可以通过一些方法绕过安全机制并伪造任意的令牌

## 更改算法类型  

### 算法为空
JWT支持“None”算法。如果alg字段被设置为“None”，那么任何令牌都将被认为是有效的，如果它们的签名部分被设置为空。例如，
以下令牌将被认为是有效的:
eyAiYWxnIiA6ICJOb25lIiwgInR5cCIgOiAiSldUIiB9Cg.eyB1c2VyX25hbWUgOiBhZG1pbiB9Cg.

它只是这两个blob的base64url编码版本，没有任何签名。  
{
 "alg" : "None",
 "typ" : "JWT"
}  
{
 "user" : "admin"
}  
该特性最初用于调试目的。但是，如果在生产环境中不关闭，那么攻击者可以通过将alg字段设置为“None”来伪造任何他们想要的令牌。然后，
他们可以使用伪造的令牌冒充网站上的任何人。

### HMAC算法  
用于JWTs的两种最常见的算法是HMAC和RSA。对于HMAC，令牌将使用密钥进行签名，然后使用相同的密钥进行验证。对于RSA，首先使用私钥创建令牌，
然后使用相应的公钥进行验证

至关重要的是，HMAC令牌的密钥和RSA令牌的私钥要保持秘密，因为它们用于对令牌进行签名

现在让我们假设有一个最初设计用来使用RSA令牌的应用程序。令牌是用私钥a签名的，私钥a对公众保密。然后使用公钥B对令牌进行验证，任何人都可以使用公钥B。
只要这些令牌始终被当作RSA令牌对待，这就没有问题

现在，如果攻击者将alg更改为HMAC，那么她可以使用RSA公钥B对伪造的令牌进行签名，从而创建有效的令牌。  

## 提供无效的签名  
也有可能令牌的签名在到达应用程序后从未经过验证。通过这种方式，攻击者可以通过提供无效的签名来绕过安全机制  

## Bruteforce the secret key（暴力破解秘钥） 

## Leak the secret key
如果攻击者不能强行获得密钥，她可能会尝试泄漏密钥。如果存在另一个允许攻击者读取存储密钥值的文件的漏洞
(如目录遍历、XXE、SSRF)，则攻击者可以窃取密钥并对任意令牌进行签名  

## KID manipulation  
KID代表“Key ID”。它是JWTs中的一个可选头字段，它允许开发人员指定用于验证令牌的密钥。KID参数的正确用法如下:    
{
 "alg" : "HS256",
 "typ" : "JWT",
 "kid" : "1"       // use key number 1 to verify the token 
}  
由于该字段是由用户控制的，所以它可能被攻击者操纵并导致危险的后果  

### 目录遍历  
由于KID通常用于从文件系统中检索密钥文件，如果在使用之前未对其进行清理，则可能导致目录遍历攻击。在这种情况下，攻击者可以指定
文件系统中的任何文件、作为用于验证令牌的密钥。  
“kid”: “../../public/css/main.css” 
// use the publicly available file main.css to verify the token  
例如，攻击者可以强制应用程序使用一个公开可用的文件作为密钥，并使用该文件签署HMAC令牌  

### SQL注入  
KID还可以用于从数据库中检索密钥。在这种情况下，可以利用SQL注入绕过JWT签名  
如果KID参数可以进行SQL注入，那么攻击者可以使用该注入返回她想要的任何值
```
“kid”: "aaaaaaa' UNION SELECT 'key';--"  
// use the string "key" to verify the token
```
例如，上述注入将导致应用程序返回字符串“key”(因为名为“aaaaaaa”的键在数据库中不存在)。然后，  
将使用字符串“key”作为密钥来验证令牌  

## Header parameter manipulation  
除了密钥ID之外，JSON web令牌标准还为开发人员提供了通过UR指定密钥的能力  

### 1. JKU header parameter  

JKU是“JWK Set URL”的缩写。它是一个可选的头字段，用于指定指向一组用于验证令牌的键的URL。
如果允许并且没有适当地限制该字段，那么攻击者可以托管自己的密钥文件，并指定应用程序使用它来验证令牌  

### 2. JWK header parameter  
可选的JWK (JSON Web密钥)头参数允许攻击者将用于直接验证令牌的密钥嵌入令牌中  

### 3. X5U, X5C URL manipulation  
与jku和jwk头类似，x5u和x5c头参数允许攻击者指定用于验证令牌的公钥证书或证书链。x5u指定URI表单中的信息，
而x5c允许将证书值嵌入到令牌中  

## 其他JWT安全问题  

### 信息泄露
由于JSON web令牌用于访问控制，它们通常包含关于用户的信息。
  
如果令牌未加密，任何人都可以base64解码令牌并读取令牌的有效负载。因此，如果令牌包含敏感信息，它可能成为信息泄漏的来源。
正确实现的JSON web令牌签名部分提供数据完整性，而不是保密性

### Command Injection(命令注入攻击)  
有时，当KID参数直接传递给不安全的文件读取操作时，可以将命令注入到代码流中

允许这种类型攻击的函数之一是Ruby open()函数。该函数允许攻击者执行系统命令，只需将该命令附加在KID文件名之后的
输入中即可

这只是一个例子。从理论上讲，只要应用程序将任何未清除的头参数传递到任何类似于system()、exec()的函数中，
就会发生这样的漏洞。

Ultimately, JSON web tokens are just another form of user input. They should always be handled with 
skepticism and sanitized rigorously.  
最终，JSON web标记只是另一种形式的用户输入。我们应该始终以怀疑的态度对待它们，并对它们进行严格的消毒

免责声明:这篇文章是为了引起人们对JSON Web令牌漏洞的注意，并帮助开发人员识别常见的陷阱。请不要使用此
信息攻击网站或冒充他人  

在没有测试权限的系统上尝试此操作是非法的。如果您发现了漏洞，请负责任地向供应商披露。帮助我们的互联网成为一个
更安全的地方  
