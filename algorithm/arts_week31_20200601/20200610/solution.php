<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/6/10
 * Time: 9:28
 */

class Solution
{
    /**
     * @param Integer $x
     * @return Boolean
     */
    function isPalindrome($x) {
        if(!is_int($x)) return false;
        if($x < 0) return false;
        if($x < 10) return true;
        $strX = (string)$x;
        $strXlen = strlen($strX);
        if($strX[$strXlen-1] === '0') return false;
        for($i = 0; $i < $strXlen; $i++) {
            if($strX[$i] != $strX[$strXlen-$i-1]) return false;
        }
        return true;
    }

    function isPalindrome2($x) {
        if(!is_int($x)) return false;
        if($x < 0) return false;
        $rem = 0;
        $y = 0;
        $quo = $x;
        while($quo != 0) {
            $rem = $quo % 10;
            $y = $y * 10 + $rem;
            $quo = floor($quo / 10);
        }
        return $y === $x;
    }
}
