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
     * @param Integer $R---矩阵行数
     * @param Integer $C---矩阵列数
     * @param Integer $r0---选择的行数
     * @param Integer $c0---选择的列数
     * @return Integer[][]
     */
    static function allCellsDistOrder($R, $C, $r0, $c0) {

        $temp = [];

        for ($i=0; $i<$R; $i++) {
            for ($j=0; $j<$C; $j++) {
                $temp[$i.'_'.$j] = abs($i-$r0) + abs($j-$c0);
            }
        }

        asort($temp);
        $result = array_keys($temp);
        return array_map(function($v) {
            $temp = explode('_', $v);
            return array_map(function($v1){  return intval($v1);}, $temp);
        } , $result);
    }
}

//var_dump(ord('b')-ord('a'));
Solution::allCellsDistOrder(3,3,2,2);
