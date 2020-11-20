<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/20
 * Time: 8:51
 */

class Solution1
{

    /**
     * https://leetcode-cn.com/problems/climbing-stairs/solution/pa-lou-ti-by-leetcode-solution/
     * 时间复杂度： O(log(n))
     * 空间复杂度： O(1)
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n) {
        $q = [
            [1,1],
            [1,0]
        ];
        $res = $this->my_pow($q, $n);
        return $res[0][0];
    }


    function my_pow(array $m, int $n) {
        $ret = [
            [1,0],
            [0,1]
        ];
        while($n > 0) {
            if(($n & 1) == 1) {
                $ret = $this->multiply($ret, $m);
            }
            $n >>= 1;
            $m = $this->multiply($m, $m);
        }
        return $ret;
    }

    function multiply(array $m ,array $n) : array {
        $c = [];
        for($i = 0; $i < 2; $i++) {
            for($j = 0; $j < 2; $j++) {
                $c[$i][$j] = $m[$i][0] * $n[0][$j] + $m[$i][1] * $n[1][$j];
            }
        }
        return $c;
    }

}
