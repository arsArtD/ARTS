<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/8/2
 * Time: 8:48
 */

//https://leetcode-cn.com/problems/valid-parentheses/

class Solution{

    private $str = '';

    /**
     * @return string
     */
    public function getStr()
    {
        return $this->str;
    }

    /**
     * @param string $str
     */
    public function setStr($str)
    {
        $this->str = $str;
    }

    function matchMe($a, $b) {
        return in_array($a.$b,   ['()', '[]', '{}']);
    }

    /**
     * @param $str
     */
    function isValid($str) {

        if (empty($str)) return true;

        $arr = str_split($str);

        $len = sizeof($arr);

        //奇数情况下括号一定不匹配
        if ($len%2 !=0) return false;

        $temp = [];

        for($i = 0; $i < $len; $i++) {
            if(in_array($arr[$i], ['{','[','('])) {
                $temp[] = $arr[$i];
            } else {
                if ($this->matchMe(end($temp),$arr[$i])){
                    array_pop($temp);
                }
            }
        }

        return sizeof($temp) == 0;
    }
}

