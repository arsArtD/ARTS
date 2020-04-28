

阅读下文有感： 

https://medium.com/@radicalloop/running-multiple-processes-asynchronously-with-php-laravel-15f84aba5abc  


## 同步执行主线程并后台执行 
```
$process = new Process('php ' . base_path('artisan') . ' task:long-running-task &');
$process->setTimeout(0);
$process->run();
```

#  异步执行子线程
```
for ($i = 0; $i < $numberOfProcess; $i++) {
     $process = new Process('php ' . base_path('artisan') . " task {$i}");
     $process->setTimeout(0);
     $process->disableOutput();
     $process->start();
     $processes[] = $process;
}
while (count($processes)) {
  foreach ($processes as $i => $runningProcess) {
    // specific process is finished, so we remove it
    if (! $runningProcess->isRunning()) {
      unset($processes[$i]);
    }
    sleep(1);
  }
}
```
