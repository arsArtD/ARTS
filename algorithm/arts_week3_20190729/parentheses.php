<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2019/8/2
 * Time: 8:48
 */


//https://leetcode-cn.com/problems/valid-parentheses/

$str1 = '()[]';

$str2 = '{([])}';

$str3 = $str1.$str2;

$str4 = '([)]';

$arr = str_split($str);

$len = sizeof($arr);

require_once '../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class solution{

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
    function parentheses($str) {

        $arr = str_split($str);

        $len = sizeof($arr);

        if ($len == 0) return true;

        //奇数情况下括号一定不匹配
        if ($len%2 !=0) return false;

        $temp = [];

        for($i = 0; $i < $len; $i++) {
            if(in_array($arr[$i], ['{','[','('])) {
                $temp[] = $arr[$i];
            } else {
                if (matchMe(end($temp),$arr[$i])){
                    array_pop($temp);
                }
            }
        }

        return sizeof($temp) == 0;
    }
}

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new solution();
    }

    function test1()
    {
        $this->cls->setStr('()');
        $this->assertTrue($this->cls->parentheses($this->cls->getStr()));
    }

    function test2()
    {
        $this->cls->setStr('()[]{}');
        $this->assertTrue($this->cls->parentheses($this->cls->getStr()));
    }

    function test3()
    {
        $this->cls->setStr('(]');
        $this->assertFalse($this->cls->parentheses($this->cls->getStr()));
    }

    function test4()
    {
        $this->cls->setStr('([)]');
        $this->assertFalse($this->cls->parentheses($this->cls->getStr()));
    }

    function test5()
    {
        $this->cls->setStr('({})');
        $this->assertTrue($this->cls->parentheses($this->cls->getStr()));
    }
}