<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/28
 * Time: 12:21
 */

class Solution
{
    /**
     * @ref https://leetcode-cn.com/problems/container-with-most-water/solution/sheng-zui-duo-shui-de-rong-qi-by-leetcode-solution/
     * @param Integer[] $height
     * @return Integer
     */
    function maxArea($height) {
        $left = 0;
        $right = count($height) -1;
        $ans = 0;

        while($left < $right) {
            $area = min($height[$left], $height[$right]) * ($right - $left);
            $ans = max($ans, $area);
            if($height[$left] <= $height[$right]) {
                ++$left;
            } else {
                --$right;
            }
        }

        return $ans;
    }
}
