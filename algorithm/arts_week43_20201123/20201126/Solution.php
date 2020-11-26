<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/26
 * Time: 9:00
 */

class Solution
{

    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse($x) {
        $intMax = pow(2, 31) - 1;
        $intMin = -pow(2, 31);

        $xStr = (string)$x;
        $signFlag = in_array($xStr{0}, ['+', '-']);
        if($signFlag) {
            // 去掉先导0
            $temp = preg_replace('/^([0]*)([1-9]?[0-9]+)$/', '${2}', strrev(substr($xStr, 1)));
            $x = $xStr{0}.$temp;
        } else {
            $x = preg_replace('/^([0]*)([1-9]?[0-9]+)$/', '${2}', strrev($xStr));
        }
        if($x < $intMin || $x > $intMax) {
            $x = 0;
        }
        $x = (int)$x;
        return $x;
    }

    function reverse1($x) {
        $max = pow(2, 31);
        $s = (int)strrev(abs($x));
        $result = $x >= 0 ?($s+1 > $max ? 0 : $s):($s > $max ? 0 : '-'. $s);
        $result = (int)$result;
        //var_dump($x, $result);
        return $result;
    }

    /**
     * @ref https://leetcode-cn.com/problems/reverse-integer/solution/zheng-shu-fan-zhuan-by-leetcode/
     * @param $x
     * @return float|int
     */
    function reverse2($x) {
        $rev = 0;
        $intMax = pow(2, 31) - 1;
        $intMin = -pow(2, 31);
        while ($x != 0) {
            $pop = $x % 10;
            $x = (int)($x / 10);
            if ($rev > $intMax/10 || ($rev == $intMax / 10 && $pop > 7)) return 0;
            if ($rev < $intMin/10 || ($rev == $intMin / 10 && $pop < -8)) return 0;
            $rev = $rev * 10 + $pop;
        }
        //var_dump($rev);
        return $rev;
    }
}
