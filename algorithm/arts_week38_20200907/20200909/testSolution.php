<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/9/9
 * Time: 8:43
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

    function test1()
    {
        $okReverseStr = "s'teL ekat edoCteeL tsetnoc";
        $reverseStr = $this->cls->reverseWords("Let's take LeetCode contest");
        $this->assertEquals($okReverseStr, $reverseStr);
    }

}
