
# go module 

go module是go官方自带的go依赖管理库,在1.13版本正式推荐使用  
go module可以将某个项目(文件夹)下的所有依赖整理成一个 go.mod 文件,里面写入了依赖的版本等  
使用go module之后我们可不用将代码放置在src下了   

# 开启go module 

go在1.13版本默认是auto,代表 当项目在 GOPATH/src 外且项目根目录有 go.mod 文件时，开启 go module.  
也就是说,如果你不把代码放置在 GOPATH/src 下则默认使用 MODULE 管理.    
不好意思看错了,1.13+的版本判断开不开启MODULE的依据是根目录下有没有go.mod文件  
我们也可手动更改为 on(全部开启)/off(全部不开启)

这里演示设置为 on

windows:  
set GO111MODULE=on  
mac:  
export GO111MODULE=on    
然后输入  
go env  
查看 GO111MODULE 选项    
为 on 代表修改成功  

# go proxy
export GOPROXY=https://goproxy.io  

# 初始化 
为你的项目第一次使用 GO MODULE(项目中还没有go.mod文件)   
进入你的项目文件夹  
cd xxx/xxx/test/  
初始化 MODULE   
```
go mod init test(test为项目名)  
```
我们会发现在项目根目录会出现一个 go.mod 文件  
注意,此时的 go.mod 文件只标识了项目名和go的版本,这是正常的,因为只是初始化了  

# 检测依赖
```
go mod tidy 
```
tidy会检测该文件夹目录下所有引入的依赖,写入 go.mod 文件  
写入后你会发现 go.mod 文件有所变动  


# 下载依赖 
我们需要将依赖下载至本地,而不是使用 go get  
```
go mod download
```

如果你没有设置 GOPROXY 为国内镜像,这步百分百会夯住到死    
此时会将依赖全部下载至 GOPATH 下,会在根目录下生成 go.sum 文件, 该文件是依赖的详细依赖, 但是我们开头说了,  
我们的项目是没有放到 GOPATH 下的,那么我们下载至 GOPATH 下是无用的,照样找不到这些包   

# 导入依赖
```
go mod vendor
```
执行此命令,会将刚才下载至 GOPATH 下的依赖转移至该项目根目录下的 vendor(自动新建) 文件夹下  

# 依赖更新
这里的更新不是指版本的更新,而是指引入新依赖  
依赖更新请从检测依赖部分一直执行即可,即  
```  
go mod tidy
go mod download
go mod vendor
```

# 新增依赖
有同学会问,不使用 go get ,我怎么在项目中加新包呢?  
直接项目中 import 这个包,之后更新依赖即可  

# 在协作中使用 GOMODULE
要注意的是, 在项目管理中,如使用git,请将 vendor 文件夹放入白名单,不然项目中带上包体积会很大  
git设置白名单方式为在git托管的项目根目录新建 .gitignore 文件  
但是 go.mod 和 go.sum 不要忽略  
另一人clone项目后在本地进行依赖更新(同上方依赖更新)即可  

# GOMODULE常用命令
```
go mod init  # 初始化go.mod
go mod tidy  # 更新依赖文件
go mod download  # 下载依赖文件
go mod vendor  # 将依赖转移至本地的vendor文件
go mod edit  # 手动修改依赖文件
go mod graph  # 打印依赖图
go mod verify  # 校验依赖
```

