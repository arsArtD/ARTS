
总结如下文章:  

https://mp.weixin.qq.com/s/Ui0qaMup-KWXiz3RBM14Kw    


# 富文本目前发展的矛盾

##   落后的生产力

* 编辑内容相关标准推进缓慢  
* 浏览器厂商对于相同操作或者场景实现方式的不同，导致兼容性的问题  
* 使用HTML DOM描述富文本内容有太多不可控制的情况  

## 日益增长的需求

* 不确定的交互意图，比如按Delete键，不同的焦点位置有不同的情况需要考虑
* 内容输入的多样性，比如有：打字键入、粘贴、拖拽等，每个处理起来都相当复杂
* 大量需要拦截阻止和代理的浏览器默认行为，保证数据的完整性和正确性
* 用户对于编辑器的使用要求越来越高，比如：合并单元格、列表多级嵌套、协同编辑、版本对比、段落标注，大家都认为这是基本需求，其实这里面的技术难度是超出大家的想象的。


# 开源富文本编辑技术

* CKEditor 1-4（2008）
* UEditor (2012)
* Quill.js（2012）
* CKEditor 5（2014）
* Prosemirror（2015）
* Draft.js（2015）
* Slate（2016）


# 编辑器技术阶段划分

* Level 0（不知道为啥从零开始）是编辑器的起始阶段，代表旧一代的编辑器的实现
* Level 1 第二阶段，是在第一阶段发展过来的，有一定的先进性，也引入了主流的一些编程思想，对于富文本内容有一定的抽象
* Level 2 第三阶段，完全不依赖浏览器的编辑能力，独立的实现光标和排版


# 开源富文本编辑技术探究 

## 2008 - CKEditor 1-4(level0)

### 原理
代表传统编辑器的技术路线（同类型技术的主要是UEditor），主要依赖于浏览器原生的编辑能力，用户内容的输入是浏览器直接处理，加粗、斜体、回车  
等这类的处理则是捕获浏览器的事件来覆盖浏览器默认行为来实现，再辅以一些DOM的嵌套规则（dtd）和复杂数据输入（如粘贴）的过滤规则来约束数据的正确性  

内容的可编辑主要依赖DOM的contentEditable属性，基于原生execCommand或者自定义扩展的execCommand去操作DOM实现富文内容的修改。  

### 特点
依赖浏览器原生的编辑能力（Level 0）
基于浏览器execCommand或者扩展的指令集
基于DOM的嵌套规则和过滤
输出富文本内容是HTML字符串

### 优点
* 基于浏览器原生编辑能力，输入非常流畅
* 没有令人头疼的IME（组合输入）问题

### 缺点
* 不可以预测的交互，容易出现数据混乱（拖拽、复制粘贴、删除）
* 相同操作不同浏览器可能有不同的实现（比如基本的加粗、斜体Enter），很难实现表现和数据完全统一
* 特定结构的富文本内容（图片+Caption）实现复杂
* 对于协同编辑器支持困难（CKEditor 5重头开始做的根本原因）

### 小结
本质还是直接操作DOM,属于第一阶段


## 2012 - Quill.js(level1)

### 背景

github star: 28K(截至2020.11.05)； 石墨文档是基于这个做的

### 原理

底层还是依赖DOM的contentEditable特性，但是Quill对DOM Tree以及数据的修改操作进行了抽象，这意味着编辑器开发者大部分场景下其实不是直接通过  
修改DOM完成编辑器功能的，而是通过Quill提供的模型操作API来完成操作的，主角变成了：Delta、Parchment & Blots  


### 特点

* 依赖浏览器原生的编辑能力（Level 1）
* 数据更新主体是Delta，DOM的更新由单独的Parchment & Blots描述
* 输出数据可以是HTML的字符串也可以由Delta描述的一系列操作（也就是JSON），但是可读性补不好一般很少作为结果数据保存
* Quill.js主体、Parchment、Delta都是独立的仓储，架构良好


## 2015 - ProseMirror （level1）

### 背景 & 原理

Confluence 是基于此实现的，将主流的前端的架构理念应用到了编辑器的开发中，比如彻底使用纯JSON数据描述富文本内容，引入不可变数据以及Virtual DOM的概念，  
还有插件机制、分层、Schemas（范式）等等，所以感觉ProseMirror是一款理念先进且体系相对比较完善的一款编辑器（或者说框架）  


### 特点

* 依赖浏览器原生的编辑能力（Level 1）
* 嵌套的文档模型（区别于Delta的OT模型，它的文档模型是通常意义上的JS对象模型，对应的模型数据可以作为结果直接存储）
* Schemas（范式）约定模型嵌套以及渲染规则
* 统一数据更新流，采用单向数据流、不可变数据及虚拟DOM避免直接操作DOM（这一点确实融合了主流的函数式编程的思想）
* 输出的数据是纯JSON
* 个人认为唯一不足的就是它需要开发者重新学习它独有的描述DOM的范式（相对于Slate）


