

thinkphp在执行命令的时候，如果通过  
$output->println($str) 输出的时候，如果$str有中文，则有可能会乱码。

通过查看源码，发现，$output输出的时候，是通过向php://stdout输出的，
通过简单的例子测试，windows命令行中向php://stdout输出中文字符时会乱码，

最终解决方法：  
向php://output输出，或者使用echo,print等输出方法。
