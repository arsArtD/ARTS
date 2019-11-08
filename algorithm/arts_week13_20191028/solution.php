<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/11/03
 * Time: 22:36
 */

//ini_set('display_errors', 'On');
error_reporting(E_ALL);
//题目参照 readme.md
class Solution {

    /**
     * @param Integer[][] $intervals
     * @return Integer[][]
     */
    function merge($intervals) {
        if(sizeof($intervals) == 0) return $intervals;

        return  $this->subMerge($intervals);
    }

    function subMerge(&$srcArr) {
        if(sizeof($srcArr) > 1) {
            for($i =0; $i<sizeof($srcArr); $i++) {
                //echo $i,PHP_EOL;
                for($j=$i+1; $j<sizeof($srcArr); $j++) {


                    $result = $this->mergeSection($srcArr[$i], $srcArr[$j]);

                    if($result) {
                        //echo json_encode($result).PHP_EOL;
                        //有交集，数组最前面插入合并后的值
                        array_splice($srcArr, $i, 1, [$result]);
                        array_splice($srcArr, $j, 1);
                        $this->subMerge($srcArr);
                    }
                }
            }
        }
        return $srcArr;
    }

    function mergeSection($s1, $s2) {
        //echo json_encode($s1).PHP_EOL;
        //echo json_encode($s2).PHP_EOL.PHP_EOL;
        //没有交集的情况： [1,3]  [4,6];
        //有交集的情况：
        // 情况1： 区间完全包含： [1,3] [2,3];   [2,3] [1,9]
        // 情况2： 区间有部分交集： [1,3] [2,7];   [1,3] [3,4];
        if($s2[0] > $s1[1] || $s1[0] > $s2[1]) {
            return false;
        }
        return [
            min($s1[0], $s2[0]),
            max($s1[1], $s2[1])
        ];
    }
}
