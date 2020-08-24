<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/8/11
 * Time: 8:45
 */


class Automaton
{

    public $sIntMax;
    public $sIntMin;
    public $standard;
    public $state;
    public $sign;
    public $ans;
    public $table;

    public function __construct()
    {
        $this->standard = pow(2,31);
        $this->sIntMax = $this->standard -1;
        $this->sIntMin = -1 * $this->standard;
        $this->state = 'start';
        $this->sign = 1;
        $this->ans = 0;
        $this->table = [
            'start' => ['start', 'signed', 'in_number', 'end'],
            'signed' => ['end', 'end', 'in_number', 'end'],
            'in_number' => ['end', 'end', 'in_number', 'end'],
            'end' => ['end', 'end', 'end', 'end']
        ];
    }

    private function get_col($c) {
        // '' +/- number other
        if(ctype_space($c)) {
            return 0;
        }
        if($c == '+' || $c == '-') {
            return 1;
        }
        if(is_numeric($c)){
            return 2;
        }
        return 3;
    }

    public function get($c) {
        //  需要考虑是否有trim的替代方案----使用ctype_space函数
        //$c = trim($c);
        $this->state = $this->table[$this->state][$this->get_col($c)];
        //echo $c.'===='.$this->state.PHP_EOL;
        if($this->state == 'in_number') {
            $this->ans = $this->ans * 10 + (int)$c;
            $this->ans = $this->sign == 1 ? min($this->ans, $this->sIntMax) : min($this->ans, $this->standard );
        }
        if($this->state == 'signed') {
            $this->sign = $c == '+' ? 1 : -1;
        }
    }

}



class Solution
{

    /**
     * @param String $str
     * @refer: https://leetcode-cn.com/problems/string-to-integer-atoi/solution/zi-fu-chuan-zhuan-huan-zheng-shu-atoi-by-leetcode-/
     * @return Integer
     */
    function myAtoi($str) {
        //return intval($str);
        $autoMaton = new Automaton();
        $strLen = strlen($str);
        //echo $str.PHP_EOL;
        for($i = 0; $i < $strLen; $i++) {
            $autoMaton->get($str[$i]);
        }
        //exit;
        //var_dump($autoMaton->sign, $autoMaton->ans);
        return $autoMaton->sign * $autoMaton->ans;
    }
}

//$s = new Solution();
//$s->myAtoi("    -42");

