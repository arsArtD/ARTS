<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/6
 * Time: 8:33
 */

class Solution
{
    /**
     * @param Integer[] $nums
     * @return Boolean true-->有重复元素
     */
    function containsDuplicate($nums) {
        $uniqArr = array_unique($nums);
        return count($uniqArr) != count($nums);
    }

    /**
     * 本方法在 Leetcode 上会超时。一般而言，如果一个算法的时间复杂度为 O(n^2)
     * 它最多能处理的n大约为10^4,当n接近10^5时就会超时
     * @ref https://leetcode-cn.com/problems/contains-duplicate/solution/cun-zai-zhong-fu-yuan-su-by-leetcode/
     * @param $nums
     * @return bool
     */
    function containsDuplicate1($nums) {
       foreach($nums as $i => $num) {
           for($j = 0; $j < $i; $j++) {
               if($nums[$j] == $nums[$i])  return true;
           }
       }
       return false;
    }

    /**
     * 时间复杂度 nlong(n)
     * @param $nums
     * @return bool
     */
    function containsDuplicate2($nums) {
        sort($nums);
        $len = count($nums) - 1;
        for($i = 0; $i < $len; $i++) {
            if($nums[$i] == $nums[$i+1])  return true;
        }
        return false;
    }

    /**
     * 时间复杂度O(n)
     * @param $nums
     * @return bool
     */
    function containsDuplicate3($nums) {
        $map = [];
        foreach($nums as $num) {
            if(isset($map[$num])) return true;
            $map[$num] = 1;
        }
        return false;
    }
}
