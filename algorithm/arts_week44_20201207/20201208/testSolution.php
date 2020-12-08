<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/12/8
 * Time: 9:05
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
            ['data' => 3,  'expect' => [ [1,2,3], [8,9,4], [7,6,5] ]],
            ['data' => 2,  'expect' => [ [1,2], [4,3]]]
        ];
        $caseFuns = ['generateMatrix'];
        foreach($caseFuns as $caseFun) {
            foreach($cases as $case) {
                //echo $case['data'].PHP_EOL;
                self::assertTrue(json_encode($case['expect']) === json_encode($this->cls->$caseFun($case['data'])) );
            }
        }

    }

    function testArr() {
       $t = [
           [
               0 => 1,
               1 => 2,
               2 => 3
           ],
           [
               2 => 4,
               0 => 8,
               1 => 9
           ],
           [
               2 => 5,
               1 => 6,
               0 => 7
           ]
       ];
       foreach($t as &$row) {
           ksort($row);
       }
       print_r($t);
    }
}
