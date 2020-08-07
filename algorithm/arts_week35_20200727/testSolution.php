<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/20
 * Time: 9:51
 */

require_once '../../vendor/autoload.php';
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
        $result = $this->cls->grayCode(3);
        $this->assertEquals(json_encode([0,1,3,2,6,7,5,4]), json_encode($result));
    }
}
