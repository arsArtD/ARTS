

https://coolshell.cn/articles/19840.html

# http的前世今生  

## 总述

HTTP (Hypertext transfer protocol) 翻译成中文是超文本传输协议，是互联网上重要的一个协议，由欧洲核子研究委员会CERN的  
英国工程师 Tim Berners-Lee v发明的，同时，他也是WWW的发明人，最初的主要是用于传递通过HTML封装过的数据。在1991年发布了  
HTTP 0.9版，在1996年发布1.0版，1997年是1.1版，1.1版也是到今天为止传输最广泛的版本（初始RFC 2068 在1997年发布， 然后  
在1999年被 RFC 2616 取代，再在2014年被 RFC 7230 /7231/7232/7233/7234/7235取代），2015年发布了2.0版，其极大的优化  
了HTTP/1.1的性能和安全性，而2018年发布的3.0版，继续优化HTTP/2，激进地使用UDP取代TCP协议，目前，HTTP/3 在2019年9月26日   
被 Chrome，Firefox，和Cloudflare支持  

## HTTP 0.9 / 1.0

* 在请求中加入了HTTP版本号，如：GET /coolshell/index.html HTTP/1.0
* HTTP 开始有 header了，不管是request还是response 都有header了。
* 增加了HTTP Status Code 标识相关的状态码。
* 还有 Content-Type 可以传输其它的文件了。  

##   HTTP/1.1 

* 可以设置 keepalive 来让HTTP重用TCP链接，重用TCP链接可以省了每次请求都要在广域网上进行的TCP的三次握手的巨大开销。   
  这是所谓的“HTTP 长链接” 或是 “请求响应式的HTTP 持久链接”。英文叫 HTTP Persistent connection.   
  
* 支持pipeline网络传输，只要第一个请求发出去了，不必等其回来，就可以发第二个请求出去，可以减少整体的响应时间。  
  （注：非幂等的POST 方法或是有依赖的请求是不能被pipeline化的）  
  
* 支持 Chunked Responses ，也就是说，在Response的时候，不必说明 Content-Length 这样，客户端就不能断连接，直到  
  收到服务端的EOF标识。这种技术又叫 “服务端Push模型”，或是 “服务端Push式的HTTP 持久链接”  

* 还增加了 cache control 机制。  
* 协议头注增加了 Language, Encoding, Type 等等头，让客户端可以跟服务器端进行更多的协商。
* 还正式加入了一个很重要的头—— HOST这样的话，服务器就知道你要请求哪个网站了。因为可以有多个域名解析到同一个IP上，
   要区分用户是请求的哪个域名，就需要在HTTP的协议中加入域名的信息，而不是被DNS转换过的IP信息。  
* 正式加入了 OPTIONS 方法，其主要用于 CORS – Cross Origin Resource Sharing 应用。

HTTP/1.1应该分成两个时代，一个是2014年前，一个是2014年后，因为2014年HTTP/1.1有了一组RFC（7230 /7231/7232/7233/7234/7235），
这组RFC又叫“HTTP/2 预览版”。其中影响HTTP发展的是两个大的需求：  

一个需要是加大了HTTP的安全性，这样就可以让HTTP应用得广泛，比如，使用TLS协议。
另一个是让HTTP可以支持更多的应用，在HTTP/1.1 下，HTTP已经支持四种网络协议：  
传统的短链接。  
可重用TCP的的长链接模型。  
服务端push的模型。  
WebSocket模型  

## HTTP/2  

虽然 HTTP/1.1 已经开始变成应用层通讯协议的一等公民了，但是还是有性能问题，虽然HTTP/1.1 可以重用TCP链接，但是请求还是一个一个串行发的，  
需要保证其顺序。然而，大量的网页请求中都是些资源类的东西，这些东西占了整个HTTP请求中最多的传输数据量。所以，理论上来说，如果能够并行这些请求，  
那就会增加更大的网络吞吐和性能。

