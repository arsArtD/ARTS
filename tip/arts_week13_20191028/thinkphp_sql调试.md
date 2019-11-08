


dababase.php 中修改debug对应的值为true

app_debug和app_trace设置为true  

打印出的日志在 runtime/log目录下   

如果获取单行的sql：  User::fetchSql->find(1);  这样不会执行，sql,而只会返回sql;  

