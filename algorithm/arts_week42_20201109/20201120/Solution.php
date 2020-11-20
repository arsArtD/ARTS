<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/20
 * Time: 8:51
 */

class Solution
{

    /**
     * f(x) = f(x-1) + f(x-2) 可能跨了一级台阶，也可能跨了两级台阶
     * 时间复杂度： O(n)
     * 空间复杂度： O(1)
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n) {
        $q = 0;
        $r = 1;
        for($i = 1; $i <= $n; $i++) {
            $p = $q;
            $q = $r;
            $r = $p + $q;
        }
        return $r;
    }

    /**
     * 通项公式, 因为有浮点数运算，可能会有误差
     * 时间复杂度（O(logn))
     * 空间复杂度（O(1)）
     * @param $n
     * @return
     */
    function climbStairs1($n) {
        $sqrt5 = sqrt(5);
        $fibn = pow((1+ $sqrt5) / 2, $n+1) - pow((1-$sqrt5) / 2, $n + 1);
        return intval($fibn/ $sqrt5);
    }
}
