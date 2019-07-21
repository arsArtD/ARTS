

# 参考资料

* https://www.nginx.com/resources/wiki/modules/auth_digest/
  
  默认 ngx_http_auth_digest 模块是编译到nginx的
  
  
```
auth_digest_user_file /opt/httpd/conf/passwd.digest;
auth_digest_shm_size 4m;   # the storage space allocated for tracking active sessions

location /private {
    auth_digest 'this is not for you';
    auth_digest_timeout 60s; # allow users to wait 1 minute between receiving the
                             # challenge and hitting send in the browser dialog box
    auth_digest_expires 10s; # after a successful challenge/response, let the client
                             # continue to use the same nonce for additional requests
                             # for 10 seconds before generating a new challenge
    auth_digest_replays 20;  # also generate a new challenge if the client uses the
                             # same nonce more than 20 times before the expire time limit
}
```


```
location / {
    auth_digest 'this is not for you';
    location /pub {
        auth_digest off; # this sub-tree will be accessible without authentication
    }
}
```

```
wget https://github.com/atomx/nginx-http-auth-digest/archive/master.zip
unzip master.zip
#加载模块到openresty中。
#cd {openresty目录} && ./configure --add-mudule={auth-digest模块的路径} -j2  --prefix {指定的路径} && make -j2 && make install
cd nginx-http-auth-digest-master
./htdigest.py {file_name} {user_name} {auth_digest}
```


# 访问正常的报文：

requst: Authorization: Digest username="admin", realm="this is not for you", nonce="693477005d347cfb", uri="/private/", algorithm=MD5, response="a220473030980ff48219d69f37747f13", qop=auth, nc=00000003, cnonce="a1046bfc1b3a885d"  
response: Authentication-Info: qop="auth", rspauth="76e490b2a9ebe336f1c4fba035679c5a", cnonce="a3ccd8da06cbb45b", nc=00000001
