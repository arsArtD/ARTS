<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/27
 * Time: 8:56
 */

class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement($nums)
    {
        sort($nums);
        return $nums[floor(count($nums) / 2)];
    }

    function majorityElement2($nums)
    {
        // 内置函数
        $count = array_count_values($nums);
        return array_search(max($count), $count);
    }

    function majorityElement3($nums)
    {
        // hash table
        $hash = [];
        foreach ($nums as $num) {
            if (!isset($hash[$num])) $hash[$num] = 0;
            $hash[$num]++;
        }
        return array_search(max($hash), $hash);
    }

    /**
     *  摩尔投票法：

        核心就是对拼消耗。

        玩一个诸侯争霸的游戏，假设你方人口超过总人口一半以上，并且能保证每个人口出去干仗都能一对一同归于尽。最后还有人活下来的国家就是胜利。

        那就大混战呗，最差所有人都联合起来对付你（对应你每次选择作为计数器的数都是众数），或者其他国家也会相互攻击（会选择其他数作为计数器的数），但是只要你们不要内斗，最后肯定你赢。

        最后能剩下的必定是自己人。
     *
     * @param $nums
     * @return mixed
     */
    function majorityElement4($nums)
    {
        // Stack 开心消消乐
        $stack = [];
        foreach ($nums as $num) {
            if (empty($stack) || end($stack) == $num) {
                $stack[] = $num;
            } else {
                array_pop($stack);
            }
        }

        return end($stack);
    }

}
