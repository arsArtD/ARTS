
人机验证相关资料：  

文档地址：   
https://help.aliyun.com/document_detail/66340.html?spm=5176.11065259.1996646101.searchclickresult.36de22bf0Or82c  

人机验证后台：  
https://yundunnext.console.aliyun.com/?spm=a2c4g.11186623.2.12.7d457c7cqIO338&p=afs#/person-machine  

自定义前端样式：（需要登录人机验证后台进行修改）  
https://help.aliyun.com/document_detail/122717.html?spm=a2c4g.11186623.6.601.2f0733a3zvM4sA  

sdk相关：  
https://developer.aliyun.com/sdk/php.html?spm=a2c6h.13321295.1365408.3.2f7868a60D3rEN  
https://packagist.org/packages/alibabacloud/sdk?spm=a2c6h.13321367.1365437.3.7a34f0598GUQZM 


使用无痕验证的注意事项： 网站最好是https的  

人机验证相关参数：  
需要在阿里后台开通人机验证的服务。  
配置子账号有人机验证的权限，并记录accesskey, accessSecret. 部分参数如下：  
AFS_ENDPOINTNAME=cn-hangzhou  
AFS_REGIONID=cn-hangzhou  
AFS_PRODUCT=afs  
AFS_DOMAIN=afs.aliyuncs.com  
AFS_ACCESSKEY={子账号accesskey}  
AFS_ACCESSSECRET={子账号accessSecret}  
AFS_APPKEY={应用id，人机验证后台可见}  
