  
阅读下文有感：   
https://medium.com/@daniel.dan/whats-new-in-php-7-4-top-10-features-that-you-need-to-know-e0acc3191f0a  

php7.4将在2019年11月28号发布，被评为2019年度10大流行开发语言第八位，比18年前进了一名  

php7.4的特性： 

## 1.箭头函数的支持  
```
$a = [1, 2, 3, 4, 5];
$b = array_map(fn($n) => $n * $n * $n, $a);
print_r($b);
```

## 2.类型属性的支持 

由于声明类型(不包括void和callable)，您可以使用nullable类型、int、float、array、string、object、iterable、self、bool和parent  

## 3.预加载  

在预加载期间，PHP还消除了不必要的包含，并解决了类依赖关系和带有特征、接口等的链接。  


## 4.协变返回&逆变参数（Covariant returns & contravariant parameters）

目前，PHP主要有不变参数类型和不变返回类型，它们都有一些约束。通过引入协变(类型的顺序是从更具体到更一般)返回和逆变(类型的顺序是从更一般到更具体)参数，
PHP开发人员将能够将参数的类型更改为它的超类型之一。反过来，返回的类型可以很容易地被它的子类型替换。   


## 5.弱引用

在PHP 7.4中，WeakReference类允许web开发人员保存到对象的链接，而该对象不会阻止其销毁  
弱引用不可序列化 
```
<?php
$obj = new stdClass;
$weakref = WeakReference::create($obj);
var_dump($weakref->get());
unset($obj);
var_dump($weakref->get());
?>
```

## 6.合并分配操作符(Coalescing assign operator)

coalesce操作符是PHP 7.4中的另一个新特性。当您需要与isset()一起应用三元运算符时，这是非常有用的。这将使您能够在第一个操作数存在且不为空时返回它。  
如果没有，它只返回第二个操作数  
```
<?php
// Fetches the value of $_GET['user'] and returns 'nobody'
// if it does not exist.
$username = $_GET['user'] ?? 'nobody';
// This is equivalent to:
$username = isset($_GET['user']) ? $_GET['user'] : 'nobody';
// Coalescing can be chained: this will return the first
// defined value out of $_GET['user'], $_POST['user'], and
// 'nobody'.
$username = $_GET['user'] ?? $_POST['user'] ?? 'nobody';
?>
```

## 7.数组表达式中的扩展运算符
与array_merge相比，PHP 7.4将使工程师能够更快地在数组中使用扩展操作符。原因有两个。首先，扩展运算符被认为是一种语言结构，  
而array_merge是一个函数。第二个原因是现在可以为常量数组优化编译时。因此，您将提高PHP 7.4的性能  

```
$parts = ['apple', 'pear'];
$fruits = ['banana', 'orange', ...$parts, 'watermelon'];
var_dump($fruits);
```

## 8.一个新的自定义对象序列化机制
在PHP的新版本中，有两种新方法可用:__serialize和__unserialize。将Serializable接口的多功能性与实现_sleep / __wakeup 方法的方法结合起来，  
这种序列化机制将允许PHP开发人员避免与现有方法相关的定制问题。了解关于这个PHP特性的更多信息  


## 9.反射的引用
诸如symfony/var-dumper之类的库严重依赖于ReflectionAPI来精确地显示变量。在此之前，没有对引用反射的适当支持，
这迫使这些库依赖hacks来检测引用。PHP 7.4增加了ReflectionReference类，解决了这个问题。  


## 10.支持从_ tostring()抛出异常
在此之前，无法从_ tostring方法抛出异常。原因是对象到字符串的转换是在标准库的许多函数中执行的，  
并不是所有函数都准备好正确地“处理”异常。作为这个RFC的一部分，对代码库中的字符串转换进行了全面的审计，并且取消了这个限制  


# 最终的想法
一周后，PHP 7.4将发布。有许多新的PHP特性可以减少内存使用并极大地提高PHP 7.4的性能。  
您将能够避免这种编程语言以前的一些限制，编写更简洁的代码，更快地创建web解决方案。  

Beta 3版本已经可以在开发服务器上下载和测试。但是，我不建议在生产服务器和实际项目中使用它。
如果您对PHP 7.4/PHP开发有任何疑问，或者只是喜欢这篇文章，请在下面留下您的评论。
