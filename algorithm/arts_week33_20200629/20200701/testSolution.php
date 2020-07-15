<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/1
 * Time: 9:58
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
        // [1,2,5,3,4,6,7]
        $result = $this->cls->findLength([1,2,3,2,1],[3,2,1,4,7]);
        $this->assertEquals(3, $result);
    }
}
