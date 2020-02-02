

阅读下文有感： 
https://badootech.badoo.com/mutation-testing-in-php-quality-measurement-for-code-coverage-48753e028346

Mutation Testing（变异测试）--- 代码覆盖率的质量度量

变异测试的例子
比如
```
function isAdult(int $age) : bool {
    return $age > 18
}
```
如果单元测试中只是判断了大于18的比如：19，小于18的比如17， 但是没有比较18.则会遗漏  

比如构造对象的时候使用了3个set，但是其中的两个set被get测试了，那么也会有覆盖度的问题  

## 变异测试的定义  
变异测试是一种机制，通过对代码进行小的修改，允许我们模仿捣乱者或初级开发人员的行为，他们试图故意破坏代码， 
将>更改为<，= to !=，等等。对于每一个善意的变更，我们运行的测试应该覆盖已经变更的行  

## 变异测试的度量  

### 术语
killed mutants  
escaped mutants  
covered mutant   
### 衡量标准  
MSI (mutation score indicator) --   the ratio of killed mutants to the total number.
mutation code coverage         --   
covered MSI

## 变异测试的问题  
### 速度慢  
并行测试  
增加线程数  
变异测试代码调优  
notice: 变异测试仅适合单元测试  

### 无限的变异  
有些变异测试有可能会引起死循环，比如变更循环条件  
变异测试代码调优  
运行时超时 

### 相同的变异 
比如 1/-2 和 -1/2的结果是一样的  

## php中进行变异测试  
常用的有： Humbug（不再维护） Infection
虽然Infection很好用，但是如下已经被我现在的公司所广泛使用  
https://github.com/badoo/soft-mocks/
比Infection欠缺的地方：并行支持。

SoftMocks是如何工作的? 它们拦截包含文件，并用一个修改过的文件替换它们:所以SoftMocks不是在执行类a，而是在不同的地方创建类a，  
并将不同的输出插入到include中。Infection的工作方式几乎完全相同，只是使用了 stream_wrapper_register()，它在系统级执行相同的操作。  
因此，我们可以使用SoftMocks或Infection。  

为了克服这些困难，我们编写了自己的小工具。我们从Infection中借用了变异操作符(它们写得很好，很容易使用)。  
我们不是通过stream_wrapper_register()运行突变，而是通过SoftMocks运行它们，因此我们使用自己的工具。  
我们的工具与我们的内部代码覆盖服务一起工作。也就是说，它可以在不运行所有测试的情况下，按需获得文件或行的覆盖率，因此速度非常快。  
最重要的是，它很简单。Infection有大量的工具和各种选项(例如，在多个线程中运行)，但是我们的工具不做任何这些。  
相反，我们使用内部基础设施来弥补这种不足。例如，为了在多个线程中运行测试，我们通过云来执行它们    

报告界面同phpunit一样丑。。


## 比较结果
使用变异测能够写出更好的测试代码

## 结论
代码覆盖率是一个重要的度量标准—您需要跟踪它。但分数并不能保证你的安全。  
变异测试有助于使您的单元测试更好，并使您的代码覆盖率跟踪更容易理解。  
PHP已经有了一个工具，所以如果您有一个小型的、简单的项目，您可以现在就使用它并尝试一下。  
开始进行突变测试，即使是手动的。只要迈出第一步，看看你会得到什么。我相信你会喜欢的  
