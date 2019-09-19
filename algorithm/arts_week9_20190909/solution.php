<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/9/17
 * Time: 13:04
 */

//题目参照 readme.md

class Solution {


    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    public function intersect($nums1, $nums2) {
        $nums1 = self::staticNum($nums1);
        $nums2 = self::staticNum($nums2);
        $resultKey = array_values(array_intersect(array_keys($nums1), array_keys($nums2)));
        $result = [];
        foreach($resultKey as $key=>$value){
            $dupNums = min($nums1[$value],$nums2[$value]);
            $fill = array_fill(0,$dupNums,$value);
            foreach($fill as $fillk=>$fillv) {
                $result[] = $fillv;
            }
        }
        return $result;
    }

    public static function staticNum($nums) {
        $hashSetArr = [];
        for($i=0; $i<sizeof($nums); $i++) {
            if(!isset($hashSetArr[$nums[$i]])) {
                $hashSetArr[$nums[$i]] = 1;
            } else {
                $hashSetArr[$nums[$i]]++;
            }
        }
        return $hashSetArr;
    }
}
