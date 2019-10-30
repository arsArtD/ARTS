<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/10/22
 * Time: 08:56
 */

//题目参照 readme.md
class Solution {

    /**
     * 三路快排算法
     * @param Integer[] $nums
     * @return NULL
     */
    function sortColors(&$nums) {
        $last = sizeof($nums) - 1;
        $middle = 0;
        $first = 0;
        while($middle <= $last) {
            if($nums[$middle] == 2) {
                $temp = $nums[$middle];
                $nums[$middle] = $nums[$last];
                $nums[$last] = $temp;
                $last--;
            } elseif($nums[$middle] == 0) {
                $nums[$first] = 0;
                if($middle > $first)
                    $nums[$middle] = 1;
                $first++;
                $middle++;
            } else {
                $middle++;
            }
        }

        return $nums;
    }
}
