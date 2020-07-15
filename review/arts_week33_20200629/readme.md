

https://github.com/coolseven/notes/blob/master/thinkphp-queue/README.md



# queue:listen的代码实现


## controller
```
public function testJob() {

     // 1.当前任务将由哪个类来负责处理。
     //   当轮到该任务时，系统将生成一个该类的实例，并调用其 fire 方法
     $jobHandlerClassName  = 'app\job\Hello';

     // 2.当前任务归属的队列名称，如果为新队列，会自动创建
     $jobQueueName  	  = "helloJobQueue";

     // 3.当前任务所需的业务数据 . 不能为 resource 类型，其他类型最终将转化为json形式的字符串
     //   ( jobData 为对象时，存储其public属性的键值对 )
     $jobData       	  = [ 'ts' => time(), 'bizId' => uniqid() , 'a' => 1 ] ;

     // 4.将该任务推送到消息队列，等待对应的消费者去执行
     $isPushed = Queue::push( $jobHandlerClassName , $jobData , $jobQueueName );

     // database 驱动时，返回值为 1|false  ;   redis 驱动时，返回值为 随机字符串|false
     if( $isPushed !== false ){
         echo date('Y-m-d H:i:s') . " a new Hello Job is Pushed to the MQ"."<br>";
     }else{
         echo 'Oops, something went wrong.';
     }
 }

```


## job
```
namespace app\job;


use think\queue\Job;

class Hello
{
    const MAX_TRY_TIMES = 3;

    /**
     * fire方法是消息队列默认调用的方法
     * @param Job            $job      当前的任务对象
     * @param array|mixed    $data     发布任务时自定义的数据
     */
    public function fire(Job $job,$data)
    {
        // 有些消息在到达消费者时,可能已经不再需要执行了
        $isJobStillNeedToBeDone = $this->checkDatabaseToSeeIfJobNeedToBeDone($data);
        if(!$isJobStillNeedToBeDone){
            $job->delete();
            return;
        }

        $isJobDone = $this->doHelloJob($data);

        if ($isJobDone['code'] == 0) {
            // 如果任务执行成功， 记得删除任务
            $job->delete();
            print("<info>Hello Job has been done and deleted"."</info>\n");
        }else{
            if ($job->attempts() > self::MAX_TRY_TIMES) {
                // 通过这个方法可以检查这个任务已经重试了几次了
                print("<warn>Hello Job has been retried more than 3 times!"."</warn>\n");
                $job->delete();
            } else {
                // 也可以重新发布这个任务
                print("<info>Hello Job will be availabe again after 2s."."</info>\n");
                $job->release(2); //$delay为延迟时间，表示该任务延迟2秒后再执行
            }
        }
    }

    /**
     * 有些消息在到达消费者时,可能已经不再需要执行了
     * @param array|mixed    $data     发布任务时自定义的数据
     * @return boolean                 任务执行的结果
     */
    private function checkDatabaseToSeeIfJobNeedToBeDone($data){
        return true;
    }

    /**
     * 根据消息中的数据进行实际的业务处理...
     */
    private function doHelloJob($data)
    {
        print("<info>Hello Job Started. job Data is: ".var_export($data,true)."</info> \n");
        print("<info>Hello Job is Fired at " . date('Y-m-d H:i:s') ."</info> \n");
        print("<info>Hello Job is Done!"."</info> \n");
        // sleep(2);  可以用来测试队列超时
        return ['code' => 0];  // 表示业务成功
        return ['code' => 1001]; // 表示业务失败需要重新执行
    }
}
```

## queue的相关配置
```
[queue]
connector = Redis
expire = 60
default = default
host = localhost
port = 6379
password =
select = 1
timeout = 0
persistent = false
```

## 测试例子
```
php think queue:listen --queue=helloJobQueuephp 
think queue:listen --queue=helloJobQueue  --timeout=10

```
