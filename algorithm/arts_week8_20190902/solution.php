<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/9/13
 * Time: 12:14
 */

//题目参照 readme.md

class Solution {


    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersection1($nums1, $nums2) {
        $result = array_intersect($nums1, $nums2);
        return array_unique(array_values($result));
    }

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersection($nums1, $nums2) {
        $temp = array_flip($nums1);
        $u = [];
        foreach ($nums2 as $v) {
            if(isset($temp[$v])) $u[] = $v;
        }
        return array_unique($u);
    }
}

