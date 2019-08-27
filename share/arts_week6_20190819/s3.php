<?php

/*
 * 求斐波那契问题的第三种方法--通项公式
 * 从算法的角度，差不多是优化的极限
 * @param n
 */
function fibnacci($n) {
  return ( pow( (1 + sqrt(5))/2, $n) - pow( (1-sqrt(5))/2, $n) ) / sqrt(5);
}

$time1 = microtime(true);
echo fibnacci(60).PHP_EOL;
$time2 = microtime(true);

echo '耗时'.round($time2-$time1,3).'秒';

//40 ----  1 0233 4155
//60 ----  1 548 008 755 920
