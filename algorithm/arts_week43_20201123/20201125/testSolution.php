<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/11/25
 * Time: 8:56
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
        //echo 1%2;exit;
        $cases = [
            ['data' => ["flower","flow","flight"],  'expect' => 'fl'],
            ['data' => ["dog","racecar","car"],  'expect' => '']
        ];
        $caseFuns = ['longestCommonPrefix', 'longestCommonPrefix2', "longestCommonPrefix3", 'longestCommonPrefix4'];
//        $caseFuns = ['longestCommonPrefix'];

        foreach($caseFuns as $caseFun) {
            foreach($cases as $case) {
                self::assertEquals($case['expect'], $this->cls->$caseFun($case['data']));
            }
        }

    }
}
