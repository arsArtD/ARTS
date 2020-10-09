<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/28
 * Time: 8:50
 */

class Solution
{
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function singleNumber($nums) {
        $single = 0;
        foreach($nums as $num) {
            $single ^= $num;
        }
        return $single;
    }
}
