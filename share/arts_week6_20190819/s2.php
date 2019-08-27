<?php

/*
 * 求斐波那契问题的第二种方法--动态规划
 * 从算法的角度，差不多是优化的极限
 * @param n
 */
function fibnacci($n) {
    if ($n <= 0) return 0;
    $a1 = 0;
    $a2 = 1;
    for ($i = 1; $i < $n; $i++) {
        [$a1, $a2] = [$a2, $a1 + $a2];
    }
    return $a2;
}

$time1 = microtime(true);
echo fibnacci(40).PHP_EOL;
$time2 = microtime(true);

echo '耗时'.round($time2-$time1,3).'秒';
