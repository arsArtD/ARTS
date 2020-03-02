

阅读下文有感： 

https://medium.com/swlh/composer-everything-i-should-have-known-794225cde691  


# composer的简单认知

composer install 
composer dump-autoload 
解决安装第三方库的问题 

# composer的历史

composer之前，包管理是通过手动将包放到libs下面；另一种方式则是使用pear 
pear的特点如下  
* 包是安装在系统的
* 每个包都是唯一的 
* 如果自己写的库想并入pear，需要一定数量的投票支持  
* 既有的解决方案警示过期，不活跃或者不维护  

#  进入composer 
Nills Adermann and Jordi Boggiano 创建了composer 
composer基于工程  
每个人都能贡献，开发，和分享包到其他人  
这种方式鼓励了更多的经过打磨过的，完整的，没有bug的库产生  
composer是一种依赖管理工具，依赖与composer.json配置工程的依赖，包括哪里去下载，哪里去解压，哪里去自动加载  
依赖不仅仅是php库。像php本身或者php扩展，它们不能被composer所安装，限定这些的目的仅仅是让开发者的环境统一   


# 包从哪里来  
VCS(版本管理工具，svn or git)  ,PEAR  ,url  ,.zip; 以上这些需要进行合理的资源库配置 
参照：https://getcomposer.org/doc/04-schema.md#repositories  
```
{
    "repositories": [
        {
            "type": "composer",
            "url": "http://packages.example.com"
        },
        {
            "type": "composer",
            "url": "https://packages.example.com",
            "options": {
                "ssl": {
                    "verify_peer": "true"
                }
            }
        },
        {
            "type": "vcs",
            "url": "https://github.com/Seldaek/monolog"
        },
        {
            "type": "pear",
            "url": "https://pear2.php.net"
        },
        {
            "type": "package",
            "package": {
                "name": "smarty/smarty",
                "version": "3.1.7",
                "dist": {
                    "url": "https://www.smarty.net/files/Smarty-3.1.7.zip",
                    "type": "zip"
                },
                "source": {
                    "url": "https://smarty-php.googlecode.com/svn/",
                    "type": "svn",
                    "reference": "tags/Smarty_3_1_7/distribution/"
                }
            }
        }
    ]
}
```
对于私有资源库（repositories），可以配置 access tokens 或者 basic http auth. 
配置可选项有 GitHub, Gitlab，Bitbucket  

如果没有资源库被指定，或者包在指定的资源库中找不到，那么会去主资源库（仓库），packagist.org去搜索  
一但包被定为到，composer会利用vcs的特点（分支和标签）去尝试下载最符合composer.json中配置的版本  

常见的版本号格式遵循语义化版本公约  
该约定假设有三个版本号x . y带可选稳定后缀的Z (Major.Minor.Patch)。每个数字从0开始，并根据所做的更改类型递增:  
* 主要版本.次要版本.补丁 引入了中断更改时的补丁增量
* 主要版本.次要版本.补丁 增加向后兼容的功能
* 主要版本.次要版本.补丁 
* 当bug偶尔被修复时，会使用稳定性后缀:-dev、- Patch (-p)、-alpha (-a)、-beta (-b)或- rc(发布候选版本)

需要注意的是 
* 主要版本为0.x的包。在小版本发布期间，x可以引入中断的更改。只有版本1.0.0或更高的包才被认为是可以应用到生产的  
* 并不是所有的包都遵循语义版本控制。在做出任何假设之前，一定要参考他们的文档

## 指定版本约束 

* 版本范围-使用数学运算符>，>=，<，<=，!= =1.0.0 <2.0.0 -将安装最新版本的更高或等于1.0.0但低于2.0.0
* 插入符号范围——添加插入符号将安装最新版本，该版本不包含中断更改。 ^2.1.0的意思是“安装最新的版本，比2.1.0高或等于2.1.0，但比3.0.0低。”
* 波浪符范围-类似于插入符号范围;不同之处在于，它只增加最后一个指定数字的版本。  
  ~2.1将安装最新的2可用的x版本(例如2.9)  
  ~2.1.0将安装最新的2.1。可用的x版本(例如，2.1.9)  
* 您还可以选择指定确切的版本  

您可以在两个不同的地方注册依赖项:require和require-dev。第一个包含了您的项目需要在生产环境中运行的所有内容，  
而第二个规定了进行开发工作的附加需求——例如，phpunit来运行您的测试套件。我们在两个不同的地方指定依赖项的原因  
是为了不在生产机器上安装用于开发的autoload包。  


## 为什么要是用版本范围  
指定确切的版本会使项目的依赖项难以保持最新，从而带来错过重要补丁发布的风险。使用范围将允许composer引入包含bug修复和安全补丁的新版本  
这就是composer.lock开始起作用。第一次运行安装之后，依赖项及其子依赖项的确切版本将存储在编写器中。
omposer.lock——这意味着所有后续安装都将下载完全相同的版本，从而避免了不同人使用的不同版本的库  

除非库时自己维护的，否则composer.lock需要加到代码管理里面  

运行composer update 命令时的行为就好像锁文件不存在一样。
Composer将查找任何符合您的版本约束的新版本并重写Composer。锁定文件与新的更新版本。  

## composer 自动加载  
composer产生了vendor/autoload.php，可以自定义一些自动加载项到comsposer.json中  
```
{
 "autoload": { 
  "psr-4": { 
   "Foo\\": "src/" 
  }, 
  "classmap": [ 
   "database/seeds", 
   "database/factories", 
   "lib/MyAwesomeLib.php" 
  ], 
  "files": ["src/helpers.php"], 
  "exclude-from-classmap": ["tests/"] 
 } 
}
```
* PSR-0和PSR-4是用于将类名称空间转换为包含它们的文件的物理路径的标准。例如，每当我们导入使用Foo\Bar\Baz;类时，
  composer将自动加载位于src/Foo/Bar/ Bar .php中的文件。  
* classmap  ---- 包含自动加载的类文件和目录的列表
* files ---- 包含要自动加载的文件列表。当您希望在整个项目中全局使用一组函数时，这尤其有用 
* exclude-from-classmap　---- 您还可以通过将某些文件和目录添加到下面来排除它们被自动加载　

## 自定义脚本  
使用方法： composer {脚本名}  
```
{ 
    "scripts": { 
        "test": [ 
            "@clearCache", 
            "phpunit" 
        ], 
        "clearCache": "rm -rf cache/*" 
    }
}
```

## 在线上使用composer  
* 永远不要在线上使用composer update; 
* 使用require和require-dev键将项目的依赖项划分为生产需求和开发需求。通过这种方式，composer将不会在生产环境中安装用于开发的包(例如:phpunit)。
* 确保您只自动加载所需的文件和目录。与需求一样，您也可以使用autoload和autoload-dev键将自动加载分解为生产和开发。没有理由在生产中自动加载迁移和种子目录。
* 使用 composer install --no-dev --optimize-autoloader 来安装包，并为生产环境优化autoloader。--no-dev标志指示编写器忽略只开发包，
  而 --optimalize-autoloader标志将动态PSR-0/PSR-4自动加载转换为静态类映射。这使得加载文件更快，因为使用classmap时自动加载器
  知道文件的确切位置，而使用PSR-0/PSR-4时，它总是必须检查文件是否存在


## 总结  
以上就是关于composer的主要内容，至少从用户的角度来说是这样 
如果想把包发布到packagist.org，可以参考如下地址： 
https://bootsity.com/php/create-a-composer-package-and-list-on-packagist
