<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/8
 * Time: 8:48
 */

class Solution
{
    /**
     * @ref https://leetcode-cn.com/problems/spiral-matrix-ii/solution/spiral-matrix-ii-mo-ni-fa-she-ding-bian-jie-qing-x/
     * @param Integer $n
     * @return Integer[][]
     */
    function generateMatrix($n) {
        $l = 0; // left
        $r = $n-1; // right
        $t = 0; // top
        $b = $n -1; // bottom
        $mat = [];
        $num  = 1;
        $tar = $n * $n;
        while($num <= $tar) {
            for($i = $l; $i <= $r; $i++) $mat[$t][$i] = $num++; // left to right.
            $t++;
            for($i = $t; $i <= $b; $i++) $mat[$i][$r] = $num++; // top to bottom.
            $r--;
            for($i = $r; $i >= $l; $i--) $mat[$b][$i] = $num++; // right to left.
            $b--;
            for($i = $b; $i >= $t; $i--) $mat[$i][$l] = $num++; // bottom to top.
            $l++;
        }
        foreach($mat as &$row) {
            ksort($row);
        }
        //print_r($mat);
        return $mat;
    }
}
