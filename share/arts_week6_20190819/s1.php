<?php

/*
 * 求斐波那契问题的第一种常规方法
 * @param n
 */
function fibnacci($n) {
    if ($n <= 0) return 0;
    if ($n == 1) return 1;
    return fibnacci($n-2) + fibnacci($n-1);
}

$time1 = microtime(true);
echo fibnacci(30).PHP_EOL;
$time2 = microtime(true);

echo '耗时'.round($time2-$time1,3).'秒';

//fibnacci(34)----13秒
//fibnacci(30)----2秒
