<?php
/**
 * Created by PhpStorm.
 * User: ThinkPad
 * Date: 2020/7/20
 * Time: 9:51
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
        $result = $this->cls->uniquePaths(3,2);
        $this->assertEquals(3, $result);

        $result = $this->cls->uniquePaths2(3,2);
        $this->assertEquals(3, $result);
    }
}