另外，HTTP/1.1传输数据时，是以文本的方式，借助耗CPU的zip压缩的方式减少网络带宽，但是耗了前端和后端的CPU。这也是为什么很多RPC协议诟病HTTP的一个原因，  
就是数据传输的成本比较大。  

* HTTP/2是一个二进制协议，增加了数据传输的效率。
* HTTP/2是可以在一个TCP链接中并发请求多个HTTP请求，移除了HTTP/1.1中的串行请求。
* HTTP/2会压缩头，如果你同时发出多个请求，他们的头是一样的或是相似的，那么，协议会帮你消除重复的部分。这就是所谓的HPACK算法（参看RFC 7541 附录A）
* HTTP/2允许服务端在客户端放cache，又叫服务端push，也就是说，你没有请求的东西，我服务端可以先送给你放在你的本地缓存中。
  比如，你请求X，我服务端知道X依赖于Y，虽然你没有的请求Y，但我把把Y跟着X的请求一起返回客户端。


**如果你在你的公司内负责架构的话，HTTP/2是你一个非常重要的需要推动的一个事，除了因为性能上的问题，推动标准落地也是架构师的主要职责，因为，你企业内部的架构越标准，
你可以使用到开源软件，或是开发方式就会越有效率，跟随着工业界的标准的发展，你的企业会非常自然的享受到标准所带来的红利。**

## HTTP/3 

###  Head-of-Line Blocking问题
比较经典的流量调度的问题。这个问题最早主要的发生的交换机上
HTTP/1.1中的pipeline中如果有一个请求block了，那么队列后请求也统统被block住了；HTTP/2 多请求复用一个TCP连接，一旦发生丢包，  
就会block住所有的HTTP请求。这样的问题很讨厌。好像基本无解了。  

### QUIC的特点 
* 首先是上面的Head-of-Line blocking问题，在UDP的世界中，这个就没了。这个应该比较好理解，因为UDP不管顺序，不管丢包（当然，QUIC的一个任务是要像TCP的一样稳定，  
所以QUIC有自己的丢包重传的机制）
* TCP是一个无私的协议，也就是说，如果网络上出现拥塞，大家都会丢包，于是大家都会进入拥塞控制的算法中，这个算法会让所有人都“冷静”下来，然后进入一个“慢启动”的过程，  
包括在TCP连接建立时，这个慢启动也在，所以导致TCP性能迸发地比较慢。QUIC基于UDP，使用更为激进的方式。同时，QUIC有一套自己的丢包重传和拥塞控制的协，  
一开始QUIC是重新实现一TCP 的 CUBIC算法，但是随着BBR算法的成熟（BBR也在借鉴CUBIC算法的数学模型），QUIC也可以使用BBR算法。这里，多说几句，从模型来说，  
以前的TCP的拥塞控制算法玩的是数学模型，而新型的TCP拥塞控制算法是以BBR为代表的测量模型，理论上来说，后者会更好，但QUIC的团队在一开始觉得BBR不如CUBIC的算法好，  
所以没有用。现在的BBR 2.x借鉴了CUBIC数学模型让拥塞控制更公平  
* 现在要建立一个HTTPS的连接，先是TCP的三次握手，然后是TLS的三次握手，要整出六次网络交互，一个链接才建好，虽说HTTP/1.1和HTTP/2的连接复用解决这个问题，  
但是基于UDP后，UDP也得要实现这个事。于是QUIC直接把TCP的和TLS的合并成了三次握手（对此，在HTTP/2的时候，是否默认开启TLS业内是有争议的，反对派说，  
TLS在一些情况下是不需要的，比如企业内网的时候，而支持派则说，TLS的那些开销，什么也不算了）  


目前看下来，HTTP/3目前看上去没有太多的协议业务逻辑上的东西，更多是HTTP/2 + QUIC协议。但，HTTP/3 因为动到了底层协议，所以，在普及方面上可能会比   
HTTP/2要慢的多的多。但是，可以看到QUIC协议的强大，细思及恐，QUIC这个协议真对TCP是个威胁，如果QUIC成熟了，TCP是不是会有可能成为历史呢？  


