

使用laravel migration命令的时候，特别需要注意不要使用 php artisan migrate:fresh, 该命令会删除已经生成的表  

使用migrate的时候一定要再三确认是否连接的是本地数据库  

如果要在线上使用，需要每个开发者都遵循 migrate 的使用规则  
