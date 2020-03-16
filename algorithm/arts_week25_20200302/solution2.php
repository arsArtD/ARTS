<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/3/15
 * Time: 22:40
 */
class Solution2 {

    /**
     * @param String $num1
     * @param String $num2
     * @return String
     */
    function multiply($num1, $num2) {
        if($num1 == 0 || $num2 == 0) return "0";
        $arr = array();
        for($i = strlen($num1)-1; $i >= 0; $i--) {
            for($j = strlen($num2)-1; $j >= 0; $j--) {
                $arr[$i+$j] += $num1[$i] * $num2[$j];
            }
        }
        $first = 0;
        for($i = count($arr)-1; $i >= 0; $i--) {
            $tmp = ($arr[$i] + $first) % 10;
            $first = floor(($arr[$i] + $first) / 10);
            $arr[$i] = $tmp;
        }
        ksort($arr);
        $first > 0 ? array_unshift($arr, $first) : $arr;
        return implode('', $arr);
    }
}
