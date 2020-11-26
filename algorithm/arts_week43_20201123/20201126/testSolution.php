<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/26
 * Time: 9:00
 */

require_once '../../../vendor/autoload.php';
require_once 'Solution.php';
use PHPUnit\Framework\TestCase;

class testSolution extends TestCase
{
    private $cls;

    public function __construct()
    {
        $this->cls = new Solution();
    }

    function test() {

//        $a = '1010';
//        $b = preg_match('/^([0]*)([1-9]?[0-9]+)$/',strrev($a), $matches);
//        $c = preg_replace('/^([0]*)([1-9]?[0-9]+)$/', '${2}', strrev($a));
//        var_dump($matches, $c);
//        exit;

        //echo 1%2;exit;
        $cases = [
//            ['data' => 123,  'expect' => 321],
            ['data' => -123,  'expect' => -321],
            ['data' => 120,  'expect' => 21],
            ['data' => 901000,  'expect' => 109],
            ['data' => 10,  'expect' => 1],
            ['data' => 1534236469, 'expect' => 0]
        ];
        $caseFuns = ['reverse', 'reverse1', 'reverse2'];
        foreach($caseFuns as $caseFun) {
            foreach($cases as $case) {
                //echo $case['data'].PHP_EOL;
                self::assertTrue($case['expect'] === $this->cls->$caseFun($case['data']));
            }
        }

    }
}
