

## 解析字符串 
```
use Symfony\Component\Yaml\Yaml;

$value = Yaml::parse("foo: bar");
// $value = ['foo' => 'bar']
```

## 捕获解析yaml异常  
```
use Symfony\Component\Yaml\Exception\ParseException;

try {
    $value = Yaml::parse('...');
} catch (ParseException $exception) {
    printf('Unable to parse the YAML string: %s', $exception->getMessage());
}
```


## 解析yaml文件  
```
use Symfony\Component\Yaml\Yaml;

$value = Yaml::parseFile('/path/to/file.yaml');
```


## yaml中写内容 
```
use Symfony\Component\Yaml\Yaml;

$array = [
    'foo' => 'bar',
    'bar' => ['foo' => 'bar', 'bar' => 'baz'],
];

$yaml = Yaml::dump($array);

file_put_contents('/path/to/file.yaml', $yaml);
```

更多使用方法参见：  
https://symfony.com/doc/current/components/yaml.html   
