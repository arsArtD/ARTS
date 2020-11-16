<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/11
 * Time: 8:42
 */

class Solution
{
    /**
     * @ref https://leetcode-cn.com/problems/maximum-subarray/solution/zui-da-zi-xu-he-by-leetcode-solution/
     * 动态规划问题
     * 时间复杂度：O(n)，其中 n 为 nums 数组的长度。我们只需要遍历一遍数组即可求得答案。
     * 空间复杂度：O(1)。我们只需要常数空间存放若干变量。
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        $pre = 0;
        $maxAns = $nums[0];
        foreach($nums as $index => $num) {
            $pre = max($pre + $num, $num);
            echo sprintf('curr index: %s, curr num: %s, currpre: %s'.PHP_EOL, $index, $num, $pre);
            $maxAns = max($maxAns, $pre);
        }
        return $maxAns;
    }
}