## 2015 - Draft.js（level1 pro）

### 背景且原理 

知乎的富文本编辑器基于此实现。Draft.js是第一个把富文本编辑器与React结合的开源作品，开发者在进行编辑器开发时既不用操作DOM、  
也不用单独学习一套构建UI的范式，而是可以直接编写React组件实现编辑器的UI，某种意义上是生产力的巨大提升，  
因为Draft.js和React一样也是Facebook团队开源的框架，所以Draft.js整体理念与React非常的吻合，也代表了主流的编程思想，  
比如使用状态管理保存富文本数据、使用Immutable.js库、数据的修改基本全部代理了浏览器的默认行为，通过状态管理的方式修改富文本数据。  


### 特点 

* 依赖浏览器原生的编辑能力（Level 1 Pro）
* React 作为UI层
* 与React结合的富文本数据的管理（状态管理）
* 毋容置疑Draft.js因为没有做伤筋动骨的架构更新，它的稳定性、细节处理应该相较于其它框架（Slate）有很大优势
* Draft对于文档数据的描述过于死板，比如需要嵌套节点的表格就不那么容易实现，即使能把一个表格当做富文组件嵌到Draft编辑器中，  
它的局限性也很大（比如单元格中基本的加粗、斜体、链接就没办法借助编辑器的能力实现了），所以它的数据模型是不太完善的。


## 2016 - Slate （Level 1 Pro）

### 背景
Slate从一出来大量借鉴了Quill、ProseMirror、Draft.js的优点，虽然是主流编辑器中出道比较晚的，但是由于结构良好，理念新颖，还有作者对于架构的持续改进，目前还是比较受欢迎的一款编辑器。  

### 特点
* 依赖浏览器原生的编辑能力（Level 1 Pro）
* Shchema 定义数据的约束规则（ProseMirror）
* Nest Data Model（ProseMirror）
* React作为视图层（Draft.js）
* 插件作为一等公民，开发者对于交互拥有很大的控制权（Draft.js）
* Immutable、统一的数据更改Commands（Draft.js）
 
###  2018 - Slate Core
抽取独立的视图层，底层不在强依赖React  

### 2019 - Slate Migration
2019年年底的时候，Slate对于它自己进行了一次大的架构升级，这次被称为大修的升级（0.50.x）可以说亮点非常多，  
首先是TypeScript对所有代码重新实现，其次是把原来复杂的插件机制简化，还有把不可变数据的模型改为更简洁对新手更友好的Immer，  
同样是视图层与核心实现分离，虽然目前还有不少缺陷，包括中文输入以及浏览器兼容性的问题，但是通过实践发现这些都可以在视图层进行修复的。  

# 编辑器的未来  

其实未来早已来临，早在2010年Google Doc就使用了全新的技术来实现富文本编辑器，就是大家通常说的第三阶段（Level 2），  
可以实现文本的独立排版，不再依靠浏览器的任何编辑功能，自主实现选区光标和内容排版，只不过目前还没有一款基于这套架构的开源技术。  

# 总结 

得益于开源技术，编辑器的实践经验得以延续和发展，没有绝得的好坏，每一款编辑器都有自己的特点，    
CKEditor是发展时间最久，它的技术线路清晰可寻，发展时间最长，跨越了编辑器技术的第一阶段和第二阶段，  
从CKEditor 4到CKEditor 5更是经历完全的重构，从根本上解决协同编辑的问题，Quill.js也可以称为老牌的编辑器了，  
受众非常大，从市面使用Quill.js的产品（石墨文档、ClickUp）也可以看出它的可塑性非常强，ProseMirror可以说是非常稳定的编辑器，  
知乎上也有人专门拿它和Slate做过对比，况且有Confluence做背书自然差不了，最晚出来的Slate，则一路大刀阔斧的重构，  
目前整体架构异常优雅和简洁，又搭载了TypeScript，感觉势头非常强劲，都是非常值得学习的。  

# github地址  

https://github.com/ckeditor/ckeditor4  
https://ckeditor.com/ckeditor-4/  

https://github.com/ckeditor/ckeditor5  
https://ckeditor.com/ckeditor-5/  

https://github.com/quilljs/quill    
https://quilljs.com/   

https://github.com/ProseMirror/prosemirror    
http://prosemirror.net/  

https://github.com/facebook/draft-js   
https://draftjs.org/  

https://github.com/ianstormtaylor/slate  
http://slatejs.org/  