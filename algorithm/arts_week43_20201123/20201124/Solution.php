<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/24
 * Time: 9:09
 */

class Solution
{
    /**
     * @param Integer $n
     * @return Boolean
     */
    function isPowerOfTwo($n) {
        if(!is_int($n) || $n <= 0) return false;
        if($n == 1) return true;
        if($n % 2 != 0) return false;
        return $this->isPowerOfTwo($n / 2);
    }

    /**
     * https://leetcode-cn.com/problems/power-of-two/solution/2de-mi-by-leetcode/
     * 2的幂--只有一位是1，其余的都是0
     * @param $n
     * @return bool
     */
    function isPowerOfTwo1($n) {
        if(!is_int($n) || $n <= 0) return false;
        return ($n & ($n-1)) === 0;
    }

    function isPowerOfTwo2($n) {
        if(!is_int($n) || $n <= 0) return false;

        $tmp = 1;
        for($i = 0; $i < 63; $i++) {
            if($tmp == $n) {
                return true;
            }
            $tmp <<= 1;
        }
        return false;
    }

    /**
     * 时间复杂度：O(logN)
     * @param $n
     * @return bool
     */
    function isPowerOfTwo3($n) {
        if($n <= 0) return false;
        while($n % 2 == 0) {
            $n /= 2;
        }
        return $n == 1;
    }


    function isPowerOfTwo4($n) {
        return $n > 0 && ($n & -$n) === $n;
    }
}
