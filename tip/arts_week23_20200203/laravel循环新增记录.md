

如下写法是错误的  

```
$data = [
    ["field_1" => '1', "field_2" => 2],
    ["field_1" => '1', "field_2" => 2],
    ["field_1" => '1', "field_2" => 2]
];
$demoModel = new DemoModel();
foreach($data as $value) {
    $demoModel->field_1 = $value["feild_1"];
    $demoModel->field_2 = $value["feild_2"];
    $demoModel->save();
}
```

正确的写法如下：  

```
$data = [
    ["field_1" => '1', "field_2" => 2],
    ["field_1" => '1', "field_2" => 2],
    ["field_1" => '1', "field_2" => 2]
];

foreach($data as $value) {
    $demoModel = new DemoModel();
    $demoModel->field_1 = $value["feild_1"];
    $demoModel->field_2 = $value["feild_2"];
    $demoModel->save();
}
```
