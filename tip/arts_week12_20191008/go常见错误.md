

error :   cannot refer to unexported name  
解决方法： 模块中要导出的函数，必须首字母大写  （Go” Language Tutorial-5(Exported Names)）  


error:   cannot load golang.org/x/net/context
解决方法：   
go.mod  
```
module github.com/exercise

require (
    golang.org/x/text v0.3.0
    gopkg.in/yaml.v2 v2.1.0 
)

replace (
    golang.org/x/text => github.com/golang/text v0.3.0
)
```


error: Golang: runnerw.exe: CreateProcess failed with error 216 (no message available)  
解决方法： 一个目录下只能有一个main函数.改为测试文件即可  




