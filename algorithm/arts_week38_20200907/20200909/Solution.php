<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/9
 * Time: 8:43
 */

class Solution {

    /**
     * @ref https://leetcode-cn.com/problems/reverse-words-in-a-string-iii/solution/php-by-kuriv-30/
     * @param $s
     * @return
     */
    function reverseWords($s) {
        $str = '';
        $result = '';

        for($i = 0, $sLen = strlen($s); $i < $sLen; $i++) {
            if($s[$i] == ' ' || $end = $i == $sLen -1) {
                if($end) {
                    $str .= $s[$i];
                }
                for($left = 0, $tlen = strlen($str), $right = $tlen-1; $left < $right; $left++,$right--) {
                    $tmp = $str[$left];
                    $str[$left] = $str[$right];
                    $str[$right] = $tmp;
                }
                $result .= $str;
                if($s[$i] == ' ') {
                    $result .= ' ';
                }
                $str = '';
            } else {
                $str .= $s[$i];
            }
        }

        return $result;
    }


}
