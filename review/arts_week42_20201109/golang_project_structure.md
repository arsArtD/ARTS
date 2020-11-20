
# golang project structure
https://tutorialedge.net/golang/go-project-structure-best-practices/


## 较小的应用--扁平化结构

```
application/
 - main.go
 - main_test.go
 - utils.go
 - utils_test.go
```

用处：
1. 微服务
2. 小的工具类或库

examples:  
https://github.com/tidwall/gjson  
https://github.com/go-yaml/yaml  


## 中大型应用 --  模块化  

```
rest-api/
- main.go
- user/
- - user.go
- - login.go
- - registration.go
- articles/
- - articles.go
- utils/
- - common_utils.go
```

examples: 
https://github.com/google/go-cloud   
https://github.com/hashicorp/consul  
https://github.com/ipfs/go-ipfs   such as: git bittorrent
https://github.com/gohugoio/hugo   such as: 静态站点


## 成熟的项目  

https://github.com/hashicorp/terraform/tree/master/terraform  
https://github.com/kubernetes/kubernetes  
