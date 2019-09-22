<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/9/22
 * Time: 22:29
 */

//题目参照 readme.md

class Solution {


    /**
     * @param Integer[] $A
     * @return Integer
     */
    function largestPerimeter($A) {
        rsort($A);
        $tsize = count($A);
        if ($tsize < 3) return 0;
        return self::validateTriagle($A);
    }

    public static function validateTriagle($arr) {
        $result = 0;
        while(sizeof($arr) >= 3) {
            if ($arr[0]+$arr[1] > $arr[2] && $arr[0]+$arr[2] > $arr[1] && $arr[1]+$arr[2] > $arr[0]) {
                $result = $arr[0]+$arr[1]+$arr[2];
                break;
            }
            array_splice($arr,0,1);
        }
        return $result;
    }
}

//Solution::largestPerimeter([1,2,1]);
echo Solution::largestPerimeter([3,6,2,3]); //输出： 8

