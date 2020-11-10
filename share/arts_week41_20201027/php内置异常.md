
```angular2html
LogicException：PHP5.1起，表示程序逻辑中的错误，这种异常应当由代码修复。
BadFunctionCallException：PHP5.1起，LogicException的子类，如果回调函数引用的是未定义函数或参数缺失则抛出异常，一个典型的用法是与is_callable函数结合使用。
DomainException：PHP5.1起，LogicException的子类，如果值不在有效的数据范围内则抛出异常。
InvalidArgumentException：PHP5.1起，LogicException的子类，如果参数不是预期的类型则抛出异常。
LengthException：PHP5.1起，LogicException的子类，如果长度无效则抛出异常。
OutOfRangeException：PHP5.1起，LogicException的子类，当请求非法索引时抛出异常，检测编译时可知的错误。
 BadMethodCallException：PHP5.1起，BadFunctionCallException的子类，如果回调函数引用的是未定义方法或参数缺失则抛出异常。
RuntimeException：PHP5.1起，运行时发生错误会抛出异常。
OutOfBoundsException：PHP5.1起，RuntimeException的子类，如果不是有效的键则抛出异常，表示编译时无法检测的错误。
OverflowException：PHP5.1起，RuntimeException的子类，添加元素到已满的容器中则抛出异常。
RangeException：PHP5.1起，RuntimeException的子类，在程序运行时出现范围错误时抛出异常，通常除了范围错误同时还有算术错误，是DomainException的运行时版本。
UnderflowException：PHP5.1起，RuntimeException的子类，在空容器上执行无效操作时抛出异常。
```

