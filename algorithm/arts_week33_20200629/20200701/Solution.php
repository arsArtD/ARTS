<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/1
 * Time: 9:31
 */

class Solution
{
    /**
     * 动态规划算法
     * @param Integer[] $A
     * @param Integer[] $B
     * @return Integer
     */
    function findLength($A, $B)
    {
        $alen = count($A);
        $blen = count($B);
        $ans = 0;
        $dp = [];

        for($i = $alen -1; $i >=0; $i--) {
            for($j = $blen-1; $j >=0; $j--) {
                $dp[$i][$j] = $A[$i] == $B[$j] ? $dp[$i+1][$j+1] + 1 :0;
                $ans = max($ans, $dp[$i][$j]);
            }
        }
        return $ans;
    }
}

