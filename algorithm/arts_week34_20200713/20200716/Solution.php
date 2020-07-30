<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/16
 * Time: 9:46
 */

class Solution
{
    /**
     * 排配组合
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths($m, $n) {
        return $this->C($m+$n-2, $m-1);
    }


    /**
     * 动态规划
     * 题解参照： https://leetcode-cn.com/problems/unique-paths/solution/dong-tai-gui-hua-by-powcai-2/
     * 杨辉三角形，每个位置的路径 = 该位置左边的路径 + 该位置上边的路径
     * @param Integer $m
     * @param Integer $n
     * @return Integer
     */
    function uniquePaths2($m, $n) {
        $cur = array_fill(0, $n, 1);
        for($i = 1; $i < $m; $i++) {
            for($j = 1; $j < $n; $j++) {
                $cur[$j] += $cur[$j-1];
            }
        }
        return $cur[$n-1];
    }


    function factorial($n) {
        if($n <= 0)  return 1;
        //array_product 计算并返回数组的乘积
        //range 创建一个包含指定范围的元素的数组
        return array_product(range(1, $n));
    }

    function C($m, $n) {
        //return int(math.factorial(m+n-2)/math.factorial(m-1)/math.factorial(n-1))
        return $this->factorial($m)/($this->factorial($n) * $this->factorial($m-$n));
    }

}
