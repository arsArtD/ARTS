

## 1. 注册事件

```
app／Providers/EventServicePorvider.php  中添加如下代码： 

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Illuminate\Database\Events\QueryExecuted' => [
            'App\Listeners\QueryListener',
        ],
    ];
}
```

## 2. 添加监听事件
```
public function handle(QueryExecuted $event)
{
    try{
        if (env('APP_DEBUG') == true) {
            $sql = str_replace("?", "'%s'", $event->sql);
            foreach ($event->bindings as $i => $binding) {
                if ($binding instanceof DateTime) {
                    $event->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else {
                    if (is_string($binding)) {
                        $event->bindings[$i] = "'$binding'";
                    }
                }
            }
            $log = vsprintf($sql, $event->bindings);
            $log = $log.'  [ RunTime:'.$event->time.'ms ] ';
            (new Logger('sql'))->pushHandler(new RotatingFileHandler(storage_path('logs/sql/sql.log')))->info($log);
        }
    }catch (Exception $exception){

    }
}
```
