<?php

/*
 * 求斐波那契问题的第三种方法--通项公式的优化
 * 时间复杂度（logn）
 * @param n
 */
function fibnacci($n) {
  return ( myPow( (1 + sqrt(5))/2, $n) - myPow( (1-sqrt(5))/2, $n) ) / sqrt(5);
}

/**
 * 计算指数
 * @param $x
 * @param $n
 * @return int
 */
function myPow($x, $n) {
    $r = 1;
    $v = $x;
    while($n) {
        if ($n %2 == 1) {
            $r *= $v;
            $n -= 1;
        }
        $v = $v * $v;
        $n = $n / 2;
    }
    return $r;
}

$time1 = microtime(true);
echo fibnacci(60).PHP_EOL;
$time2 = microtime(true);

echo '耗时'.round($time2-$time1,3).'秒';

//40 ----  1 0233 4155
//60 ----  1 548 008 755 920
