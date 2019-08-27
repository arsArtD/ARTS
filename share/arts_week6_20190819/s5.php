<?php
/*
 * 求斐波那契问题的第四种解法--矩阵乘法
 * 时间复杂度（logn）
 * @param n
 */
function fibnacci($n) {
    if ($n <= 0) return 0;
    return matrix_mul([ [0,1],[0,0] ], matrix_pow([ [0,1], [1,1] ], $n-1) ) [0][1];
}

/**
 * 二阶矩阵乘法
 * @param $x
 * @param $y
 */
function matrix_mul($x, $y) {
    return [
       [ $x[0][0] * $y[0][0] +   $x[0][1] * $y[1][0],   $x[0][0] * $y[1][0] +   $x[0][1] * $y[1][1] ],
       [ $x[1][0] * $y[0][0] +   $x[1][1] * $y[1][0],   $x[1][0] * $y[0][1] +   $x[1][1] * $y[1][1] ]
    ];
}

/**
 *
 * @param $x
 * @param $n
 */
function matrix_pow($x, $n) {
    $r = [ [1,0], [0,1] ];
    $v = $x;
    while($n) {
        if($n % 2 == 1) {
            $r = matrix_mul($r, $v);
            $n -= 1;
        }
        $v = matrix_mul($v, $v);
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
