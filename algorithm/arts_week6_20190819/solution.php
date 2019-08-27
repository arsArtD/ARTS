<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/8/27
 * Time: 21:58
 */

//题目参照 readme.md

class Solution {

    static function getSortStr($str) {
        $temp = str_split($str);
        sort($temp);
        return $temp;
    }

    /**
     * 执行时间80ms左右
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram1($s, $t) {
        return self::getSortStr($s) == self::getSortStr($t);
    }

    /**
     * 执行时间20ms左右
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram($s, $t) {
        $x = array_fill(0,26,0);
        $y = array_fill(0,26,0);
        for($i = 0; $i < strlen($s); $i++) {
            $x[ ord($s[$i]) - ord('a')]++;
        }
        for($j = 0; $j < strlen($t); $j++) {
            $y[ ord($t[$j]) - ord('a')]++;
        }
        //var_dump($y);exit;
        for($k = 0; $k < 26; $k++) {
            if ($x[$k] != $y[$k]) return false;
        }
        return true;
    }
}

//var_dump(ord('b')-ord('a'));
