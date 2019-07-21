
参照： 
nginx auth digest网站： http://www.ttlsa.com/nginx/nginx-basic-http-authentication/  
auth-digest源码： https://github.com/atomx/nginx-http-auth-digest  
openresty安装： http://openresty.org/en/installation.html  

* nginx.conf的内容

```
server {
 listen 81;

 include /etc/nginx/default.d/*.conf;
 root /home/nginx_learn;

 location /auth {
   auth_basic "test nginx http auth basic";
   auth_basic_user_file conf.d/htpasswd;
   autoindex on;
 }
}

```

*  如果用的云服务器，需要确认安全组中添加了81端口

*  如果验证失败，在response中会有： WWW-Authenticate: Basic realm="test nginx http auth basic"

*  如果请求成功，在request中有： Authorization: Basic YTAwMToxMjM0NTY=

*  htpasswd 中内容的生成方式： 

    printf "ttlsa:$(openssl passwd -crypt 123456)\n" >>conf/htpasswd  
    cat conf/htpasswd 
    
    或者:  
    创建文件并增加用户： htpasswd  -bc {file_name} {user_name} {user_psw}  
    增加用户： htpasswd -c {file_name} {user_name} {user_psw}   
    删除用户： htpasswd -D {file_name} {user_name}
