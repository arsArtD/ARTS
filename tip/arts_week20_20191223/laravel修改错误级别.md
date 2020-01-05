

app/Providers/AppServiceProvider.php

中的boot方法中添加：

error_reporting(E_ERROR | E_PARSE );

在laravel5.8测试通过。command和正常的http请求中的php错误级别都会按照这个设置   
