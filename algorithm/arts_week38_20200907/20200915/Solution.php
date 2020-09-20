<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/15
 * Time: 8:47
 */

class Solution
{
    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString(&$s) {
        $strlen = count($s);
        if($strlen < 2) return $s;
        $i = 0;
        $j = $strlen - 1;
        while($i < $j) {
            $tmp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $tmp;
            $i++;
            $j--;
        }
        return $s;
    }
}
