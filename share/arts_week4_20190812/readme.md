
 使用laravel 来做跨域时建议使用(https://github.com/barryvdh/laravel-cors)
 \Barryvdh\Cors\HandleCors::class
 
 如下文件中：
 app/Http/Kernel.php  
 $middleware 添加  \Barryvdh\Cors\HandleCors::class
 
 
 执行：
 php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"
 
 在config目录下会生成cors.php
 config/cors.php
 
 supportsCredentials-->true 即可。
 
 前端也需要添加 withCredentials为 true
 
